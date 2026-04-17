<?php get_header(); global $wp_query; ?>
<section class="mb40">
	<div class="container">
		<div class="row posts_archive_wr">
			<?php if(function_exists('tax_nav')){tax_nav();}?>
			
			<?php if ( have_posts() ) {?>
				<?php while ( have_posts() ) { the_post(); ?>
					<div class="<?php echo get_bobcat_loop_class(get_post_type());?>"><?php get_template_part( 'parts/loop', get_post_type()); ?></div>
				<?php } ?>
			<?php } ?>
			
		</div>
		<?php
			if($wp_query->max_num_pages > 1){
				if(function_exists('loadmore_button')){loadmore_button($wp_query,get_post_type(),get_bobcat_loop_class(get_post_type()));}
			}
		?>
	</div>
</section>
<?php get_footer();