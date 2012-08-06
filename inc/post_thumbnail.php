<?php 
function post_thumbnail(){
	global $post;
	if(has_post_thumbnail()){	//如果有缩略图，则显示缩略图
	
		$pic_url = get_post_meta($post->ID, 'Image Source url', true); 
		
		$timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		if(get_post_meta($post->ID,'Image Source url',true)){
			$post_timthumb = '<a href="'.$pic_url.'" target="_blank" title="'.$post->post_title.'"><img class="post_caption_img" src="'.$timthumb_src[0].'" alt="'.$post->post_title.'" /></a>';
		} else {
			$post_timthumb = '<img class="post_caption_img" src="'.$timthumb_src[0].'" alt="'.$post->post_title.'" />';
		}
		
	} else {
		$post_timthumb = '<img class="post_caption_img" src="" />';
	}
	echo $post_timthumb;
}
?>