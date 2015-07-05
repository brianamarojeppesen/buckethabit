<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     /**
      * Class Faqs
      *
      * @property Faqs_model $faqs_model
      */
     class Faqs extends CI_Controller {

          /**
           * Faqs constructor.
           */
          public
          function __construct ()
          {
               parent::__construct();
               $this->load->model('faqs_model');
               $this->load->library('layouts');
          }

          public
          function index ()
          {
               $this->answered();
          }

          public
          function answered ()
          {
               $data[ 'faqs' ]  = $this->faqs_model->get_faqs (TRUE);
               $this->layouts->set_title('FAQS');
               $this->layouts->view('faqs/index', $data);
          }

          public
          function unanswered ()
          {
               $data[ 'faqs' ]  = $this->faqs_model->get_faqs (FALSE);
               $this->layouts->set_title('Unanswered FAQS');
               $this->layouts->view('faqs/index', $data);
          }

          public
          function all ()
          {
               $data[ 'faqs' ]  = $this->faqs_model->get_faqs ();
               $this->layouts->set_title('FAQS');
               $this->layouts->view('faqs/index', $data);
          }

          public
          function ask ()
          {
               $this->load->helper ( 'form' );
               $this->load->library ( 'form_validation' );

               $this->form_validation->set_rules ( 'question' , 'Question' , 'trim|required' );

               if ( $this->form_validation->run () === FALSE )
               {
                    $this->layouts->set_title('Ask a question');
                    $this->layouts->view('faqs/ask');
               }
               else
               {
                    $this->faqs_model->set_faqs ();
                    $this->layouts->set_title('Success');
                    $this->layouts->view('faqs/added');
               }
          }

          public
          function answer (
               $id = NULL
          )
          {

                    $data[ 'faq' ]  = $this->faqs_model->get_faqs (NULL, $id);

                    $this->load->helper ( 'form' );
                    $this->load->library ( 'form_validation' );

                    $this->form_validation->set_rules ( 'question' , 'Question' , 'trim|required' );
               $this->form_validation->set_rules ( 'answer' , 'Answer' , 'trim|required' );

                    if ( $this->form_validation->run () === FALSE )
                    {
                         $this->layouts->set_title('Answer question');
                         $this->layouts->view('faqs/answer', $data);
                    }
                    else
                    {
                         $this->faqs_model->update_faq ();
                         $this->layouts->set_title('Success');
                         $this->layouts->view('faqs/answered');
                    }
          }
     }