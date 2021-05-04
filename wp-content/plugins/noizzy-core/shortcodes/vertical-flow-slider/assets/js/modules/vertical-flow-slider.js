(function($) {
	'use strict';
	
	var verticalFlowSlider = {};
	edge.modules.verticalFlowSlider = verticalFlowSlider;
	
	verticalFlowSlider.edgeInitVerticalFlowSlider = edgeInitVerticalFlowSlider;
	
	
	verticalFlowSlider.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitVerticalFlowSlider();
	}

	/*
     ** Vertical Flow Slider
     */
    function edgeInitVerticalFlowSlider() {

        var verticalFlowSlider = $('.swiper-container.edge-vertical-flow-slider');

        if (verticalFlowSlider.length) {
            verticalFlowSlider.each(function () {
                var swiper = $(this);

                var mouseWheelControl = swiper.data('mouse-wheel-control') == 'yes' ? true : false;
                var activeSlide = swiper.find('.edge-swiper-active-slide');
                var allSlides = swiper.find('.edge-swiper-all-slides');
                var positionX,
                    holderWidth,
                    swiperWrapper = swiper.find('.swiper-wrapper');

                var swiperSlider = new Swiper(swiper, {
                    loop: false,
                    parallax: true,
                    speed: 700,
                    slidesPerView: 1,
                    mousewheel: true,
                    direction: 'vertical',
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    on: {
                      init: function () {
                       var verticalFlowSliderLink = $('.edge-slide-link');
                        verticalFlowSliderLink.on('mouseenter mouseleave', function(event){
                            var linkIndex = $(this).index();
                            $('.swiper-pagination-bullet:nth-child( ' + ( linkIndex + 1 ) + ')').trigger("click");
                        }); 
                      }
                    }
                });
            });
        }
    }
	
})(jQuery);