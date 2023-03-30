(function($) {

	/**
	 * Full Screen Animation
	 */
	function menuToggle() {

		if( $('.wpbf-menu-full-screen').hasClass('active') ) {
			$('.wpbf-menu-toggle').removeClass("active").attr( 'aria-expanded', 'false' );
			$('.wpbf-menu-full-screen').removeClass('active');
			$('.wpbf-menu-full-screen').fadeOut(150);
		} else {
			$('.wpbf-menu-toggle').addClass("active").attr( 'aria-expanded', 'true' );
			$('.wpbf-menu-full-screen').addClass('active');
			$('.wpbf-menu-full-screen').fadeIn(150);
		}

	}

	function menuToggleClose() {

		if( $('.wpbf-menu-full-screen').hasClass('active') ) {
			$('.wpbf-menu-full-screen').removeClass('active');
			$('.wpbf-menu-full-screen').fadeOut(150);
		}

	}

	$('.wpbf-menu-toggle').click(function() {
		menuToggle();
	});

	$('.wpbf-menu-full-screen .wpbf-close').click(function() {
		menuToggleClose();
	});

	$(document).keyup(function(e) {
		if (e.keyCode === 27) {
			menuToggleClose();
		}
	});

})( jQuery );