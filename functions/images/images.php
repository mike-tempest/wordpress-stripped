<?php
/**
* images.php
*
* Here is where all image related functions should be
*
* @package wordpress-stripped
*/


add_filter('wp_get_attachment_url', 'mt_modify_attachment_url', 10, 2);

/**
 * Captures the url for the attachments, and if it's an image (a 'large' exists within sizes), then returns the link to the large image link, otherwise the original (the attachment is not an image)
 * @param  string $url the link to the original image / attachment
 * @param  int $id  id of the attachment we're talking about
 * @return string      the resized image url
 */
function mt_modify_attachment_url( $url, $id) {
	$newurl = &$url;
	$postmeta = wp_get_attachment_metadata( $id, true );
	if(isset( $postmeta['sizes']['large']['url'] ) ) {
		$newurl = $postmeta['sizes']['large']['url'];
	}
	return $newurl;
}


/*
 * Add custom image sizes to the theme.
 * Uncomment the code below to activate this functionality.
 * add_image_size( 'NAME OF IMAGE SIZE' (string), WIDTH (integer), HEIGHT (integer), CROP IMAGE? (boolean) );
 */

// Remove the inline styling from the [gallery] shortcode.
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 *
 * Returns the images uploaded via a predefined meta box in the admin panel.
 * @name 		mt_page_gallery()
 * @param 		array $args
 * @return		HTML
 * @author 		Matt <info@michaeltempest.co.uk>
 * @since		1.0
 */
function mt_page_gallery ( $args = false ) {
	// Make sure the params have been passed.
	if( !args || !is_array( $args ) )
		return;
	// Set up default argument parameters.
	$defaults = array(
		'parent'		=> get_the_ID(),
		'meta'			=> false,
		'size'			=> 'thumbnail',
		'icon'			=> false,
		'before'		=> false,
		'after'			=> false,
		'before_image'	=> false,
		'after_image'	=> false
	);
	// Parse incomming $args into an array and merge it with $defaults.
	$args = wp_parse_args( $args, $defaults );
	// OPTIONAL: declare each item into an array and merge it with $defaults.
	extract( $args, EXTR_SKIP );
	// Count the list of images sent through.
	$max = count( $meta );
	// If the amount of images is greater than 1.
	if( $max > 0 ) {
		// Set up our query args and fetch the images.
		$images = get_posts( array(
			'post_type'		=> 'attachment',
			'post_parent'	=> $parent,
			'numberposts'	=> $max,
			'include'		=> $meta
		) );
		// Include the before tag.
		if( $before )
			echo $before;
		// Loop through the image data and display the images.
		foreach( $images as $image ) {
			// Make sure we are dealing with images.
			if( wp_attachment_is_image( $image->ID ) ) {
				$img = wp_get_attachment_image_src( $image->ID, $size, $icon );
				// Include the before image tag.
				if( $before_image ) {
					echo $before_image;
				}
				// Include the image itself.
				echo '<img src="' . $img[0] . '" width="' . $img[1] . '" height="' . $img[2] . '" alt="' . $image->post_title . '" />';
				// Include the before image tag.
				if( $after_image ) {
					echo $after_image;
				}
			}
		}
		// Include the after tag.
		if( $after )
			echo $after;
	}
}