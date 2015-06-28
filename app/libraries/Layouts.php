<?php if ( ! defined ( 'BASEPATH' ) )
{
     exit( 'No direct script access allowed' );
}

     /**
      * Class Layouts
      *
      */
     class Layouts
     {

          /**
           * Will hold a CodeIgniter instance
           *
           * @var object
           */
          private $CI;

          /**
           * Will hold a title for the page, NULL by default
           *
           * @var string
           */
          private $page_title = NULL;

          /**
           * The title separator, ' | ' by default
           *
           * @var string
           */
          private $title_separator = NULL;

          private $site_title      = NULL;

          private $styles          = [ ];

          private $scripts         = [ ];

          private $menu_items      = [ ];

          /**
           * Layouts constructor.
           */
          public
          function __construct ()
          {

               $this->CI =& get_instance ();
               $this->CI->load->library ( 'session' );
               $this->CI->config->load ( 'layouts' , TRUE );
               $this->site_title      = $this->CI->config->item ( 'site_title' , 'layouts' );
               $this->title_separator = $this->CI->config->item ( 'title_separator' , 'layouts' );

               $this->add_style ( 'styles/styles.min.css' );
               $this->add_script ( 'scripts/scripts.php' );

               $this->add_menu_items ();
          }

          public
          function set_title (
                    $title
          ) {

               $this->page_title = $title;
          }

          public
          function get_seo_title ()
          {

               // Handle the site's title. If NULL, don't add anything. If not, add a
               // separator and append the title.
               return ( $this->page_title !== NULL ) ? $this->page_title . $this->title_separator . $this->site_title : $this->site_title;
          }

          public
          function view (
                    $view_name , $params = [ ] , $layout = 'html'
          ) {

               if (isset($params['update_menu'])) {
                    $this->add_menu_items ();

                    if (!isset($params['changes'])) $params['changes'] = [];
                    $params['changes'][] = [
                                        'target'  => '#menu' ,
                                        'content' => $this->print_menu () ,
                              ];
               }

               // Load the view's content, with the params passed
               if ($view_name)
               {
                    $content = $this->CI->load->view ( $view_name , $params , TRUE );
               } else {
                    $content = null;
               }

               // Now load the layout, and pass the view we just rendered
               $this->CI->load->view (
                         'layouts/' . $layout ,
                         [
                                   'content' => $content ,
                                   'seo_title'          => $this->get_seo_title () ,
                                   'site_title'         => $this->site_title ,
                                   'page_title'       => $this->page_title ,
                                   'response_type'      => (isset($params['response_type'])) ? $params['response_type'] : 'default' ,
                                   'redirect'           => (isset($params['redirect'])) ? $params['redirect'] : null ,
                                   'changes'           => (isset($params['changes'])) ? $params['changes'] : null
                         ]
               );
          }

          public
          function add_style (
                    $path , $prepend_base_url = TRUE
          ) {

               if ( $prepend_base_url )
               {
                    $this->CI->load->helper ( 'url' ); // Load this just to be sure
                    $this->styles[] = base_url () . $path;
               }
               else
               {
                    $this->styles[] = $path;
               }

               return $this; // This allows chain-methods
          }

          public
          function print_styles ()
          {

               // Initialize a string that will hold all styles
               $final_styles = '';

               foreach ( $this->styles as $style )
               {
                    $final_styles .= '<link href="' . $style . '" rel="stylesheet" type="text/css" />';
               }

               return $final_styles;
          }

          public
          function add_script (
                    $path , $prepend_base_url = TRUE
          ) {

               if ( $prepend_base_url )
               {
                    $this->CI->load->helper ( 'url' ); // Load this just to be sure
                    $this->scripts[] = base_url () . $path;
               }
               else
               {
                    $this->scripts[] = $path;
               }

               return $this; // This allows chain-methods
          }

          public
          function print_scripts ()
          {

               $this->CI->load->helper ( 'url' ); // Load this just to be sure

               // Initialize a string that will hold all styles
               $final_scripts = '<script type="text/javascript" src="' . base_url (
                         ) . 'scripts/LAB.min.js"></script><script>$LAB';

               foreach ( $this->scripts as $script )
               {
                    $final_scripts .= '.script("' . $script . '")';
               }

               $final_scripts .= '.wait(function() { $BS.update() })</script>';

               return $final_scripts;
          }

          public
          function add_menu_item (
                    $url = NULL , $content = NULL , $icon = NULL , $class = NULL , $parent = NULL
          ) {

               $menu_item = [
                         'url'      => ( strpos ( $url , 'http' ) || $url === NULL ) ? $url : base_url () . $url ,
                         'content'  => $content ,
                         'icon'     => $icon ,
                         'class'    => $class ,
                         'children' => [ ] ,
               ];

               if ( $parent )
               {
                    for ( $i = 0 ; $i < count ( $this->menu_items ) ; $i ++ )
                    {
                         if ( $this->menu_items[ $i ][ 'class' ] === $parent )
                         {
                              $this->menu_items[ $i ][ 'children' ][] = $menu_item;
                         }
                    }
               }
               else
               {
                    $this->menu_items[] = $menu_item;
               }

               return $this; // This allows chain-methods
          }

          public
          function add_menu_items ()
          {

               $this->menu_items = [ ];
               $this->add_menu_item ( '' , 'Home' , 'icon' , 'home' );
               //               $this->add_menu_item ( NULL , 'Menu item 2' , 'icon' , 'menu_item_2' );
               //               $this->add_menu_item ( 'url' , 'Menu item 2 1' , 'icon' , 'menu_item_2_1' , 'menu_item_2' );
               //               $this->add_menu_item ( 'url' , 'Menu item 3' , 'icon' , 'menu_item_3' );
               $this->add_menu_item ( NULL , $this->signin_component () , 'icon' , 'signin_component' );
          }

          public
          function print_menu (
                    $menu = NULL , $class = NULL , $level = 0 , $pre = NULL , $post = NULL
          ) {

               if ( ! isset( $menu ) )
               {
                    $menu = $this->menu_items;
               }

               $final_menu = $pre;

               // Initialize a string that will hold all styles

               if ($level) {
                    $final_menu .= '<ul class="submenu">';
               } else {
                    $final_menu .= '<section class="centered-navigation" role="banner">'.
                                   '<div class="centered-navigation-wrapper">'.
                                   '<a href="javascript:void(0)" class="mobile-logo">'.
                                   '<img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_3_dark.png" alt="Logo image">'.
                                   '</a>'.
                                   '<a href="javascript:void(0)" id="js-centered-navigation-mobile-menu" class="centered-navigation-mobile-menu no-bs">MENU</a>'.
                                   '<nav role="navigation">';
                    $final_menu .= '<ul id="js-centered-navigation-menu" class="centered-navigation-menu show">';
               }

//               $final_menu .= '<ul id="' . implode ( '_' , $menu_classes );
//               $menu_classes[] = $class;
//               $final_menu .= '" class="' . implode ( ' ' , $menu_classes ) . '">';

               foreach ( $menu as $menu_item )
               {
                    $menu_item_classes   = [ ];
                    if ($menu_item['class'] === 'signin_component') $menu_item_classes[] = 'more';
                    if (!$level) $menu_item_classes[] = 'nav-link';
                    $menu_item_classes[] = $menu_item[ 'class' ];

                    $child_menu = '';
                    if ( count ( $menu_item[ 'children' ] ) > 0 )
                    {
                         $menu_item_classes[] = 'more';

                         $child_menu = $this->print_menu (
                                   $menu_item[ 'children' ] ,
                                   $menu_item[ 'class' ] ,
                                   $level + 1
                         );
                    }

                    $menu_item_text = ( $menu_item[ 'icon' ] ) ? '<i class="icon-' . $menu_item[ 'icon' ] . '"></i>' . $menu_item[ 'content' ] : $menu_item[ 'content' ];

                    if ( isset( $menu_item[ 'url' ] ) )
                    {
                         $menu_item_text = '<a href="' . $menu_item[ 'url' ] . '">' . $menu_item_text . '</a>';
                    }

                    $final_menu .= '<li class="' . implode (
                                        ' ' ,
                                        $menu_item_classes
                              ) . '">' . $menu_item_text . $child_menu . '</li>';
               }

               $final_menu .= '</ul>';

               if (!$level) {
                    $final_menu .= '</nav>'.
                                   '</div>'.
                                   '</section>';
               }

               $final_menu .= $post;

               return $final_menu;
          }

          function is_logged_in ()
          {

               $is_logged_in = $this->CI->session->userdata ( 'is_logged_in' );

               return ( isset( $is_logged_in ) && $is_logged_in === TRUE );
          }

          public
          function signin_component ()
          {

               if ( $this->is_logged_in () )
               {
                    return '<a class="no-bs">'.$this->CI->session->username.'</a><ul class="submenu signin_component">'.
                           '<li><a href="/account">My Account</a></li>'.
                           '<li class="signout_form">'.$this->signout_form ().'</li>'.
                           '</ul>';
               }
               else
               {
                    return '<a class="no-bs">Sign In</a><ul class="submenu signin_component"><li class="signin_form">' . $this->signin_form (
                    ) . '</li></ul>';
               }
          }

          public
          function signin_form ()
          {

               $this->CI->load->helper ( 'form' );

               $data[ 'username' ] = $this->CI->input->post ( 'username' );

               return $this->CI->load->view ( 'accounts/signin' , $data , TRUE );
          }

          public
          function signout_form ()
          {

               $this->CI->load->helper ( 'form' );

               return $this->CI->load->view ( 'accounts/signout' , NULL , TRUE );
          }
     }