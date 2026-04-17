<?php
	add_action('admin_head', function(){echo '<style>#edittag{max-width: 100%;}</style>';}); // admin area styles

	add_action( 'wp_enqueue_scripts', 'bobcat_enqueue_styles' );
	function bobcat_enqueue_styles(): void {
		wp_deregister_script('jquery');
		wp_register_script( 'jquery', get_site_url().'/wp-includes/js/jquery/jquery.min.js', [], null, true );
		wp_enqueue_script('jquery');
		
		$dependencies = ['jquery'];
		$bobcat_style = ['bobcat_style'];
		
		wp_enqueue_style('bobcat_style', get_stylesheet_uri(), null, null); // main styles
		wp_enqueue_style('bobcat_main', get_template_directory_uri() .'/assets/css/main.min.css', $bobcat_style, null); // main scss
		wp_enqueue_script('slick_js', get_template_directory_uri().'/assets/js/slick.min.js', $dependencies, null, true ); // slick
		wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.min.js', $dependencies, null, true ); // custom scripts
		wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', $dependencies, '4.1.3', true ); // bootstrap
		wp_enqueue_script('mask_js', get_template_directory_uri().'/assets/js/jquery.inputmask.min.js', $dependencies, null, true ); // validate phone contact form 7
		wp_enqueue_script('niceselect_js', get_template_directory_uri().'/assets/js/nice_select.min.js', $dependencies, null, true );
		if(is_singular()){wp_enqueue_script('fancybox_js', get_template_directory_uri().'/assets/js/jquery.fancybox.min.js', $dependencies, '3.2.10', true );} // fancybox

		//flexible fields scss
		if(!is_search() && !is_404()) {
			if ( is_singular() ) {
				global $post;
				$post_id = $post->ID;
			} else if ( is_category() || is_home() ) {
				$post_id = get_queried_object()->term_id;
			} else if ( is_404() ) {
				$post_id = '';
			}
			if ( get_field( 'flexible_fields', $post_id ) ) {
				wp_enqueue_style( 'bobcat_flexible', get_template_directory_uri() . '/assets/css/flexible.min.css', $bobcat_style, null );
			}
		}
	}
