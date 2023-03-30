<?php
/**
 * Kirki WooCommerce
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Add custom field about WooCommerce to Cuztomizer
 */
function wpbf_kirki_premium_woocommerce() {
	/* Fields – Menu Item */

	// Menu Item Icon.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_icon',
			'label'    => esc_attr__( 'Icon', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'cart',
			'priority' => 0,
			'multiple' => 1,
			'choices'  => array(
				'cart'   => esc_attr__( 'Cart', 'wpbfpremium' ),
				'basket' => esc_attr__( 'Basket', 'wpbfpremium' ),
				'bag'    => esc_attr__( 'Bag', 'wpbfpremium' ),
			),
		)
	);

	// Separator.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'custom',
			'settings' => 'separator-56462',
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
			'priority' => 0,
		)
	);

	// Menu Item Text.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_label',
			'label'    => esc_attr__( '"Cart" Text', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'show',
			'priority' => 20,
			'multiple' => 1,
			'choices'  => array(
				'show' => esc_attr__( 'Show', 'wpbfpremium' ),
				'hide' => esc_attr__( 'Hide', 'wpbfpremium' ),
			),
		)
	);

	// Menu Item Amount.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_amount',
			'label'    => esc_attr__( 'Amount', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'show',
			'priority' => 21,
			'multiple' => 1,
			'choices'  => array(
				'show' => esc_attr__( 'Show', 'wpbfpremium' ),
				'hide' => esc_attr__( 'Hide', 'wpbfpremium' ),
			),
		)
	);

	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'custom',
			'settings' => 'separator-11214',
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
			'priority' => 22,
		)
	);

	// Menu Item Dropdown.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_menu_item_dropdown',
			'label'    => esc_attr__( 'Cart Dropdown', 'wpbfpremium' ),
			'section'  => 'wpbf_woocommerce_menu_item_options',
			'default'  => 'show',
			'priority' => 23,
			'multiple' => 1,
			'choices'  => array(
				'show' => esc_attr__( 'Enable', 'wpbfpremium' ),
				'hide' => esc_attr__( 'Disable', 'wpbfpremium' ),
			),
		)
	);

	// Display On Add to Cart.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'toggle',
			'settings'        => 'woocommerce_menu_item_dropdown_popup',
			'label'           => esc_attr__( 'Cart Popup', 'wpbfpremium' ),
			'description'     => esc_attr__( 'Displays the cart dropdown for a short period of time after a product was added to the cart', 'wpbfpremium' ),
			'section'         => 'wpbf_woocommerce_menu_item_options',
			'default'         => false,
			'priority'        => 23,
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

	// Cart Button.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'select',
			'settings'        => 'woocommerce_menu_item_dropdown_cart_button',
			'label'           => esc_attr__( 'Cart Button', 'wpbfpremium' ),
			'section'         => 'wpbf_woocommerce_menu_item_options',
			'default'         => 'show',
			'priority'        => 24,
			'multiple'        => 1,
			'choices'         => array(
				'show' => esc_attr__( 'Show', 'wpbfpremium' ),
				'hide' => esc_attr__( 'Hide', 'wpbfpremium' ),
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

	// Checkout Button.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'select',
			'settings'        => 'woocommerce_menu_item_dropdown_checkout_button',
			'label'           => esc_attr__( 'Checkout Button', 'wpbfpremium' ),
			'section'         => 'wpbf_woocommerce_menu_item_options',
			'default'         => 'show',
			'priority'        => 25,
			'multiple'        => 1,
			'choices'         => array(
				'show' => esc_attr__( 'Show', 'wpbfpremium' ),
				'hide' => esc_attr__( 'Hide', 'wpbfpremium' ),
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

	/* Fields – Shop & Archive Pages (Loop) */

	// Image Flip.
	Kirki::add_field(
		'wpbf',
		array(
			'type'        => 'select',
			'settings'    => 'woocommerce_loop_image_flip',
			'label'       => esc_attr__( 'Image Flip', 'wpbfpremium' ),
			'description' => esc_attr__( 'Displays the first image of your product gallery (if available) when hovering over the product thumbnail.', 'wpbfpremium' ),
			'section'     => 'woocommerce_product_catalog',
			'default'     => 'enabled',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'enabled'  => esc_attr__( 'Enabled', 'wpbfpremium' ),
				'disabled' => esc_attr__( 'Disabled', 'wpbfpremium' ),
			),
		)
	);

	// Infinite Scroll.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'select',
			'settings'        => 'woocommerce_loop_infinite_scroll',
			'label'           => esc_attr__( 'Infinite Scroll', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'disabled',
			'priority'        => 25,
			'multiple'        => 1,
			'choices'     => array(
				'disabled' => esc_attr__( 'Disabled', 'wpbfpremium' ),
				'enabled'  => esc_attr__( 'Enabled', 'wpbfpremium' ),
				// 'button'   => esc_attr__( 'Load More Button', 'wpbfpremium' )
			),
		)
	);

	// Separator.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'custom',
			'settings' => 'separator-48556239',
			'section'  => 'woocommerce_product_catalog',
			'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
			'priority' => 25,
		)
	);

	// Separator.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'custom',
			'settings' => 'separator-83905',
			'section'  => 'woocommerce_product_catalog',
			'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
			'priority' => 30,
		)
	);

	// Quick View.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_loop_quick_view',
			'label'    => esc_attr__( 'Quick View', 'wpbfpremium' ),
			'section'  => 'woocommerce_product_catalog',
			'default'  => 'enabled',
			'priority' => 30,
			'multiple' => 1,
			'choices'  => array(
				'enabled'  => esc_attr__( 'Enabled', 'wpbfpremium' ),
				'disabled' => esc_attr__( 'Disabled', 'wpbfpremium' ),
			),
		)
	);

	// Quick View Font Size.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'dimension',
			'label'           => esc_attr__( 'Font Size', 'wpbfpremium' ),
			'settings'        => 'woocommerce_loop_quick_view_font_size',
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'priority'        => 30,
			'default'         => '14px',
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_quick_view',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Quick View Font Color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_quick_view_font_color',
			'label'           => esc_attr__( 'Font Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => '#ffffff',
			'priority'        => 30,
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

	// Quick View Background Color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_quick_view_background_color',
			'label'           => esc_attr__( 'Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => 'rgba(0,0,0,.7)',
			'priority'        => 30,
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

	// Quick View Overlay Color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_quick_view_overlay_color',
			'label'           => esc_attr__( 'Overlay Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'rgba(0,0,0,.8)',
			'priority'        => 30,
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
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'custom',
			'settings' => 'separator-10304214',
			'section'  => 'woocommerce_product_catalog',
			'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
			'priority' => 30,
		)
	);

	// Off Canvas Sidebar.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_loop_off_canvas_sidebar',
			'label'    => esc_attr__( 'Off Canvas Sidebar', 'wpbfpremium' ),
			'section'  => 'woocommerce_product_catalog',
			'default'  => 'disabled',
			'priority' => 30,
			'multiple' => 1,
			'choices'  => array(
				'enabled'  => esc_attr__( 'Enabled', 'wpbfpremium' ),
				'disabled' => esc_attr__( 'Disabled', 'wpbfpremium' ),
			),
		)
	);

	// Off Canvas Sidebar Icon.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'select',
			'settings' => 'woocommerce_loop_off_canvas_sidebar_icon',
			'label'    => esc_attr__( 'Icon', 'wpbfpremium' ),
			'section'  => 'woocommerce_product_catalog',
			'default'  => 'search',
			'priority' => 30,
			'multiple' => 1,
			'choices'  => array(
				'search'    => esc_attr__( 'Search', 'wpbfpremium' ),
				'hamburger' => esc_attr__( 'Hamburger', 'wpbfpremium' ),
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

	// Off Canvas Sidebar Label.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'text',
			'settings' => 'woocommerce_loop_off_canvas_sidebar_label',
			'label'    => esc_attr__( 'Label', 'wpbfpremium' ),
			'section'  => 'woocommerce_product_catalog',
			'default'  => 'Filter',
			'priority' => 30,
			'active_callback' => array(
				array(
					'setting'  => 'woocommerce_loop_off_canvas_sidebar',
					'operator' => '!=',
					'value'    => 'disabled',
				),
			),
		)
	);

	// Off Canvas Sidebar Font Color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_font_color',
			'label'           => esc_attr__( 'Font Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => '#ffffff',
			'priority'        => 30,
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

	// Off Canvas Sidebar Background Color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_background_color',
			'label'           => esc_attr__( 'Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'transport'       => 'postMessage',
			'default'         => '',
			'priority'        => 30,
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

	// Off Canvas Sidebar Overlay Color.
	Kirki::add_field(
		'wpbf',
		array(
			'type'            => 'color',
			'settings'        => 'woocommerce_loop_off_canvas_sidebar_overlay_color',
			'label'           => esc_attr__( 'Overlay Background Color', 'wpbfpremium' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => 'rgba(0,0,0,.2)',
			'priority'        => 30,
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

	/* Fields – Checkout Page */

	// Distraction Free.
	Kirki::add_field(
		'wpbf',
		array(
			'type'     => 'toggle',
			'settings' => 'woocommerce_distraction_free_checkout',
			'label'    => esc_attr__( 'Distraction Free Checkout', 'wpbfpremium' ),
			'section'  => 'woocommerce_checkout',
			'default'  => 0,
			'priority' => 1,
			'multiple' => 1,
		)
	);

}
add_action( 'after_setup_theme', 'wpbf_kirki_premium_woocommerce' );
