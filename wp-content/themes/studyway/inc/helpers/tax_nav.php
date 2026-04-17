<?php
	function tax_nav(): void { ?>
		<?php
			$post_type                      = get_post_type();
			$item_class                     = '';
			$queried_object_taxonomy        = '';
			$link_href                      = get_post_type_archive_link($post_type);
			if ( function_exists( 'is_woocommerce' ) ) {
				$queried_object_taxonomy    = 'product_cat';
				if(is_shop()){
					$item_class             = 'current';
				}
			}else if(is_archive() && !is_tax()){
				$queried_object_taxonomy    = get_object_taxonomies($post_type) ? get_object_taxonomies($post_type)[0] : '';
			}else if(is_tax()){
				$queried_object_taxonomy    = get_object_taxonomies($post_type)[0];
				$item_class                 = 'current';
			}else if(is_singular(array('page')) || is_home()){
				$link_href                  = get_post_type_archive_link( 'post' );
				$queried_object_taxonomy    = 'category';//pass taxonomy name as argument on single page or in index.php (e.g. category)
				$post_type                  = 'post';
				$item_class                 = 'current';
			}

			$taxonomies     = '';
			if($queried_object_taxonomy != 'language' && !empty($queried_object_taxonomy)){
				$taxonomies = get_terms([
						'taxonomy'   => $queried_object_taxonomy,
						'hide_empty' => true
				]);
			}
		?>
		<?php if(!empty($taxonomies)){?>
			<div class="container mt50 mb40">
				<div class="tax_filter overflowscroll">
					<?php $items_count = count(get_posts(array('post_type'=>$post_type,'post_status'=>'publish','posts_per_page'=>-1,)));?>
					<div class="position-relative tax_filter_item_wr <?php echo $item_class; ?>">
						<a href="<?php echo $link_href; ?>" title="<?php _e('All','bobcat'); ?>" class="tax_filter_item">
							<?php _e('All','bobcat'); ?>
						</a>
					</div>
					<?php foreach ( $taxonomies as $tagname ) {?>
						<?php $term_id = $tagname->term_id; ?>
						<div class="position-relative tax_filter_item_wr <?php echo get_queried_object_id() == $term_id ? 'current' : ''; ?>">
							<a href="<?php echo get_term_link( $tagname->slug, $queried_object_taxonomy ); ?>" title="<?php echo $tagname->name; ?>" class="tax_filter_item">
								<?php echo $tagname->name; ?>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
<?php }