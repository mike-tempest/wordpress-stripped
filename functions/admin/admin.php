<?php
/**
 * admin.php
 *
 * Purpose: To create admin setting pages.
 * Usage: Add the pages to the $admin_pages array
 * You need to specify a "Page title", "Menu title", "Capability", "Menu slug", "Settings section", "Settings name" and the fields to be included in the Settings page.
 * You have the choice of adding "Textboxes", "Textareas", "WYSIWYGs", "Radio buttons" and "Select boxes".
 * When creating the fields you must specify the following: "Type", "Name" and "Title"
 * If you are adding a set of radio buttons or a select box you need to add an "Options" array specifying "Key" => "Value"
 *
 * @package wordpress-stripped
 */


// Run a quick check to see if we are logged into the admin panel.
if( is_admin() ) {

	// Add in the classes.
	require_once( get_template_directory() . '/functions/admin/classes/admin.class.php' );
	
	// Add in the "Theme page" class.
	require_once( get_template_directory() . '/functions/admin/classes/admin-add-page.class.php' );
	
	// Create the array that stores the individual settings page information.
	$admin_pages = array();

	// Set up a new settings page as an array part.
	$admin_pages[] = array(
		'page_title' 		=> 'MT Theme Options',
		'menu_title' 		=> 'Theme Options',
		'capability' 		=> 'manage_options',
		'menu_slug' 		=> 'mt_theme_options',
		'settings_section'	=> 'mt_misc_options_section',
		'settings_name' 	=> 'mt_theme_options',
		'settings_desc' 	=> 'Add in the theme options description here!',
		'fields' => array(
			// New textbox
			array(
				'type' 	=> 'textbox',
				'name' 	=> 'mt_theme_textbox',
				'title' => 'Theme textbox'
			),
			// New textarea
			array(
				'type' 	=> 'textarea',
				'name' 	=> 'mt_theme_textarea',
				'title' => 'Theme textarea'
			),
			// New WYSIWYG
			array(
				'type' 	=> 'wysiwyg',
				'name' 	=> 'mt_theme_wysiwyg',
				'title' => 'Theme wysiwyg'
			),
			// New radio buttons
			array(
				'type' 		=> 'radio',
				'name' 		=> 'mt_theme_checkboxes',
				'title' 	=> 'Theme radio buttons',
				'options' 	=> array(
					'Yes' 		=> 'Y',
					'No' 		=> 'N',
					'Maybe' 	=> 'M'
				),
				'desc' 		=> 'Just a trial of the description array part that can be added to the separate fields...'
			),
			// New radio buttons
			array(
				'type' 		=> 'select',
				'name'		=> 'mt_theme_select_box',
				'title' 	=> 'Theme select box',
				'options' 	=> array(
					'David' 	=> 'david',
					'James' 	=> 'james',
					'Matthew' 	=> 'matthew',
					'Patrik' 	=> 'patrik'
				),
				'desc' 		=> 'Just a trial of the description array part that can be added to the separate fields...'
			)
		)
	);

	// Run a quick check to see if the mt_Admin_Pages class has been included in the functions.
	if( class_exists( 'mt_Admin_Add_Pages' ) ) {
		// Loop through the array and pass the data to the mt_Admin_Pages class.
		foreach( $admin_pages as $admin_page ) {
			new mt_Admin_Add_Pages( $admin_page );
		}
	}
	
	// Add in the "Sub pages" class.
	require_once( get_template_directory() . '/functions/admin/classes/admin-add-sub-page.class.php' );
	
	// Create the array that stores the individual settings page information.
	$admin_sub_pages = array();

	// Set up a new settings page as an array part.
	$admin_sub_pages[] = array(
		'parent_slug' 		=> 'edit.php?post_type=projects',
		'page_title' 		=> 'Project settings',
		'menu_title' 		=> 'Project settings',
		'capability' 		=> 'manage_options',
		'menu_slug' 		=> 'mt_project_settings',
		'settings_section' 	=> 'mt_project_settings_section',
		'settings_name' 	=> 'mt_project_settings',
		'settings_desc' 	=> 'Add in the project settings description here!',
		'fields' => array(
			// New textbox
			array(
				'type' 	=> 'textbox',
				'name' 	=> 'mt_project_textbox',
				'title' => 'Theme textbox'
			),
			// New textarea
			array(
				'type' 	=> 'textarea',
				'name' 	=> 'mt_project_textarea',
				'title' => 'Theme textarea'
			),
			// New WYSIWYG
			array(
				'type' 	=> 'wysiwyg',
				'name' 	=> 'mt_project_wysiwyg',
				'title' => 'Theme wysiwyg'
			),
			// New radio buttons
			array(
				'type' 	=> 'radio',
				'name' 	=> 'mt_project_checkboxes',
				'title' => 'Theme radio buttons',
				'options' => array(
					'Yes' 	=> 'Y',
					'No' 	=> 'N',
					'Maybe' => 'M'
				),
				'desc' 	=> 'Just a trial of the description array part that can be added to the separate fields...'
			),
			// New radio buttons
			array(
				'type' 	=> 'select',
				'name' 	=> 'mt_project_select_box',
				'title' => 'Theme select box',
				'options' => array(
					'David' 	=> 'david',
					'James' 	=> 'james',
					'Matthew' 	=> 'matthew',
					'Patrik' 	=> 'patrik'
				),
				'desc' 	=> 'Just a trial of the description array part that can be added to the separate fields...'
			)
		)
	);

	// Run a quick check to see if the mt_Admin_Pages class has been included in the functions.
	if( class_exists( 'mt_Admin_Add_Pages' ) ) {
		// Loop through the array and pass the data to the mt_Admin_Pages class.
		foreach( $admin_sub_pages as $admin_sub_page ) {
			new mt_Admin_Add_Sub_Pages( $admin_sub_page );
		}
	}
}