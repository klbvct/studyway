<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><?php wp_head(); ?></head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebSite">
	<?php echo get_field('after_body_data','options')??''; ?>
	<link itemprop="url" href="<?php echo get_home_url(); ?>" />
	<div class="body_overlay"></div>
	<header class="header w-100 position-fixed transition">
		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<!--logo-->
				<?php the_logo('header_logo transition mr-auto ml15'); ?>
				<nav class="navbar justify-content-center d-lg-flex">
					<div class="d-flex position-relative d-lg-none justify-content-between align-items-center mb20 ml15 mr15">
						<?php the_logo('d-block position-relative w-100 menu_logo'); ?>
						<div class="menu_close d-block d-lg-none cursor-pointer"></div>
					</div>

					<?php
						wp_nav_menu( [
							'theme_location'    => 'main_top_menu',
							'container'         => false,
							'items_wrap'        => '<ul id="%1$s" class="%2$s nav d-flex align-items-center ml-auto mr-auto">%3$s</ul>',
							'walker'            => new Bootstrap_Walker_Nav_Menu
						]);
					?>
					<?php if(function_exists('pll_the_languages')){ ?>
						<ul class="pl-0 lang_wr d-flex d-lg-none f000"><?php pll_the_languages( ['show_names' => 1] ); ?></ul>
					<?php } ?>
					<?php if(function_exists('the_phones')){ the_phones('d-flex d-lg-none respcenter mb20');} ?>
					<a href="#callback" data-toggle="modal" data-target="#callback" title="<?php _e('Callback', 'bobcat');?>" class="button position-absolute zindex10 d-lg-none"><?php _e('Callback', 'bobcat');?></a>
				</nav>

				<?php if(function_exists('pll_the_languages')){ ?>
					<div class="lang_wr d-none d-lg-flex f000">
						<?php pll_the_languages( [ 'show_names' => 1, 'dropdown'=>'1'] ); ?>
					</div>
				<?php } ?>
				
				<?php the_phones('d-none d-lg-block f16 f600 ml50'); ?>

				<a href="#callback" data-toggle="modal" data-target="#callback" title="<?php _e('Callback', 'bobcat');?>" class="button d-lg-inline-flex d-none mr15 ml20"><?php _e('Callback', 'bobcat');?></a>
				
				<div class="menu_toggler d-block d-lg-none position-relative mr15"></div>
			</div>
		</div>
	</header>
	<div id="content_wrapper">
		<?php
			if ( function_exists('yoast_breadcrumb') && !is_front_page() && !is_404() && !get_field('hide_breadcrumbs')) {yoast_breadcrumb( '<div class="container mb30 mt20" id="breadcrumbs"><ul class="m-0 p-0 d-flex overflowscroll">','</ul></div>');}