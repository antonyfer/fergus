(function($) {
    'use strict';
	
	var imageGallery = {};
	edge.modules.imageGallery = imageGallery;
	
	imageGallery.edgeInitImageGalleryMasonry = edgeInitImageGalleryMasonry;
	
	
	imageGallery.edgeOnWindowLoad = edgeOnWindowLoad;
	
	$(window).on('load', edgeOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function edgeOnWindowLoad() {
		edgeInitImageGalleryMasonry();
	}
	
	/*
	 ** Init Image Gallery shortcode - Masonry layout
	 */
	function edgeInitImageGalleryMasonry(){
		var holder = $('.edge-image-gallery.edge-ig-masonry-type');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edge-ig-masonry');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edge-ig-image',
						percentPosition: true,
						packery: {
							gutter: '.edge-ig-grid-gutter',
							columnWidth: '.edge-ig-grid-sizer'
						}
					});
					
					setTimeout(function() {
						masonry.isotope('layout');
						edge.modules.common.edgeInitParallax();
					}, 800);
					
					masonry.css('opacity', '1');
				});
			});
		}
	}

})(jQuery);