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

?>
