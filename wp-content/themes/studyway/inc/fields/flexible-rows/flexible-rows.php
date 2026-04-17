<?php
	$section_prefix         = str_replace(['flexible','-','_'],'',$args['acf_fc_layout']);
	$section_hd             = $args['section_hd'] ?? '';
	$section_des            = $args['section_des'] ?? '';
	$section_img            = $args['section_img'] ?? '';
?>
<?php if($section_hd || $section_des){?>
	<div class="row mb40">
		<?php if($section_img){the_picture($section_img, 'lazy section_img d-none d-xl-block');}?>
		<?php if($section_hd){?>
			<div class="col-12 f40 f600 text-center l12">
				<?php get_template_part('inc/fields/elements/section', 'title', ['title' => $section_hd]); ?>
			</div>
		<?php } ?>
		<?php if($section_des){?>
			<div class="col-12 <?php echo $section_hd ? 'mt50' : '';?>">
				<?php get_template_part('inc/fields/elements/section', 'description', ['description' => $section_des]); ?>
			</div>
			<div class="text-center col-12 show_more_wr">
				<a href="#" title="<?php _e('Load more', 'bobcat');?>" class="button bordered_bt show_more">
					<?php _e('Load more', 'bobcat');?>
					<span class="ml10">+</span>
				</a>
			</div>
		<?php } ?>
	</div>
<?php }