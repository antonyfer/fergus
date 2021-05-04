(function($) {
    'use strict';

    var portfolioList = {};
    edge.modules.portfolioList = portfolioList;

    portfolioList.edgeOnDocumentReady = edgeOnDocumentReady;
    portfolioList.edgeOnWindowLoad = edgeOnWindowLoad;
    portfolioList.edgeOnWindowResize = edgeOnWindowResize;
    portfolioList.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {

    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
        edgeInitPortfolioMasonry();
        edgeInitPortfolioFilter();
        edgeInitPortfolioListAnimation();
	    edgeInitPortfolioPagination().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
        edgeInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
	    edgeInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgeInitPortfolioListAnimation(){
        var portList = $('.edge-portfolio-list-holder.edge-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.edge-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('edge-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('edge-item-shown');
                        }, 800);
                    },{accX: 0, accY: -200});
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function edgeInitPortfolioMasonry(){
        var holder = $('.edge-portfolio-list-holder.edge-pl-masonry');

        if(holder.length){
	        holder.each(function(){
                var thisHolder = $(this),
                    masonry = thisHolder.children('.edge-pl-inner'),
                    size = thisHolder.find('.edge-pl-grid-sizer').width();

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.edge-pl-grid-gutter',
                        columnWidth: '.edge-pl-grid-sizer'
                    }
                });
                
	            edge.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), size);
	            
                setTimeout(function () {
	                edge.modules.common.edgeInitParallax();
                }, 600);

                masonry.isotope( 'layout').css('opacity', '1');
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function edgeInitPortfolioFilter(){
        var filterHolder = $('.edge-portfolio-list-holder .edge-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.edge-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.edge-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('edge-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.edge-pl-filter:first').addClass('edge-pl-current');
	            
	            if(thisPortListHolder.hasClass('edge-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.edge-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
	                    portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.edge-pl-filter').removeClass('edge-pl-current');
                    thisFilter.addClass('edge-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                edgeInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.edge-pl-inner').isotope({ filter: filterValue });
	                    edge.modules.common.edgeInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function edgeInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.edge-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = edge.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'noizzy_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.edge-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('edge-showing edge-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgeGlobalVars.vars.edgeAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArticles) {
                            setTimeout(function() {
	                            edge.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.edge-pl-grid-sizer').width());
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('edge-showing edge-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    edgeInitPortfolioListAnimation();
	                                edge.modules.common.edgeInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('edge-showing edge-filter-trigger');
                            edgeInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function edgeInitPortfolioPagination(){
		var portList = $('.edge-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.edge-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.edge-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - edgeGlobalVars.vars.edgeAddForAdminBar;
			
			if(!thisPortList.hasClass('edge-pl-infinite-scroll-started') && edge.scroll + edge.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.edge-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('edge-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('edge-pl-pag-infinite-scroll')) {
				thisPortList.addClass('edge-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = edge.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.edge-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisPortList.hasClass('edge-pl-pag-standard')) {
					loadingItem.addClass('edge-showing edge-standard-pag-trigger');
					thisPortList.addClass('edge-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('edge-showing');
				}
				
				var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'noizzy_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgeGlobalVars.vars.edgeAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('edge-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('edge-pl-pag-standard')) {
							edgeInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edge-pl-masonry')){
									edgeInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edge-pl-gallery') && thisPortList.hasClass('edge-pl-has-filter')) {
									edgeInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgeInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edge-pl-masonry')){
								    if(pagedLink == 1) {
                                        edgeInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        edgeInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('edge-pl-gallery') && thisPortList.hasClass('edge-pl-has-filter') && pagedLink != 1) {
									edgeInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
								    if (pagedLink == 1) {
                                        edgeInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        edgeInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
								}
							});
						}
						
						if(thisPortList.hasClass('edge-pl-infinite-scroll-started')) {
							thisPortList.removeClass('edge-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.edge-pl-load-more-holder').hide();
			}
		};
		
		var edgeInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.edge-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edge-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edge-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edge-pl-pag-next a');
			
			standardPagNumericItem.removeClass('edge-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edge-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgeInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
			edge.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.edge-pl-grid-sizer').width());
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisPortList.removeClass('edge-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgeInitPortfolioListAnimation();
				edge.modules.common.edgeInitParallax();
				edge.modules.common.edgePrettyPhoto();
			}, 600);
		};
		
		var edgeInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisPortList.removeClass('edge-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			edgeInitPortfolioListAnimation();
			edge.modules.common.edgeInitParallax();
			edge.modules.common.edgePrettyPhoto();
		};
		
		var edgeInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
			edge.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.edge-pl-grid-sizer').width());
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgeInitPortfolioListAnimation();
				edge.modules.common.edgeInitParallax();
				edge.modules.common.edgePrettyPhoto();
			}, 600);
		};
		
		var edgeInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing');
			thisPortListInner.append(responseHtml);
			edgeInitPortfolioListAnimation();
			edge.modules.common.edgeInitParallax();
			edge.modules.common.edgePrettyPhoto();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edge-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edge-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edge-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edge-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}

})(jQuery);