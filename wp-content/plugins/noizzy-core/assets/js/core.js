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
(function($) {
	'use strict';
	
	var animationHolder = {};
	edge.modules.animationHolder = animationHolder;
	
	animationHolder.edgeInitAnimationHolder = edgeInitAnimationHolder;
	
	
	animationHolder.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgeInitAnimationHolder(){
		var elements = $('.edge-grow-in, .edge-fade-in-down, .edge-element-from-fade, .edge-element-from-left, .edge-element-from-right, .edge-element-from-top, .edge-element-from-bottom, .edge-flip-in, .edge-x-rotate, .edge-z-rotate, .edge-y-translate, .edge-fade-in, .edge-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	edge.modules.button = button;
	
	button.edgeButton = edgeButton;
	
	
	button.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var edgeButton = function() {
		//all buttons on the page
		var buttons = $('.edge-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	edge.modules.countdown = countdown;
	
	countdown.edgeInitCountdown = edgeInitCountdown;
	
	
	countdown.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function edgeInitCountdown() {
		var countdowns = $('.edge-countdown'),
			date = new Date(),
			format = 'ODHMS',
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth != month ) {
					month = month - 1;
				}

                if( countdown.data('format') === 'yes' ) {
                    format = 'DHMS'; console.log(format)
                }

				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: format,
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	edge.modules.counter = counter;
	
	counter.edgeInitCounter = edgeInitCounter;
	
	
	counter.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function edgeInitCounter() {
		var counterHolder = $('.edge-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.edge-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('edge-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	edge.modules.customFont = customFont;
	
	customFont.edgeCustomFontResize = edgeCustomFontResize;
	customFont.edgeCustomFontTypeOut = edgeCustomFontTypeOut;
	
	
	customFont.edgeOnDocumentReady = edgeOnDocumentReady;
	customFont.edgeOnWindowLoad = edgeOnWindowLoad;
	
	$(document).ready(edgeOnDocumentReady);
	$(window).on('load', edgeOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgeOnWindowLoad() {
		edgeCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function edgeCustomFontResize() {
		var holder = $('.edge-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.edge-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.edge-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.edge-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.edge-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function edgeCustomFontTypeOut() {
		var edgeTyped = $('.edge-cf-typed');
		
		if (edgeTyped.length) {
			edgeTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.edge-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.edge-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.edge-cf-typed-1').text(),
					string_2 = thisTyped.find('.edge-cf-typed-2').text(),
					string_3 = thisTyped.find('.edge-cf-typed-3').text(),
					string_4 = thisTyped.find('.edge-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	edge.modules.elementsHolder = elementsHolder;
	
	elementsHolder.edgeInitElementsHolderResponsiveStyle = edgeInitElementsHolderResponsiveStyle;
	
	
	elementsHolder.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitElementsHolderResponsiveStyle();
	}
	
	/*
	 **	Elements Holder responsive style
	 */
	function edgeInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.edge-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.edge-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1366-1600') !== 'undefined' && thisItem.data('1366-1600') !== false) {
						largeLaptop = thisItem.data('1366-1600');
					}
					if (typeof thisItem.data('1024-1366') !== 'undefined' && thisItem.data('1024-1366') !== false) {
						smallLaptop = thisItem.data('1024-1366');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('680-768') !== 'undefined' && thisItem.data('680-768') !== false) {
						ipadPortrait = thisItem.data('680-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.edge-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.edge-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.edge-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.edge-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.edge-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
				
				if (typeof edge.modules.common.edgeOwlSlider === "function") {
					edge.modules.common.edgeOwlSlider();
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var fullScreenSections = {};
	edge.modules.fullScreenSections = fullScreenSections;
	
	fullScreenSections.edgeInitFullScreenSections = edgeInitFullScreenSections;
	
	
	fullScreenSections.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitFullScreenSections();
	}
	
	/*
	 **	Init full screen sections shortcode
	 */
	function edgeInitFullScreenSections(){
		var fullScreenSections = $('.edge-full-screen-sections');
		
		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this),
					fullScreenSectionsWrapper = thisFullScreenSections.children('.edge-fss-wrapper'),
					fullScreenSectionsItems = fullScreenSectionsWrapper.children('.edge-fss-item'),
					fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
					fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('edge-fss-item-has-style'),
					enableContinuousVertical = false,
					enableNavigationData = '',
					enablePaginationData = '';
				
				var defaultHeaderStyle = '';
				if (edge.body.hasClass('edge-light-header')) {
					defaultHeaderStyle = 'light';
				} else if (edge.body.hasClass('edge-dark-header')) {
					defaultHeaderStyle = 'dark';
				}
				
				if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
					enableContinuousVertical = true;
				}
				if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
					enableNavigationData = thisFullScreenSections.data('enable-navigation');
				}
				if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
					enablePaginationData = thisFullScreenSections.data('enable-pagination');
				}
				
				var enableNavigation = enableNavigationData !== 'no',
					enablePagination = enablePaginationData !== 'no';
				
				fullScreenSectionsWrapper.fullpage({
					sectionSelector: '.edge-fss-item',
					scrollingSpeed: 1200,
					verticalCentered: false,
					continuousVertical: enableContinuousVertical,
					navigation: enablePagination,
					onLeave: function(index, nextIndex, direction){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
						}
					},
					afterRender: function(){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
							thisFullScreenSections.children('.edge-fss-nav-holder').css('visibility','visible');
						}
						
						fullScreenSectionsWrapper.css('visibility','visible');
					}
				});
				
				setResposniveData(thisFullScreenSections);
				
				if(enableNavigation) {
					thisFullScreenSections.find('#edge-fss-nav-up').on('click', function() {
						$.fn.fullpage.moveSectionUp();
						return false;
					});
					
					thisFullScreenSections.find('#edge-fss-nav-down').on('click', function() {
						$.fn.fullpage.moveSectionDown();
						return false;
					});
				}
			});
		}
	}
	
	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			edge.body.removeClass('edge-light-header edge-dark-header').addClass('edge-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			edge.body.removeClass('edge-light-header edge-dark-header').addClass('edge-' + default_header_style + '-header');
		} else {
			edge.body.removeClass('edge-light-header edge-dark-header');
		}
	}
	
	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#edge-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#edge-fss-nav-down'),
			enableContinuousVertical = false;
		
		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}
		
		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}
	
	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.edge-fss-item'),
			responsiveStyle = '',
			style = '';
		
		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';
			
			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}
			
			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {
				
				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1366px) {.edge-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.edge-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.edge-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.edge-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});
		
		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}
		
		if (style.length) {
			$('head').append(style);
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	edge.modules.googleMap = googleMap;
	
	googleMap.edgeShowGoogleMap = edgeShowGoogleMap;
	
	
	googleMap.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function edgeShowGoogleMap(){
		var googleMap = $('.edge-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.edge-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "edge-map-"+ uniqueId;
				
				edgeInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function edgeInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'edge-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edge-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('edge-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			edgeInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function edgeInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	edge.modules.icon = icon;
	
	icon.edgeIcon = edgeIcon;
	
	
	icon.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgeIcon = function() {
		var icons = $('.edge-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('edge-icon-animation')) {
				icon.appear(function() {
					icon.parent('.edge-icon-animation-holder').addClass('edge-icon-animation-show');
				}, {accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.edge-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	edge.modules.iconListItem = iconListItem;
	
	iconListItem.edgeInitIconList = edgeInitIconList;
	
	
	iconListItem.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var edgeInitIconList = function() {
		var iconList = $('.edge-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('edge-appeared');
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    'use strict';
	
	var imageGallery = {};
	edge.modules.imageGallery = imageGallery;
	
	imageGallery.edgeInitImageGalleryMasonry = edgeInitImageGalleryMasonry;
	
	
	imageGallery.edgeOnWindowLoad = edgeOnWindowLoad;
	
	$(window).on('load', edgeOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function edgeOnWindowLoad() {
		edgeInitImageGalleryMasonry();
	}
	
	/*
	 ** Init Image Gallery shortcode - Masonry layout
	 */
	function edgeInitImageGalleryMasonry(){
		var holder = $('.edge-image-gallery.edge-ig-masonry-type');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edge-ig-masonry');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edge-ig-image',
						percentPosition: true,
						packery: {
							gutter: '.edge-ig-grid-gutter',
							columnWidth: '.edge-ig-grid-sizer'
						}
					});
					
					setTimeout(function() {
						masonry.isotope('layout');
						edge.modules.common.edgeInitParallax();
					}, 800);
					
					masonry.css('opacity', '1');
				});
			});
		}
	}

})(jQuery);
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
(function($) {
	'use strict';
	
	var pieChart = {};
	edge.modules.pieChart = pieChart;
	
	pieChart.edgeInitPieChart = edgeInitPieChart;
	
	
	pieChart.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function edgeInitPieChart() {
		var pieChartHolder = $('.edge-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.edge-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.edge-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var progressBar = {};
	edge.modules.progressBar = progressBar;
	
	progressBar.edgeInitProgressBars = edgeInitProgressBars;
	
	
	progressBar.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function edgeInitProgressBars(){
		var progressBar = $('.edge-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.edge-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					edgeInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function edgeInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.edge-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	edge.modules.tabs = tabs;
	
	tabs.edgeInitTabs = edgeInitTabs;
	
	
	tabs.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function edgeInitTabs(){
		var tabs = $('.edge-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edge-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edge-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.edge-tabs a.edge-external-link').off('click');
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';
    
    var textMarquee = {};
    edge.modules.textMarquee = textMarquee;
    
    textMarquee.edgeInitTextMarquee = edgeInitTextMarquee;
	textMarquee.edgeTextMarqueeResize = edgeTextMarqueeResize;
    
    textMarquee.edgeOnDocumentReady = edgeOnDocumentReady;
    
    $(document).ready(edgeOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeTextMarqueeResize();
        edgeInitTextMarquee();
    }
    
    /**
     * Init Text Marquee effect
     */
    function edgeInitTextMarquee() {
        var textMarqueeShortcodes = $('.edge-text-marquee');

        if (textMarqueeShortcodes.length) {
            textMarqueeShortcodes.each(function(){
                var textMarqueeShortcode = $(this),
                    marqueeElements = textMarqueeShortcode.find('.edge-marquee-element'),
                    originalText = marqueeElements.filter('.edge-original-text'),
                    auxText = marqueeElements.filter('.edge-aux-text');

                var calcWidth = function(element) {
                    var width;

                    if (textMarqueeShortcode.outerWidth() > element.outerWidth()) {
                        width = textMarqueeShortcode.outerWidth();
                    } else {
                        width = element.outerWidth();
                    }

                    return width;
                };

                var marqueeEffect = function () {
	                edgeRequestAnimationFrame();
	                
                    var delta = 1, //pixel movement
                        speedCoeff = 0.8, // below 1 to slow down, above 1 to speed up
                        marqueeWidth = calcWidth(originalText);
                    marqueeElements.css({'width':marqueeWidth}); // set the same width to both elements
                    auxText.css('left', marqueeWidth); //set to the right of the initial marquee element

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this),
                            currentPos = 0;

                        var edgeInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            //move marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            marqueeElement.css('transform','translate3d('+speedCoeff*currentPos+'px,0,0)');
	
	                        requestNextAnimationFrame(edgeInfiniteScrollEffect);

                            $(window).resize(function(){
                                marqueeWidth = calcWidth(originalText);
                                currentPos = 0;
                                originalText.css('left',0);
                                auxText.css('left', marqueeWidth); //set to the right of the inital marquee element
                            });
                        }; 
                            
                        edgeInfiniteScrollEffect();
                    });
                };

                marqueeEffect();
            });
        }
    }
    
    /*
     * Request Animation Frame shim
     */
	function edgeRequestAnimationFrame() {
		window.requestNextAnimationFrame =
			(function () {
				var originalWebkitRequestAnimationFrame = undefined,
					wrapper = undefined,
					callback = undefined,
					geckoVersion = 0,
					userAgent = navigator.userAgent,
					index = 0,
					self = this;
				
				// Workaround for Chrome 10 bug where Chrome
				// does not pass the time to the animation function
				
				if (window.webkitRequestAnimationFrame) {
					// Define the wrapper
					
					wrapper = function (time) {
						if (time === undefined) {
							time = +new Date();
						}
						
						self.callback(time);
					};
					
					// Make the switch
					
					originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;
					
					window.webkitRequestAnimationFrame = function (callback, element) {
						self.callback = callback;
						
						// Browser calls the wrapper and wrapper calls the callback
						originalWebkitRequestAnimationFrame(wrapper, element);
					};
				}
				
				// Workaround for Gecko 2.0, which has a bug in
				// mozRequestAnimationFrame() that restricts animations
				// to 30-40 fps.
				
				if (window.mozRequestAnimationFrame) {
					// Check the Gecko version. Gecko is used by browsers
					// other than Firefox. Gecko 2.0 corresponds to
					// Firefox 4.0.
					
					index = userAgent.indexOf('rv:');
					
					if (userAgent.indexOf('Gecko') != -1) {
						geckoVersion = userAgent.substr(index + 3, 3);
						
						if (geckoVersion === '2.0') {
							// Forces the return statement to fall through
							// to the setTimeout() function.
							
							window.mozRequestAnimationFrame = undefined;
						}
					}
				}
				
				return window.requestAnimationFrame   ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame    ||
					window.oRequestAnimationFrame      ||
					window.msRequestAnimationFrame     ||
					
					function (callback, element) {
						var start,
							finish;
						
						window.setTimeout( function () {
							start = +new Date();
							callback(start);
							finish = +new Date();
							
							self.timeout = 1000 / 60 - (finish - start);
							
						}, self.timeout);
					};
				}
			)();
	}

	/*
	 **	Text Marquee resizing style
	 */
	function edgeTextMarqueeResize() {
		var holder = $('.edge-text-marquee');

		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';

				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}

				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}

				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}

				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.edge-text-marquee." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.edge-text-marquee." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.edge-text-marquee." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.edge-text-marquee." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}

				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}

				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}

})(jQuery);
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