		</div><!--content_wrapper-->
		<?php
			if(!is_404() && !is_page([123,492, 1260, 1264]) && (is_singular(['page','post']) || is_front_page())){
				if ( function_exists( 'related_posts' ) ) {
					related_posts();
				}
			}
		?>
		<?php if(!is_404() && !is_page([1260])){?>
			<section class="pt100 pb50 bg000">
				<div class="container">
					<div class="row">
						<div class="col-12 f40 f500 mb50 text-center text-white">
							<?php _e('Консультація щодо навчання за кордоном', 'bobcat');?>
						</div>
						<div class="col-12 f500 mb30 text-center text-white">
							<?php _e('Обери напрям, країну та рівень твоєї освіти', 'bobcat');?>
						</div>
						<?php the_generated_form();?>
					</div>
				</div>
			</section>
		<?php } ?>
		<footer class="colophon pt50 pb50 position-relative" id="footer">
			<div class="ft_wr">
				<div class="container">
					<div class="row">
						<div class="col-12 col-xl-4 mt15 mb15 ">
							<div class="row">
								<div class="col-12"><?php the_picture( [ 'url' => get_field('site_logo_w', 'options'), 'width' => '180', 'height' => '23', ], 'lazy'); ?></div>
								<div class="col-12" style="margin-top: 2rem;"><span id='iasBadge' data-account-id='3617'></span><script async defer crossorigin="anonymous" src="https://www-cdn.icef.com/scripts/iasbadgeid.js"></script></div>
							</div>
							
							
						</div>
						<div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt15 mb15 ft_widget_wr">
							<?php if ( is_active_sidebar( 'ft_widget_1' )){dynamic_sidebar( 'ft_widget_1' );} ?>
						</div>
						<div class="col-12 col-sm-6 col-lg-3 col-xl-2 mt15 mb15 ft_widget_wr">
							<?php if ( is_active_sidebar( 'ft_widget_2' )){dynamic_sidebar( 'ft_widget_2' );} ?>
						</div>
						<div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt15 mb15 ft_widget_wr">
							<div class="f700 f20 text-white mb30 widget-title">
								<?php _e('Contacts', 'bobcat');?>
							</div>
							<?php if(function_exists('the_phones')){ the_phones('d-block mb20');} ?>
							<?php if(function_exists('the_emails')){ the_emails('d-block mb20');} ?>
						</div>
						<div class="col-12 site_info_wr position-relative">
							<div class="row">
								<div class="col-12 col-sm-6 col-xl-4 mt15 mb15">
									<!-- © <?php echo date('Y') . ' '. esc_attr( get_bloginfo( 'name', 'display' ) ) . ' ' . __('All rights reserved','bobcat'); ?> -->
									© <?php echo date('Y') . ' EUROPE CENTER LTD. ' . __('All rights reserved','bobcat'); ?>
								</div>
								<?php if(function_exists('social_repeater') || function_exists('mes_repeater')){ ?>
									<div class="col-12 col-sm-3 col-xl-4 mt15 mb15 d-flex align-items-center flex-wrap ft_soc_wr ">
										<?php
											$soc_class = 'mr20 mes_item';
											if(function_exists('social_repeater')){
												social_repeater($soc_class);
											}
											if(function_exists('mes_repeater')){
												mes_repeater($soc_class);
											}
										?>
									</div>
								<?php } ?>
								<div class="col-12 col-sm-3 col-xl-4 mt15 mb15 d-flex align-items-center flex-wrap ft_soc_wr">
									<?php
										wp_nav_menu( [
											'theme_location'    => 'footer_menu',
											'container'         => false,
											'items_wrap'        => '<ul id="%1$s" class="%2$s ft_nav">%3$s</ul>',
										]);
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		
		<button id="scroll_bt" title="" aria-label="scroll to top button" class="position-fixed text-white zindex100 text-center"><i class="icon-angle-up"></i></button>

		<?php
			get_template_part('inc/parts/modals');
			wp_footer();
			echo get_field('before_body_data','options')??'';
		?>
	</body>
</html>