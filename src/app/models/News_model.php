<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     class News_model
               extends CI_Model
     {

          public
          function __construct ()
          {

               $this->load->database ();
          }

          /**
           * @param bool|false $slug
           *
           * @return mixed
           */
          public
          function get_news (
                    $slug = FALSE
          ) {

               if ( $slug === FALSE )
               {
                    $query = $this->db->get ( 'news' );

                    return $query->result_array ();
               }

               $query = $this->db->get_where ( 'news' , [ 'slug' => $slug ] );

               return $query->row_array ();
          }

          public
          function set_news ()
          {

               $this->load->helper ( 'url' );

               $slug = url_title ( $this->input->post ( 'title' ) , 'dash' , TRUE );

               $data = [
                         'title' => $this->input->post ( 'title' ) ,
                         'slug'  => $slug ,
                         'text'  => $this->input->post ( 'text' ) ,
               ];

               return $this->db->insert ( 'news' , $data );
          }

     }