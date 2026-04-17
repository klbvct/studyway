<?php
	$cats       = get_the_category();
	$author_id  = get_the_author_meta('ID');
	$intro      = get_extended(get_post_field('post_content'))['main'];
	$content    = get_extended(get_post_field('post_content'))['extended'];
?>
<article class="mb40">
	<div class="container">
		<div class="row">
			<div class="col-12 post_content">
				<?php if($cats){?>
					<div class="post_cat_wr pt50">
						<?php
							foreach (get_the_category() as $term) {
								$term_link = get_term_link($term);
								if (is_wp_error($term_link)) { continue; }
								echo '<a href="' . esc_url($term_link) . '"  title="' . $term->name . '">' . $term->name . '</a>';
							}
						?>
					</div>
				<?php } ?>
				
				<h1 class="page-title"><?php the_title();?></h1>
				
				<div class="author_info_wr mt40 d-flex">
					<div class="author_img position-relative">
						<?php the_picture(get_field('author_img','user_'.$author_id)['sizes']['thumbnail'], 'lazy cover_image');?>
					</div>
					<div class="author_info d-flex flex-column justify-content-center">
						<div class="author_name f24 f500 mb10 f000"><?php echo get_the_author_meta('display_name', $author_id);?></div>
						<div class="author_position secondary_color"><?php echo get_field('author_position_'.get_current_locale(),'user_'.$author_id) ?? '';?></div>
					</div>
				</div>
				
				<div class="views_wr d-flex mb30 secondary_color w-100 align-items-center">
					<div class="d-flex align-items-center"><i class="icon-eye-1 mr10"></i> <?php echo do_shortcode('[post-views]');?></div>
					<div class="post_date ml30 mr-auto"><?php echo get_the_time( get_option( 'date_format' ) );?></div>
					
					<!-- <?php if(function_exists('social_sharing')){social_sharing();} ?> -->
					<?php if(function_exists('social_repeater') || function_exists('mes_repeater')){ 

						$soc_class = 'mr20 mes_item';
						if(function_exists('social_repeater')){
							social_repeater($soc_class);
						}
						if(function_exists('mes_repeater')){
							mes_repeater($soc_class);
						}

					} ?>

				</div>
				<div class="post_content__center">
					<?php
						if($intro){
							echo apply_filters('the_content', $intro);
						}
					?>
					<div class="post_content_nav_wr mb50 mt30">
						<div class="f600 mb15"><?php _e('Про що пойде мова','bobcat');?>:</div>
						<div class="post_content_nav"></div>
					</div>
					
					<?php if( has_post_thumbnail()){ ?>
						<div class="entry_thumbnail mb20">
							<?php the_picture('', 'lazy', true); ?>
						</div>
					<?php } ?>
					<?php
						if($content){
							echo apply_filters('the_content', $content);
						}
					?>
				</div>


			</div>
		</div>
	</div>
</article>