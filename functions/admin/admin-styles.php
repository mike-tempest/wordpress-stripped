<?php
/**
 * admin-styles.php
 *
 * This file contains all the style changes to the wp-admin interface
 *
 * @package wordpress-stripped
 */

/**
 *
 * a function to add a custom style to the login form
 * @return html
 * @author	Mike Tempest <info@michaeltempest.co.uk>
 * @since 	1.0
 */
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/functions/admin/css/mt-admin-styles.css" />';
}

/**
 *
 * a function to change the url of the image on the login form
 * @return html
 * @author	Mike Tempest <info@michaeltempest.co.uk>
 * @since 	1.0
 */
function wpc_url_login(){
	return "http://www.michaeltempest.co.uk/";
}

/**
 *
 * Customise the footer in admin
 * @return 	html
 * @author 	Mike Tempest <info@michaeltempest.co.uk>
 * @since 	1.0
 */
function remove_footer_admin () {
	echo '&copy; ' . date( 'Y' ) . ' | Electric Studio';
}

/**
 *
 * Adds ES logo and link to admin bar
 * @param 	object $wp_admin_bar
 * @author	Mike Tempest <info@michaeltempest.co.uk>
 * @since 	1.0
 */
function add_mt_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node('wp-logo');
    $args = array(
        'id' => 'mt_logo',
        'title' => '<img src="'.get_bloginfo('template_directory') . '/functions/admin/images/mt_icon.png"/>',
        'href' => 'http://www.michaeltempest.co.uk',
    );
    $wp_admin_bar->add_node( $args );
}

/**
 *
 * removes wp logo from admin bar
 * @param 	object $wp_admin_bar
 * @author	Mike Tempest <info@michaeltempest.co.uk>
 * @since 	1.0
 */
function remove_wp_logo($wp_admin_bar){
    $wp_admin_bar->remove_node('wp-logo');
}

/**
 *
 * Revomes unnecessary widgets from the dashboard
 * @author Mike Tempest <info@michaeltempest.co.uk>
 * @since	1.0
 */
function wpc_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

/*
 * The below will remove the standard wordpress logo in the admin bar.
 * 
 * add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
 * Set to 999 so is loaded after wo_logo menu node is added.
 * 
 * The below will add in a custom logo into the admin bar.
 * 
 * add_action( 'admin_bar_menu', 'add_mt_logo', 1 );
 * Set to 1 so is loaded first.
 */

// Add actions and filters for the functions in this file
add_action('login_head', 'custom_login');
// add_action('wp_dashboard_setup', 'wpc_dashboard_widgets');
add_filter('admin_footer_text', 'remove_footer_admin');
add_filter('login_headerurl', 'wpc_url_login');

?>