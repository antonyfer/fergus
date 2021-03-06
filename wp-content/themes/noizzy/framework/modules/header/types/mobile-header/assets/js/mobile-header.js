(function ($) {
	"use strict";
	
	var mobileHeader = {};
	edge.modules.mobileHeader = mobileHeader;
	
	mobileHeader.edgeOnDocumentReady = edgeOnDocumentReady;
	mobileHeader.edgeOnWindowResize = edgeOnWindowResize;
	
	$(document).ready(edgeOnDocumentReady);
	$(window).resize(edgeOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function edgeOnDocumentReady() {
		edgeInitMobileNavigation();
		edgeInitMobileNavigationScroll();
		edgeMobileHeaderBehavior();
	}
	
	/*
        All functions to be called on $(window).resize() should be in this function
    */
	function edgeOnWindowResize() {
		edgeInitMobileNavigationScroll();
	}
	
	function edgeInitMobileNavigation() {
		var navigationOpener = $('.edge-mobile-header .edge-mobile-menu-opener'),
			navigationHolder = $('.edge-mobile-header .edge-mobile-nav'),
			dropdownOpener = $('.edge-mobile-nav .mobile_arrow, .edge-mobile-nav h6, .edge-mobile-nav a.edge-mobile-no-link');
		
		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				
				if (navigationHolder.is(':visible')) {
					navigationHolder.slideUp(450, 'easeInOutQuint');
					navigationOpener.removeClass('edge-mobile-menu-opened');
				} else {
					navigationHolder.slideDown(450, 'easeInOutQuint');
					navigationOpener.addClass('edge-mobile-menu-opened');
				}
			});
		}
		
		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				var thisItem = $(this);

				thisItem.on('tap click', function (e) {
					var thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');

						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('edgtf-opened');
						} else {
							thisItemParent.addClass('edgtf-opened');

							if (thisItemParentSiblingsWithDrop.length === 0) {
								thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
								});
							} else {
								thisItemParent.siblings().removeClass('edgtf-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
								});
							}
						}
					}
				});
			});
		}
		
		$('.edge-mobile-nav a, .edge-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				navigationHolder.slideUp(450, 'easeInOutQuint');
				navigationOpener.removeClass("edge-mobile-menu-opened");
			}
		});
	}
	
	function edgeInitMobileNavigationScroll() {
		if (edge.windowWidth <= 1024) {
			var mobileHeader = $('.edge-mobile-header'),
				mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
				navigationHolder = mobileHeader.find('.edge-mobile-nav'),
				navigationHeight = navigationHolder.outerHeight(),
				windowHeight = edge.windowHeight - 100;
			
			//init scrollable menu
			var scrollHeight = mobileHeaderHeight + navigationHeight > windowHeight ? windowHeight - mobileHeaderHeight : navigationHeight;
			
			navigationHolder.height(scrollHeight).perfectScrollbar({
				wheelSpeed: 0.6,
				suppressScrollX: true
			});
		}
	}
	
	function edgeMobileHeaderBehavior() {
		var mobileHeader = $('.edge-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.edge-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
		
		if (edge.body.hasClass('edge-content-is-behind-header') && mobileHeaderHeight > 0 && edge.windowWidth <= 1024) {
			$('.edge-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (edge.body.hasClass('edge-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + edgeGlobalVars.vars.edgeAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount) {
					mobileHeader.addClass('edge-animate-mobile-header');
				} else {
					mobileHeader.removeClass('edge-animate-mobile-header');
				}
				
				if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('edge-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.edge-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);