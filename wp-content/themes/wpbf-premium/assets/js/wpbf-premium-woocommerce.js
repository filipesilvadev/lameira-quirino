(function ($) {
	var duration = $(".wpbf-navigation").data('sub-menu-animation-duration');
	var closeCartTimeoutId = null;
	var $elms = {};
	var states = {};

	function init() {
		setupElms();
		setupEvents();
	}

	function setupElms() {
		$elms.cartPopupOverlay = $('.wpbf-woo-menu-item-popup-overlay');
	}

	function setupEvents() {
		$(document).on('click', '.wpbf-woo-quick-view', function (e) {
			e.preventDefault();
			var product_id = $(this).data('product_id');
			var data = {
				'action': 'wpbf_woo_quick_view',
				'product_id': product_id
			};

			var $modal = $('<div>', { 'class': 'wpbf-woo-quick-view-modal wpbf-clearfix' });
			var $close = $('<i>', { 'class': 'wpbf-close wpbff wpbff-times', 'aria-hidden': 'true' });
			var $closest = $(this).closest('.woocommerce');
			$modal.prependTo($closest);
			$close.appendTo('.wpbf-woo-quick-view-modal');

			$('.wpbf-woo-quick-view-modal').fadeIn(300);

			jQuery.post(wpbf_woo_quick_view.ajax_url, data, function (response) {
				$(response).hide().insertAfter($modal).fadeIn(300);
				if($('#wpbf-woo-quick-view-gallery').hasClass('wpbf-siema')){
					mySiema = new Siema({
						selector: '.wpbf-siema',
						duration: 200,
						easing: 'ease-out',
						perPage: 1,
						startIndex: 0,
						draggable: true,
						multipleDrag: true,
						threshold: 20,
						loop: true,
						rtl: false,
					});

					document.querySelector('.wpbf-quik-view-gallery-prev').addEventListener('click', function(){
						mySiema.prev();
					});

					document.querySelector('.wpbf-quik-view-gallery-next').addEventListener('click', function(){
						mySiema.next();
					});
				}
				
			});
		});

		$(document).on('click', '.wpbf-woo-quick-view-modal-content .product:not(.product-type-external) .single_add_to_cart_button', function (e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			var variation_form_obj = $(this).parents('.variations_form'),
				variationBag = {},
				error_flag = false,
				payload,
				quantity = $(this).parents('.cart').find('input[name="quantity"]').val(),
				is_variation = variation_form_obj.length > 0,
				product_id = is_variation === true ? variation_form_obj.data('product_id') : $(this).val(),
				variation_id = variation_form_obj.find('input[name="variation_id"]').val(),
				variations = variation_form_obj.find('select[name^=attribute]');

			if (!variations.length) {
				variations = variation_form_obj.find('[name^=attribute]:checked');
			}

			if (!variations.length) {
				variations = variation_form_obj.find('input[name^=attribute]');
			}


			variations.each(function () {
				var $this = $(this),
					attributeName = $this.attr('name'),
					attributevalue = $this.val(),
					index,
					variationName;

				$this.removeClass('error'); // what's this doing?

				if (attributevalue.length === 0) {
					index = attributeName.lastIndexOf('_');
					variationName = attributeName.substring(index + 1);
					error_flag = true;

					$('.wpbf-woo-quick-view-modal-content select').each(function () {
						if (!$(this).val()) {
							$(this).addClass('select-error');
						}
					});
				} else {
					variationBag[attributeName] = attributevalue;
				}
			});

			// bail if there is any error.
			if (error_flag === true) return;

			payload = {
				'action': 'wpbf_woo_quick_view_add_to_cart',
				'product_id': product_id,
				'quantity': quantity,
				'is_variation': is_variation
			};

			if (is_variation === true) {
				payload.variations = variationBag;
				payload.variation_id = variation_id;
			}

			jQuery.post(wpbf_woo_quick_view.ajax_url, payload, function (results) {
				$(document.body).trigger('wc_fragment_refresh');
				$(document.body).trigger('added_to_cart', [results.fragments, results.cart_hash]);
				closeQuickViewModal();
			});
		});

		$(document).on('click', '.wpbf-woo-quick-view-modal-content select', function () {
			if ($(this).val()) {
				$(this).removeClass('select-error');
			}
		});

		$(document).on('click', '.wpbf-woo-quick-view-modal', function () {
			closeQuickViewModal();
		});

		// Close on Escape
		$(document).keyup(function (e) {
			if (e.keyCode == 27) {
				if ($('.wpbf-woo-quick-view-modal-content').is(':visible')) {
					closeQuickViewModal();
				}
			}
		});

		$(document.body).on('added_to_cart', function () {
			addToCartPopup();
		});

		$(document).on('mouseenter', '.wpbf-woo-menu-item-popup', function () {
			// only continue if the popup is opened via "added_to_cart" event
			if (!states.overlayOpened) return;
			clearTimeout(closeCartTimeoutId);
		});

		$(document).on('mouseleave', '.wpbf-woo-menu-item-popup', function () {
			closeCartOverlay();
		});
	}

	function closeQuickViewModal() {
		var $quickViewModal = $('.wpbf-woo-quick-view-modal-content, .wpbf-woo-quick-view-modal');

		$quickViewModal.fadeOut('300', function () {
			$quickViewModal.remove();
		});
	}

	function addToCartPopup() {
		setTimeout(function () {
			openCartPopup();
		}, 250);

		closeCartTimeoutId = setTimeout(function () {
			closeCartPopup();
		}, 4000);
	}

	function openCartPopup() {
		$('.wpbf-woo-menu-item.wpbf-woo-menu-item-popup .wpbf-woo-sub-menu').fadeIn(duration);
		$elms.cartPopupOverlay.fadeIn(duration, function () {
			states.overlayOpened = true;
		});
	}

	function closeCartPopup() {
		$('.wpbf-woo-menu-item.wpbf-woo-menu-item-popup .wpbf-woo-sub-menu').fadeOut(duration);
		closeCartOverlay();
	}

	function closeCartOverlay() {
		if (!states.overlayOpened) return;
		$elms.cartPopupOverlay.fadeOut(duration, function () {
			states.overlayOpened = false;
		});
	}

	function openOffCanvasSidebar() {
		$('.wpbf-woo-off-canvas-sidebar').addClass('active');
		$('.wpbf-woo-off-canvas-sidebar-overlay').fadeIn(300);
	}

	function closeOffCanvasSidebar() {
		$('.wpbf-woo-off-canvas-sidebar').removeClass('active');
		$('.wpbf-woo-off-canvas-sidebar-overlay').fadeOut(300);
	}

	$('.wpbf-woo-off-canvas-sidebar-button').click(function() {
		openOffCanvasSidebar();
	});

	$('.wpbf-woo-off-canvas-sidebar-overlay, .wpbf-woo-off-canvas-sidebar .wpbf-close').click(function() {
		closeOffCanvasSidebar();
	});

	// Close on Escape
	$(document).keyup(function (e) {
		if (e.keyCode == 27) {
			if ($('.wpbf-woo-off-canvas-sidebar-overlay').is(':visible')) {
				closeOffCanvasSidebar();
			}
		}
	});

	init();
})(jQuery);