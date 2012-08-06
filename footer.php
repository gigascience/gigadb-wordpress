	<!-- S Footer -->
	<div id="footer_wrapper">
		<div id="footer">
			<div id="footer_logo">
				<a id="footer_logo_a" title="(Giga)nScience" href="http://www.gigasciencejournal.com/">(Giga)nScience</a><a id="footer_logo_b" title="BGI" href="http://en.genomics.cn/navigation/index.action">BGI</a>
			</div>
			<div id="footer_nav">
				<div id="guide">
				<?php
					if ( function_exists( 'register_nav_menus' ) ) {
						wp_nav_menu(array('theme_location'=>'footer_nav','menu_id'=>'guide_nav','menu_class' => '','container'=>'ul'));
					}
				?>
				</div>
				<div id="share">
					<ul>
						<?php if (get_option('giga_facebook_id')) { ?>
						<li id="share_facebook"><a href="http://facebook.com/<?php echo get_option('giga_facebook_id'); ?>">Be a fan on Facebook</a></li>
						<?php } ?>
						<?php if (get_option('giga_twitter_id')) { ?>
						<li id="share_twitter"><a href="http://twitter.com/<?php echo get_option('giga_twitter_id'); ?>">Follow us on Twitter</a></li>
						<?php } ?>
						<?php if (get_option('giga_weibo_id')) { ?>
						<li id="share_weibo"><a href="http://weibo.com/<?php echo get_option('giga_weibo_id'); ?>">Follow us on Sina</a></li>
						<?php } ?>
						<?php if (get_option('giga_rss_id')) { ?>
						<li id="share_rss"><a href="<?php echo get_option('giga_rss_id'); ?>">GigaBlog</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- E Footer -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/all.js"></script>
</body>
</html>