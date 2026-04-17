<?php
	$section_prefix = str_replace(['flexible','-','_'],'',$args['acf_fc_layout']);
	$section_hd     = $args['section_hd'] ?? '';
?>
<div class="row mb40">
	<?php if($section_hd){?>
		<div class="col-12 col-md-6 mt15 mb15">
			<?php get_template_part('inc/fields/elements/section', 'title', ['title' => $section_hd]); ?>
		</div>
	<?php } ?>
	<?php if(($args['section_group']['show_socials'] && function_exists('social_repeater')) || ($args['section_group']['show_messengers'] && function_exists('mes_repeater'))){?>
		<div class="col-12 col-md-6 mt15 mb15 align-self-end">
			<div class="d-flex align-items-center flex-wrap">
				<?php
					$soc_class = 'mr20 mes_item f000';
					if(function_exists('social_repeater')){
						social_repeater($soc_class);
					}
					if(function_exists('mes_repeater')){
						mes_repeater($soc_class);
					}
				?>
			</div>
		</div>
	<?php } ?>
</div>

<div class="row">
	<div class="col-12 col-md-6 mt15 mb15">
		<?php if($args['section_group']['show_phone'] && function_exists('the_phones')){?>
			<div class="d-flex ct_item">
				<div class="label"><?php _e('Phone', 'bobcat'); ?></div>
				<?php the_phones('d-block'); ?>
			</div>
		<?php } ?>
	</div>
	<div class="col-12 col-md-6 mt15 mb15">
		<?php if($args['section_group']['show_address'] && function_exists('the_address')){?>
			<div class="d-flex ct_item">
				<div class="label"><?php _e('Адреса', 'bobcat'); ?></div>
				<?php the_address('d-block'); ?>
			</div>
		<?php } ?>
	</div>
	<div class="col-12 col-md-6 mt15 mb15">
		<?php if($args['section_group']['show_email'] && function_exists('the_emails')){?>
			<div class="d-flex ct_item">
				<div class="label"><?php _e('Пошта', 'bobcat'); ?></div>
				<?php the_emails('d-block'); ?>
			</div>
		<?php } ?>
	</div>
	<div class="col-12 col-md-6 mt15 mb15">
		<?php if($args['section_group']['show_hours'] && function_exists('the_hours')){?>
			<div class="d-flex ct_item">
				<div class="label"><?php _e('Hours', 'bobcat'); ?></div>
				<?php the_hours('d-block'); ?>
			</div>
		<?php } ?>
	</div>
</div>