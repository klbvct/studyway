<?php
	function get_the_picture($images, $class = '', $featured = false, $loop_featured = false) : string {
		$lazy        = str_contains( $class, 'lazy' ) ? 'lazy' : 'eager';
		$class       = str_replace( 'lazy', '', $class );
		$sources     = '';
		$mobile_size = ! str_contains( $class, 'cover_image' ) ? 'medium' : 'thumb_420';
		$placeholder = get_template_directory_uri() . '/images/noimage.jpg';
		
		// featured images
		if ( $featured ) {
			$thumbnail_id   = get_post_thumbnail_id();
			$alt            = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ? : get_the_title();
			$title          =  get_the_title($thumbnail_id) ? : get_the_title();
			$src_mobile     = wp_get_attachment_image_src( $thumbnail_id, $mobile_size );
			$src_large      = wp_get_attachment_image_src( $thumbnail_id, 'large' );
			$src_medium     = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
			if( $loop_featured ) {
				//				if($src_large['0'] && $src_mobile['0']){
				//					$nice_images['420'] = [
				//						'src'   => $src_large['0'],
				//						'width' => $src_large['1'] ?? 420,
				//						'height'=> $src_large['2'] ?? 420,
				//					];
				//				}
				$nice_images ['320'] = [
					'src'       => $src_mobile['0'] ?? $placeholder,
					'width'     => $src_mobile['1'] ?? 320,
					'height'    => $src_mobile['2'] ?? 320,
				];
			}else{
				$images         = wp_get_attachment_image_src( $thumbnail_id, 'full' ) ?? '';
				if(is_array($images) && $images['0'] && $src_large['0'] && $src_medium['0'] ) {
					$nice_images['1201'] = [
						'src'   => $images['0'],
						'width' => $images['1'] ?? 1201,
						'height'=> $images['2'] ?? 1201,
					];
				}
				if(is_array($src_large) && $src_large['0'] && $src_medium['0']){
					$nice_images['420'] = [
						'src'   => $src_large['0'] ?? $placeholder,
						'width' => $src_large['1'] ?? 420,
						'height'=> $src_large['2'] ?? 420,
					];
				}
				$nice_images ['320'] = [
					'src'       => $src_medium['0'] ?? $placeholder,
					'width'     => $src_medium['1'] ?? 320,
					'height'    => $src_medium['2'] ?? 320,
				];
			}
			foreach ( $nice_images as $key => $val ) {
				if ( $val != '' ) {
					$sources  .= '<source media="(min-width: ' . $key . 'px)" srcset="' . $val['src'] . '">';
				}
			}
			$img_data = [
				'src'       => $images['0'] ?? $placeholder,
				'width'     => $images['1'] ?? 300,
				'height'    => $images['2'] ?? 300,
			];
			// acf images array
		}else if( is_array( $images )){
			$alt            = $images['alt'] ?? get_the_title();
			$title          = $images['title'] ?? get_the_title();
			if(isset($images['url']) && isset($images['sizes']['large']) && isset($images['sizes'][ $mobile_size ])) {
				$nice_images['992'] = [
					'src'   => $images['url'],
					'width' => $images['width'] ?? 920,
					'height'=> $images['height'] ?? 920,
				];
			}
			if(isset($images['sizes']['large']) && isset($images['sizes'][ $mobile_size ])){
				$nice_images['420'] = [
					'src'   => $images['sizes']['large'],
					'width' => $images['sizes']['large-width'] ?? 420,
					'height'=> $images['sizes']['large-height'] ?? 420,
				];
			}
			$nice_images ['320'] = [
				'src'       => $images['sizes'][ $mobile_size ] ?? $images['url'],
				'width'     => $images['sizes'][ $mobile_size . '-width' ] ?? 320,
				'height'    => $images['sizes'][ $mobile_size . '-height' ] ?? 320,
			];
			
			foreach ( $nice_images as $key => $val ) {
				if ( $val != '' ) {
					$sources  .= '<source media="(min-width: ' . $key . 'px)" srcset="' . $val['src'] . '">';
				}
			}
			$img_data = [
				'src'       => $images['url'],
				'width'     => $images['width'],
				'height'    => $images['height'],
			];
			// single image link
		}else{
			$img_data = [
				'src'       => !empty($images) ? $images : $placeholder,
				'width'     => 300,
				'height'    => 300
			];
			$sources    .= '<source media="(min-width: 320px)" srcset="' . $img_data['src'] . '">';
			$alt        = get_the_title();
			$title      = get_the_title();
		}
		
		$img = '<img src="' . $img_data['src'] . '" title="'.$title.'" alt="' . $alt . '" width="' . $img_data['width'] . '" height="' . $img_data['height'] . '" loading="' . $lazy . '">';
		return '<picture class="' . $class . '" >' . $sources . $img . '</picture>';
	}
	function the_picture($images, $class = '', $featured = false, $loop_featured = false) : void {
		echo get_the_picture($images, $class, $featured, $loop_featured);
	}
	
	
	/* examples
	  1. $featured == true && $loop_featured == true
	  the_picture('', 'lazy cover_image', true, true);

	  2. $featured == true && $loop_featured == false
	  the_picture('', 'lazy', true);

	  3. acf images as array
	  the_picture($block_img, 'cover_image lazy');

	  4. custom images as array
	  $attachment = [
	       'alt'           => get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?? get_the_title(),
	       'url'           => wp_get_attachment_image_src( $attachment_id,'large' )[0],
	       'sizes'         => array(
	           'large'     => wp_get_attachment_image_src( $attachment_id,'large' )[0],
	           'thumb_420' => wp_get_attachment_image_src( $attachment_id,'thumb_420' )[0],
	       ),
	       'width'         => wp_get_attachment_image_src( $attachment_id,'large' )[1],
	  		'height'        => wp_get_attachment_image_src( $attachment_id,'large' )[2],
	  	];
	   the_picture( $attachment,'cover_image lazy');

	  5.single image link
	  the_picture( wp_get_attachment_image_src( $attachment_id, "medium" )['0'],'cover_image lazy');

	  6. simple array
	   the_picture( [ 'url' => get_template_directory_uri().'/images/ft_logo.svg', 'width' => '170', 'height' => '24', ], 'lazy');
	  7. Custom array
	  				the_picture([
					'url'           => get_template_directory_uri().'/images/bg_prices.png',
					'sizes'         => [
				        'large'     => get_template_directory_uri().'/images/bg_prices.png',
				        'thumb_420' => get_template_directory_uri().'/images/bg_prices_320.png',
					],
					'width'         => '1201',
					'height'        => '1201',
				], 'lazy cover_image');
		 8. Custom array
		the_picture([
			'url'       => $repeater_img['sizes']['large'],
			'width'     => $repeater_img['sizes']['large-width'],
			'height'    => $repeater_img['sizes']['large-height'],
			'alt'       => $repeater_img['alt']
	    ], 'lazy');

	*/