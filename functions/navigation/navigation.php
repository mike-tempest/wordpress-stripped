<?php
/**
 * navigation.php
 *
 * Contains all functions that manage this theme's navigation
 *
 * @package wordpress-stripped
 */

/*
 * Register navigation areas
 */
register_nav_menus(array(
	'header' => 'Header Navigation',
	'footer' => 'Footer Navigation',
	'mobile' => 'Mobile Navigation'
));

/**
 *
 * Function to see if there are more than one page of results
 * @name	mt_show_posts_nav
 * @return	bool
 * @author	Michael Tempest
 * @since	1.0
 */
function mt_show_posts_nav() {
	global $wp_query;
	return ( $wp_query->max_num_pages > 1 ) ? true : false;
}

/**
 *
 * Return next and prev links for the archive pages
 * @name	mt_archive_navigation
 * @param 	string $nav_class
 * @return	HTML
 * @author	Michael Tempest
 * @since	1.0
 */
function mt_archive_navigation( $nav_class = 'post_nav' ) {
	global $wp_query;
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	if ( mt_show_posts_nav() ) { ?>
		<nav class="<?php echo $nav_class; ?> clearfix">
			<?php if( $paged < $wp_query->max_num_pages ) { ?>
				<div class="nav_previous">
					<span class="arrow"></span>
					<?php next_posts_link( __( 'Older Entries' ) ); ?>
				</div>
			<?php }
			if( $paged > 1 ) { ?>
				<div class="nav_next">
					<?php previous_posts_link( __( 'Newer Entries' ) ); ?>
					<span class="arrow"></span>
				</div>
			<?php } ?>
		</nav><!-- #nav-above -->
	<?php }
}

/**
 *
 * Return next and previous links for the single pages.
 * @name	mt_single_navigation
 * @param 	string $nav_class
 * @return	HTML
 * @author	Michael Tempest
 * @since	1.0
 */
function mt_single_navigation( $nav_class = 'post_nav' ) { ?>
	<nav class="<?php echo $nav_class; ?> clearfix">
		<div class="nav_previous"><?php previous_post_link( '%link' ); ?></div>
		<div class="nav_next"><?php next_post_link( '%link' ); ?></div>
	</nav>
<?php }