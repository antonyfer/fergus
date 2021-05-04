(function ($) {
    'use strict';

    var albumsSlider = {};
    edge.modules.albumsSlider = albumsSlider;

    albumsSlider.edgeOnDocumentReady = edgeOnDocumentReady;
    albumsSlider.edgeOnWindowLoad = edgeOnWindowLoad;
    albumsSlider.edgeOnWindowResize = edgeOnWindowResize;
    albumsSlider.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeAlbumsSliderMouseWheelScroll();
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
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
    }

    function edgeAlbumsSliderMouseWheelScroll() {

        if ($('.edge-albums-player-slider-holder .edge-alb-with-player .edge-owl-slider').length) {
            $('.edge-albums-player-slider-holder .edge-alb-with-player .edge-owl-slider').each(function () {
                var $this = $(this);

                // check for mouseWheel option and enables functionality
                var mouseWheelEnabled = $('.edge-albums-player-slider-holder .edge-alb-with-player').data('slider-mousewheel');

                if (mouseWheelEnabled !== 'undefined' && mouseWheelEnabled === 'yes') {

                    // allow one mousewheel each 0.5 second
                    var timestamp_mousewheel = 0; //Define if not in a function

                    $this.on("mousewheel", ".owl-stage", function (e) {
                        var d = new Date();

                        /*on mousewheel event compare two times to allow event every 0.5 second*/
                        if ((d.getTime() - timestamp_mousewheel) > 500) {

                            /*acquire new time for comparison*/
                            timestamp_mousewheel = d.getTime();

                            if (e.deltaY > 0) {
                                $this.trigger('next.owl');
                            } else {
                                $this.trigger('prev.owl');
                            }
                            e.preventDefault();
                        }
                    });
                }
            });
        }
    }

})(jQuery);