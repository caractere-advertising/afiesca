<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// Menu 
register_nav_menus( array(
    'megamenu' => 'Mega Menu',
	  'main' => 'Menu Principal',
	  'footer' => 'Bas de page',
    'topheader' => 'Top menu'
) );

add_theme_support( 'post-thumbnails' ); 

//SVG Files
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
  
function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
  
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
  add_filter( 'upload_mimes', 'cc_mime_types' );
  add_action( 'admin_head', 'fix_svg' );

  add_action( 'wp_ajax_nopriv_searchbar', 'searchbar' );
  add_action( 'wp_ajax_searchbar', 'searchbar');
  
  function searchbar(){
    global $wpdb;

    if($_POST):
        $q = sanitize_text_field($_POST['q']);
    endif;
    $table = $wpdb->prefix.'posts';
    $result = array();

    if($q):
        $req = $wpdb->get_results("SELECT * FROM $table WHERE `post_title` LIKE '%$q%' AND `post_status` = 'publish' AND `post_type` IN ('page','post')", ARRAY_A);

        if($req):
            foreach ($req as $post) {
                // Récupérer l'URL en fonction du type de contenu
                if ($post['post_type'] == 'page') {
                    $permalink = get_page_link($post['ID']);
                } else {
                    $permalink = get_permalink($post['ID']);
                }

                $post['permalink'] = $permalink;
                $result[] = $post;
            }
        else: 
            $result = 'Aucun résultat';
        endif;
    endif;

    wp_send_json_success($result);
    wp_die();
}

  