<?php
/**
 * page.php
 * @package wordpress-stripped
 */
get_header();
	if( have_posts() ) : while( have_posts() ) : the_post();
		get_template_part( 'content', 'standard-page' );
	endwhile; endif;
	wp_reset_query();
get_footer();