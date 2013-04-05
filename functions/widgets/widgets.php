<?php
/**
 * widgets.php
 *
 * Here is where all widget related functions should be.
 *
 * @package wordpress-stripped
 */
function mt_widgets_init() {
	register_sidebar( array(
		'name' => __( 'ADD NAME HERE' ),
		'id' => 'ADD-ID-HERE',
		'description' => __( '' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
// Initiate the widgets within the theme.
add_action( 'widgets_init', 'mt_widgets_init' );