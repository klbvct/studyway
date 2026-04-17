<?php add_filter( 'paginate_links', function($link){if(is_paged()){$link= str_replace('page/1/', '', $link);}return $link;}); //remove page/1 from pagination to avoid redirects ?>
<?php function bobcat_pagination($query) : void { ?>
	<?php if($query->max_num_pages > 1){ ?>
		<div class="row pagination_wr mt40">
			<div class="col-12 pagination d-flex flex-wrap justify-content-center  <?php echo is_active_sidebar('left_blog_widget_area') ? 'col-xl-9 ml-auto' : '';?>">
				<?php
					$big                = 999999999;
					echo paginate_links( [
						'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'        => '?paged=%#%',
						'current'       => max( 1, get_query_var('paged') ),
						'total'         => $query->max_num_pages,
						'prev_text'     => '',
						'next_text'     => '',
					] );
				?>
			</div>
		</div>
	<?php } ?>
<?php }