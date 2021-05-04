(function($) {
    'use strict';

    var portfolio = {};
    edge.modules.portfolio = portfolio;
	
	portfolio.edgeOnDocumentReady = edgeOnDocumentReady;
    portfolio.edgeOnWindowLoad = edgeOnWindowLoad;
	portfolio.edgeOnWindowResize = edgeOnWindowResize;
	
	$(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
	$(window).resize(edgeOnWindowResize);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		initPortfolioSingleMasonry();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgeOnWindowLoad() {
		edgePortfolioSingleFollow().init();
	}
	
	/*
	All functions to be called on $(window).resize() should be in this function
	*/
	function edgeOnWindowResize() {
		initPortfolioSingleMasonry();
	}
	
	var edgePortfolioSingleFollow = function () {
		var info = $('.edge-follow-portfolio-info .edge-portfolio-single-holder .edge-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.edge-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .edge-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0,
				constant = 30; //30 to prevent mispositioned
		}
		
		var infoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				if (edge.scroll >= infoHolderOffset - headerHeight - edgeGlobalVars.vars.edgeAddForAdminBar - constant) {
					var marginTop = edge.scroll - infoHolderOffset + edgeGlobalVars.vars.edgeAddForAdminBar + headerHeight + constant;
					// if scroll is initially positioned below mediaHolderHeight
					if (marginTop + infoHolderHeight > mediaHolderHeight) {
						marginTop = mediaHolderHeight - infoHolderHeight + constant;
					}
					info.stop().animate({
						marginTop: marginTop
					});
				}
			}
		};

        var recalculateInfoHolderPosition = function () {
            if (info.length && mediaHolderHeight >= infoHolderHeight) {
                //Calculate header height if header appears
                if (edge.scroll > 0 && header.length) {
                    headerHeight = header.height();
                }

                var headerMixin = headerHeight + edgeGlobalVars.vars.edgeAddForAdminBar + constant;
                if (edge.scroll >= infoHolderOffset - headerMixin) {
                    if (edge.scroll + infoHolderHeight + headerMixin + 2 * constant < infoHolderOffset + mediaHolderHeight) {
                        info.stop().animate({
                            marginTop: (edge.scroll - infoHolderOffset + headerMixin + 2 * constant)
                        });
                        //Reset header height
                        headerHeight = 0;
                    } else {
                        info.stop().animate({
                            marginTop: mediaHolderHeight - infoHolderHeight
                        });
                    }
                } else {
                    info.stop().animate({
                        marginTop: 0
                    });
                }
            }
        };
		
		return {
			init: function () {
				infoHolderPosition();
				$(window).scroll(function () {
					recalculateInfoHolderPosition();
				});
			}
		};
	};
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.edge-portfolio-single-holder .edge-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
			var size = masonry.find('.edge-ps-grid-sizer').width(),
				isFixedEnabled = masonry.find('.edge-ps-image[class*="edge-masonry-size-"]').length > 0;
			
			masonry.waitForImages(function(){
				masonry.isotope({
					layoutMode: 'packery',
					itemSelector: '.edge-ps-image',
					percentPosition: true,
					packery: {
						gutter: '.edge-ps-grid-gutter',
						columnWidth: '.edge-ps-grid-sizer'
					}
				});

				//edge.modules.common.setFixedImageProportionSize(masonry, masonry.find('.edge-ps-image'), size, isFixedEnabled);
				edge.modules.common.setFixedImageProportionSize(masonry, masonry.find('.edge-ps-image'), size, false);

				masonry.isotope( 'layout').css('opacity', '1');
			});
		}
	}

})(jQuery);