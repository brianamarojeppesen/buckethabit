<?php
     $response = [
               'type'     => $response_type ,
               'changes'  => (is_array($changes)) ? $changes : [],
     ];

     if (isset($seo_title)) {
          $response['changes'][] = [
                    'target'  => 'head>title' ,
                    'content' => $seo_title,
          ];
     }

     if (isset($page_title)) {
          $response['changes'][] = [
                    'target'  => '#page_title' ,
                    'content' => $page_title,
          ];
     }

     if (isset($content)) {
          $response['changes'][] = [
                    'target'  => '#content' ,
                    'content' => $content,
          ];
     }

     if (isset($redirect)) {
          $response['redirect'] = $redirect;
     }

     echo json_encode ( $response );