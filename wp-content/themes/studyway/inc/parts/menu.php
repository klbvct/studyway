<?php
	/**
	 * Set up the menus for the Bobcat theme.
	 *
	 * This function registers menu areas*/
	if ( ! function_exists( 'bobcat_menu_setup' ) ){
		function bobcat_menu_setup(): void {
			register_nav_menus	(
				[
					'main_top_menu' => 'Основне меню зверху',
					'footer_menu'   => 'Меню в подвалі',
				]
			);
		}
	}
	add_action( 'after_setup_theme', 'bobcat_menu_setup' );
	
	// associate bootstrap menu with wp menu
	class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
		/* Display li element */
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( isset( $args[0] ) && is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
		
		/* Start li elements */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			
			/*icons and images in menu start*/
			$icon = get_field('menu_icon', $item);
			if( $icon ) {
				$item->title= $args->link_before . apply_filters('the_title', '<div class="icon_wr position-relative">'.get_the_picture( [ 'url' => $icon['sizes']['thumbnail'], 'width' => '24', 'height' => '24', ], 'contain_image lazy') . $item->title.'</div>', $item->ID);
			}
			/*icons and images in menu end*/
			
			if ( is_object($args) && !empty($args->has_children) ) {
				$link_after = $args->link_after;
				$args->link_after = ' <div class="has_children_link"></div>';
			}
			parent::start_el($output, $item, $depth, $args, $id);
			if ( is_object($args) && !empty($args->has_children) ){
				$args->link_after = $link_after;
			}
		}
		
		/* Start ul elements */
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			// Depth-dependent classes.
			$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
			$display_depth = ( $depth + 1); // because it counts the first submenu as 0
			$classes = array(
				'sub-menu',
				( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
				'menu-depth-' . $display_depth
			);
			$class_names = implode( ' ', $classes );
			// Build HTML for output.
			$output .= "\n" . $indent . ' <ul  class="' . $class_names . '">' . "\n";
		}
		
		/* End ul elements */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}
	}