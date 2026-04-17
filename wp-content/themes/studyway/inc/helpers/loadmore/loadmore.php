<?php
	add_action('wp_ajax_bobcatloadmore', 'bobcat_loadmore');
	add_action('wp_ajax_nopriv_bobcatloadmore', 'bobcat_loadmore');
?>
<?php function bobcat_loadmore(): void { ?>
	<?php
	$args                   = unserialize(stripslashes($_POST['query']));
	$args['paged']          = $_POST['page'] + 1;
	$args['post_status']    = 'publish';
	$post_type              = $_POST['posttype'] ? : 'post';
	query_posts( $args );
	?>
	<?php if( have_posts() ) { ?>
		<?php while( have_posts() ){ the_post();?>
			<?php if($_POST['customtpl']){ ?>
				<?php get_template_part('parts/loop', $_POST['customtpl']);?>
			<?php } else { ?>
				<div class="<?php echo $_POST['item_class']; ?>">
					<?php get_template_part('parts/loop', $post_type);?>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } wp_die(); ?>
<?php } ?>
<?php function loadmore_button(object $query, string $posttype ='', string $item_class = '', string $customtpl=''): void { ?>
	<?php
	wp_enqueue_script('loadmore_js', get_template_directory_uri() . '/inc/helpers/loadmore/loadmore.min.js', ['jquery'], null, true );
	$totalPages     = $query->max_num_pages;
	$page_number    = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
	$per_page       = $query->query_vars['posts_per_page'] ?? 12;
	?>
	<?php if($totalPages > 1){ ?>
		<?php if($page_number != $totalPages){ ?>
			<div class="row mt30 loadmore_wr">
				<div class="col-12 text-center">
					<button
							class           = 'button loadmore_button bordered_bt'
							data-class      = '<?php echo $item_class;?>'
							data-query      = '<?php echo serialize($query->query_vars); ?>'
							data-posttype   = '<?php echo $posttype; ?>'
							data-loadingtext= '<?php _e("Loading","bobcat"); ?>'
							data-current    = '<?php echo $page_number; ?>'
							data-perpage    = '<?php echo $per_page; ?>'
							data-totalpages = '<?php echo $totalPages; ?>'
							aria-label      = '<?php _e("Load more","bobcat");?>'
							data-customtpl  = '<?php echo $customtpl; ?>'
					>
						<?php _e("Load more","bobcat");?>
						<span class="ml10">+</span>
					</button>
				</div>
			</div>
		<?php }?>
	<?php }?>
<?php }