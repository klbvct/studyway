<?php
	/**
	 * Initializes the Bobcat widgets.
	 *
	 * This function registers multiple sidebars for use in footer and shop layouts.
	 *
	 * @return void
	 */
	function bobcat_widgets_init(): void {
		$footer_sidebars = [1,2];
		foreach ($footer_sidebars as $id){
			register_sidebar( [
				'name'              =>  'Колонка в подвалі '. $id, 'bobcat' ,
				'id'                => 'ft_widget_'.$id,
				'description'       =>  'Колонка в подвалі '. $id, 'bobcat' ,
				'before_widget'     => '<div id="%1$s" class="%2$s">',
				'after_widget'      => '</div>',
				'before_title'      => '<div class="f700 f20 text-white mb30 widget-title">',
				'after_title'       => '</div>',
			]);
		}
	}
	add_action( 'widgets_init', 'bobcat_widgets_init' );