<?php
/**
 * projects.php
 *
 * This file defines the post-type of 'projects'
 * For more info on register_post_type arguments visit - http://codex.wordpress.org/Function_Reference/register_post_type#Arguments
 *
 * @package wordpress-stripped
 */

/**
 *
 * Function to set up projects post-type
 * @author	Michael Tempest <info@michaeltempest.co.uk>
 * @since 	1.0
 */
function mt_create_projects () {
	$labels = array(
		'name' 					=> _x( 'Projects', 'post type general name' ),
		'singular_name' 		=> _x( 'Project', 'post type singular name' ),
		'add_new' 				=> _x( 'Add New', 'Project' ),
		'add_new_item' 			=> __( 'Add New ' . 'Project' ),
		'edit_item' 			=> __( 'Edit ' . 'Project' ),
		'new_item' 				=> __( 'New ' . 'Project' ),
		'view_item' 			=> __( 'View ' . 'Project' ),
		'search_items' 			=> __( 'Search ' . 'Projects' ),
		'not_found' 			=> __( 'No ' . 'Projects' . ' found' ),
		'not_found_in_trash' 	=> __( 'No ' . 'Projects' . ' found in Trash' ),
		'parent_item_colon' 	=> ''
	);
	// You can rewrite the slug on the front end by adding this to the key => Value on line 42 below.
	$rewrite = array(
		'slug' 			=> 'ADD-SLUG-HERE',
		'with_front' 	=> false
	);
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'query_var' 			=> true,
		'rewrite' 				=> true, // You can use $rewrite VAR above here.
		'capability_type' 		=> 'post',
		'has_archive' 			=> true,
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
		'map_meta_cap' 			=> true

	);
	// Register the custom post type.
	register_post_type( 'projects', $args );
}
add_action( 'init', 'mt_create_projects' );