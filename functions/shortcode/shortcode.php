<?php
/**
 * shortcode.php
 *
 * All functions for shortcodes should be put into this file
 *
 * @package wordpress-stripped
 */

/**
 *
 * Fix the empty paragraphs that get added to the DOM when using shortcodes.
 * @name	mt_empty_paragraph_fix
 * @param 	string $content
 * @return	string
 * @author	Michael Tempest
 * @since	1.0
 */
function mt_empty_paragraph_fix( $content ) {
	// An array of the offending tags.
	$arr = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);
	// Remove the offending tags and return the stripped content.
	$stripped_content = strtr( $content, $arr );
	return $stripped_content;
}
add_filter( 'the_content', 'mt_empty_paragraph_fix' );

/**
 * Add in the column container.
 * @name mt_column_container
 * @param 	string $atts, string $content
 * @return	HTML
 * @author	Michael Tempest
 * @since	1.0
 */
function mt_column_container( $atts, $content = '&nbsp;' ) {
	extract(shortcode_atts(array(
			'per_row' => 2,
			'class' => false
	), $atts));
	$html = '';
	// Concatonate the string together.
	$html .= '<div class="columns columns-' . $per_row;
	if( $class )
		$html .=  ' ' . $class;
	$html .= ' clearfix">';
	$html .= do_shortcode( $content );
	$html .= '</div>';
	return $html;
}
add_shortcode('columns', 'mt_column_container');

/**
 * Add in the individual columns.
 * @name mt_column
 * @param 	string $atts, string $content
 * @return	HTML
 * @author	Michael Tempest
 * @since	1.0
 */
function mt_ind_column( $atts, $content = '&nbsp;' ) {
	extract(shortcode_atts(array(
			'title' => false,
			'width' => false
	), $atts));
	$html = '';
	$html = '';
	// Concatonate the string together.
	$html .= '<div class="column';
	if( $width )
		$html .= ' ' . $width;
	$html .= '">';
	$html .= '<div class="col-inner clearfix">';
	if( $title )
		$html .= '<p><strong>' . $title . '</strong></p>';
	$html .= do_shortcode( $content );
	$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode('col', 'mt_ind_column');