(function($) {

	/**
	 * Toggle
	 */
	function menuToggle() {

		if($('.wpbf-menu-off-canvas').hasClass("active")) {
			$('.wpbf-menu-toggle').removeClass("active").attr( 'aria-expanded', 'false' );
			$('.wpbf-menu-off-canvas').removeClass('active');
			$('body').removeClass('active');
			$('.wpbf-menu-overlay').stop().animate({opacity:'0'}, 300, function() {
				$(this).css({display:'none'});
			});
		} else {
			$('.wpbf-menu-off-canvas').attr( 'tabindex', '-1' ).focus();
			$('.wpbf-menu-toggle').addClass("active").attr( 'aria-expanded', 'true' );
			$('.wpbf-menu-off-canvas').addClass('active');
			$('body').addClass('active');
			$('.wpbf-menu-overlay').stop().css({display:'block'}).animate({opacity:'1'}, 300);
		}

	}

	function menuToggleClose() {

		if($('.wpbf-menu-off-canvas').hasClass("active")) {
			$('.wpbf-menu-toggle').removeClass("active").attr( 'aria-expanded', 'false' );
			$('.wpbf-menu-off-canvas').removeClass('active');
			$('body').removeClass('active');
			$('.wpbf-menu-overlay').stop().animate({opacity:'0'}, 300, function() {
				$(this).css({display:'none'});
			});
		}

	}

	$('.wpbf-menu-toggle').click(function() {
		menuToggle();
	});

	$('.wpbf-menu-off-canvas .wpbf-close').click(function() {
		menuToggle();
	});

	$(window).click(function() {
		menuToggleClose();
	});

	$(document).keyup(function(e) {
		if (e.keyCode === 27) {
			menuToggleClose();	
		}
	});

	$('.wpbf-menu-off-canvas, .wpbf-menu-toggle').click(function(event){
		event.stopPropagation();
	});

	/**
	 * Sub Menu Toggle
	 */
	$('.wpbf-menu-off-canvas .wpbf-submenu-toggle').click(function(event) {

		event.preventDefault();

		if($(this).hasClass("active")) {
			$('i', this).removeClass('wpbff-arrow-up').addClass('wpbff-arrow-down');
			$(this).removeClass('active').attr( 'aria-expanded', 'false' ).siblings('.sub-menu').slideUp();
		} else {
			$('i', this).removeClass('wpbff-arrow-down').addClass('wpbff-arrow-up');
			$(this).addClass('active').attr( 'aria-expanded', 'true' ).siblings('.sub-menu').slideDown();
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
	 * Hide open menu on window resize
	 */
	$(window).resize(function(){

		var windowWidth = $(window).width();

		if(windowWidth < DesktopBreakpoint) {
			menuToggleClose();
		}

	});

})( jQuery );