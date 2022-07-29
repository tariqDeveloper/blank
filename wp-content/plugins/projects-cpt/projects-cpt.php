<?php
/**
 * @package  Project CPT
Plugin Name: Project CPT
Plugin URI: 
Description: This plugin registers Project Custom Post Type in site..
Version: 1.0.0
Author: Muhammad Tariq Khan
License: GPLv2 or later
*/

if ( !defined( 'ABSPATH' ) ) exit;


// Register Custom Post Type
function projects_post_type() {

    $labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Projects', 'text_domain' ),
        'name_admin_bar'        => __( 'Projects', 'text_domain' ),
        'archives'              => __( 'Project Archives', 'text_domain' ),
        'attributes'            => __( 'Project Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Project:', 'text_domain' ),
        'all_items'             => __( 'All Projects', 'text_domain' ),
        'add_new_item'          => __( 'Add New Project', 'text_domain' ),
        'add_new'               => __( 'Add New Project', 'text_domain' ),
        'new_item'              => __( 'New Project', 'text_domain' ),
        'edit_item'             => __( 'Edit Project', 'text_domain' ),
        'update_item'           => __( 'Update Project', 'text_domain' ),
        'view_item'             => __( 'View Project', 'text_domain' ),
        'view_items'            => __( 'View Projects', 'text_domain' ),
        'search_items'          => __( 'Search Project', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Project', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Project', 'text_domain' ),
        'items_list'            => __( 'Projects list', 'text_domain' ),
        'items_list_navigation' => __( 'Projects list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Projects list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Project', 'text_domain' ),
        'description'           => __( 'This is Projects Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'taxonomies'            => array( 'project-type' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-post',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'projects', $args );

}
add_action( 'init', 'projects_post_type', 0 );

// Register Custom Taxonomy
function project_type_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Project Types', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Project Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Project Type', 'text_domain' ),
        'all_items'                  => __( 'All Project Types', 'text_domain' ),
        'parent_item'                => __( 'Parent Project Type', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Project Type:', 'text_domain' ),
        'new_item_name'              => __( 'New Project Type Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Project Type', 'text_domain' ),
        'edit_item'                  => __( 'Edit Project Type', 'text_domain' ),
        'update_item'                => __( 'Update Project Type', 'text_domain' ),
        'view_item'                  => __( 'View Project Type', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate Project Types with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or Project Type items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Project Types', 'text_domain' ),
        'search_items'               => __( 'Search Project Types', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No Project Types', 'text_domain' ),
        'items_list'                 => __( 'Project Types list', 'text_domain' ),
        'items_list_navigation'      => __( 'Project Types list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'project-type', array( 'project' ), $args );

}
add_action( 'init', 'project_type_taxonomy', 0 );


//custom ajax endpoint code
add_action( 'wp_enqueue_scripts', 'add_plugin_scripts' );
function add_plugin_scripts() {
   
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, false);
    wp_enqueue_script('jquery');
    wp_register_script('cs-js-insta', plugin_dir_url( __FILE__ ) . 'assets/scripts-cs-insta.js',array('jquery'),false,true);
    //wp_enqueue_script('cs-js-insta');
    wp_localize_script('cs-js-insta','myObj',array(
        'restURL' => rest_url(),
        'restNonce' => wp_create_nonce('wp_rest')
    ));
}

function at_rest_testing_endpoint()
{
     $response = array('Hello');
     echo json_encode($response);
     die();
}

/**
 * at_rest_init
 */
function at_rest_init()
{
    // route url: domain.com/wp-json/$namespace/$route
    $namespace = 'api-test/v1';
    $route     = 'testing';

    register_rest_route($namespace, $route, array(
        'methods'   => 'GET',
        'callback'  => 'at_rest_testing_endpoint'
    ));
}

add_action('rest_api_init', 'at_rest_init');
?>