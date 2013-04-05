<?php
/**
 * load-scripts.php
 *
 * This is where all Javascipt files should be included.
 *
 * @package wordpress-stripped
 */

/**
 *
 * Load modernizr into the dom, make sure it only loads once.
 * @name	mt_load_modernizr
 * @author	Michael Tempest <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_load_modernizr () {
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr/modernizr.js', false, 1 );
	wp_enqueue_script( 'modernizr' );
}
add_action( 'wp_enqueue_scripts', 'mt_load_modernizr' );

/**
 *
 * Load jquery into the dom, make sure it only loads once. If jquery is available from google load it from there or default to the local copy.
 * @name	mt_load_jquery
 * @author	Michael Tempest <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_load_jquery () {
	$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';
	$check_url = @fopen( $url, 'r' );
	wp_deregister_script( 'jquery' );
	if( !$check_url )
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', false, 1 );
	else
		wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery/jquery-1.7.1.min.js', false, 1 );
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'mt_load_jquery' );

/**
 *
 * Load the global javascript file into the DOM
 * @name	mt_load_global_script
 * @author	Michael Tempest <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_load_global_script () {
	wp_register_script( 'global_script', get_template_directory_uri() . '/js/jquery/global.js', false, 1, true );
	wp_enqueue_script( 'global_script' );
	/*
	 * Hook a global config object to the DOM so we can pick out useful info in the global.js script.
	 *
	 * If you are using AJAX in the theme add the nonce to the array part below.
	 * E.g. 'nonce_name' => $nonce_object->get_nonce();
	 *
	 * Remember though in order to access the nonce, you need to make the AJAX object global.
	 * E.g. global $nonce_object
	 *
	 * See functions >> ajax >> ajax.php for list of nonce objects.
	 */
	wp_localize_script( 'global_script', 'mt_CONFIG', array(
		'site_url' => get_template_directory_uri(),
		'admin_url' => admin_url( 'admin-ajax.php' )
	) );
}
add_action( 'wp_enqueue_scripts', 'mt_load_global_script' );

/**
 * Adds in browser support for legacy browsers
 * @name   mt_browser_support()
 * @author Gabor Javorszky
 * @since  1.0
 * @return null nothing, echoes out a bit of html code
 */
function mt_browser_support() {
	echo '
		<!--[if lt IE 9]>
			<script src="' . get_template_directory_uri() . '/js/html5/html5.js"></script>
			<script src="' . get_template_directory_uri() . '/js/respond/respond.min.js"></script>
		<![endif]-->';
}
add_action( 'wp_head' , 'mt_browser_support' );
