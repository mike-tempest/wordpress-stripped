<?php
/**
 * taxonomies.php
 *
 * This file defines the custom taxonomies that can be assigned to posts or custom post types.
 * For more info on register_taxonomy arguments visit - http://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package wordpress-stripped
 */

/**
 *
 * Function to set up custom taxonomies.
 * @author	Michael Tempest <info@michaeltempest.co.uk>
 * @since 	1.0
 */
function mt_create_custom_taxonomies () {
	// Create a custom category taxonomy
	register_taxonomy( 'project-categories', array('projects'), array(
		'hierarchical' => true,
		'label' => 'Project categories',
		'singular_label' => 'Project category',
		'rewrite' => true
	) );
	// Create a custom tag taxonomy
	register_taxonomy( 'project-tags', array('projects'), array(
		'hierarchical' => false,
		'label' => 'Project tags',
		'singular_label' => 'Project tag',
		'rewrite' => true
	) );
}
add_action( 'init', 'mt_create_custom_taxonomies');