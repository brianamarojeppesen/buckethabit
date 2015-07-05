<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     /**
      * Class News
      *
      * @property News_model $news_model
      */
     class News
               extends CI_Controller
     {

          public
          function __construct ()
          {
               parent::__construct ();
               $this->load->model ( 'news_model' );
               $this->load->library('layouts');
          }

          public
          function index ()
          {
               $data[ 'news' ]  = $this->news_model->get_news ();
               $this->layouts->set_title('News archive');
               $this->layouts->view('news/index', $data);

          }

          public
          function view (
                    $slug = NULL
          ) {

               $data[ 'news_item' ] = $this->news_model->get_news ( $slug );

               if ( empty( $data[ 'news_item' ] ) )
               {
                    show_404 ();
               }

               $this->layouts->set_title($data[ 'news_item' ][ 'title' ]);
               $this->layouts->view('news/view', $data);

          }

          public
          function create ()
          {
               $this->load->helper ( 'form' );
               $this->load->library ( 'form_validation' );

               $this->form_validation->set_rules ( 'title' , 'Title' , 'required' );
               $this->form_validation->set_rules ( 'text' , 'Text' , 'required' );

               if ( $this->form_validation->run () === FALSE )
               {
                    $this->layouts->set_title('Create a news item');
                    $this->layouts->view('news/create');
               }
               else
               {
                    $this->news_model->set_news ();
                    $this->layouts->set_title('Success');
                    $this->layouts->view('news/success');
               }
          }

     }