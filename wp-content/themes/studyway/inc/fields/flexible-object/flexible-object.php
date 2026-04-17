<?php
	/** @noinspection PhpUndefinedVariableInspection */

	$section_prefix         = str_replace(['flexible','-','_'],'',$args['acf_fc_layout']);
	$section_hd             = $args['section_hd'] ?? '';
	$block_object_ids       = $args['posts_object'];
	$block_slick            = $args['section_group']['section_slick'] ?? '';
	$block_wrapper_class    = $block_slick ? 'position-relative slick_wr ' . $section_prefix . '_slider_wr bottom_arrows space_between_slides equal_height' : 'row mt40 posts_archive_wr' ;
	$section_item_class     = $args['section_group']['section_item_class'] ?? '';
	$post_type              = 'post';
	$block_item_class       = $block_slick ? 'loop_'.$post_type.'_item_wr' : 'loop_'.$post_type.'_item_wr col-12 col-sm-6 '.$section_item_class['value'].' mt15 mb15';
?>
<?php if($section_hd){?>
	<div class="row">
		<div class="col-12 text-center nice_title f40 f500 l15">
			<?php get_template_part('inc/fields/elements/section', 'title', ['title' => $section_hd]); ?>
		</div>
	</div>
<?php } ?>

<?php
	if($block_slick){
		$posts_per_page = -1;
	}else if($section_item_class['value'] == 'col-lg-12'){
		$posts_per_page = 1;
	}else if($section_item_class['value'] == 'col-lg-6'){
		$posts_per_page = 2;
	}else if($section_item_class['value'] == 'col-lg-4'){
		$posts_per_page = 3;
	}else if($section_item_class['value'] == 'col-lg-3'){
		$posts_per_page = 4;
	}else if($section_item_class['value'] == 'col-lg-2'){
		$posts_per_page = 6;
	}else if($section_item_class['value'] == 'col-lg-1'){
		$posts_per_page = 12;
	}else if($section_item_class['value'] == 'col-lg-20'){
		$posts_per_page = 5;
	}
	$block_posts_args   = [
		'posts_per_page'=> $posts_per_page,
		'post_type'     => $post_type,
	];
	if($block_object_ids){
		$block_posts_args['post__in']   = $block_object_ids;
		$block_posts_args['orderby']    = 'post__in';
	}
	$block_posts_query = new WP_Query($block_posts_args);
?>
<?php if( $block_posts_query->have_posts() ){?>
	<div class="<?php echo $block_wrapper_class; ?>"  data-cols="<?php echo $section_item_class['label']; ?>">
		<?php while( $block_posts_query->have_posts()){$block_posts_query->the_post(); ?>
			<div class="<?php echo $block_item_class; ?>">
				<?php get_template_part( 'parts/custom_loop',get_post_type() ); ?>
			</div>
		<?php } ?>
	</div>
<?php wp_reset_query(); }