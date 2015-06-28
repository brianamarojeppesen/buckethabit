<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Pages
 */
class Pages extends CI_Controller {

    public function view($page = 'home') {

        $this->load->library('layouts');

        if ( !file_exists(APPPATH.'/views/pages/'.$page.'.php') ) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->layouts->set_title(ucfirst($page));

        if ( $this->input->post ( 'ajax' ) )
        {
            $this->layouts->view ( 'pages/' . $page, null, 'json' );
        } else
        {
            $this->layouts->view ( 'pages/' . $page );
        }

    }

}
