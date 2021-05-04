(function ($) {
    "use strict";

    window.edge = {};
    edge.modules = {};

    edge.scroll = 0;
    edge.window = $(window);
    edge.document = $(document);
    edge.windowWidth = $(window).width();
    edge.windowHeight = $(window).height();
    edge.body = $('body');
    edge.html = $('html, body');
    edge.htmlEl = $('html');
    edge.menuDropdownHeightSet = false;
    edge.defaultHeaderStyle = '';
    edge.minVideoWidth = 1500;
    edge.videoWidthOriginal = 1280;
    edge.videoHeightOriginal = 720;
    edge.videoRatio = 1.61;

    edge.edgeOnDocumentReady = edgeOnDocumentReady;
    edge.edgeOnWindowLoad = edgeOnWindowLoad;
    edge.edgeOnWindowResize = edgeOnWindowResize;
    edge.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edge.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if (edge.body.hasClass('edge-dark-header')) {
            edge.defaultHeaderStyle = 'edge-dark-header';
        }
        if (edge.body.hasClass('edge-light-header')) {
            edge.defaultHeaderStyle = 'edge-light-header';
        }
    }

    /* 
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {

    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
        edge.windowWidth = $(window).width();
        edge.windowHeight = $(window).height();
    }

    /* 
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
        edge.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch (true) {
        case edge.body.hasClass('edge-grid-1300'):
            edge.boxedLayoutWidth = 1350;
            //edge.gridWidth = 1300;
            break;
        case edge.body.hasClass('edge-grid-1200'):
            edge.boxedLayoutWidth = 1250;
            //edge.gridWidth = 1200;
            break;
        case edge.body.hasClass('edge-grid-1000'):
            edge.boxedLayoutWidth = 1050;
            //edge.gridWidth = 1000;
            break;
        case edge.body.hasClass('edge-grid-800'):
            edge.boxedLayoutWidth = 850;
            //edge.gridWidth = 800;
            break;
        default :
            edge.boxedLayoutWidth = 1150;
            //edge.gridWidth = 1100;
            break;
    }

    edge.gridWidth = function () {
        var gridWidth = 1100;

        switch (true) {
            case edge.body.hasClass('edge-grid-1300') && edge.windowWidth > 1400:
                gridWidth = 1300;
                break;
            case edge.body.hasClass('edge-grid-1200') && edge.windowWidth > 1300:
                gridWidth = 1200;
                break;
            case edge.body.hasClass('edge-grid-1000') && edge.windowWidth > 1200:
                gridWidth = 1200;
                break;
            case edge.body.hasClass('edge-grid-800') && edge.windowWidth > 1024:
                gridWidth = 800;
            default :
                break;
        }

        return gridWidth;
    };

})(jQuery);