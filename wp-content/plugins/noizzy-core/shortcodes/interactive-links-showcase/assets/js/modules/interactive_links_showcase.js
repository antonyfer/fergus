(function($) {
	'use strict';
	
	var interactiveLinksShowcase = {};
	edge.modules.interactiveLinksShowcase = interactiveLinksShowcase;
	
	interactiveLinksShowcase.edgeInitInteractiveLinksShowcase = edgeInitInteractiveLinksShowcase;
	
	
	interactiveLinksShowcase.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitInteractiveLinksShowcase();
	}

	/*
     ** Vertical Flow Slider
     */
    function edgeInitInteractiveLinksShowcase() {

        var interactiveLinksShowcase = $('.swiper-container.edge-interactive-links-showcase');

        if (interactiveLinksShowcase.length) {
            interactiveLinksShowcase.each(function () {
                var swiper = $(this);

                var mouseWheelControl = swiper.data('mouse-wheel-control') == 'yes' ? true : false;
                var activeSlide = swiper.find('.edge-swiper-active-slide');
                var allSlides = swiper.find('.edge-swiper-all-slides');
                var positionX,
                    holderWidth,
                    swiperWrapper = swiper.find('.swiper-wrapper');

                var swiperSlider = new Swiper(swiper, {
                    loop: false,
                    parallax: false,
                    speed: 400,
                    slidesPerView: 1,
                    mousewheel: mouseWheelControl,
                    effect: 'fade',
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    on: {
                      init: function () {
                       var interactiveLinksShowcaseLink = $('.edge-slide-link');
                        swiper.find('.edge-slide-link:nth-child(1)').addClass('edge-slide-link-active');

                        interactiveLinksShowcaseLink.on('mouseenter mouseleave', function(event){
                            var linkIndex = $(this).index();
                            swiper.find('.edge-slide-link').removeClass('edge-slide-link-active');
                            $(this).addClass('edge-slide-link-active');
                            $('.swiper-pagination-bullet:nth-child( ' + ( linkIndex + 1 ) + ')').trigger("click");
                        }); 
                      }
                    }
                });
            });
        }
    }
	
})(jQuery);