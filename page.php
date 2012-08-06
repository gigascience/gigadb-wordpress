<?php get_header(); ?>
	<!-- S Main -->
	<div id="main_wrapper">
		<div id="main" class="clearfix">
			<?php if (have_posts()): ?>
			<div id="content">
				<?php while (have_posts()):the_post();?>
				<div class="list_bd">
					<div class="content_hd">
						<h3><?php the_title(); ?></h3>
					</div>
					<div class="content_bd">
						<div class="post">
							<?php the_content() ;?>
						</div>
					</div>
					<div class="content_ft"></div>
				</div>
				<?php endwhile;?>
			</div>
			<?php endif;?>
		</div>
	</div>
	<!-- E Main -->
	
<?php get_footer(); ?>