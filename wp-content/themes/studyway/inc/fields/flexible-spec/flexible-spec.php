<?php
	$section_prefix = str_replace(['flexible','-','_'],'',$args['acf_fc_layout']);
	$section_hd     = $args['section_hd'] ?? '';
?>
<?php if($section_hd){?>
	<div class="row">
		<div class="col-12 text-center nice_title f40 f500 l15">
			<?php get_template_part('inc/fields/elements/section', 'title', ['title' => $section_hd]); ?>
		</div>
	</div>
<?php } ?>

<?php if(have_rows('spec_repeater_'.get_current_locale(), 'options')){ ?>
	<div class="nice_item_wr">
		<?php while(have_rows('spec_repeater_'.get_current_locale(), 'options')){the_row(); ?>
			<a href="#callback" title="<?php echo get_sub_field('repeater_hd');?>" data-toggle="modal" data-target="#callback" class="nice_item f000" data-select="menu-1" <?php echo get_row_index() > 6 ? 'style="display: none"' : ''; ?>>
				<?php
					$repeater_img = get_sub_field('repeater_img');
					if($repeater_img){
						the_picture( [ 'url' => $repeater_img['sizes']['medium'], 'width' => '24', 'height' => '31', ], 'lazy mr15');
					}
					echo get_sub_field('repeater_hd');
				?>
			</a>
			<?php if(get_row_index() === 6){?>
				<div class="text-center mt40 w-100">
					<a href="#" title="<?php _e('Переглянути всі напрямки', 'bobcat');?>" class="button bordered_bt show_all">
						<?php _e('Переглянути всі напрямки', 'bobcat');?>
						<span class="ml10">+</span>
					</a>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php }