<?php
	// core functions
	get_template_part('inc/helpers/optmzn'); // assets optimization
	get_template_part('inc/helpers/assets'); // assets
	get_template_part('inc/helpers/settings'); // settings
	get_template_part('inc/parts/menu'); // menu
	get_template_part('inc/helpers/consent_log'); // GDPR consent logging

	get_template_part('inc/parts/sidebars'); //sidebars
	get_template_part('inc/helpers/picture'); // pictures
	get_template_part('inc/helpers/video'); // videos (youtube and local)
	get_template_part('inc/helpers/pagination'); // pagination
	
	get_template_part('inc/contacts/logo'); // logo
	get_template_part('inc/contacts/phones'); // phones
	get_template_part('inc/contacts/emails'); // emails
	get_template_part('inc/contacts/addresses'); // addresses
	get_template_part('inc/contacts/hours'); // open hours
	get_template_part('inc/contacts/mssngrs'); //messengers
	get_template_part('inc/contacts/socials'); //socials
	get_template_part('inc/contacts/opengraph'); //opengraph
	get_template_part('inc/helpers/share'); //share posts
	get_template_part('inc/helpers/polylang/polylang_strings'); //polylang
	get_template_part('inc/helpers/related_posts'); //related posts
	get_template_part('inc/helpers/tax_nav'); //archive navigation
	

	// custom functions
	add_action( 'acf/init', 'bobcat_custom_function');
	function bobcat_custom_function() : void {
		get_template_part('inc/helpers/flexible_fields'); // flexible fields
		get_template_part('inc/helpers/loadmore/loadmore'); // loadmore posts
	}
	// custom connect favicon.ico
	function add_custom_favicon() {
		echo '
		<link rel="icon" href="' . get_site_url() . '/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="' . get_site_url() . '/favicon.ico" type="image/x-icon">
		';
		}
	add_action('wp_head', 'add_custom_favicon');
