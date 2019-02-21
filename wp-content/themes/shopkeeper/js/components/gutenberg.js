jQuery(document).ready(function ($) {
	
	var uniqId = ( function() {
	    var i=0;
	    return function() {
	        return i++;
	    }
	})();

	// Add fresco to galleries
	$( ".wp-block-gallery" ).each(function() {

		var that = $(this);

		that.attr('id', 'gallery-'+uniqId());

	  	that.find('.blocks-gallery-item').each(function(){

		  	var this_gallery_item = $(this);

		  	$(this).find('a').addClass('fresco');
				
			this_gallery_item.find('.fresco').attr('data-fresco-group', that.attr('id'));

			if ( this_gallery_item.find('figcaption').length > 0 ) {
				this_gallery_item.find('.fresco').attr('data-fresco-caption', this_gallery_item.find('figcaption').text());
			}
			
		});

	});

	// Hide slider when empty
	$('.wp-block-gbt-slider').each(function() {

		var wrapper = $(this).find('.swiper-wrapper');

		if( wrapper.children('div.swiper-slide').length == 0 ) {

			$(this).remove();

		}
	});
});