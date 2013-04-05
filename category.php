<?php
/**
 * category.php
 * @package wordpress-stripped
 */
get_header();
	if( have_posts() ) : while( have_posts() ) : the_post();
		get_template_part( 'loop', 'news' );
	endwhile; endif;
	wp_reset_query();
get_footer();