(function($) {
    'use strict';

    var eventsList = {};
    edge.modules.eventsList = eventsList;

    eventsList.edgeOnDocumentReady = edgeOnDocumentReady;
    eventsList.edgeOnWindowLoad = edgeOnWindowLoad;
    eventsList.edgeOnWindowResize = edgeOnWindowResize;
    eventsList.edgeOnWindowScroll = edgeOnWindowScroll;

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
        edgeInitEventsLoadMore();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
    }

    /**
     * Initializes events load more function
     */
    function edgeInitEventsLoadMore(){

        var eventsList = $('.edge-events-list-holder-outer.edge-events-load-more');

        if(eventsList.length){
            eventsList.each(function(){

                var thisEventList = $(this);
                var thisEventListInner = thisEventList.find('.edge-events-list-holder');
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisEventList.find('.edge-events-list-load-more a');
                var loadMoreButtonHolder = thisEventList.find('.edge-events-list-paging');

                if ( thisEventList.find('.edge-grid').length ) {
                    thisEventListInner = thisEventList.find('.edge-grid');
                }

                if (typeof thisEventList.data('max-num-pages') !== 'undefined' && thisEventList.data('max-num-pages') !== false) {
                    maxNumPages = thisEventList.data('max-num-pages');
                }

                loadMoreButton.on('click', function (e) {
                    var loadMoreDatta = edgeGetEventsAjaxData(thisEventList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();
                    if(nextPage <= maxNumPages){
                        loadMoreButtonHolder.find('.edge-events-list-load-more').stop().animate({opacity:0}, 200, 'easeInOutQuint',
                            function(){
                                loadMoreButtonHolder.find('.edge-stripes').stop().animate({opacity:1},200, 'easeInOutQuint');
                            });
                        var ajaxData = edgeSetEventsAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: edgeGlobalVars.vars.edgeAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisEventList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = response.html;

                                thisEventList.waitForImages(function(){
                                    thisEventListInner.append(responseHtml);
                                    loadMoreButtonHolder.find('.edge-stripes').stop().animate({opacity:0}, 200, 'easeInOutQuint',
                                        function(){
                                            loadMoreButtonHolder.find('.edge-events-list-load-more').stop().animate({opacity:1},200, 'easeInOutQuint');
                                            if(nextPage > maxNumPages){
                                                loadMoreButtonHolder.find('.edge-stripes').remove();
                                                loadMoreButtonHolder.fadeOut(200, 'easeInOutQuint').remove();
                                            }
                                        });
                                });
                            }
                        });
                    } else {
                        loadMoreButtonHolder.hide();
                    }
                });

            });
        }
    }

    /**
     * Initializes events load more data params
     * @param events list container with defined data params
     * return array
     */
    function edgeGetEventsAjaxData(container){
        var returnValue = {};

        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.showLoadMore = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.titleTag = '';
        returnValue.buttonShape = '';
        returnValue.textColor = '';
        returnValue.skin = '';
        returnValue.borderColor = '';
        returnValue.eventStatus = '';
        returnValue.layout = '';

        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
            returnValue.number = container.data('number');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('button-shape') !== 'undefined' && container.data('button-shape') !== false) {
            returnValue.buttonShape = container.data('button-shape');
        }
        if (typeof container.data('skin') !== 'undefined' && container.data('skin') !== false) {
            returnValue.skin = container.data('skin');
        }
        if (typeof container.data('text-color') !== 'undefined' && container.data('text-color') !== false) {
            returnValue.textColor = container.data('text-color');
        }
        if (typeof container.data('border-color') !== 'undefined' && container.data('border-color') !== false) {
            returnValue.borderColor = container.data('border-color');
        }
        if (typeof container.data('event-status') !== 'undefined' && container.data('event-status') !== false) {
            returnValue.eventStatus = container.data('event-status');
        }
        if (typeof container.data('layout') !== 'undefined' && container.data('layout') !== false) {
            returnValue.layout = container.data('layout');
        }

        return returnValue;
    }


    /**
     * Sets events load more data params for ajax function
     * @param events list container with defined data params
     * return array
     */
    function edgeSetEventsAjaxData(container){
        var returnValue = {
            action: 'noizzy_music_events_ajax_load_more',
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            showLoadMore: container.showLoadMore,
            nextPage: container.nextPage,
            titleTag: container.titleTag,
            buttonShape: container.buttonShape,
            skin: container.skin,
            textColor: container.textColor,
            borderColor: container.borderColor,
            eventStatus: container.eventStatus,
            layout: container.layout
        };

        return returnValue;

    }

})(jQuery);