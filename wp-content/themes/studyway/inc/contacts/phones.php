<?php
	function get_the_phones(string $class='', bool $info = false, bool $single = false): string {
		$html                   = '';
		if(have_rows('phone_repeater_'.get_current_locale(),'options')){
			while(have_rows('phone_repeater_'.get_current_locale(),'options')){the_row();
				$repeater_hd    = get_sub_field('repeater_hd');
				$repeater_hd_2  = get_sub_field('repeater_hd_2');
				if ( $info) {
					$html       .= '<div class="col_phone_item mb15 d-flex flex-column position-relative">';
				}
				if( $repeater_hd_2 && $info ){
					$html       .='<div class="f14 l15">'.$repeater_hd_2.'</div>';
				}
				if($single){
					if(get_row_index() === 1) {
						$html .= '<a href="tel:+' . preg_replace( '/[^0-9]/', '', $repeater_hd ) . '" title="' . $repeater_hd . '" class="' . $class . '">' . $repeater_hd . '</a>';
					}
				}else{
					$html .='<a href="tel:+'.preg_replace('/[^0-9]/', '', $repeater_hd).'" title="'. $repeater_hd.'" class="'. $class.'">'.$repeater_hd.'</a>';
				}
				if ( $info) {
					$html       .= '</div>';
				}
			}
		}
		return $html;
	}
	function the_phones(string $class='', bool $info = false, bool $single = false): void{
		echo get_the_phones($class, $info, $single);
	}