jQuery(function($) {
	
	"use strict";

	/*function slider_fullHeight() {
		
		$('.shortcode_getbowtied_slider').each(function() {			
			var fullHeight = $(window).height() - $('body:not(.header-transparent) .site-header').height() - $('#wpadminbar').height();
			if ($(this).hasClass('full_height')) {
				$(this).css('height', fullHeight);
			}

		})

	}*/

	//slider_fullHeight();

	$('.shortcode_getbowtied_slider').each(function() {

		var autoplay = $(this).attr('data-autoplay');
		if ($.isNumeric(autoplay)) {
			autoplay = autoplay * 1000;
		} else {
			autoplay = 10000;
		}

		var mySwiper = new Swiper ($(this), {
			
			// Optional parameters
		    direction: 'horizontal',
		    loop: true,
		    grabCursor: true,
			preventClicks: true,
			preventClicksPropagation: true,
			autoplay: autoplay,
			speed: 600,
			effect: 'slide',
		    
		    // // If we need pagination
		    pagination: $(this).find('.shortcode-slider-pagination'),
		    paginationClickable: true,

		    // // Navigation arrows
		    nextButton: $(this).find('.swiper-button-next'),
		    prevButton: $(this).find('.swiper-button-prev'),

		    parallax: true,

		    
		    // // And if we need scrollbar
		    // scrollbar: '.swiper-scrollbar',
		});

	});

		
	
	/*$(window).resize(function() {
		
		//slider_fullHeight();

	})*/
});
