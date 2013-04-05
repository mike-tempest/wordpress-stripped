<?php
/**
 * admin-add-page.class.php
 *
 * This file contains class mt_Admin_Add_Pages that builds theme option pages
 * in the wp-admin
 *
 * @package wordpress-stripped
 */
if( class_exists( 'mt_Admin_Pages' ) ) {
	class mt_Admin_Add_Pages extends mt_Admin_Pages {
		
		/**
		 *
		 * Construct
		 * @param 		array $admin_page
		 * @author		Matt <info@michaeltempest.co.uk>
		 * @since		1.0
		 */
		function __construct( $admin_page ) {
			// Make sure we are in the admin panel.
			if( !is_admin() )
				return;
			// Set the $admin_page property so we can access it within the class.
			$this->admin_page 	= $admin_page;
			$this->fields 		= $admin_page['fields'];
			$this->section 		= $admin_page['menu_slug'];
			// Hook the page onto the admin menu.
			add_action( 'admin_menu', array( &$this, 'add_page' ) );
			add_action('admin_init', array( &$this, 'register_theme_settings' ) );
		}

		/**
		 *
		 * Add the theme options page
		 * @since 	1.0
		 * @author Matt <info@michaeltempest.co.uk>
		 */
		function add_page() {
			// Create the page to house all the theme settings fields.
			add_theme_page(
				$this->admin_page['page_title'], // Set the page title.
				$this->admin_page['menu_title'], // Set the menu title.
				$this->admin_page['capability'], // Set the capabilty level (only admins should be able to view).
				$this->admin_page['menu_slug'], // Set the menu slug.
				array( // Run a function to add content to the page.
					&$this,
					'create_page_content'
				)
			);
		}
		
	}
}