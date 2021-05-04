(function($) {
    'use strict';

    var artistsSlider = {};
    edge.modules.artistsSlider = artistsSlider;

    artistsSlider.edgeOnDocumentReady = edgeOnDocumentReady;
    artistsSlider.edgeOnWindowLoad = edgeOnWindowLoad;
    artistsSlider.edgeOnWindowResize = edgeOnWindowResize;
    artistsSlider.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeArtistsSliderHover();
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

    function edgeArtistsSliderHover() {

        if ( $('.edge-artists-slider').length ) {
            $('.edge-artists-slider').each(function(){
                var $this = $(this);

                // check for mouseWheel option and enables functionality
                var mouseWheelEnabled = $this.data('slider-mousewheel');

                if ( mouseWheelEnabled !== 'undefined' && mouseWheelEnabled === 'yes') {

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

                var showActiveSlideInfo = function() {
                    $this.find('.active').each(function(){
                        var $info = $(this).find('.edge-artist-info').html();
                        $(this).on('mousemove', function(e){

                            if($(this).hasClass('active')) {

                                $('.edge-artists-slider-info').html($info)
                                $('.edge-artists-slider-info').css({
                                    top: e.clientY,
                                    left: e.clientX,
                                    opacity: 1
                                });
                            }
                        });

                        $(this).on('mouseleave', function(){
                            $('.edge-artists-slider-info').css('opacity', 0);
                        });
                    });
                }

                /*init once to show info on firs active slide before translate*/
                showActiveSlideInfo();

                /*init function after translation of slider*/
                $this.on('translated.owl.carousel', function(){
                    showActiveSlideInfo();
                });

            });

        }
    }

})(jQuery);