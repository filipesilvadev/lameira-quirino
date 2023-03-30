(function($) {

	// Mega Menu | prevent click on headlines
	 $('.wpbf-mega-menu > .sub-menu > .menu-item a[href="#"]').click(function(event) {
	 	event.preventDefault();
	 });

	/* Sub Menu Animations */

	var duration = $(".wpbf-navigation").data('sub-menu-animation-duration');

	// Down Animation
	$('.wpbf-sub-menu-animation-down > .menu-item-has-children').hover(function() {
		$('.sub-menu', this).first().stop().css({display:'block'}).animate({marginTop:'0', opacity:'1'}, duration);
	},
	function(){
		$('.sub-menu', this).first().stop().animate({opacity:'0', marginTop:'-10px'}, duration, function() {
			$(this).css({display:'none'});
		});
	});

	// Up Animation
	$('.wpbf-sub-menu-animation-up > .menu-item-has-children').hover(function() {
		$('.sub-menu', this).first().stop().css({display:'block'}).animate({marginTop:'0', opacity:'1'}, duration);
	},
	function(){
		$('.sub-menu', this).first().stop().animate({opacity:'0', marginTop:'10px'}, duration, function() {
			$(this).css({display:'none'});
		});
	});

	// Zoom In Animation
	$('.wpbf-sub-menu-animation-zoom-in > .menu-item-has-children').hover(function() {
		$('.sub-menu', this).first().stop(true).css({display:'block'}).transition({scale:'1', opacity:'1'}, duration);
	},
	function(){
		$('.sub-menu', this).first().stop(true).transition({scale:'.95', opacity:'0'}, duration).fadeOut(5);
	});

	// Zoom Out Animation
	$('.wpbf-sub-menu-animation-zoom-out > .menu-item-has-children').hover(function() {
		$('.sub-menu', this).first().stop(true).css({display:'block'}).transition({scale:'1', opacity:'1'}, duration);
	},
	function(){
		$('.sub-menu', this).first().stop(true).transition({scale:'1.05', opacity:'0'}, duration).fadeOut(5);
	});

	// WooCommerce Menu Item
	$(document).on({
		mouseenter: function () {
			$('.wpbf-woo-menu-item .wpbf-woo-sub-menu').stop().fadeIn(duration);
		},
		mouseleave: function () {
			$('.wpbf-woo-menu-item .wpbf-woo-sub-menu').stop().fadeOut(duration);
		}
	}, ".wpbf-woo-menu-item.menu-item-has-children");

	/* Responsive Video Opt-In */

	$('.wpbf-video-opt-in-button, .wpbf-video-opt-in-image').click(function(event) {
		event.preventDefault();
		var url = $(this).parent().next().attr('data-wpbf-video');
		$(this).parent().next().children().attr("src", url);
		$(this).parent().next().removeClass('opt-in');
		$(this).parent().remove();
	});

	$(window).load(function() {

		if ($('.wpbf-post-grid-masonry').length) {

			$('.wpbf-post-grid-masonry').isotope({
				itemSelector: '.wpbf-article-wrapper',
				transitionDuration: 20,
			});

		}

	});

})( jQuery );