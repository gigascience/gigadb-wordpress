<!-- S 主搜 -->
<div id="main_sear">
	<?php if (is_home()) { ?>
	<div id="sear_hd">
		<h3>GigaDB</h3>
	</div>
	<?php } elseif (is_404()) { ?>
	<div id="sear_hd">
		<h5>Data Not Found, <em>Try another keyword!</em></h5>
	</div>
	<?php } ?>
	<div id="sear_bd">
		<form method="get" class="searchform" action="<?php bloginfo('home'); ?>">
			<input type="text" value="SEARCH by Species, DOI, Data Type" name="s" class="s" autocomplete="off" /><input type="submit" class="submit" value="" />
		</form>
		<?php 
		if (get_option('giga_data') == 'show') { ?>
		<div id="sear_option">
			<span id="browse">Browse by Dataset</span><span id="select"><span>All databases</span> <i class="down_arrow"></i></span><ul>
				<li><a href="javascript:;" title="All databases">All databases</a></li>
				<?php 
				$wp_cat_list = wp_list_categories('style=none&echo=0&hide_empty=0&hierarchical=true&title_li=');
				$wp_cat_str = preg_replace('/<br \/>/','',$wp_cat_list);
				$wp_cat_str1 = preg_replace('/<a /','<li><a ',$wp_cat_str);
				$wp_cat_str2 = preg_replace('/<\/a>/','</a></li>',$wp_cat_str1);
				echo $wp_cat_str2;
				?> 
			</ul>
		</div>
		<?php } ?>
	</div>
	<?php if (is_home() || is_404()) { ?>
	<div id="sear_ft">
		<p>GigaDB contains discoverable, trackable, and citable data that have been assigned DOIs and are available for public download and use.</p>
	</div>
	<?php } ?>
	
	<?php 
		$cloud_array = wp_tag_cloud('number=0&format=array&echo=false&hide_empty=0');
		if ($cloud_array) {
			$cloud_string = implode(',', $cloud_array);
			$str = preg_replace('/<a [^>]*>|<\/a>/','"',$cloud_string);
		}
	?>
	<script type="text/javascript">
		$(function() {
			$('.searchform .s').tagSuggest({
				tags: [
					<?php echo $str; ?>
				]
			});
		})
	</script>
</div>
<!-- E 主搜 -->