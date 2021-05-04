(function($) {
	'use strict';
	
	var counter = {};
	edge.modules.counter = counter;
	
	counter.edgeInitCounter = edgeInitCounter;
	
	
	counter.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function edgeInitCounter() {
		var counterHolder = $('.edge-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.edge-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('edge-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
})(jQuery);