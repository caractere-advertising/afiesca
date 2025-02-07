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

    if ($_POST) {
        $q = sanitize_text_field($_POST['q']);
    }

    $table = $wpdb->prefix . 'posts';
    $result = array();

    if ($q) {
        $req = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT ID, post_title, post_type FROM $table 
                WHERE post_title LIKE %s 
                AND post_status = 'publish' 
                AND post_type IN ('page', 'post')",
                "%{$q}%"
            ), 
            ARRAY_A
        );

        if ($req) {
            foreach ($req as $post) {
                $permalink = ($post['post_type'] == 'page') ? get_page_link($post['ID']) : get_permalink($post['ID']);

                $result[] = array(
                    'post_title' => $post['post_title'],
                    'permalink'  => $permalink,
                );
            }

            // Envoi la réponse JSON avec tous les résultats
            wp_send_json_success($result);
        } else { 
            wp_send_json_error('Aucun résultat');
        }
    }

    wp_die();
}


/*********************************
 Custom Post Type ---- Jobs
**********************************/

function add_custom_post_jobs() {

	$labels = array(
		'name'                  => _x( 'Job.s', 'Post Type General Name', 'custom_post_type' ),
		'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'custom_post_type' ),
		'menu_name'             => __( 'Jobs', 'custom_post_type' ),
		'name_admin_bar'        => __( 'Job', 'custom_post_type' ),
		'archives'              => __( 'Archives', 'custom_post_type' ),
		'attributes'            => __( 'Item Attributes', 'custom_post_type' ),
		'all_items'             => __( 'Toute.s', 'custom_post_type' ),
		'add_new_item'          => __( 'Ajouter une nouvelle offre', 'custom_post_type' ),
		'add_new'               => __( 'Ajouter job', 'custom_post_type' ),
		'new_item'              => __( 'Nouveau', 'custom_post_type' ),
		'edit_item'             => __( 'Modifier', 'custom_post_type' ),
		'update_item'           => __( 'Mettre à jour', 'custom_post_type' ),
		'view_item'             => __( 'Voir', 'custom_post_type' ),
		'view_items'            => __( 'Voir', 'custom_post_type' ),
		'search_items'          => __( 'Recherche', 'custom_post_type' ),
		'not_found'             => __( 'Non trouvé', 'custom_post_type' ),
		'not_found_in_trash'    => __( 'Non trouvé', 'custom_post_type' ),
		'featured_image'        => __( 'Miniature', 'custom_post_type' ),
		'set_featured_image'    => __( 'Définir la miniature', 'custom_post_type' ),
		'remove_featured_image' => __( 'Retirer la miniature', 'custom_post_type' ),
		'use_featured_image'    => __( 'Utiliser comme miniature', 'custom_post_type' ),
		'insert_into_item'      => __( 'Insérer', 'custom_post_type' ),
		'uploaded_to_this_item' => __( 'Uploader', 'custom_post_type' ),
		'items_list'            => __( 'List', 'custom_post_type' ),
		'items_list_navigation' => __( 'Items list navigation', 'custom_post_type' ),
		'filter_items_list'     => __( 'Filtrer', 'custom_post_type' ),
	);
	$args = array(
		'label'                 => __( 'Jobs', 'custom_post_type' ),
		'description'           => __( 'Nouvelle offre chez Wolfs', 'custom_post_type' ),
		'labels'                => $labels,
		'taxonomies'            => array( 'jobs' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-feedback',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'supports'				      => array('title', 'revisions', 'author', 'thumbnail'),
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'		    => 'post',
	);
	register_post_type( 'jobs', $args );
}
add_action( 'init', 'add_custom_post_jobs', 0 );
  