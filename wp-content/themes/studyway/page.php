<?php get_header(); ?>

<?php if(get_field('show_title')){?>
	<article>
		<section class="position-relative page_bg_wr">
			<?php if( has_post_thumbnail()){  the_picture('', 'contain_image', true); } ?>
				<div class="container" >
					<div class="row">
						<div class="col-12">
							<h1 class="page-title mb50 text-center"><?php the_title();?></h1>
							<?php if(!is_page([1260, 1264])){ ?>
								<div class="f500 mb30 text-center">
									<?php _e('Обери напрям, країну та рівень твоєї освіти', 'bobcat');?>
								</div>
								<?php the_generated_form();?>
							<?php } ?>
						</div>
					</div>
				</div>
		</section>
		<div class="container">
			<div class="row">
				<div class="col-12 post_content">
					<?php
						if ( have_posts() ) {
							while ( have_posts() ) { the_post();
								the_content();
							}
						}
					?>
				</div>
			</div>
		</div>
	</article>
<?php } ?>

<?php if(function_exists('flexible_fields')){flexible_fields();} ?>

<?php get_footer();