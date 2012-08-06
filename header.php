<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tags.js"></script>
	<title><?php wp_title(''); if ( !(is_home()) ) { ?> &raquo; <?php } ?><?php bloginfo('name'); ?></title>
	<?php //wp_head(); ?>
</head>
<body <?php body_class($class); ?>>
	<!-- S Head -->
	<div id="header_wrapper">
		<div id="header">
			<div id="hgroup">
				<h1><a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
			</div>
			<div id="nav">
				<?php
					if ( function_exists( 'register_nav_menus' ) ) {
						wp_nav_menu(array('theme_location'=>'header_nav','menu_id'=>'header_nav','menu_class' => '','container'=>'ul'));
					}
				?>
				
				<?php if (is_single() || is_page()) { ?>
				<div id="header_sear">
					<form action="<?php bloginfo('home'); ?>" class="header_searform" method="get">
						<input type="text" class="s" name="s" value=""><input type="submit" value="" class="submit">
					</form>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- E Head -->