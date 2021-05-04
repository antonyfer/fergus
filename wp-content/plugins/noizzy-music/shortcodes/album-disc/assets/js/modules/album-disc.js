(function($) {
	'use strict';
	
	var albumDisc = {};
	edge.modules.albumDisc = albumDisc;
	
	albumDisc.edgeInitAlbumDisc = edgeInitAlbumDisc;
	
	
	albumDisc.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitAlbumDisc();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgeInitAlbumDisc() {
        var albumDiscs = $('.edge-album-disc.edge-animate-on-appear');

        if (albumDiscs.length) {
            albumDiscs.each(function(){
            var albumDisc = $(this);

            //vss
            if (albumDisc.closest('.edge-vss-ms-section').length) {
                if (albumDisc.closest('.edge-vss-ms-section').hasClass('active') && !albumDisc.hasClass('edge-appeared')) {
                    setTimeout(function(){
                        albumDisc.addClass('edge-appeared');
                    }, 500); 
                    //duration of a slide
                }
            } 
            //scroll
            else {
                albumDisc.appear(function(){
                    albumDisc.addClass('edge-appeared');
                },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
            }

            }); 
        }
    }
	
})(jQuery);