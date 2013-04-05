<?php
/**
 * load-styles.php
 *
 * This is where all css files should be included.
 *
 * @package wordpress-stripped
 */

/**
 *
 * Load the global stylesheet into the dom, make sure it only loads once.
 * @name	mt_load_global_styles
 * @author	Michael Tempest <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_load_global_styles () {
	wp_register_style( 'global_styles', get_template_directory_uri() . '/style.css', false, 1 );
	wp_enqueue_style( 'global_styles' );
}
add_action( 'wp_enqueue_scripts', 'mt_load_global_styles' );