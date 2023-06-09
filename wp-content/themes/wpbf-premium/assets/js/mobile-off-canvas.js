(function($) {

	/**
	 * Mobile Toggle
	 */
	function mobileToggle() {

		var mobileToggle = $('.wpbf-mobile-menu-toggle');

		if(mobileToggle.hasClass("active")) {
			$('body').removeClass('active-mobile');
			mobileToggle.removeClass("active").attr( 'aria-expanded', 'false' );
			$('.wpbf-mobile-menu-container').removeClass('active');
			$('.wpbf-mobile-menu-overlay').stop().animate({opacity:'0'}, 300, function() {
				$(this).css({display:'none'});
			});
		} else {
			$('body').addClass('active-mobile');
			mobileToggle.addClass("active").attr( 'aria-expanded', 'true' );
			$('.wpbf-mobile-menu-container').addClass('active');
			$('.wpbf-mobile-menu-overlay').stop().css({display:'block'}).animate({opacity:'1'}, 300);
		}

	}

	function mobileToggleClose() {

		var mobileToggle = $('.wpbf-mobile-menu-toggle');

		if(mobileToggle.hasClass('active')) {
			$('body').removeClass('active-mobile');
			mobileToggle.removeClass("active").attr( 'aria-expanded', 'false' );
			$('.wpbf-mobile-menu-container').removeClass('active');
			$('.wpbf-mobile-menu-overlay').stop().animate({opacity:'0'}, 300, function() {
				$(this).css({display:'none'});
			});
		}

	}

	$('.wpbf-mobile-menu-toggle').click(function() {
		mobileToggle();
	});

	$('.wpbf-mobile-menu-off-canvas .wpbf-close').click(function() {
		mobileToggle();
	});

	$(window).click(function() {
		mobileToggleClose();
	});

	$(document).keyup(function(e) {
		if (e.keyCode === 27) {
			mobileToggleClose();	
		}
	});

	$('.wpbf-mobile-menu-container, .wpbf-mobile-menu-toggle').click(function(event){
		event.stopPropagation();
	});

	// close mobile menu on anchor link clicks
	// only if menu item doesn't have submenus
	$('.wpbf-mobile-menu a').click(function() {

		var attribute  = $(this).attr('href');
		var HasSubMenu = $(this).parent().hasClass('menu-item-has-children');

		if((attribute.match("^#") || attribute.match("^/#")) && HasSubMenu == false ) {
			mobileToggle();
		}

	});

	/**
	 * Desktop Breakpoint
	 *
	 * Retrieve Desktop Breakpoint from Body Class
	 */
	var DesktopBreakpointClass = $('body').attr("class").match(/wpbf-desktop-breakpoint-[\w-]*\b/);

	if( DesktopBreakpointClass !== null ) {
		var string = DesktopBreakpointClass.toString();
		var DesktopBreakpoint = string.match(/\d+/);
	} else {
		var DesktopBreakpoint = '1024';
	}

	/**
	 * Resize Fallback
	 *
	 * Hide open mobile menu on window resize
	 */
	$(window).resize(function() {

		var windowWidth = $(window).width();

		if(windowWidth > DesktopBreakpoint) {
			mobileToggleClose();
			if($('.wpbf-mobile-mega-menu').length) {
				$('.wpbf-mobile-mega-menu').removeClass('wpbf-mobile-mega-menu').addClass('wpbf-mega-menu');
			}
		} else {
			if($('.wpbf-mega-menu').length) {
				$('.wpbf-mega-menu').removeClass('wpbf-mega-menu').addClass('wpbf-mobile-mega-menu');
			}
		}

	});

	/**
	 * Submenu Toggle Arrow
	 */
	function SubMenuMobileToggle(that) {

		if($(that).hasClass("active")) {
			$('i', that).removeClass('wpbff-arrow-up').addClass('wpbff-arrow-down');
			$(that).removeClass('active').attr( 'aria-expanded', 'false' ).siblings('.sub-menu').slideUp();
		} else {
			$('i', that).removeClass('wpbff-arrow-down').addClass('wpbff-arrow-up');
			$(that).addClass('active').attr( 'aria-expanded', 'true' ).siblings('.sub-menu').slideDown();
		}

	}
	 
	$('.wpbf-mobile-menu-off-canvas .wpbf-submenu-toggle').click(function(event) {
		event.preventDefault();
		SubMenuMobileToggle(this);
	});

	function SubMenuToggleOnEmtyLink(that) {

		var toggle = $(that).siblings('.wpbf-submenu-toggle');

		if(toggle.hasClass("active")) {
			$('i', toggle).removeClass('wpbff-arrow-up').addClass('wpbff-arrow-down');
			toggle.removeClass('active').attr( 'aria-expanded', 'false' ).siblings('.sub-menu').slideUp();
		} else {
			$('i', toggle).removeClass('wpbff-arrow-down').addClass('wpbff-arrow-up');
			toggle.addClass('active').attr( 'aria-expanded', 'true' ).siblings('.sub-menu').slideDown();
		}

	}

	$('.wpbf-mobile-menu a').click(function() {

		var attribute  = $(this).attr('href');
		var HasSubMenu = $(this).parent().hasClass('menu-item-has-children');

		if((attribute.match("^#") || attribute.match("^/#")) && HasSubMenu == true ) {
			SubMenuToggleOnEmtyLink(this);
		}
	});

})( jQuery );