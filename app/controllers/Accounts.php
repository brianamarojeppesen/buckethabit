<?php if ( ! defined ( 'BASEPATH' ) )
{
     exit( 'No direct script access allowed' );
}

     /**
      * Class Accounts
      *
      * @property Accounts_model $accounts_model
      */
     class Accounts
               extends MY_Controller
     {

          public
          function validate_credentials ()
          {

               $this->load->model ( 'accounts_model' );
               $query = $this->accounts_model->validate ();

               if ( $query ) // if the user's credentials validated...
               {
                    $this->session->username = $this->input->post ( 'signin_form_username' );
                    $this->session->is_logged_in = TRUE;
                    $this->session->is_admin = $query['is_admin'];

                    if ($this->input->post('ajax')) {
                         $data['response_type'] = 'success';
                         $data['redirect'] = base_url().'bucket';
                         $data['update_menu'] = true;
                         $this->layouts->view ( null , $data , 'json' );
                    } else
                    {
                         redirect ( 'bucket' );
                    }
               }
               else
               {
                    if ($this->input->post('ajax')) {
                         $data['response_type'] = 'error';
                         $data['changes'] = [
                              [
                                        'target' => '#signin_form_error',
                                        'content' => "Invalid login information."
                              ]
                         ];
                         $this->layouts->view ( null , $data , 'json' );
                    } else
                    {
                         redirect ( '' );
                    }
               }
          }

          public
          function signout ()
          {

               unset($this->session->username);
               $this->session->is_logged_in = false;
               $this->session->sess_destroy ();

               if ($this->input->post('ajax')) {
                    $data['redirect'] = base_url();
                    $data['update_menu'] = true;
                    $this->layouts->view ( null , $data , 'json' );
               } else
               {
                    redirect ( '' );
               }
          }

          public
          function signup ()
          {

               $this->load->helper ( 'form' );
               $this->layouts->set_title ( 'Sign Up' );

               $data[ 'signup_form_first_name' ] = $this->security->xss_clean($this->input->post ( 'signup_form_first_name' ));
               $data[ 'signup_form_last_name' ]  = $this->security->xss_clean($this->input->post ( 'signup_form_last_name' ));
               $data[ 'signup_form_email' ]      = $this->security->xss_clean($this->input->post ( 'signup_form_email' ));
               $data[ 'signup_form_username' ]   = $this->security->xss_clean($this->input->post ( 'signup_form_username' ));
               $data[ 'signup_form_lost_password_question_1' ]   = $this->security->xss_clean($this->input->post ( 'signup_form_lost_password_question_1' ));
               $data[ 'signup_form_lost_password_question_2' ]   = $this->security->xss_clean($this->input->post ( 'signup_form_lost_password_question_2' ));
               $data[ 'signup_form_lost_password_question_3' ]   = $this->security->xss_clean($this->input->post ( 'signup_form_lost_password_question_3' ));

               if ( $this->input->post ( 'ajax' ) && ( ! $this->input->post ( 'test' ) ) )
               {
                    $this->layouts->view ( 'accounts/signup' , $data , 'json' );
               }
               elseif ( $this->input->post ( 'ajax' ) && $this->input->post ( 'test' ) )
               {
                    $data['changes'] = [];

                    if (form_error($this->input->post ( 'test_field' ))) {
                         $data['changes'][] = [
                                   'target' => '#'.$this->input->post ( 'test_field' ).'_error',
                                   'content' => form_error($this->input->post ( 'test_field' ))
                         ];
                    } else {
                         $data['changes'][] = [
                                   'target' => '#'.$this->input->post ( 'test_field' ).'_error',
                                   'content' => ''
                         ];
                    }

                    $data['changes'][] = [
                         'target' => '#signup_form_bucket_csrf_token',
                         'value' => $this->security->get_csrf_hash()
                    ];

                    $this->layouts->view ( null , $data , 'json' );
               }
               else
               {
                    $this->layouts->view ( 'accounts/signup' , $data );
               }
          }

          public
          function create_account ()
          {

               $this->load->library ( 'form_validation' );
               // field name, error message, validation rules
               $this->form_validation->set_rules (
                         'signup_form_first_name' ,
                         'First name' ,
                         [
                              'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_last_name' ,
                         'Last name' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_email' ,
                         'Email' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required', 'valid_email',
                                   'is_unique[accounts.email]'
                         ],
                         [
                                   'required'    => '{field} must be provided.' ,
                                   'valid_email' => '{field} is invalid.' ,
                                   'is_unique'   => '{field} already in use.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );

               $this->form_validation->set_rules (
                         'signup_form_username' ,
                         'Username' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required', 'min_length[4]',
                                   'is_unique[accounts.username]', 'alpha_numeric'
                         ],
                         [
                                   'required'      => '{field} must be provided.' ,
                                   'min_length'    => '{field} must be at least {param} characters long.' ,
                                   'is_unique'     => '{field} already in use.' ,
                                   'alpha_numeric' => '{field} must contain only alpha-numeric characters.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_password' ,
                         'Password' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required', 'min_length[4]',
                                   'max_length[32]'
                         ],
                         [
                                   'required'   => '{field} must be provided.' ,
                                   'min_length' => '{field} must be 4-32 characters long.' ,
                                   'max_length' => '{field} must be 4-32 characters long.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_password2' ,
                         'Password confirmation' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required', 'matches[signup_form_password]'
                         ],
                         [
                                   'required' => '{field} must be provided.' ,
                                   'matches'  => '{field} must match Password.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );

               $this->form_validation->set_rules (
                         'signup_form_lost_password_question_1' ,
                         'Question 1' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_lost_password_answer_1' ,
                         'Answer 1' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_lost_password_question_2' ,
                         'Question 2' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_lost_password_answer_2' ,
                         'Answer 2' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_lost_password_question_3' ,
                         'Question 3' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );
               $this->form_validation->set_rules (
                         'signup_form_lost_password_answer_3' ,
                         'Answer 3' ,
                         [
                                   'trim', ['xss_clean', [$this->security, 'xss_clean']], 'required'
                         ],
                         [
                                   'required' => '{field} must be provided.',
                                   'xss_clean' => '{field} has errors.'
                         ]
               );

               if ( $this->form_validation->run () == FALSE )
               {
                    $this->signup ();
               }
               else
               {
                    $this->load->model ( 'accounts_model' );
                    if ( $query = $this->accounts_model->create_account () && ( ! $this->input->post ( 'test' ) ) )
                    {
                         $this->layouts->set_title ( 'Sign Up Successful' );

                         if ( $this->input->post ( 'ajax' ) )
                         {
                              $this->layouts->view ( 'accounts/signup_successful' , NULL , 'json' );
                         }
                         else
                         {
                              $this->layouts->view ( 'accounts/signup_successful' );
                         }
                    }
                    else
                    {
                         $this->signup ();
                    }
               }
          }

          public
          function index ()
          {
               if ($this->is_logged_in(TRUE) && $this->session->username) {
                    $this->view($this->session->username);
               } else {
                    show_404();
               }
          }

          public
          function view ($username = null)
          {
               if (($username && $username == $this->session->username) || $this->session->is_admin)
               {
                    $this->load->model ( 'accounts_model' );

                    $data[ 'accounts_response' ] = $this->accounts_model->get_accounts ( $username );

                    if ( empty( $data[ 'accounts_response' ] ) )
                    {
                         show_404 ();
                    }

                    if (isset($data['accounts_response']['username'])) {
                         $this->layouts->set_title ( $data[ 'accounts_response' ][ 'username' ] );
                         if ( $this->input->post ( 'ajax' ) ) {
                              $this->layouts->view ( 'accounts/view' , $data, 'json' );
                         } else
                         {
                              $this->layouts->view ( 'accounts/view' , $data );
                         }
                    } else {
                         $this->layouts->set_title ( 'Accounts' );
                         if ( $this->input->post ( 'ajax' ) ) {
                              $this->layouts->view ( 'accounts/list' , $data, 'json' );
                         } else
                         {
                              $this->layouts->view ( 'accounts/list' , $data );
                         }
                    }
               } else {
                    show_404();
               }
          }
     }