<?php function related_posts(){ ?>
	<?php
		global $post;
		$args = [
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'post__not_in'   => [$post->ID],
			'order'          => 'DESC',
			'orderby'        => 'post_views'
		];
		$related_posts_query = new WP_Query($args);
	?>
	<?php if ($related_posts_query->have_posts()){?>
		<div class="container mt30 pb100">
			<div class="row">
				<div class="col-12 text-center nice_title f40 f500 l15">
					<?php _e('Related articles','bobcat'); ?>
				</div>
				<?php while ($related_posts_query->have_posts()) { $related_posts_query->the_post(); ?>
					<div class="<?php the_bobcat_loop_class(get_post_type());?>" >
						<?php get_template_part( 'parts/loop', get_post_type() );?>
					</div>
				<?php } ?>
				<div class="col-12 text-center mt30">
					<a href="<?php the_permalink(pll_get_post(1219));?>" title="" class="button bordered_bt">
						<?php _e('Усі статті','bobcat');?>
						<span class="ml10">+</span>
					</a>
				</div>
			</div>
		</div>
	<?php wp_reset_query(); } ?>
<?php }