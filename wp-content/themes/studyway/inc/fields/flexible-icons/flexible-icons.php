<?php
	$section_prefix         = str_replace(['flexible','-','_'],'',$args['acf_fc_layout']);
	$section_hd             = $args['section_hd'] ?? '';
	$block_slick            = $args['section_group']['section_slick'] ?? '';
	$section_repeater       = $args['section_repeater'] ?? '';
	$block_wrapper_class    = $block_slick ? 'position-relative slick_wr ' . $section_prefix . '_slider_wr bottom_arrows equal_height space_between_slides' : 'row' ;
	$block_item_class       = $block_slick ? ' ': 'col-12 col-sm-6 col-md-4 '.$args['section_group']['section_item_class']['value'].' mt15 mb15 ';
?>

<?php if($section_hd){?>
	<div class="row">
		<div class="col-12 text-center nice_title f40 f500 l15">
			<?php get_template_part('inc/fields/elements/section', 'title', ['title' => $section_hd]); ?>
		</div>
	</div>
<?php } ?>

<?php if($section_repeater){?>
	<div class="<?php echo $block_wrapper_class; ?>" data-cols="<?php echo $args['section_group']['section_item_class']['label']; ?>">
		<?php foreach($section_repeater as $item){?>
			<?php
				$repeater_hd_1      = $item['repeater_hd_1']; //name
				$repeater_hd_2      = $item['repeater_hd_2']; //sub title
				$repeater_url       = $item['repeater_url']; //url
			?>
			<a href="<?php echo $repeater_url; ?>" title="<?php echo $repeater_hd_1; ?>" target="_blank" class="<?php echo $section_prefix;?>_item_wr <?php echo $block_item_class;?>" >
				<div class="<?php echo $section_prefix;?>_item">
					<div class="<?php echo $section_prefix;?>_img_wr position-relative zoom_image">
						<?php the_picture($item['repeater_img'] ?? '','cover_image lazy');?>
					</div>
					<div class="<?php echo $section_prefix;?>_item_footer">
						<div class="d-block f500 mb15 f000">
							<?php echo $repeater_hd_1; ?>
						</div>
						<?php if($repeater_hd_2){?>
							<div class="secondary_color">
								<?php echo $repeater_hd_2; ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</a>
		<?php } ?>
	</div>
<?php }