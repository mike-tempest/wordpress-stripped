<?php
/**
 * misc.php
 *
 * This file is for functions that don't belong anywhere else!
 *
 * @package wordpress-stripped
 */

/*
 * Lets remove some of the junk wordpress adds to the wp_head hook
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/*
 * Add extra wordpress functionality by adding theme support.
 * Uncomment the functiona arguments to customise the functionality.
 * For extra information visit - http://codex.wordpress.org/Function_Reference/add_theme_support
 */
add_theme_support('post-formats', array(
	'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
) );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header', array(
	'random-default' => true,
	'width'          => 940,
	'height'         => 320,
	'flex-height'    => false,
	'flex-width'     => false,
	'header-text'    => true,
	'uploads'        => true
) );

/**
 *
 * Returns boolean to see if the page has any children.
 * @name 	mt_has_children()
 * @param 	int $post_ID
 * @return 	bool
 * @author 	Matt <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_has_children( $post_id ) {
	$children  = get_pages( 'child_of=' . $post_id );
	$ancestors = get_post_ancestors( $post_id );
	// Does the post have any children?
	if( count( $children ) > 0 ) {
		return true;
	} else {
		// Does the post have any ancestors?
		if( count( $ancestors ) > 0 ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 *
 * Returns the ID for the parent page.
 * @name 	mt_get_root_page()
 * @param 	int $post_ID
 * @param	post_type $type
 * @return 	int
 * @author 	Matt <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_get_root_page( $post_ID = false, $type = 'page' ) {
	if( !$post_ID )
		return false;
	$ancestors = get_ancestors( $post_ID, $type );
	$count = count( $ancestors );
	$i = ( $count - 1 );
	if( $count > 0 ) {
		return $ancestors[$i];
	} else {
		return $post_ID;
	}
}

/**
 *
 * Return the ID of a page based on the page slug been passed.
 * @name		mt_page_id()
 * @param 		string $page_name
 * @returns 	int
 * @author		Matt <info@michaeltempest.co.uk>
 * @since		1.0
 */
function mt_page_id( $page_name = false ) {
	if( $page_name === false )
		return false;
	$arr = array();
	$pages = get_pages();
	foreach ( $pages as $page ) {
		$arr[$page->post_name] = $page->ID;
	}
	return $arr[$page_name];
}

/**
 *
 * Returns true if the current page is a news page.
 * @name 	mt_is_news()
 * @param 	string/array/bool $post_type
 * @param	string/array/bool $taxonomy
 * @author 	Matt <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_is_news( $post_type = false, $taxonomy = false ) {
	$args = ( ( is_home() || is_archive() || is_single() ) && !( is_tax( $taxonomy ) || is_post_type_archive( $post_type ) || is_singular( $post_type ) ) ) ? true : false;
	return $args;
}

/**
 *
 * Returns true if you are on a specific custom post type page.
 * @name 	mt_is_custom_posttype()
 * @param 	array $post_type
 * @param	array $taxonomy
 * @author	Michael Tempest <info@michaeltempest.co.uk>
 * @since	1.0
 */
function mt_is_custom_post($post_type = false, $taxonomy = false){
	return ( is_post_type_archive( $post_type ) || is_singular( $post_type ) || is_tax( $taxonomy ) ) ? true : false;
}

/**
 *
 * Returns the files uploaded via a predefined meta box in the admin panel.
 * @name 		mt_page_attachments()
 * @param 		array $args
 * @return		HTML
 * @author 		Matt <info@michaeltempest.co.uk>
 * @since		1.0
 */
function mt_page_attachments ( $args = false ) {
	// Make sure the params have been passed.
	if( !args || !is_array( $args ) )
		return;
	// Set up default argument parameters.
	$defaults = array(
		'parent'		=> get_the_ID(), 	// Integer
		'meta'			=> false, 			// Array
		'file_type'		=> false, 			// Array or String.
	);
	// Parse incomming $args into an array and merge it with $defaults.
	$args = wp_parse_args( $args, $defaults );
	// OPTIONAL: declare each item into an array and merge it with $defaults.
	extract( $args, EXTR_SKIP );
	// Count the list of files sent through.
	$max = count( $meta );
	// If the amount of files is greater than 1.
	if( $max > 0 ) {
		// Set up our query args and fetch the images.
		$attachments = get_posts( array(
			'post_type'		=> 'attachment',
			'post_parent'	=> $parent,
			'numberposts'	=> $max,
			'include'		=> $meta
		) );
		// Loop through the image data and display the images.
		foreach( $attachments as $att ) {
			// Get the file.
			$file = wp_get_attachment_url( $att->ID );
			// Split the file path.
			$path = pathinfo( $file );
			// Get the file type.
			$type = strtolower( $path['extension'] );
			// If a file type has been passed to the function via the $args array
			// and the file type does not match this skip over the file.
			if( $file_type != false ) {
				// If we are dealing with an array.
				if( is_array( $file_type ) ) {
					// If the file type doesn't appear in the array
					if( !in_array( $type, array_map( 'strtolower', $file_type ) ) )
						continue;
				}
				// If we are dealing with a string.
				elseif ( $type != strtolower( $file_type ) ) {
					continue;
				}
			}
			echo '<a href="' . $file . '" class="download ' . $type . '" title="' . $att->post_title . '">' . $att->post_title . '</a>';
		}
	}
}

/**
 *
 * Returns information about the current query.
 * @name 		mt_get_query_info()
 * @param 		N/A
 * @return		array
 * @author 		Matt <info@michaeltempest.co.uk>
 * @since		1.0
 */
function mt_get_query_info () {
	// We need to grab some info from the $wp_query.
	global $wp_query;
	// Create an array to store all the info.
	$info = array();
	// First see what page we are on.
	$info['paged'] 			= get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
	// See how many posts should be outputted per page.
	$info['posts_per_page'] = $wp_query->query_vars['posts_per_page'];
	// See the overall posts returned.
	$info['post_count'] 	= $wp_query->found_posts;
	// Show the start value for the results that are displayed.
	$info['showing_start'] 	= ( $info['paged'] > 1 ) ? ( ( ( $info['paged'] - 1 ) * $info['posts_per_page'] ) + 1 ) : 1;
	// Show the end value for the results that are displayed.
	$info['showing_end'] 	= ( ($info['showing_start'] + ( $info['posts_per_page'] - 1 ) ) < $info['post_count'] ) ? $info['showing_start'] + ( $info['posts_per_page'] - 1 ) : $info['post_count'];
	// Get the search query.
	$info['searched'] 		= get_search_query() ? trim( get_search_query() ) : false;

	return $info;
}