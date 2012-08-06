<?php get_header(); ?>
	<!-- S Main -->
	<div id="main_wrapper">
		<div id="main" class="clearfix">
			<?php if (have_posts()): ?>
			
			<?php while (have_posts()):the_post();?>
			<!-- S Content -->
			<div id="content">
				<div class="content_hd">
					<h2><?php the_title(); ?></h2>
				</div>
				<div class="content_bd">
					<div class="post">
						<?php the_content() ;?>
					</div>
					<div id="download" class="widget">
						<div class="widget_hd">
							<h3>download</h3>
						</div>
						<div class="widget_bd">
							<p></p>
						</div>
					</div>
				</div>
				<div class="content_ft"></div>
			</div>
			<!-- E Content -->
			
			<!-- S Sidebar -->
			<div id="sidebar">
				<div class="widget no_widget_hd">
					<div class="sidebar_bd">
						<div class="widget_bd">
							<div class="post_caption">
								<?php post_thumbnail(); ?>
								<h4><?php the_title(); ?></h4>
								<a href="http://creativecommons.org/licenses/by-nc/2.0/"><img src="<?php bloginfo('template_directory'); ?>/imgs/images/cc.jpg" alt="" /></a>
							</div>
						</div>
					</div>
					<div class="sidebar_ft"></div>
				</div>
				
				<div class="widget">
					<div id="citation" class="sidebar_bd">
						<div class="widget_hd">
							<h3>Citation</h3>
						</div>
						<div class="widget_bd">
							<p></p>
						</div>
					</div>
					<div class="sidebar_ft"></div>
				</div>
				
				<?php 
					$association_src = get_post_meta($post->ID, 'Association Source url', true);
					$association_url = get_post_meta($post->ID, 'Association link url', true);
					if ($association_src) { ?>
					<div class="widget">
						<div id="association" class="sidebar_bd">
							<div class="widget_hd">
								<h3>Data in association with</h3>
							</div>
							<div class="widget_bd">
								<p><a href="<?php echo $association_url; ?>"><img src="<?php echo $association_src; ?>" alt=""></a></p>
							</div>
						</div>
						<div class="sidebar_ft"></div>
					</div>
				<?php } ?>
			</div>
			<!-- E Sidebar -->
			<?php endwhile;?>
			
			<?php endif;?>
		</div>
	</div>
	<!-- E Main -->
<?php get_footer(); ?>