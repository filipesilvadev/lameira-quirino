<?php
/**
 * Kirki WooCommerce.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Extend the WordPress customizer.
 */
function wpbf_kirki_premium_woocommerce() {

	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	// Only load customizer settings if we are above or equal the minimum required version.
	if ( ! version_compare( WPBF_VERSION, WPBF_MIN_VERSION, '>=' ) ) {
		return;
	}

	/* Fields – menu item */

	// Menu item icon.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_icon',
			'label'    => __( 'Icon', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'cart',
			'priority' => 0,
			'multiple' => 1,
			'choices'  => array(
				'cart'   => __( 'Cart', 'wpbfpremium' ),
				'basket' => __( 'Basket', 'wpbfpremium' ),
				'bag'    => __( 'Bag', 'wpbfpremium' ),
				'bag-2'  => __( 'Bag 2', 'wpbfpremium' ),
			),
		)
	);

	// Separator.
	new \Kirki\Pro\Field\Divider(
		[
			'settings' => 'woocommerce_menu_item_icon_separator',
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'priority' => 0,
		]
	);

	// Menu item text.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_label',
			'label'    => __( '"Cart" Text', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'show',
			'priority' => 20,
			'multiple' => 1,
			'choices'  => array(
				'show' => __( 'Show', 'wpbfpremium' ),
				'hide' => __( 'Hide', 'wpbfpremium' ),
			),
		)
	);

	// Menu item custom text.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'text',
			'settings'        => 'woocommerce_menu_item_custom_label',
			'default'         => '',
			'label'           => __( '"Cart" Text', 'wpbfpremium' ),
			'section'         => 'wpbf_woocommerce_menu_item_options',
			'default'         => 'Cart',
			'priority'        => 20,
			'transport'       => 'postMessage',
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_menu_item_label',
					'operator' => '==',
					'value'    => 'show',
				),
			),
		)
	);

	// Menu item amount.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_amount',
			'label'    => __( 'Amount', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'show',
			'priority' => 21,
			'multiple' => 1,
			'choices'  => array(
				'show' => __( 'Show', 'wpbfpremium' ),
				'hide' => __( 'Hide', 'wpbfpremium' ),
			),
		)
	);

	// Separator.
	new \Kirki\Pro\Field\Divider(
		[
			'settings' => 'woocommerce_menu_item_amount_separator',
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'priority' => 22,
		]
	);

	// Menu item dropdown.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_dropdown',
			'label'    => __( 'Cart Dropdown', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'show',
			'priority' => 23,
			'multiple' => 1,
			'choices'  => array(
				'show' => __( 'Enable', 'wpbfpremium' ),
				'hide' => __( 'Disable', 'wpbfpremium' ),
			),
		)
	);

	// Cart button.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'select',
			'settings'        => 'woocommerce_menu_item_dropdown_cart_button',
			'label'           => __( 'Cart Button', 'wpbfpremium' ),
			'section'         => 'wpbf_woocommerce_menu_item_options',
			'default'         => 'show',
			'priority'        => 24,
			'multiple'        => 1,
			'choices'         => array(
				'show' => __( 'Show', 'wpbfpremium' ),
				'hide' => __( 'Hide', 'wpbfpremium' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_menu_item_dropdown',
					'operator' => '!=',
					'value'    => 'hide',
				),
			),
		)
	);

	// Checkout button.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'select',
			'settings'        => 'woocommerce_menu_item_dropdown_checkout_button',
			'label'           => __( 'Checkout Button', 'wpbfpremium' ),
			'section'         => 'wpbf_woocommerce_menu_item_options',
			'default'         => 'show',
			'priority'        => 25,
			'multiple'        => 1,
			'choices'         => array(
				'show' => __( 'Show', 'wpbfpremium' ),
				'hide' => __( 'Hide', 'wpbfpremium' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_menu_item_dropdown',
					'operator' => '!=',
					'value'    => 'hide',
				),
			),
		)
	);

	// Display on add to cart.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'toggle',
			'settings'        => 'woocommerce_menu_item_dropdown_popup',
			'label'           => __( 'Cart Popup', 'wpbfpremium' ),
			'tooltip'         => __( 'Display the cart dropdown for a short period of time after a product was added to the cart. Works only in combination with Sticky Navigation.', 'wpbfpremium' ),
			'section'         => 'wpbf_woocommerce_menu_item_options',
			'default'         => false,
			'priority'        => 26,
			'multiple'        => 1,
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_menu_item_dropdown',
					'operator' => '!=',
					'value'    => 'hide',
				),
				array(
					'setting'  => 'menu_sticky',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);

	/* Fields – shop & archive pages (loop) */

	$shop_priority = 60;

	// Separator.
	new \Kirki\Pro\Field\Divider(
		[
			'settings' => 'woocommerce_loop_separator_premium_0',
			'section'  => 'woocommerce_product_catalog',
			'priority' => $shop_priority++,
		]
	);

	// Image flip.
	Kirki::add_field(
		'wpbf',
		array(
			'type'        => 'select',
			'settings'    => 'woocommerce_loop_image_flip',
			'label'       => __( 'Image Flip', 'wpbfpremium' ),
			'description' => __( 'Displays the first image of your product gallery (if available) when hovering over the product thumbnail.', 'wpbfpremium' ),
			'section'     => 'woocommerce_product_catalog',
			'default'     => 'enabled',
			'priority'    => $shop_priority++,
			'multiple'    => 1,
			'choices'     => array(
				'enabled'  => __( 'Enabled', 'wpbfpremium' ),
				'disabled' => __( 'Disabled', 'wpbfpremium' ),
			),
		)
	);

	// Infinite scroll.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_loop_infinite_scroll',
			'label'    => __( 'Infinite Scroll', 'wpbfpremium' ),
			'section'  => 'woocommerce_product_catalog',
			'default'  => 'disabled',
			'priority' => $shop_priority++,
			'multiple' => 1,
			'choices'  => array(
				'disabled' => __( 'Disabled', 'wpbfpremium' ),
				'enabled'  => __( 'Enabled', 'wpbfpremium' ),
				// 'button'   => __( 'Load More Button', 'wpbfpremium' ),
			),
		)
	);

	// Separator.
	new \Kirki\Pro\Field\Divider(
		[
			'settings' => 'woocommerce_loop_separator_premium_1',
			'section'  => 'woocommerce_product_catalog',
			'priority' => $shop_priority++,
		]
	);

	// Quick view.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_loop_quick_view',
			'label'    => __( 'Quick View', 'wpbfpremium' ),
			'section'  => 'woocommerce_product_catalog',
			'default'  => 'enabled',
			'priority' => $shop_priority++,
			'multiple' => 1,
			'choices'  => array(
				'enabled'  => __( 'Enabled', 'wpbfpremium' ),
				'disabled' => __( 'Disabled', 'wpbfpremium' ),
			),
		)
	);

	// Quick view font size.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'input_slider',
			'label'           => __( 'Font Size', 'wpbfpremium' ),
			'settings'        => 'woocommerce_loop_quick_view_font_size',
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'priority'        => $shop_priority++,
			'default'         => '14px',
			'choices'         => array(
				'min'  => 0,
				'max'  => 50,
				'step' => 1,
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_quick_view',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Quick view font color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_quick_view_font_color',
			'label'           => __( 'Font Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => '#ffffff',
			'priority'        => $shop_priority++,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_quick_view',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Quick view background color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_quick_view_background_color',
			'label'           => __( 'Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => 'rgba(0,0,0,.7)',
			'priority'        => $shop_priority++,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_quick_view',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Quick view overlay color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_quick_view_overlay_color',
			'label'           => __( 'Overlay Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'rgba(0,0,0,.8)',
			'priority'        => $shop_priority++,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_quick_view',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Separator.
	new \Kirki\Pro\Field\Divider(
		[
			'settings' => 'woocommerce_loop_separator_premium_2',
			'section'  => 'woocommerce_product_catalog',
			'priority' => $shop_priority++,
		]
	);

	// Off canvas sidebar.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'select',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar',
			'label'           => __( 'Off Canvas Sidebar', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'disabled',
			'priority'        => $shop_priority++,
			'multiple'        => 1,
			'choices'         => array(
				'enabled'  => __( 'Enabled', 'wpbfpremium' ),
				'disabled' => __( 'Disabled', 'wpbfpremium' ),
			),
			'partial_refresh' => array(
				'woocommerce_loop_off_canvas_sidebar' => array(
					'container_inclusive' => true,
					'selector'            => '.wpbf-woo-off-canvas-sidebar-button',
					'render_callback'     => function () {
						return wpbf_woo_off_canvas_sidebar();
					},
				),
			),
		)
	);

	// Off sidebar icon.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'select',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_icon',
			'label'           => __( 'Icon', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'search',
			'priority'        => $shop_priority++,
			'multiple'        => 1,
			'choices'         => array(
				'search'    => __( 'Search', 'wpbfpremium' ),
				'hamburger' => __( 'Hamburger', 'wpbfpremium' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_off_canvas_sidebar',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
			'partial_refresh' => array(
				'woocommerce_loop_off_canvas_sidebar_icon' => array(
					'container_inclusive' => true,
					'selector'            => '.wpbf-woo-off-canvas-sidebar-button',
					'render_callback'     => function () {
						return wpbf_woo_off_canvas_sidebar();
					},
				),
			),
		)
	);

	// Off canvas sidebar label.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'text',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_label',
			'label'           => __( 'Label', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'Filter',
			'priority'        => $shop_priority++,
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_off_canvas_sidebar',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
			'partial_refresh' => array(
				'woocommerce_loop_off_canvas_sidebar_label' => array(
					'container_inclusive' => true,
					'selector'            => '.wpbf-woo-off-canvas-sidebar-button',
					'render_callback'     => function () {
						return wpbf_woo_off_canvas_sidebar();
					},
				),
			),
		)
	);

	// Off canvas sidebar font color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_font_color',
			'label'           => __( 'Font Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => '#ffffff',
			'priority'        => $shop_priority++,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_off_canvas_sidebar',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Off canvas sidebar background color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_background_color',
			'label'           => __( 'Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => '',
			'priority'        => $shop_priority++,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_off_canvas_sidebar',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Off canvas sidebar overlay color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_overlay_color',
			'label'           => __( 'Overlay Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'rgba(0,0,0,.2)',
			'priority'        => $shop_priority++,
			'transport'       => 'postMessage',
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_off_canvas_sidebar',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	/* Fields – checkout page */

	// Distraction free.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'toggle',
			'settings' => 'woocommerce_distraction_free_checkout',
			'label'    => __( 'Distraction Free Checkout', 'wpbfpremium' ),
			'section'  => 'woocommerce_checkout',
			'default'  => 0,
			'priority' => 1,
			'multiple' => 1,
		)
	);

}
add_action( 'after_setup_theme', 'wpbf_kirki_premium_woocommerce' );
