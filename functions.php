<?php
/**
 * functions.php
 *
 * This file includes all of the files required from the functions folder.
 * Orginally this was wrapped within a function however this was removed as classes defined within would not be able to be called from the rest of the theme.
 *
 * @package wordpress-stripped
 */

/*
 * Handle miscellaneous theme functionality.
 */
require_once( get_template_directory() . '/functions/misc/misc.php' );

/*
 * Load in the custom styles.
 * Load in the custom scripts.
 */
require_once( get_template_directory() . '/functions/misc/load-scripts.php' );
require_once( get_template_directory() . '/functions/misc/load-styles.php' );

/*
 * Add in pretty standard wordpress functionality.
 * Navigation, images, widgets, custom post types and custom taxonomies are all managed via the includes below.
 */
require_once( get_template_directory() . '/functions/navigation/navigation.php' );
require_once( get_template_directory() . '/functions/images/images.php' );
// require_once( TEMPLATEPATH . '/functions/widgets/widgets.php' );
require_once( get_template_directory() . '/functions/post-types/projects.php' );
require_once( get_template_directory() . '/functions/post-types/taxonomies.php' );

/*
 * Add in the class for the custom theme option pages.
 * Add in the script that controls what fields appear in the custom theme page(s).
 */
require_once( get_template_directory() . '/functions/admin/admin.php' );

/*
 * Add a custom login design to the theme.
 */
require_once( get_template_directory() . '/functions/admin/admin-styles.php' );

/*
 * Add in the classes custom AJAX functionality.
 * Add in the script that define the AJAX objects.
 */
require_once( get_template_directory() . '/functions/ajax/classes/ajax.class.php' );
require_once( get_template_directory() . '/functions/ajax/classes/ajax-example.class.php' );
require_once( get_template_directory() . '/functions/ajax/ajax.php' );

/*
 * The meta box requires you to install this plugin - http://wordpress.org/extend/plugins/meta-box/
 * Run a quick check to make sure the plugin is installed.
 */
if ( class_exists( 'RW_Meta_Box' ) ) {
	require_once( get_template_directory() . '/functions/meta-boxes/meta-box-usage.php' );
}
