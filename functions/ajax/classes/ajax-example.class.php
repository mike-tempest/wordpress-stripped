<?php
/**
 * ajax-example.class.php
 * @package wordpress-stripped
 */

class mt_Ajax_Example extends mt_Ajax {
	function __construct( $name ) {
		// If nothing is passed, return nowt!
		if( empty( $name ) )
			return;
		// Set the $nonce_name;
		$this->nonce_name = $name;
		// Set the nonce.
		$this->set_nonce( $this->nonce_name );
		// Run a check to see if we are in the admin panel.
		if( is_admin() )
			add_action( 'wp_ajax_example_method', array( &$this, 'example_method' ) );
		add_action( 'wp_ajax_nopriv_example_method', array( &$this, 'example_method' ) );
	}
	
	// 
	function example_method () {
		// Check the nonce.
		check_ajax_referer( $this->nonce_name );
		// Lets exit the function.
		die();
	}
}