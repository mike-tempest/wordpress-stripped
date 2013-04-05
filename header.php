<?php
/**
 * header.php
 * @package wordpress-stripped
 *
 * The only styles / scripts that should appear in this file are conditional.
 * The global styles / scripts are handles in functions >> misc >> load-scripts.php && load-styles.php respectively.
 *
 */
?>
<!doctype html>
<!--[if lt IE 7 ]>
	<html lang="en" class="no-js ie6">
<![endif]-->
<!--[if IE 7 ]>
	<html lang="en" class="no-js ie7">
<![endif]-->
<!--[if IE 8 ]>
	<html lang="en" class="no-js ie8">
<![endif]-->
<!--[if IE 9 ]>
	<html lang="en" class="no-js ie9">
<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
	<html lang="en">
<!--<![endif]-->
	<head profile="http://gmpg.org/xfn/11">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
		<title><?php wp_title(); ?></title>
                <link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/6f355a37-47f6-4e91-b561-5dd9d44cd8d3.css"/>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="page">
			<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
			chromium.org/developers/how-tos/chrome-frame-getting-started -->
			<!--[if lt IE 7]>
				<p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
			<![endif]-->
			<header class="page-header">
				<?php wp_nav_menu( array(
					'theme_location' => 'header',
					'container' => 'nav',
					'container_id' => 'header-navigation-container',
					'container_class' => 'navigation',
					'menu_id' => 'header-navigation-list',
					'menu_class' => 'clearfix',
				) ); ?>
			</header>
			<div class="page-content" role="main">
