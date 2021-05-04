(function($) {
    'use strict';
	
	var accordions = {};
	edge.modules.accordions = accordions;
	
	accordions.edgeInitAccordions = edgeInitAccordions;
	
	
	accordions.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function edgeInitAccordions(){
		var accordion = $('.edge-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('edge-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: -1,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('edge-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.edge-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('mouseenter mouseleave', function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);