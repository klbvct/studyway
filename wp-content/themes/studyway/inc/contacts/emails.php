<?php
	function get_the_emails($class='', $info = false): string {
		$html                   = '';
		if(have_rows('email_repeater_'.get_current_locale(),'options')){
			while(have_rows('email_repeater_'.get_current_locale(),'options')) {the_row();
				$repeater_hd    = get_sub_field( 'repeater_hd' );
				$repeater_hd_2  = get_sub_field( 'repeater_hd_2' );
				if ( $info) {
					$html       .= '<div class="col_email_item mb15 d-flex flex-column position-relative">';
				}
				if($repeater_hd_2 && $info){
					$html       .= '<div class="f14 l15 email_title">' . $repeater_hd_2 . '</div>';
				}
				$html           .= '<a href="mailto:' . antispambot( $repeater_hd, 1 ) . '" title="' . $repeater_hd . '" class="'. $class.'">' . $repeater_hd . '</a>';
				if ( $info) {
					$html       .= '</div>';
				}
			}
		}
		return $html;
	}
	function the_emails($class='', $info = false): void {
		echo get_the_emails($class, $info);
	}