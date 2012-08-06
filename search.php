<?php get_header(); ?>
	<?php if (have_posts()): ?>
	<div id="sear_wrapper">
		<?php include (TEMPLATEPATH . '/main_sear.php'); ?>
	</div>
	<!-- S Main -->
	<div id="main_wrapper">
		<div id="main" class="clearfix">
		<?php 
			$cat_name_cookie = $_COOKIE['cat_name'];
			if ($cat_name_cookie != 'All databases') {
				$cat_query = "select term_id from $wpdb->terms where name='{$cat_name_cookie}'";
				$cat_id = $wpdb->get_var($cat_query);
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts("s=$s&paged=$paged&cat=". $cat_id);
			}
		?>
			
			<div id="content">
				<div class="list_hd">
					<h2>The following datasets match your search:</h2>
				</div>
				<?php while (have_posts()):the_post();?>
				<?php
					$title = get_the_title();
					$content = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,'......');
					$keys = explode(' ',$s);
					$title = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color:#f60;">\0</span>',$title);
					$content = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color:#f60;">\0</span>',$content);
				?>
				<div class="list_bd">
					<div class="content_hd">
						<h3><?php echo $title; ?></h3>
					</div>
					<div class="content_bd">
						<div class="post">
							<p><?php echo $content;?></p>
							<div class="read_more">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">read more</a> >>
							</div>
						</div>
					</div>
					<div class="content_ft"></div>
				</div>
				<?php endwhile;?>
			</div>
			<div id="page_nav">
				<div class="page_prev_next page_prev">
					<?php previous_posts_link('Forward') ?>
				</div>
				<div class="page_prev_next page_next">
					<?php next_posts_link('Next') ?>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			if ($('.list_bd').length <= 0) {
				var searHtml = '<div id="main_sear"><div id="sear_hd"><h5>Data Not Found, <em>Try another keyword!</em></h5></div><div id="sear_bd"><form method="get" class="searchform" action="http://hmu030146.chinaw3.com"><input type="text" value="SEARCH by Species, DOI, Data Type" name="s" class="s" autocomplete="off"><span class="tagMatches"></span><input type="submit" class="submit" value=""></form><div id="sear_option"><span id="browse">Browse by Dataset</span><span id="select"><span>All databases</span> <i class="down_arrow"></i></span><ul><li class="select_option"><a href="javascript:;" title="All databases">All databases</a></li><li class="cat-item cat-item-8 select_option"><a href="http://hmu030146.chinaw3.com/?cat=8" title="View all posts filed under EST">EST</a></li><li class="cat-item cat-item-1 select_option"><a href="http://hmu030146.chinaw3.com/?cat=1" title="View all posts filed under GigaData">GigaData</a></li><li class="cat-item cat-item-9 select_option"><a href="http://hmu030146.chinaw3.com/?cat=9" title="View all posts filed under GSS">GSS</a></li><li class="cat-item cat-item-5 select_option"><a href="http://hmu030146.chinaw3.com/?cat=5" title="View all posts filed under Nucleotide">Nucleotide</a></li><li class="cat-item cat-item-6 select_option"><a href="http://hmu030146.chinaw3.com/?cat=6" title="View all posts filed under Protein">Protein</a></li><li class="cat-item cat-item-7 select_option"><a href="http://hmu030146.chinaw3.com/?cat=7" title="View all posts filed under Taxonomy">Taxonomy</a></li><li class="cat-item cat-item-10 select_option"><a href="http://hmu030146.chinaw3.com/?cat=10" title="View all posts filed under UniGene">UniGene</a></li><li class="cat-item cat-item-11 select_option"><a href="http://hmu030146.chinaw3.com/?cat=11" title="View all posts filed under UniSTS">UniSTS</a></li></ul></div></div></div>';
				$('#sear_wrapper').remove();
				$(searHtml).prependTo($('#main'));
				$('#content, #page_nav').remove();
				$('body').removeClass('search').addClass('error404');
			}
		</script>
	</div>
	<!-- E Main -->
	<?php else: ?>
	<!-- S Main -->
	<div id="main_wrapper">
		<div id="main" class="clearfix">
			<?php include (TEMPLATEPATH . '/main_sear.php'); ?>
			<script type="text/javascript">
			$(function() {
				$('body').removeClass('search').addClass('error404');
				$('<div id="sear_hd"><h5>Data Not Found, <em>Try another keyword!</em></h5></div>').prependTo($('#main_sear'));
			})
			</script>
		</div>
	</div>
	<!-- E Main -->
	<?php endif;?>
<?php get_footer(); ?>
