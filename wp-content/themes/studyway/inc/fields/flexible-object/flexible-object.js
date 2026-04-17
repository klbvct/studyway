let objectPrefix = 'object';
function extendedSettings() {
	return {
		slidesToShow    : jQuery('.'+objectPrefix+'_slider_wr').data('cols'),
		responsive      : [
			{
				breakpoint: 992,
				settings: {
					slidesToShow    : 3,
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow    : 2,
				}
			},
			{
				breakpoint: 575,
				settings: {
					slidesToShow    : 1,
					centerMode      : true,
					centerPadding   :'30px',
				}
			}
		]
	};
}
flexible_slick_slider(objectPrefix, extendedSettings());