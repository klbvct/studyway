<?php
	add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' ); // Disables the block editor from managing widgets in the Gutenberg plugin.
	add_filter( 'use_widgets_block_editor', '__return_false' ); // Disables the block editor from managing widgets in the Gutenberg plugin.
	add_filter( 'auto_core_update_send_email', '__return_false' ); // Disable core update emails
	add_filter( 'auto_plugin_update_send_email', '__return_false' ); // Disable plugin update emails
	add_filter( 'auto_theme_update_send_email', '__return_false' ); // Disable theme update emails
	add_filter( 'wpseo_json_ld_output', '__return_false' ); // disable yoast seo schema json data
	add_filter( 'json_enabled','__return_false'); // disable json rest api
	add_filter( 'json_jsonp_enabled', '__return_false'); // disable json rest api
	add_action( 'wp_enqueue_scripts', function(){wp_dequeue_style('wp-block-library'); if(!is_admin()) {
		wp_dequeue_style( 'dashicons' );wp_dequeue_style( 'post-views-counter-frontend' );
	}}); // dequeue block styles
	add_action( 'wp_footer', function(){wp_dequeue_script( 'wp-embed' );}); // dequeue wp-embed
	add_action( 'init', function(){remove_image_size( '1536x1536' );remove_image_size( '2048x2048' );}); // remove unused image sizes
	add_filter( 'intermediate_image_sizes', function($sizes) {return array_diff($sizes, ['medium_large']);}); // remove unused image sizes
	
	//remove_action( 'wp_head', 'wp_generator' );
	
	/**
	 * Removes auto sizes CSS fix from the provided content.
	 *
	 * @param bool $add_auto_sizes Set to true if auto sizes need to be added, otherwise set to false.
	 *
	 * @return bool Returns true if the auto sizes CSS fix was successfully removed, false otherwise.
	 */
	function remove_auto_sizes_css_fix($add_auto_sizes) {return false;}
	add_filter('wp_img_tag_add_auto_sizes', 'remove_auto_sizes_css_fix');
	

	/**
	 * Removes 'jquery-migrate' dependency from the registered 'jquery' script.
	 *
	 * @param stdClass $scripts The scripts object containing registered scripts.
	 *
	 * @return void
	 */
	function remove_jq_migrate( $scripts ): void {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) {
				$script->deps = array_diff( $script->deps,['jquery-migrate']);
			}
		}
	}
	add_action( 'wp_default_scripts', 'remove_jq_migrate' );
	
	/**
	 * Disable emojis in WordPress.
	 *
	 * @return void
	 */
	function disable_emojis(): void {
		remove_action( 'wp_head', 'wp_resource_hints' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		add_filter( 'emoji_svg_url', '__return_false' );
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'rsd_link');
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	}
	function disable_emojis_tinymce( $plugins ): array {if ( is_array( $plugins ) ) {return array_diff( $plugins, ['wpemoji'] );} else {return array();}}
	add_action( 'init', 'disable_emojis' );
	
	/**
	 * Preload large image based on conditions and image sizes.
	 *
	 * @return void
	 */
	function preload_large_image(){
		$flexibleFields = get_field('flexible_fields');
		if (isset($flexibleFields[0]['section_img'])) {
			$large_images = $flexibleFields[0]['section_img'];
			if(is_array($large_images['sizes'])){
				if($large_images['sizes']['thumb_420']){
					generate_mobile_preload_html($large_images['sizes']['thumb_420']);
				}
				generate_desktop_preload_html($large_images['url']);
			}
		} else if (is_singular(['product', 'post', 'page']) && has_post_thumbnail()){
			generate_mobile_preload_html(get_the_post_thumbnail_url( get_the_ID(),'thumb_420'));
			generate_desktop_preload_html(get_the_post_thumbnail_url( get_the_ID(),'ful'));
		}
		if(function_exists( 'is_woocommerce')){
			global $wp_query;
			if(is_product_category() && ! empty( $wp_query->posts[0]->ID ) ) {
				generate_mobile_preload_html(get_the_post_thumbnail_url( $wp_query->posts[0]->ID, 'woocommerce_single' ));
			}
		}
	}
	function generate_mobile_preload_html($image_url){
		echo( '<link rel="preload" href="' .$image_url. '.webp" as="image" fetchpriority="high" media="(max-width: 575px)">' );
	}
	function generate_desktop_preload_html($image_url){
		echo '<link rel="preload" href="'.$image_url.'" as="image" fetchpriority="high" media="(min-width: 576px)">';
	}
	add_action('wp_head','preload_large_image', 1);