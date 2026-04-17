<?php
	function get_social_repeater(string $soc_class=''): string{
		$html = '';
		if(have_rows('social_repeater','options')){
			while(have_rows('social_repeater','options')){the_row();
				$repeater_img   = get_sub_field('repeater_img');
				$repeater_link  = get_sub_field('repeater_link');
				$soc_title      = parse_url(str_replace(['www.', '.com'], '', $repeater_link))['host'];
				if($repeater_link){
					if(is_array($repeater_img)){
						$html .= '<a href="'.$repeater_link.'" rel="nofollow noopener" target="_blank" title="'.$repeater_link.'" class="'.$soc_class.' '.$soc_title.'"><img src="'. $repeater_img['sizes']['thumbnail'] .'" alt="" width="'. $repeater_img['sizes']['thumbnail-width'].'" height="'. $repeater_img['sizes']['thumbnail-height'].'" class="" loading="lazy" /></a>';
					}else{
						$html .='<a href="'. $repeater_link.'" rel="nofollow noopener" target="_blank" title="'. $repeater_link.'" class="'.$soc_class.' '.$soc_title.'">'.$repeater_img.'</a>';
					}
				}
			}
		}
		return $html;
	}
	function social_repeater(string $soc_class=''): void{
		echo get_social_repeater($soc_class);
	}