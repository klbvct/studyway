jQuery(document).on('click','.loadmore_button', function(){
	let button          = jQuery(this);
	let buttontext      = button.text();
	let data                = {
		'query'         : button.data('query'),
		'page'          : button.attr('data-current'),
		'item_class'    : button.data('class'),
		'posttype'      : button.data('posttype'),
		'customtpl'     : button.data('customtpl'),
	};
	jQuery.ajax({
		url             : ajaxurl+'?action=bobcatloadmore',
		data            : data,
		type            : 'POST',
		beforeSend      : function () {
			button.attr('disabled','disabled');
			button.text( button.data('loadingtext'));
		},
		success         : function( data ){
			if( data ) {
				button.text(buttontext);
				button.parents('section').find('.posts_archive_wr').append(data);
				button.parents('section').find('.pagination').find('.current').removeClass('current').next().addClass('current');
				button.attr('data-current',parseInt(button.attr('data-current'), 10)+1);
				button.attr('disabled',false);
				jQuery('.posts_shown').text(parseInt(button.attr('data-current'), 10)*button.attr('data-perpage'));
				if ( button.attr('data-current') >= button.data('totalpages') ){
					jQuery('.loadmore_wr, .pagination_wr').remove();
				}
			} else {
				button.remove();
			}
		}
	});
});