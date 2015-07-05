<?php if ( ! defined ( 'BASEPATH' ) )
{
     exit( 'No direct script access allowed' );
}

     class Bucket
               extends MY_Controller
     {

          public $members_only = TRUE;

          function index ()
          {
               $this->load->helper ( 'form' );
               $this->layouts->set_title ( 'Bucket' );
               if ($this->input->post('ajax')) {
                    $this->layouts->view ( 'bucket/home', null, 'json' );
               } else
               {
                    $this->layouts->view ( 'bucket/home' );
               }
          }
     }