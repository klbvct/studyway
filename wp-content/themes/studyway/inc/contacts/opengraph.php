<?php add_action('wp_head','bobcat_opengraph', 1); ?>
<?php function bobcat_opengraph() : void { ?>
	<?php
		//title
		$title          = get_bloginfo('name');

		//description
		$description    = get_bloginfo('description') ?? '';

		//image
		$image          = get_field('site_logo','options') ? :  ''; // must be square
		if(is_archive()){
			if(function_exists( 'is_woocommerce' ) && is_shop()){
				//title
				$post_id        = get_option( 'woocommerce_shop_page_id' );
				if ( function_exists('pll_current_language') ) {
					$post_id    = pll_get_post($post_id);
				}
				$title          = get_the_title($post_id);

				//description
				$description    = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ? : strip_tags(get_the_excerpt());

				//image
				$image          = get_field('site_logo','options') ? :  ''; // must be square
			}else{
				//title
				$title          = str_replace(['Категорія: ', 'Позначка: '], ['', ''], strip_tags(get_the_archive_title()));

				//description
				$options        = get_option('wpseo_taxonomy_meta');
				if(!empty($options[get_queried_object()->taxonomy])){
					foreach ( $options[get_queried_object()->taxonomy] as $id => $option ) {
						if ( get_queried_object_id() === $id ) {
							$description = $option['wpseo_desc'] ?? get_bloginfo('description');
							break;
						}
					}
				}else {
					$description = get_bloginfo('description') ?? '';
				}

				//image
				$attachment_id  = get_term_meta( get_queried_object_id(), 'thumbnail_id', true );
				$image          = $attachment_id ? wp_get_attachment_image_src( $attachment_id,'large' )['0'] : ''; // must be square
			}
		}else if(is_singular()){
			//title
			$title          = get_the_title();

			//description
			$description    = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ? : strip_tags(get_the_excerpt());

			//image
			$image          = get_post_thumbnail_id() ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )['0'] :  ''; // must be square
		}
	?>
	<meta property="og:type"        content = "website"/>
	<meta property="og:title"       content = "<?php echo $title; ?>" />
	<meta property="og:url"         content = "<?php echo home_url( $_SERVER['REQUEST_URI'] ); ?>"/>
	<meta property="og:description" content = "<?php echo $description; ?>"/>
	<meta property="og:site_name"   content = "<?php bloginfo('name'); ?>"/>
	<meta property="og:image"       content = "<?php echo $image;?> "/>
	<meta property="og:image:width" content = "500" />
	<meta property="og:image:type"  content = "image/png" />
	<meta property="og:locale"      content = "<?php echo function_exists('pll_current_language') ? pll_default_language() : get_locale(); ?>"/>
<?php }