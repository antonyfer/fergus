(function($) {
	'use strict';
	
	var tabs = {};
	edge.modules.tabs = tabs;
	
	tabs.edgeInitTabs = edgeInitTabs;
	
	
	tabs.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function edgeInitTabs(){
		var tabs = $('.edge-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edge-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edge-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.edge-tabs a.edge-external-link').off('click');
			});
		}
	}
	
})(jQuery);