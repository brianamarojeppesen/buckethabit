<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     class Faqs_model
               extends CI_Model
     {

          public
          function __construct ()
          {

               $this->load->database ();
          }

          /**
           * @param bool|false $live
           *
           * @return mixed
           */
          public
          function get_faqs (
                    $live = NULL, $id = NULL
          ) {

               if ( $live === NULL )
               {
                    if (isset($id)) {
                         $query = $this->db->get_where ( 'faqs' , [ 'id' => $id ] );
                         return $query->row_array();
                    } else
                    {
                         $query = $this->db->get ( 'faqs' );

                         return $query->result_array ();
                    }
               }

               $query = $this->db->get_where ( 'faqs' , [ 'live' => $live ] );

               return $query->result_array ();
          }

          public
          function set_faqs ()
          {

               $data = [
                         'question' => $this->input->post ( 'question' ) ,
               ];

               return $this->db->insert ( 'faqs' , $data );

          }

          public
          function update_faq ()
          {

               $data = [
                         'question' => $this->input->post ( 'question' ) ,
                         'answer' => $this->input->post ( 'answer' ) ,
                         'live' => $this->input->post ( 'live' ) == 'on' ,
               ];

               return $this->db->update('faqs', $data, [ 'id' => $this->input->post('id')]);

          }

     }