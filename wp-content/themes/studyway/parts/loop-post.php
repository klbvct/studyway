<?php $cats = get_the_category(); ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" class="inner_wr h-100 d-block">
	<div  class="d-block loop_title_wr f24 l12 mb15 f000" ><?php the_title();?></div>
	<div class="loop_post_excerpt secondary_color mb15 l12"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></div>
	
	<div class="primary_color"><?php _e('Read more','bobcat');?></div>
	
	<div class="loop_info_wr">
		<?php if($cats){?>
			<div class="post_cat_wr">
				<?php
					foreach (get_the_category() as $term) {
						$term_link = get_term_link($term);
						if (is_wp_error($term_link)) { continue; }
						echo '<div class="mb0 cat_item">' . $term->name . '</div>';
					}
				?>
			</div>
			<div class="d-flex align-items-center secondary_color">
				<i class="icon-eye-1 mr10"></i>
				<?php echo pvc_get_post_views( get_the_ID() );?>
			</div>
		<?php } ?>
	</div>
</a>