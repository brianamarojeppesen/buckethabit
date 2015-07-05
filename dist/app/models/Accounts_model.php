<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     class Accounts_model
               extends CI_Model
     {

          public function validate()
          {
               $query = $this->db->get_where ( 'accounts' , [
                         'username' => $this->input->post('signin_form_username')
               ] );

               $row = $query->row_array();

               if ($row && password_verify($this->input->post('signin_form_password') , $row['password']))
               {
                    return $row;
               }
          }

          public function create_account()
          {
               $new_account_insert_data = array(
                    'first_name' => $this->input->post('signup_form_first_name'),
                    'last_name' => $this->input->post('signup_form_last_name'),
                    'email' => $this->input->post('signup_form_email'),
                    'username' => $this->input->post('signup_form_username'),
                    'password' => password_hash($this->input->post('signup_form_password'), PASSWORD_DEFAULT),
                    'lost_password_question_1' => $this->input->post('signup_form_lost_password_question_1'),
                    'lost_password_answer_1' => $this->input->post('signup_form_lost_password_answer_1'),
                    'lost_password_question_2' => $this->input->post('signup_form_lost_password_question_2'),
                    'lost_password_answer_2' => $this->input->post('signup_form_lost_password_answer_2'),
                    'lost_password_question_3' => $this->input->post('signup_form_lost_password_question_3'),
                    'lost_password_answer_3' => $this->input->post('signup_form_lost_password_answer_3')
               );

               return $this->db->insert('accounts', $new_account_insert_data);
          }

          public
          function get_accounts (
                    $username = NULL
          ) {

               if (isset($username)) {
                    $query = $this->db->get_where ( 'accounts' , [ 'username' => $username ] );
                    return $query->row_array();
               } else
               {
                    $query = $this->db->get ( 'accounts' );
                    return $query->result_array ();
               }
          }

//          public
//          function set_faqs ()
//          {
//
//               $data = [
//                         'question' => $this->input->post ( 'question' ) ,
//               ];
//
//               return $this->db->insert ( 'faqs' , $data );
//
//          }
//
//          public
//          function update_faq ()
//          {
//
//               $data = [
//                         'question' => $this->input->post ( 'question' ) ,
//                         'answer' => $this->input->post ( 'answer' ) ,
//                         'live' => $this->input->post ( 'live' ) == 'on' ,
//               ];
//
//               return $this->db->update('faqs', $data, [ 'id' => $this->input->post('id')]);
//
//          }

     }