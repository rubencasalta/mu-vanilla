jQuery(function() {


});

jQuery(window).on('load', function() {

	/* MASONRY */
		if(jQuery('.masonry').length) {
			jQuery('.masonry').masonry({
				itemSelector: '.masonry-item'
			});
		}
	/* --- */

});