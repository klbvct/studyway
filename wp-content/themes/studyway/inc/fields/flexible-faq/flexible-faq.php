<?php
	$section_prefix         = str_replace(['flexible','-','_'],'',$args['acf_fc_layout']);
	$section_hd             = $args['section_hd'] ?? '';
	$section_des            = $args['section_des'] ?? '';
	$section_repeater       = $args['section_repeater'] ?? '';
?>

<?php if($section_hd){?>
	<div class="row mb40">
		<div class="col-12 text-center nice_title f40 f500 l15">
			<?php get_template_part('inc/fields/elements/section', 'title', ['title' => $section_hd]); ?>
		</div>
	</div>
<?php } ?>

<?php if($section_repeater){?>
	<div class="row">
		<?php foreach($section_repeater as $item){?>
			<?php
				$repeater_hd    = $item['repeater_hd'];
				$repeater_des   = $item['repeater_des'];
			?>
			<div class="col-12 <?php echo $section_prefix;?>_item_wr">
				<div class="<?php echo $section_prefix;?>_item">
					<?php if($repeater_hd){?>
						<div class="<?php echo $section_prefix;?>_question pr20 cursor-pointer position-relative accordeon_toggler" itemprop="name"><?php echo $repeater_hd;?></div>
					<?php } ?>
					<?php if($repeater_des){ ?>
						<div class="<?php echo $section_prefix;?>_answer pt20  position-relative mb0 post_content accordeon_info secondary_color">
							<?php echo $repeater_des;?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
<?php }