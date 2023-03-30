(function($) {

	/* Sticky Menu
	========================================================================== */

	// don't take it further if the navigation doesn't exist
	if ($('.wpbf-navigation').length == 0) return;

	// Sticky Vars
	var sticky = $('.wpbf-navigation').data('sticky');

	var delay = $(".wpbf-navigation").data('sticky-delay');
	var animation = $(".wpbf-navigation").data('sticky-animation');
	var duration = $(".wpbf-navigation").data('sticky-animation-duration');

	var offset_top = $('.wpbf-navigation').offset().top;
	
	var fired = 0;
	var lastScrollTop = 0;
	
	var distance = parseInt(offset_top) + parseInt(delay);

	var menu_logo = $('.wpbf-logo img').attr('src');
	var menu_active_logo = $('.wpbf-logo').data("menu-active-logo");

	// Sticky Navigation
	function stickyNavigation() {

	var scroll_top = $(window).scrollTop();

	var navHeight = $('.wpbf-navigation').outerHeight();

		if (scroll_top > distance && fired == '0') {

			$('.wpbf-navigation').addClass('wpbf-navigation-active');

			if(animation == 'slide') {

				$('.wpbf-navigation').css({ 'position':'fixed', 'left':'0', 'zIndex':'666', 'top': -navHeight }).animate({'top':0}, duration);

			} else if(animation == 'fade') {

				$('.wpbf-navigation').css({ 'display':'none', 'position':'fixed', 'top':'0', 'left':'0', 'zIndex':'666' }).fadeIn(duration);

			} else {

				$('.wpbf-navigation').css({ 'position': 'fixed', 'top':'0', 'left':'0', 'zIndex':'666' });

				if(animation == 'scroll') {

					$('.wpbf-navigation').addClass('wpbf-navigation-animate');

				}

			}

			if (!$('body').hasClass('wpbf-transparent-header')) {

				$('.wpbf-page-header').css('marginTop', navHeight);

			}

			if ($('.wpbf-logo').data('menu-active-logo')) {
				$('.wpbf-logo img').attr('src', menu_active_logo);
				$('.wpbf-mobile-logo img').attr('src', menu_active_logo);
			}

			fired = '1';

		} else if (scroll_top < distance && fired == '1') {

			$('.wpbf-navigation').removeClass('wpbf-navigation-active wpbf-navigation-animate');

			if (!$('body').hasClass('wpbf-transparent-header')) {

				$('.wpbf-navigation').css({ 'position':'', 'top':'', 'left':'', 'zIndex':'' });
				$('.wpbf-page-header').css('marginTop', '');

			} else {

				$('.wpbf-navigation').css({ 'position':'absolute', 'top':'', 'left':'', 'zIndex':'' });

			}

			if ($('.wpbf-logo').data('menu-active-logo')) {
				$('.wpbf-logo img').attr('src', menu_logo);
				$('.wpbf-mobile-logo img').attr('src', menu_logo);
			}

			fired = '0';

		}

	};

	// Hide on Scroll
	function HideOnScroll() {
		var scroll_top = $(window).scrollTop();
		var navHeight = $('.wpbf-navigation').outerHeight();

	    if(Math.abs(lastScrollTop - scroll_top) <= delay) return;

		if (scroll_top > lastScrollTop && scroll_top > navHeight){
			// Scroll Down
			$('.wpbf-navigation').css({'top':-navHeight});
			$('.wpbf-navigation').removeClass('wpbf-navigation-scroll-up').addClass('wpbf-navigation-scroll-down');
		} else {
			// Scroll Up
			if(scroll_top + $(window).height() < $(document).height()) {
				$('.wpbf-navigation').css({'top':'0px'});
				$('.wpbf-navigation').removeClass('wpbf-navigation-scroll-down').addClass('wpbf-navigation-scroll-up');
			}
		}

		lastScrollTop = scroll_top;
		
	}


	// execute		
	if(sticky) {

		$(window).scroll(function() {

			stickyNavigation();

			if(sticky && animation == 'scroll') {

				HideOnScroll();

			}

		});

	}

})( jQuery );