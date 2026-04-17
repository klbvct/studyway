<?php
	/**
	 * Retrieves the address information.
	 * This function retrieves the address information from the repeater field based on the current locale.
	 * @param string $class An optional CSS class to be applied to the address <div>.
	 * @return string The address HTML content.
	 */
	function get_the_address( string $class = '' ): string {
		$html = '';
		if ( have_rows( 'address_repeater_' . get_current_locale(), 'options' ) ) {
			while ( have_rows( 'address_repeater_' . get_current_locale(), 'options' ) ) {
				the_row();
				$repeater_hd = get_sub_field( 'repeater_hd' );
				$html        .= '<div class="' . $class . '">' . $repeater_hd . '</div>';
			}
		}
		return $html;
	}

	function the_address(string $class ): void {
		echo get_the_address( $class );
	}