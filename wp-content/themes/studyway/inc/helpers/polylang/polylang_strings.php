<?php
	/*polylang custom strings translation*/
	add_action( 'after_setup_theme', 'bobcat_after_setup_theme' );
	function bobcat_after_setup_theme() {
		if ( function_exists( 'pll_register_string' ) ) {
			pll_register_string( 'string1', 'Архітектура та будівництво', 'bobcat_strings' );
			pll_register_string( 'string2', 'Бізнес та управління', 'bobcat_strings' );
			pll_register_string( 'string3', 'Інженерія', 'bobcat_strings' );
			pll_register_string( 'string4', 'IT', 'bobcat_strings' );
			pll_register_string( 'string5', 'Мистецтво та дизайн', 'bobcat_strings' );
			pll_register_string( 'string6', 'Туризм та готельна справа', 'bobcat_strings' );
			pll_register_string( 'string7', 'Медицина', 'bobcat_strings' );
			pll_register_string( 'string8', 'Економіка та фінанси', 'bobcat_strings' );
			pll_register_string( 'string9', 'Психологія', 'bobcat_strings' );
			pll_register_string( 'string10', 'Маркетинг та реклама', 'bobcat_strings' );
			pll_register_string( 'string11', 'Юриспруденція', 'bobcat_strings' );
			pll_register_string( 'string12', 'Міжнародні відносини', 'bobcat_strings' );
			pll_register_string( 'string13', 'Біотехнології', 'bobcat_strings' );
			pll_register_string( 'string14', 'Фізика', 'bobcat_strings' );
			pll_register_string( 'string15', 'Потрібна допомога', 'bobcat_strings' );
			pll_register_string( 'string16', 'Канада', 'bobcat_strings' );
			pll_register_string( 'string17', 'США', 'bobcat_strings' );
			pll_register_string( 'string18', 'Великобританія', 'bobcat_strings' );
			pll_register_string( 'string19', 'Німеччина', 'bobcat_strings' );
			pll_register_string( 'string20', 'Іспанія', 'bobcat_strings' );
			pll_register_string( 'string21', 'Швейцарія', 'bobcat_strings' );
			pll_register_string( 'string22', 'Австрія', 'bobcat_strings' );
			pll_register_string( 'string23', 'Кіпр', 'bobcat_strings' );
			pll_register_string( 'string24', 'Мальта', 'bobcat_strings' );
			pll_register_string( 'string25', 'Потрібна допомога', 'bobcat_strings' );
			pll_register_string( 'string26', 'Випускник школи', 'bobcat_strings' );
			pll_register_string( 'string27', 'Бакалавр', 'bobcat_strings' );
			pll_register_string( 'string28', 'Магістр', 'bobcat_strings' );
			pll_register_string( 'string29', 'Вже працюю', 'bobcat_strings' );
			pll_register_string( 'string30', 'Напрям', 'bobcat_strings' );
		}
	}