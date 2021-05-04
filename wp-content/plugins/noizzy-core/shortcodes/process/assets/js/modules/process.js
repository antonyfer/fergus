(function($) {
	'use strict';
	
	var process = {};
	edge.modules.process = process;
	
	process.edgeInitProcess = edgeInitProcess;
	
	
	process.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function edgeInitProcess() {
		var holder = $('.edge-process-holder');
		
		if(holder.length) {
			holder.each(function(){
				var thisHolder = $(this);
				
				thisHolder.appear(function(){
					thisHolder.addClass('edge-process-appeared');
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
})(jQuery);