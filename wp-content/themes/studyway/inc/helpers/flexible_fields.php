<?php function flexible_fields(): void { ?>
	<?php
		$post_id = '';
		if ( function_exists( 'is_woocommerce' ) ) {
			if (is_product_category() || is_tax() || is_tag()) {
				$post_id        = 'category_'. get_queried_object()->term_id; // need to check for category  or product_cat
			}else if(is_shop()){
				$post_id        = get_option( 'woocommerce_shop_page_id' );
				if ( function_exists('pll_current_language') ) {
					$post_id    = pll_get_post($post_id);
				}
			}
		}else if(is_home()){
			$post_id            = get_option( 'page_for_posts' );
		}else if(is_archive()){
			$post_id            = 'category_'. get_queried_object()->term_id;
		} else {
			global $post;
			$post_id            = $post->ID;
		}
		$sections = get_field( 'flexible_fields', $post_id );
	?>
	<?php if ( $sections ) { ?>
		<?php foreach ( $sections as $section ) { ?>
			<?php
				$template                   = str_replace( '_', '-', $section['acf_fc_layout'] );
				$show_block                 = $section['section_group']['show_block'];
				$block_slick                = $section['section_group']['section_slick'] ?? '';
				$section_bg_image           = $section['section_group']['section_bg_image'] ?? '';
				$section_bg_video           = $section['section_group']['section_bg_video'] ?? '';
				$section_type               = str_replace( ['flexible','-','_'], '', $section['acf_fc_layout'] );
				$section_class              = !empty($section['section_group']['section_class']) ? $section['section_group']['section_class'] : 'pt50 pb50 ' ;
				$section_class              .= $section_bg_image ? ' position-relative dark_bg ' : '';
				$section_class              .= $section_bg_video ? ' position-relative dark_bg ' : '';
				$section_container_class    = $section['section_group']['section_fullwidth'] ? 'fullwidth' : '' ;
				$section_container_class    .= !empty($section['section_group']['section_reverse']) ? ' section_reverse' : '' ;
				$module_url                 = '/inc/fields/' . $template . '/' . $template;
			?>
			<?php if ( $show_block ) { ?>
				<section
						class   = "<?php echo 'section_'.$section_type.'_wr ', $section_class; ?>"
					<?php
						echo $section['section_group']['section_id'] ? 'id="'.$section['section_group']['section_id'].'"' : '';
						echo !empty($section['section_group']['section_bg_color']) ? ' style= "background-color:'.$section['section_group']['section_bg_color'].'"' : '';
					?>
				>
					<?php if($section_bg_image){ ?>
						<?php the_picture($section_bg_image, 'cover_image lazy');?>
					<?php } else if($section_bg_video){ ?>
						<div class="video_background position-absolute"><video autoplay loop muted playsinline><source src="<?php echo $section_bg_video;?>" type="video/mp4"></video></div>
					<?php } ?>
					<div class="container position-relative <?php echo $section_container_class ?>">
						<?php get_template_part( $module_url, '', $section ); ?>
					</div>
				</section>
				<?php
					if ( file_exists( get_template_directory() . $module_url . '.js' ) ) {
						wp_enqueue_script( $template, get_template_directory_uri() . $module_url . '.min.js', [ 'jquery' ], null, true );
					}
					if ( $block_slick ) {
						wp_enqueue_script( 'slick_js', get_template_directory_uri() . '/assets/js/slick.min.js', [ 'jquery' ], null, true );
					}
				?>
			<?php } ?>
		<?php }?>
	<?php }?>
<?php }