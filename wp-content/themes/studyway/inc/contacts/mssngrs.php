<?php
	function get_mes_repeater(string $option): string {
		$html = '';
		if(have_rows('mes_repeater','options')){
			while(have_rows('mes_repeater','options')){the_row();
				$repeater_radio             = get_sub_field('repeater_radio');
				$repeater_img               = get_sub_field('repeater_img');
				$repeater_link              = get_sub_field('repeater_link');
				$linkHref                   = '#';
				if($repeater_radio          =='viber'){
					$linkColor              = '8c66a9';
					if(wp_is_mobile()){
						$linkHref           = 'viber://add?number='.preg_replace('/[^0-9]/', '', $repeater_link);
					}else{
						$linkHref           = 'viber://chat?number='.preg_replace('/[^0-9]/', '', $repeater_link);
					}
				}else if($repeater_radio    =='telegram'){
					$linkHref               = 'tg://resolve?domain='.$repeater_link;
				}else if($repeater_radio    =='whatsapp'){
					$linkHref               = 'https://wa.me/'.preg_replace('/[^0-9]/', '', $repeater_link);
				}else if($repeater_radio    =='skype'){
					$linkHref               = 'skype:nikname?'.$repeater_link;
				}
				$html .= '<a href="'. $linkHref.'" target="_blank" title="'. $linkHref.'" class="'. $option.' '.$repeater_radio.'"  rel="nofollow noopener" >'. $repeater_img.'</a>';
			}
		}
		return $html;
	}
	function mes_repeater(string $option): void{
		echo get_mes_repeater($option);
	}