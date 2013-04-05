<?php
/**
 * content-news.php
 * @package wordpress-stripped
 */
$files = get_post_meta( $post->ID, '_mt_code', false );
$images = get_post_meta( $post->ID, '_mt_screenshot2', false );
?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>