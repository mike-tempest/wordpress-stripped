<?php
/**
 * ajax.class.php
 * @package wordpress-stripped
 * 
 * Create a class to handle all the ajax functionality.
 *
 */

abstract class mt_Ajax {
	
	// Create the class properties.
	protected 	$nonce_name;
	var 		$mt_nonce;
	
	// Set the nonce.
	protected function set_nonce( $nonce ) {
		$this->mt_nonce = wp_create_nonce( $this->nonce_name );
	}
	
	// Allow access to the nonce.
	public function get_nonce() {
		return $this->mt_nonce;
	}
}