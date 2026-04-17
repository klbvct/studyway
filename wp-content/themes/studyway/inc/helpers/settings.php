<?php
	/**
	 * Sets up the Bobcat theme by loading the theme text domain, adding support for title tags,
	 * enabling featured images, and registering a new image size.
	 *
	 * @return void
	 */
	function bobcat_theme_setup(): void {
		load_theme_textdomain('bobcat', get_template_directory() . '/languages' );
		add_theme_support( 'title-tag' );

		//add featured image support
		add_theme_support( 'post-thumbnails');

		/*register new image size*/
		add_image_size( 'thumb_420', 420, 420);
	}
	add_action( 'after_setup_theme', 'bobcat_theme_setup' );
	
	/**
	 * Retrieves the current locale of the website.
	 * If the Polylang plugin is active, it will return the current language set by Polylang.
	 * Otherwise, it will return the locale set in the WordPress settings.
	 *
	 * @return string The current locale of the website.
	 */
	function get_current_locale(){return function_exists('pll_current_language') ? pll_current_language() : get_locale();}

	/**
	 * Retrieves and outputs the head data.
	 *
	 * This function retrieves and outputs the head data based on the options set in the admin panel.
	 * It also handles specific logic for WooCommerce related pages.
	 *
	 * @return void
	 */
	function bobcat_head_data(): void { ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0">
		<meta name="application-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">
		<link rel="manifest" href="<?= get_stylesheet_directory_uri()?>/images/icons/site.webmanifest">
		<link rel="apple-touch-icon" sizes="60x60" href="<?= get_stylesheet_directory_uri()?>/images/icons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?= get_stylesheet_directory_uri()?>/images/icons/touch-icon-ipad-retina.png">
		<link rel="preload" href="<?= get_stylesheet_directory_uri()?>/assets/fonts/fontello/fontello.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<link rel="preload" href="<?= get_stylesheet_directory_uri()?>/assets/fonts/InterTight/InterTight-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<link rel="preload" href="<?= get_stylesheet_directory_uri()?>/assets/fonts/InterTight/InterTight-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<link rel="preload" href="<?= get_stylesheet_directory_uri()?>/assets/fonts/InterTight/InterTight-SemiBold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<link rel="preload" href="<?= get_stylesheet_directory_uri()?>/assets/fonts/InterTight/InterTight-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<script>let ajaxurl = '<?php echo site_url();?>/wp-admin/admin-ajax.php'</script>
		<?php echo get_field('head_data','options')??'';
	}
	add_action('wp_head','bobcat_head_data', 1);
	
	/**
	 * Generates the footer HTML code.
	 *
	 * This method is responsible for generating the footer HTML code, including any
	 * footer scripts or cookies notices that need to be displayed.
	 *
	 * @return void
	 */
	function bobcat_footer_data() { echo get_field('footer_data','options')??''; }
	add_action('wp_footer','bobcat_footer_data');


	/**
	 * Retrieves the title for the current archive page.
	 *
	 * @param string $title The current title string.
	 * @return string The updated title string for the archive page.
	 */
	function bobcat_theme_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		}
		return $title;
	}
	add_filter( 'get_the_archive_title', 'bobcat_theme_archive_title' );
	
	/**
	 * Checks if the website is in maintenance mode and displays a maintenance message if true.
	 * The mode may be enabled in the template options
	 * @return void
	 */
	function wp_maintenance_mode(): void {
		if ((!current_user_can('edit_themes') || !is_user_logged_in()) && get_field('maintenance_on','options')) {
			$html   = '<link rel="stylesheet" href="' . get_template_directory_uri() . '/style.css" /><link rel="stylesheet" href="' . get_template_directory_uri() . '/assets/css/main.min.css" />';
			$html   .= '<section class="pt50 pb50 "><div class="container"><div class="row"><div class="col-12 text-center">';
			$html .= '<h1>В розробці</h1><br />На даний момент сайт недоступний.';
			$html .= '<div class="d-flex align-items-center justify-content-center flex-column mb20">'.get_the_logo('d-block mb10 f24 f600').'</div>';
			$html .= '<div class="d-flex align-items-center justify-content-center flex-column mb20">'.get_the_phones('d-block mb10 f24 f600',true).'</div>';
			$html .= '<div class="d-flex align-items-center justify-content-center flex-column mb20">'.get_the_emails('d-block mb10 f24 f600',true).'</div>';
			$html .= '<div class="d-flex align-items-center justify-content-center mb20">'.get_mes_repeater('ml10 mr10 mt5 mb5 d-block f20').get_social_repeater('ml10 mr10 mt5 mb5 d-block f20').'</div>';
			$html   .='</div></div></div></section>';
			wp_die($html);
		}
	}
	add_action('get_header', 'wp_maintenance_mode');
	
	/**
	 * Sets up the options page for the template and adds sub-pages for different sections.
	 * If the ACF plugin is active, it adds the template options page and sub-pages for general, Woocommerce, and site-wide fields.
	 *
	 * @return void
	 */
	add_action('acf/init',function () {
		if (function_exists('acf_add_options_page')) {
			$parent = acf_add_options_page([
				'page_title' 	=> 'Опції шаблону',
				'menu_title'	=> 'Опції шаблону',
				'menu_slug' 	=> 'bobcat_site_options',
				'capability'	=> 'edit_posts',
				'position'      => '2',
				'redirect'		=> true
			]);
			acf_add_options_sub_page([
				'page_title' 	=> 'Загальні',
				'menu_title'	=> 'Загальні',
				'menu_slug' 	=> 'bobcat_site_options_general',
				'parent_slug' 	=> $parent['menu_slug'],
			]);
		}

		/**
		 * Sets the Google Maps API key for the given API configuration.
		 *
		 * Retrieves the Google Maps API key value from the options and adds it to the API configuration array.
		 *
		 * @param array $api The API configuration array.
		 * @return array The
		 */
		function bobcat_acf_google_map_api( $api ){
			$api['key'] = get_field('google_map_api','options');
			return $api;
		}
		add_filter('acf/fields/google_map/api', 'bobcat_acf_google_map_api');
	});
	
	/**
	 * The function makes yoast seo breadcrumbs as a list with last element not a link
	 *
	 * !!! make last element BOLD in yoast seo settings
	 *
	 * @var mixed $output The output of a specific process or function. It can have various data types and formats.
	 */
	function filter_wpseo_breadcrumb_output( $output ) {
		// Remove any <span> wrapping the whole breadcrumb structure
		$output = preg_replace('/<ul([^>]*)>\s*<span>/', '<ul$1>', $output);
		$output = preg_replace('/<\/span>\s*<\/ul>/', '</ul>', $output);
		
		// Ensure links are inside <li>
		$output = preg_replace('/<span>\s*<a/', '<li class="breadcrumbs_li"><a', $output);
		$output = preg_replace('/<\/a>\s*<\/span>/', '</a></li>', $output);
		
		// Ensure separators are inside <li>
		$output = preg_replace('/<span>\s*<i class="icon-angle-right"><\/i>\s*<\/span>/', '<li class="breadcrumbs_li"><i class="icon-angle-right"></i></li>', $output);
		
		// Fix last breadcrumb item (current page)
		$output = preg_replace('/<span class="breadcrumb_last" aria-current="page">\s*<strong>/', '<li class="breadcrumb_last" aria-current="page"><span>', $output);
		$output = preg_replace('/<\/strong>\s*<\/span>/', '</span></li>', $output);
		
		// Remove any remaining unclosed <span> wrapping breadcrumbs
		$output = str_replace('<span>', '', $output);
		$output = str_replace('</span>', '', $output);
		
		return $output;
	}
	add_filter( 'wpseo_breadcrumb_output', 'filter_wpseo_breadcrumb_output' );


	/**
	 * Get the CSS classes for loop items
	 *
	 * @return string The CSS classes
	 */
	function get_bobcat_loop_class($post_type) {
		if($post_type == 'product'){
			$class = 'col-12 col-sm-6 col-md-4 col-xl-3 mt15 mb15 loop_'.$post_type.'_item_wr';
		}else{
			$class = 'col-12 col-sm-6 col-lg-4 loop_'.$post_type.'_item_wr mt15 mb15';
		}
		return $class;
	}
	function the_bobcat_loop_class($post_type) {
		echo get_bobcat_loop_class($post_type);
	}
	
	/**
	 * Generates a form with specific elements.
	 *
	 * @return string The generated form HTML content.
	 */
	function get_generated_form(){
		$html  = '<div class="row generated_form_wr">';
		$html .= '<div class="col-12 col-md-3 mt5 mb5 position-relative">'.generate_field_of_study().'</div>';
		$html .= '<div class="col-12 col-md-3 mt5 mb5 position-relative">'.generate_country().'</div>';
		$html .= '<div class="col-12 col-md-3 mt5 mb5 position-relative">'.generate_education().'</div>';
		$html .= '<div class="col-12 col-md-3 mt5 mb5"><a href="#callback" data-toggle="modal" data-target="#callback" title="'.__('Підібрати', 'bobcat').'" class="button w-100 p-0">'.__('Підібрати', 'bobcat').'</a></div>';
		$html .= '</div>';
		return $html;
	}
	function the_generated_form(){
		echo get_generated_form();
	}
	
	/**
	 * Generates a field of study dropdown with options.
	 *
	 * @return string The generated field of study HTML content.
	 */
	function generate_field_of_study(){
		$html ='';
		if(have_rows('spec_repeater_'.get_current_locale(), 'options')){
			$html .= '<select name="menu-1" class="menu-1" required><option value="'.__('Напрям', 'bobcat').'" disabled selected>'.__('Напрям', 'bobcat').'</option>';
			while(have_rows('spec_repeater_'.get_current_locale(), 'options')){the_row();
				$html .='<option value="'.get_sub_field('repeater_hd').'">'.get_sub_field('repeater_hd').'</option>';
			}
			$html .= '</select>';
		}
		return $html;
	}
	
	/**
	 * Generates a dropdown menu with a list of countries.
	 *
	 * @return string The generated dropdown menu HTML content.
	 */
	function generate_country(){
		$html ='';
		if(have_rows('country_repeater_'.get_current_locale(), 'options')){
			$html .= '<select name="menu-2" class="menu-2" required><option value="'.__('Всі країни', 'bobcat').'" disabled selected>'.__('Всі країни', 'bobcat').'</option>';
			while(have_rows('country_repeater_'.get_current_locale(), 'options')){the_row();
				$html .='<option value="'.get_sub_field('repeater_hd').'">'.get_sub_field('repeater_hd').'</option>';
			}
			$html .= '</select>';
		}
		return $html;
	}
	
	/**
	 * Generates a dropdown menu with a list of levels.
	 * */
	function generate_education(){
		$html ='';
		if(have_rows('level_repeater_'.get_current_locale(), 'options')){
			$html .= '<select name="menu-3" class="menu-3" required><option value="'.__('Рівень освіти', 'bobcat').'" disabled selected>'.__('Рівень освіти', 'bobcat').'</option>';
			while(have_rows('level_repeater_'.get_current_locale(), 'options')){the_row();
				$html .='<option value="'.get_sub_field('repeater_hd').'">'.get_sub_field('repeater_hd').'</option>';
			}
			$html .= '</select>';
		}
		return $html;
	}
	
	/**
	 * Registers a custom form tag for Contact Form 7 that generates form selects.
	 *
	 * @return void
	 */
	function bobcat_form_selects() {
		wpcf7_add_form_tag( 'form_selects', 'generate_cf7_form_selects' );
	}
	add_action( 'wpcf7_init', 'bobcat_form_selects' );
	
	/**
	 * Generates a Contact Form 7 form with dropdown menus for field of study, country, and education level.
	 *
	 * @return string HTML code for the Contact Form 7 form with dropdown menus.
	 */
	function generate_cf7_form_selects(){
		$html = '<div class="col-12 mt5 mb5 position-relative">' . generate_field_of_study() . '</div>';
		$html .= '<div class="col-12 mt5 mb5 position-relative">'.generate_country().'</div>';
		$html .= '<div class="col-12 mt5 mb5 position-relative">'.generate_education().'</div>';
		return $html;
	}
	
	add_shortcode('post_form', 'post_generated_form');
	function post_generated_form(){ ob_start(); ?>
		<div class="container post_form_wr">
			<div class="row">
				<div class="col-12 f40 f500 mb50 text-center text-white">
					<?php _e('Консультація щодо навчання за кордоном', 'bobcat');?>
				</div>
				<div class="col-12 f500 mb30 text-center text-white">
					<?php _e('Обери напрям, країну та рівень твоєї освіти', 'bobcat');?>
				</div>
				<?php the_generated_form();?>
			</div>
		</div>
	<?php return ob_get_clean(); }