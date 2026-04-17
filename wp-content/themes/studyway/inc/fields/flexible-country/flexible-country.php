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

<?php if(have_rows('country_repeater_'.get_current_locale(), 'options')){ ?>
	<div class="nice_item_wr row justify-content-center">
		<?php while(have_rows('country_repeater_'.get_current_locale(), 'options')){the_row(); ?>
			<div class="col-6 col-lg-3">
				<a href="<?php echo get_sub_field('repeater_url'); ?>" title="<?php echo get_sub_field('repeater_hd');?>" class="f000 country_item mt5 mb5"  <?php echo get_row_index() > 4 ? 'style="display: none"' : ''; ?>>
					<?php
						$repeater_img = get_sub_field('repeater_img');
						if($repeater_img){
							the_picture( [ 'url' => $repeater_img['sizes']['medium'], 'width' => '40', 'height' => '40', ], 'lazy mr15');
						}
						echo get_sub_field('repeater_hd');
					?>
				</a>
			</div>
			<?php if(get_row_index() === 4){?>
				<div class="text-center mt40 col-12 w-100">
					<a href="#" title="<?php _e('Всі країни', 'bobcat');?>" class="button bordered_bt show_all">
						<?php _e('Всі країни', 'bobcat');?>
						<span class="ml10">+</span>
					</a>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php }