<?php 
//缩略图
if(function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
}

//导航菜单
if ( function_exists('register_nav_menus') ) {
	function mytheme_addmenus() {
		register_nav_menus(array('header_nav' => 'Header Navigation','footer_nav' => 'Footer Navigation'));
	}
	add_action( 'init', 'mytheme_addmenus' );
}

//调整登陆样式
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/custom-login.css" />';
	echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/jquery.js"></script>';
	echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/custom-login.js"></script>';
}
add_action('login_head', 'custom_login');

//调整后台样式
function custom_admin() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/custom-admin.css" />';
	echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/jquery.js"></script>';
	echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/custom-admin.js"></script>';
}
add_action('admin_head', 'custom_admin');

//正文批量替换
function content_str_replace($content = ''){
	$content = str_replace('<!--more-->', '<span class="replace"></span>', $content);
	$content = preg_replace('/<span id="more-.*"><\/span>/', '<span class="replace"></span>', $content);
	return $content;
}
add_filter('the_content', 'content_str_replace', 10);

//移除版本
remove_action('wp_head', 'wp_generator');

//主题基本设置
include_once(TEMPLATEPATH . '/basic_ctrl.php');

//自动缩略图
include_once(TEMPLATEPATH . '/inc/post_thumbnail.php');
?>