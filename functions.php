<?php

function enqueue_tailwind_styles() {
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/style.css', [], '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind_styles');

function marcu_logo() {
    add_theme_support('custom-logo', array(
        'height'      => 200,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'marcu_logo');

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml'; 
    return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types'); 


// Enregistrement du type de post personnalisé 'Restauration'
function register_restaurations_post_type() {
    $labels = array(
        'name'               => 'Restaurations',
        'singular_name'      => 'Restauration',
        'menu_name'          => 'Restaurations',
        'name_admin_bar'     => 'Restauration',
        'add_new'            => 'Ajouter Nouveau',
        'add_new_item'       => 'Ajouter Nouveau Restauration',
        'new_item'           => 'Nouveau Restauration',
        'edit_item'          => 'Éditer Restauration',
        'view_item'          => 'Voir Restauration',
        'all_items'          => 'Tous les Restaurations',
        'search_items'       => 'Rechercher Restaurations',
        'parent_item_colon'  => 'Parent Restaurations:',
        'not_found'          => 'Aucun Restauration trouvé.',
        'not_found_in_trash' => 'Aucun Restauration trouvé dans la corbeille.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'restaurations'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-hammer', // Icône pour "Restaurations"
        'show_in_rest'       => true,
        'rest_base'          => 'restaurations',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('restaurations', $args);
}

add_action('init', 'register_restaurations_post_type');


// Enregistrement du type de post personnalisé 'création'
function register_creations_post_type() {
    $labels = array(
        'name'               => 'Creations',
        'singular_name'      => 'Creation',
        'menu_name'          => 'Creations',
        'name_admin_bar'     => 'Creation',
        'add_new'            => 'Ajouter Nouveau',
        'add_new_item'       => 'Ajouter Nouveau creation',
        'new_item'           => 'Nouveau Talent',
        'edit_item'          => 'Éditer Talent',
        'view_item'          => 'Voir creation',
        'all_items'          => 'Tous les creations',
        'search_items'       => 'Rechercher creations',
        'parent_item_colon'  => 'Parent creations:',
        'not_found'          => 'Aucun creation trouvé.',
        'not_found_in_trash' => 'Aucun creation trouvé dans la corbeille.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'creations'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-admin-customizer', // Icône pour "Créations"
    );

    register_post_type('creations', $args);
}

add_action('init', 'register_creations_post_type');

function register_all_menus() {
    register_nav_menus(
        array(
            'left-menu' => __('Left Menu', 'marcu'),
            'right-menu' => __('Right Menu', 'marcu')
        )
    );
}
add_action('init', 'register_all_menus');

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer',
        'menu_slug'     => 'footer-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

function my_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_to_rest_api($response, $post, $request) {
    if (!function_exists('get_fields')) return $response;

    if (isset($post)) {
        $acf = get_fields($post->ID);
        $response->data['acf'] = $acf;
    }
    return $response;
}
add_filter('rest_prepare_restaurations', 'my_acf_to_rest_api', 10, 3);

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/restaurations/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_restauration',
        'args' => array(
            'id' => array(
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
        ),
    ));
});

function get_restauration($request) {
    $post_id = $request['id'];
    $post = get_post($post_id);

    if (empty($post) || $post->post_type !== 'restaurations') {
        return new WP_Error('no_restauration', 'Restauration non trouvée', array('status' => 404));
    }

    $response = array(
        'id' => $post->ID,
        'title' => array(
            'rendered' => get_the_title($post->ID)
        ),
        'content' => array(
            'rendered' => apply_filters('the_content', $post->post_content)
        ),
        'acf' => get_fields($post->ID)
    );

    return new WP_REST_Response($response, 200);
}

function modal_scripts() {
    if (is_page_template('restauration.php')) {
        wp_enqueue_script('restauration-modal', get_template_directory_uri() . '/js/restauration-modal.js', array('jquery'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'modal_scripts');

?>
