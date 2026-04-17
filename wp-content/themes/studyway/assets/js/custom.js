// noinspection JSCheckFunctionSignatures
let $window     = jQuery(window);
let windowsize  = $window.width();
let $body       = jQuery('body');
let $html       = jQuery('html');
let $navbar     = jQuery('.navbar');
let $scrollBt   = jQuery('#scroll_bt');

/** Resize functions
 * */
$window.on('resize',function() {
	windowsize = $window.width();
});

/** Scroll functions
 * */
$window.on('scroll',function(){
	scrolled_header();
});


/**
 * Adds or removes the 'scrolled_header' class
 * */
function scrolled_header(){$window.scrollTop() >= 50 ? $body.addClass('scrolled_header') : $body.removeClass('scrolled_header ');}

jQuery(function($) {
	scrolled_header();

	/**
	* Toggle menu on responsive devices
	*
	* */
	$(".menu_toggler").on('click',function() {$body.addClass('navbar_shown');});

	/**
	 * Smooth scroll on page load.
	 *
	 * @param {string} id - The ID of the element to scroll to.
	 */
	if (location.hash){$html.animate({scrollTop: $('#'+location.hash.split('#')[1]).offset().top}, 1000);}

	if (windowsize < 992) {
		/**
		 * Toggle sub-menus on responsive devices
		 * */
		$navbar.find('.menu-item-has-children>a .has_children_link , .menu-item-has-children > a:not([href]):not([tabindex])').on('click',function() {$(this).closest('li').toggleClass('expanded');return false;});
	}

	if (windowsize < 767) {
		/**
		 * Footer widgets toggle on responsive devices
		 * */
		$('.colophon .widget-title').on('click',function(){
			if($(this).hasClass('expanded')){
				$(this).removeClass('expanded');
				$(this).next().hide(300);
			}else{
				$(this).addClass('expanded');
				$(this).next().show(300);
			}
		});
	}

	/**
	 * Show overlay*/
	jQuery('.filter_toggle, .menu_toggler, body:not(.woocommerce-cart):not(.woocommerce-checkout) .cart_toggler, .account_toggler, .lang_select_wr button').on('click', function(){overlayShow();});

	/**
	 *  Close overlay*/
	$('.menu_close, .body_overlay, .hd_cart_mini_close, .woo_sidebar_close, .hd_acc_close, body.acc_expanded .body_overlay, .navbar li a[href^="#"]').on('click', function() {overlayClose();});


	/**
	 * Scroll to top button
	 *
	 */
	$window.on('scroll',function() { $window.scrollTop() >= 120 ? $scrollBt.show() : $scrollBt.hide();});
	$scrollBt.on('click',function(){$html.animate({scrollTop: 0}, 800);return false;});

	/**
	* Move cf7 labels before inputs.
	**/
	$('.wpcf7-form-control-wrap').each(function(){$(this).prepend($(this).prev('label').detach());});
	$('.wpcf7-radio .wpcf7-list-item').each(function(){$(this).find('input[type=radio]').after($(this).find('.wpcf7-list-item-label').detach());});

	$('select').niceSelect();
});

/**
 * Validate CF7 form empty fields and disable/enable submit button
 *
 */
jQuery(function($) {
	$('.wpcf7-form').addClass('loaded');
	$('.wpcf7 .wpcf7-submit').attr('disabled','disabled');
	/**
	 * Validate input[type=tel].Only numbers allowed
	 *
	 * */
	$(document.body).on('keypress','input[type=tel]',function (e) {if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {return false;}});

	/**
	 * Validate input[type=email].Only numbers and latin symbols allowed
	 *
	 * */
	$(document.body).on('input', 'input[type=email]', function (e) {
		let inputValue = e.target.value;
		let filteredValue = inputValue.replace(/[0-9]/g, ''); // Replace numbers with an empty string
		if (inputValue !== filteredValue) {
			e.target.value = filteredValue;
		}
	});
	$(document).on('change paste keydown blur','.wpcf7 input, .wpcf7 textarea',function(){
		let currentForm = $(this).parents('form');
		let isEmpty     = false;
		$('input[type=text],textarea', currentForm).each(function () {
			if ($(this).val().trim() === '') {
				isEmpty = true;
				return false;
			}
		});
		$('input[type=tel]', currentForm).each(function () {
			let phone       = $(this).val().trim();
			let phoneValue  = phone.split('_').join('');
			if (phoneValue.length < 18) {
				$(this).addClass('wpcf7-not-valid');
				isEmpty = true;
				return false;
			}else{
				$(this).removeClass('wpcf7-not-valid');
			}
		});
		$('input[type=email]', currentForm).each(function () {
			let emailRegEx = /^\S+@\S+\.\S+$/;
			if (!emailRegEx.test($(this).val())) {
				$(this).addClass('wpcf7-not-valid');
				isEmpty = true;
				return false;
			}
		});
		$('input[type=checkbox]', currentForm).each(function () {
			if(!$(this).is(':checked')){
				isEmpty = true;
				return false;
			}else{
				$(this).removeClass('wpcf7-not-valid');
			}
		});
		if (isEmpty) {
			$('.wpcf7-submit', currentForm).attr('disabled', 'disabled');
		} else {
			$('.wpcf7-submit', currentForm).attr('disabled', false);
		}
	});
});

/**
 * Handle cf7 forms sent
 * */
jQuery(document.body).on('wpcf7mailsent',function(){
	jQuery('#callback').modal('hide');
	jQuery('#thankyou').modal('show');
	jQuery('.wpcf7-response-output').remove();
});

/**
 * Show / close overlay */
function overlayShow(){$body.addClass('overlayshown');}
function overlayClose(){$body.removeClass('mini_expanded overlayshown acc_expanded filtershown woo_sidebar_shown navbar_shown');}

/**
 * Viewport check
 * */
jQuery.fn.isInViewport = function() {
	let elementTop        = jQuery(this).offset().top;
	let elementBottom     = elementTop + jQuery(this).outerHeight();
	let viewportTop       = jQuery(window).scrollTop();
	let viewportBottom    = viewportTop + jQuery(window).height();
	return elementBottom > viewportTop && elementTop < viewportBottom;
};

/**
 * Accordeons
 * */
jQuery(document).on('click', '.accordeon_toggler', function () {
	if (jQuery(this).hasClass('expanded') ) {
		jQuery(this).next().hide(300);
		jQuery(this).removeClass('expanded');
	} else {
		jQuery(this).next().show(300);
		jQuery(this).addClass('expanded');
	}
});

/**
 * Basic slick slider settings
 */
let slickSettings = {
	arrows          : true,
	dots            : false,
	slidesToShow    : 1,
	infinite        : true,
	speed           : 500,
	slidesToScroll  : 1,
	autoplay        : true,
	autoplaySpeed   : 50000,
	focusOnSelect   : false,
	rtl             : !!jQuery('body').hasClass('rtl')
};

/**
 * Slick slider initialization for each slick wrapper
 * @param   {string} slickPrefix      - prefix of section, used to target a slick block
 * @param   {object} extendedSettings - additional parameters for specific slick slider
 * @param   {int} maxWindowWidth      - maximum window size for slick slider to initialize
 */
function flexible_slick_slider(slickPrefix, extendedSettings, maxWindowWidth = 100000){
	/*stop youtube playing on slick change*/
	function resetVideoURL() {
		jQuery(this).find('iframe').each(function(){
			let videoURL = jQuery(this).attr('src');
			videoURL = videoURL.replace("&autoplay=1", "");
			jQuery(this).attr('src','');
			jQuery(this).attr('src',videoURL);
		});
	}
	/*initialize each slick slider on page*/
	function init_flexible_slider(){
		jQuery('.'+slickPrefix+'_slider_wr').each(function(index, element){
			if (jQuery(element).length && !jQuery(element).hasClass('slick-initialized') && jQuery(element).isInViewport() && windowsize < maxWindowWidth){
				jQuery(element).slick(jQuery.extend({}, slickSettings, extendedSettings));
				jQuery(element).on('beforeChange', resetVideoURL);
			} else if(windowsize >= maxWindowWidth && jQuery(element).hasClass('slick-initialized')){
				jQuery(element).slick('unslick');
			}
		});
	}
	jQuery(init_flexible_slider);
	jQuery(window).on('resize scroll', init_flexible_slider);
}
jQuery(document).on('click','.lang_wr .nice-select .option', function(){
	window.location.href = jQuery(this).data('value');
});


jQuery(document).on('click','.generated_form_wr .nice-select .option', function(){
	change_modal_select(jQuery(this).data('value') , jQuery(this).parents('.nice-select').prev('select').attr('class'));
});
jQuery(document).on('click', '.nice_item', function (){
	change_modal_select(jQuery(this).attr('title'),jQuery(this).attr('data-select'));
});
function change_modal_select(value='',  class_name=''){
	let modalSelect = jQuery('#callback .nice-select.' + class_name);
	jQuery('.option', modalSelect).removeClass('selected');
	jQuery('.option[data-value="'+value+'"]', modalSelect).addClass('selected');
	jQuery('.current', modalSelect).text(value);
	jQuery('#callback select.' + class_name + ' option[value="'+value+'"]').prop('selected', true).trigger('change');
}

jQuery(document).on('click', '.show_all', function (e){
	e.preventDefault();
	jQuery(this).parents('section').find('.nice_item, .country_item').show();
	jQuery(this).closest('div').hide();
});

jQuery(document).on('click', '.show_more', function (e){
	e.preventDefault();
	jQuery(this).parents('.row').find('.section_des').addClass('expanded');
	jQuery(this).remove();
});

jQuery(function($){
	let navMenu = '<ul>';
	$('.single .post_content').find('h2, h3').each(function(index, element) {
		var id = 'heading' + index;
		$(element).attr('id', id);
		navMenu += '<li><a href="#' + id + '" title="' + $(element).text() + '" class="f000 smoothscroll">' + $(element).text() + '</a></li>';
	});
	navMenu += '</ul>';
	$('.post_content_nav').html(navMenu);
	$('.post_content_nav a').on('click',function(e) {
		e.preventDefault();
		if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
			let target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$html.animate({scrollTop: target.offset().top -90}, 1000);
				return false;
			}
		}
	});
});