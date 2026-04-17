<?php
	function get_the_hours(string $class=''): string {
		$html = '';
		if(get_field('hours_fld_'.get_current_locale(),'options')){
			$html = '<div class="'.$class.'">'. get_field('hours_fld_'.get_current_locale(),'options').'</div>';
		}
		return $html;
	}
	function the_hours(string $class=''): void {
		echo get_the_hours($class);
	}