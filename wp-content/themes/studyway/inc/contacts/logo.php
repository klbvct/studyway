<?php
	function get_the_logo(string $class=''): string{
		$siteLogo = get_field('site_logo','options');
		$html = '';
		if($siteLogo ){
			if(is_front_page()){
				$html = '<div class="'. $class.'">'. get_the_picture($siteLogo, str_contains( $class, 'menu_logo' ) ? 'contain_image lazy' : 'lazy').'</div>';
			}else{
				$html = '<a href="'. get_home_url().'" title="'. esc_attr( get_bloginfo( "name", "display") ).'" rel="home" class="'. $class.'">'. get_the_picture($siteLogo, str_contains( $class, 'menu_logo' ) ? 'contain_image lazy' : 'lazy').'</a>';
			}
		}
		return $html;
	}
	function the_logo(string $class=''): void {
		echo get_the_logo($class);
	}