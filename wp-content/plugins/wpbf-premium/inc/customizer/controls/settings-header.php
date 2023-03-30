<?php
/**
 * Header customizer settings.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/* Sections */

// Transparent header.
Kirki::add_section( 'wpbf_transparent_header_options', array(
	'title'    => __( 'Transparent Header', 'wpbfpremium' ),
	'panel'    => 'header_panel',
	'priority' => 350,
) );

// Sticky navigation.
new \Kirki\Section(
	'wpbf_sticky_menu_options',
	[
		'title'    => __( 'Sticky Navigation', 'wpbfpremium' ),
		'panel'    => 'header_panel',
		'priority' => 400,
		'tabs'     => [
			'general' => [
				'label' => esc_html__( 'General', 'wpbfpremium' ),
			],
			'design'  => [
				'label' => esc_html__( 'Design', 'wpbfpremium' ),
			],
		],
	]
);

// Navigation hover effects.
Kirki::add_section( 'wpbf_menu_effect_options', array(
	'title'    => __( 'Navigation Hover Effects', 'wpbfpremium' ),
	'panel'    => 'header_panel',
	'priority' => 500,
) );

// Call to Action button.
new \Kirki\Section(
	'wpbf_cta_button_options',
	[
		'title'    => __( 'Call to Action Button', 'wpbfpremium' ),
		'panel'    => 'header_panel',
		'priority' => 600,
		'tabs'     => [
			'general' => [
				'label' => esc_html__( 'General', 'wpbfpremium' ),
			],
			'design'  => [
				'label' => esc_html__( 'Design', 'wpbfpremium' ),
			],
		],
	]
);

/* Fields - Transparent header */

// Logo.
Kirki::add_field( 'wpbf', array(
	'type'            => 'image',
	'settings'        => 'menu_transparent_logo',
	'label'           => __( 'Logo', 'wpbfpremium' ),
	'section'         => 'wpbf_transparent_header_options',
	'priority'        => 0,
	'active_callback' => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '!=',
			'value'    => '',
		),
	),
	'partial_refresh' => array(
		'menu_transparent_logo' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Width.
Kirki::add_field( 'wpbf', array(
	'type'        => 'dimension',
	'label'       => __( 'Transparent Header Width', 'wpbfpremium' ),
	'description' => __( 'Default: 1200px', 'wpbfpremium' ),
	'settings'    => 'menu_transparent_width',
	'section'     => 'wpbf_transparent_header_options',
	'transport'   => 'postMessage',
	'priority'    => 0,
	'tab'         => 'general',
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'menu_transparent_logo_separator',
		'section'  => 'wpbf_transparent_header_options',
		'priority' => 0,
	]
);

// Background color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'menu_transparent_background_color',
	'label'     => __( 'Background Color', 'wpbfpremium' ),
	'section'   => 'wpbf_transparent_header_options',
	'priority'  => 1,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Font color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'menu_transparent_font_color',
	'label'     => __( 'Font Color', 'wpbfpremium' ),
	'section'   => 'wpbf_transparent_header_options',
	'priority'  => 2,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Font color alt.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'menu_transparent_font_color_alt',
	'label'     => __( 'Hover', 'wpbfpremium' ),
	'section'   => 'wpbf_transparent_header_options',
	'priority'  => 3,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Logo color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_transparent_logo_color',
	'label'           => __( 'Logo Color', 'wpbfpremium' ),
	'section'         => 'wpbf_transparent_header_options',
	'priority'        => 3,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '==',
			'value'    => '',
		),
	),
) );

// Logo color alt.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_transparent_logo_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_transparent_header_options',
	'priority'        => 3,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '==',
			'value'    => '',
		),
	),
) );

// Tagline color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_transparent_tagline_color',
	'label'           => __( 'Tagline Color', 'wpbfpremium' ),
	'section'         => 'wpbf_transparent_header_options',
	'priority'        => 3,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '==',
			'value'    => '',
		),
		array(
			'setting'  => 'menu_logo_description',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Off canvas headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'menu_transparent_off_canvas_headline',
		'label'           => esc_html__( 'Off Canvas Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_transparent_header_options',
		'priority'        => 4,
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => 'in',
				'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			],
		],
	]
);

// Full screen headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'menu_transparent_full_screen_headline',
		'label'           => esc_html__( 'Full Screen Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_transparent_header_options',
		'priority'        => 5,
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => '==',
				'value'    => 'menu-full-screen',
			],
		],
	]
);

// Off canvas hamburger color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_transparent_hamburger_color',
	'label'           => __( 'Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_transparent_header_options',
	'priority'        => 6,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
		),
	),
) );

// Mobile menu headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings' => 'menu_transparent_mobile_headline',
		'label'    => esc_html__( 'Mobile Menu Settings', 'wpbfpremium' ),
		'section'  => 'wpbf_transparent_header_options',
		'priority' => 7,
	]
);

// Disable on mobile.
Kirki::add_field( 'wpbf', array(
	'type'     => 'toggle',
	'settings' => 'menu_transparent_mobile_disabled',
	'label'    => __( 'Disable Transparent Header', 'wpbfpremium' ),
	'section'  => 'wpbf_transparent_header_options',
	'default'  => 0,
	'priority' => 8,
) );

// Mobile menu icon color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_transparent_hamburger_color_mobile',
	'label'           => __( 'Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_transparent_header_options',
	'priority'        => 9,
	'transport'       => 'postMessage',
	'active_callback' => array(
		array(
			'setting'  => 'mobile_menu_options',
			'operator' => '!=',
			'value'    => 'menu-mobile-default',
		),
	),
) );

// Mobile menu hamburger background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_transparent_hamburger_bg_color_mobile',
	'label'           => __( 'Hamburger Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_transparent_header_options',
	'priority'        => 10,
	'transport'       => 'postMessage',
	'active_callback' => array(
		array(
			'setting'  => 'mobile_menu_options',
			'operator' => '!=',
			'value'    => 'menu-mobile-default',
		),
		array(
			'setting'  => 'mobile_menu_hamburger_bg_color',
			'operator' => '!=',
			'value'    => '',
		),
	),
) );

/* Fields - Sticky navigation */

$i = 0;

// Toggle.
new \Kirki\Field\Toggle(
	[
		'settings'        => 'menu_sticky',
		'label'           => esc_html__( 'Sticky Navigation', 'wpbfpremium' ),
		'section'         => 'wpbf_sticky_menu_options',
		'default'         => 0,
		'priority'        => $i++,
		'tab'             => 'general',
		'partial_refresh' => [
			'menu_sticky' => [
				'container_inclusive' => true,
				'selector'            => '#header',
				'render_callback'     => function () {
					return get_template_part( 'inc/template-parts/header' );
				},
			],
		],
	]
);

// Divider.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'menu_active_toggle_separator',
		'section'         => 'wpbf_sticky_menu_options',
		'priority'        => $i++,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Logo.
Kirki::add_field( 'wpbf', array(
	'type'            => 'image',
	'settings'        => 'menu_active_logo',
	'label'           => __( 'Logo', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '!=',
			'value'    => '',
		),
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
	'partial_refresh' => array(
		'menu_active_logo' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Logo size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Logo Width', 'wpbfpremium' ),
	'section'           => 'wpbf_sticky_menu_options',
	'settings'          => 'menu_active_logo_size',
	'priority'          => $i++,
	'transport'         => 'postMessage',
	'tab'               => 'general',
	'choices'           => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 1,
	),
	'active_callback'   => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '!=',
			'value'    => '',
		),
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

// Divider.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'menu_active_logo_separator',
		'section'         => 'wpbf_sticky_menu_options',
		'priority'        => $i++,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => '',
			],
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Hide logo.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'menu_active_hide_logo',
	'label'           => __( 'Hide Logo', 'wpbfpremium' ),
	'description'     => __( 'Hide logo from Sticky Navigation.', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'default'         => 0,
	'priority'        => $i++,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-stacked', 'menu-stacked-advanced', 'menu-centered' ),
		),
	),
) );

// Width.
Kirki::add_field( 'wpbf', array(
	'type'            => 'dimension',
	'label'           => __( 'Sticky Navigation Width', 'wpbfpremium' ),
	'description'     => __( 'Default: 1200px', 'wpbfpremium' ),
	'settings'        => 'menu_active_width',
	'section'         => 'wpbf_sticky_menu_options',
	'transport'       => 'postMessage',
	'priority'        => $i++,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Height.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'label'           => __( 'Menu Height', 'wpbfpremium' ),
	'settings'        => 'menu_active_height',
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'default'         => 20,
	'transport'       => 'postMessage',
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
	'choices'         => array(
		'min'  => 5,
		'max'  => 80,
		'step' => 1,
	),
) );

// Box shadow.
new \Kirki\Field\Toggle(
	[
		'settings'        => 'menu_active_box_shadow',
		'label'           => esc_html__( 'Box Shadow', 'wpbfpremium' ),
		'section'         => 'wpbf_sticky_menu_options',
		'default'         => 0,
		'priority'        => $i++,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Box shadow blur.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'menu_active_box_shadow_blur',
	'label'           => __( 'Blur', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'default'         => 5,
	'tab'             => 'design',
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'menu_active_box_shadow',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

// Box shadow color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_box_shadow_color',
	'label'           => __( 'Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'default'         => 'rgba(0,0,0,.15)',
	'priority'        => $i++,
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'menu_active_box_shadow',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

// Divider.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'menu_active_box_shadow_divider',
		'section'         => 'wpbf_sticky_menu_options',
		'priority'        => $i++,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Stacked background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_stacked_bg_color',
	'label'           => __( 'Logo Area Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'default'         => '#ffffff',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'menu_position',
			'operator' => '==',
			'value'    => 'menu-stacked-advanced',
		),
		array(
			'setting'  => 'menu_active_hide_logo',
			'operator' => '==',
			'value'    => false,
		),
	),
	'choices'         => array(
		'alpha' => true,
	),
) );

// Background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_bg_color',
	'label'           => __( 'Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'default'         => '#f5f5f7',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_font_color',
	'label'           => __( 'Font Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color alt.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_font_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Logo color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_logo_color',
	'label'           => __( 'Logo Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '==',
			'value'    => '',
		),
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Logo color alt.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_logo_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'custom_logo',
			'operator' => '==',
			'value'    => '',
		),
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Tagline color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_tagline_color',
	'label'           => __( 'Tagline Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'custom_logo',
			'operator' => '==',
			'value'    => '',
		),
		array(
			'setting'  => 'menu_logo_description',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Divider.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'menu_active_animation_separator',
		'section'         => 'wpbf_sticky_menu_options',
		'priority'        => $i++,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Delay.
Kirki::add_field( 'wpbf', array(
	'type'            => 'dimension',
	'label'           => __( 'Delay', 'wpbfpremium' ),
	'settings'        => 'menu_active_delay',
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'default'         => '',
	'description'     => __( 'Set a delay after the sticky navigation should appear. Default: 300px', 'wpbfpremium' ),
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
	'partial_refresh' => array(
		'menu_active_delay' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Animation.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'menu_active_animation',
	'label'           => __( 'Animation', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'default'         => 'none',
	'priority'        => $i++,
	'tab'             => 'general',
	'choices'         => array(
		'none'   => __( 'None', 'wpbfpremium' ),
		'fade'   => __( 'Fade In', 'wpbfpremium' ),
		'slide'  => __( 'Slide Down', 'wpbfpremium' ),
		'scroll' => __( 'Hide on Scroll', 'wpbfpremium' ),
		'shrink' => __( 'Shrink', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
	'partial_refresh' => array(
		'menu_active_animation' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Animation duration.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'label'           => __( 'Duration', 'wpbfpremium' ),
	'settings'        => 'menu_active_animation_duration',
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'default'         => 200,
	'tab'             => 'general',
	'choices'         => array(
		'min'  => 50,
		'max'  => 1000,
		'step' => 10,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'menu_active_animation',
			'operator' => '!==',
			'value'    => 'none',
		),
		array(
			'setting'  => 'menu_active_animation',
			'operator' => '!==',
			'value'    => 'scroll',
		),
		array(
			'setting'  => 'menu_active_animation',
			'operator' => '!==',
			'value'    => 'shrink',
		),

	),
	'partial_refresh' => array(
		'menu_active_animation_duration' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Off canvas headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'active_off_canvas_headline',
		'label'           => esc_html__( 'Off Canvas Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_sticky_menu_options',
		'priority'        => $i++,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => 'menu_position',
				'operator' => 'in',
				'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			],
		],
	]
);

// Full screen headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'active_full_screen_headline',
		'label'           => esc_html__( 'Full Screen Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_sticky_menu_options',
		'priority'        => $i++,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => 'menu_position',
				'operator' => '==',
				'value'    => 'menu-full-screen',
			],
		],
	]
);

// Off canvas hamburger color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_active_off_canvas_hamburger_color',
	'label'           => __( 'Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'tab'             => 'design',
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
		),
	),
) );

// Mobile menu headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'active_mobile_menu_headline',
		'label'           => esc_html__( 'Mobile Menu Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_sticky_menu_options',
		'priority'        => $i++,
		'active_callback' => [
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => 'mobile_menu_options',
				'operator' => 'in',
				'value'    => array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' ),
			],
		],
	]
);

// Disable on mobile.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'menu_active_mobile_disabled',
	'label'           => __( 'Disable Sticky Navigation', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'default'         => 0,
	'priority'        => $i++,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Mobile menu icon color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'mobile_menu_active_hamburger_color',
	'label'           => __( 'Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'mobile_menu_options',
			'operator' => 'in',
			'value'    => array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' ),
		),
	),
) );

// Mobile menu hamburger background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'mobile_menu_active_hamburger_bg_color',
	'label'           => __( 'Hamburger Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_sticky_menu_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'mobile_menu_options',
			'operator' => 'in',
			'value'    => array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' ),
		),
		array(
			'setting'  => 'mobile_menu_hamburger_bg_color',
			'operator' => '!=',
			'value'    => '',
		),
	),
) );

/* Fields - Navigation hover effects */

// Effect.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'menu_effect',
	'label'           => __( 'Hover Effect', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_effect_options',
	'default'         => 'none',
	'priority'        => 1,
	'multiple'        => 1,
	'choices'         => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'underlined' => __( 'Underline', 'wpbfpremium' ),
		'boxed'      => __( 'Box', 'wpbfpremium' ),
		'modern'     => __( 'Modern', 'wpbfpremium' ),
	),
	'partial_refresh' => array(
		'menu_effect' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Animation.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'menu_effect_animation',
	'label'           => __( 'Animation', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_effect_options',
	'default'         => 'fade',
	'priority'        => 1,
	'multiple'        => 1,
	'choices'         => array(
		'fade'  => __( 'Fade', 'wpbfpremium' ),
		'slide' => __( 'Slide', 'wpbfpremium' ),
		'grow'  => __( 'Grow', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_effect',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => 'menu_effect',
			'operator' => '!=',
			'value'    => 'modern',
		),
	),
	'partial_refresh' => array(
		'menu_effect_animation' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Alignment.
Kirki::add_field( 'wpbf', array(
	'type'            => 'radio-image',
	'settings'        => 'menu_effect_alignment',
	'label'           => __( 'Alignment', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_effect_options',
	'default'         => 'center',
	'priority'        => 2,
	'choices'         => array(
		'left'   => WPBF_PREMIUM_URI . '/inc/customizer/img/align-left.jpg',
		'center' => WPBF_PREMIUM_URI . '/inc/customizer/img/align-center.jpg',
		'right'  => WPBF_PREMIUM_URI . '/inc/customizer/img/align-right.jpg',
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_effect_animation',
			'operator' => '==',
			'value'    => 'slide',
		),
		array(
			'setting'  => 'menu_effect',
			'operator' => '!=',
			'value'    => 'modern',
		),
		array(
			'setting'  => 'menu_effect',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
	'partial_refresh' => array(
		'menu_effect_alignment' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Size (underlined).
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'menu_effect_underlined_size',
	'label'           => __( 'Size', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_effect_options',
	'priority'        => 3,
	'default'         => 2,
	'choices'         => array(
		'min'  => 1,
		'max'  => 5,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_effect',
			'operator' => '==',
			'value'    => 'underlined',
		),
	),
) );

// Border radius (boxed).
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'menu_effect_boxed_radius',
	'label'           => __( 'Border Radius', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_effect_options',
	'priority'        => 4,
	'default'         => 0,
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_effect',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
) );

// Color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_effect_color',
	'label'           => __( 'Color', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_effect_options',
	'priority'        => 5,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_effect',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

/* Fields - Call to Action button */

$i = 0;

// Toggle.
new \Kirki\Field\Toggle(
	[
		'settings'        => 'cta_button',
		'label'           => esc_html__( 'Call to Action Button', 'wpbfpremium' ),
		'tooltip'         => esc_html__( 'Add a Call to Action button to your main header navigation.', 'wpbfpremium' ),
		'section'         => 'wpbf_cta_button_options',
		'default'         => 0,
		'priority'        => $i++,
		'tab'             => 'general',
		'partial_refresh' => [
			'cta_button' => [
				'container_inclusive' => true,
				'selector'            => '#header',
				'render_callback'     => function () {
					return get_template_part( 'inc/template-parts/header' );
				},
			],
		],
	]
);

// Mobile toggle.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'cta_button_mobile',
	'label'           => __( 'Enable on Mobile', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'default'         => 0,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
	'partial_refresh' => array(
		'cta_button_mobile' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'cta_button_divider',
		'section'         => 'wpbf_cta_button_options',
		'priority'        => $i++,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'cta_button',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Button text.
Kirki::add_field( 'wpbf', array(
	'type'            => 'text',
	'settings'        => 'cta_button_text',
	'label'           => __( 'Button Text', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Button link.
Kirki::add_field( 'wpbf', array(
	'type'            => 'link',
	'settings'        => 'cta_button_url',
	'label'           => __( 'URL', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Target.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'cta_button_target',
	'label'           => __( 'Open in a new Tab', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'default'         => 0,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Border radius.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'cta_button_border_radius',
	'label'           => __( 'Border Radius', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'default'         => 0,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_background_color',
	'label'           => __( 'Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Background color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_background_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_font_color',
	'label'           => __( 'Font Color', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_font_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Transparent header headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'cta_button_transparent_header_headline',
		'label'           => esc_html__( 'Transparent Header', 'wpbfpremium' ),
		'section'         => 'wpbf_cta_button_options',
		'priority'        => $i++,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'cta_button',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_transparent_background_color',
	'label'           => __( 'Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Background color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_transparent_background_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_transparent_font_color',
	'label'           => __( 'Font Color', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_transparent_font_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Sticky navigation headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'cta_button_sticky_header_headline',
		'label'           => esc_html__( 'Sticky Navigation', 'wpbfpremium' ),
		'section'         => 'wpbf_cta_button_options',
		'priority'        => $i++,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'cta_button',
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// Background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_sticky_background_color',
	'label'           => __( 'Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Background color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_sticky_background_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_sticky_font_color',
	'label'           => __( 'Font Color', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Font color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'cta_button_sticky_font_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_cta_button_options',
	'priority'        => $i++,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'cta_button',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

/* Fields - Pre header */

// Toggle.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'pre_header_sticky',
	'label'           => __( 'Sticky Pre Header', 'wpbfpremium' ),
	'section'         => 'wpbf_pre_header_options',
	'default'         => 0,
	'priority'        => 0,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'pre_header_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => 'menu_sticky',
			'operator' => '==',
			'value'    => true,
		),
	),
	'partial_refresh' => array(
		'pre_header_sticky' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'pre_header_sticky_separator',
		'section'         => 'wpbf_pre_header_options',
		'priority'        => 0,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'pre_header_layout',
				'operator' => '!=',
				'value'    => 'none',
			],
			[
				'setting'  => 'menu_sticky',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

/* Fields - Stacked navigation (advanced) */

// Headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'stacked_advanced_headline',
		'label'           => esc_html__( 'Stacked (Advanced) Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_menu_options',
		'priority'        => 100,
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => '==',
				'value'    => 'menu-stacked-advanced',
			],
		],
	]
);

// Alignment.
Kirki::add_field( 'wpbf', array(
	'type'            => 'radio-image',
	'settings'        => 'menu_alignment',
	'label'           => __( 'Menu Alignment', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'default'         => 'left',
	'priority'        => 110,
	'multiple'        => 1,
	'tab'             => 'general',
	'choices'         => array(
		'left'   => WPBF_PREMIUM_URI . '/inc/customizer/img/align-left.jpg',
		'center' => WPBF_PREMIUM_URI . '/inc/customizer/img/align-center.jpg',
		'right'  => WPBF_PREMIUM_URI . '/inc/customizer/img/align-right.jpg',
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => '==',
			'value'    => 'menu-stacked-advanced',
		),
	),
	'partial_refresh' => array(
		'menu_alignment' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Logo height.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'label'           => __( 'Logo Area Height', 'wpbfpremium' ),
	'settings'        => 'menu_stacked_logo_height',
	'section'         => 'wpbf_menu_options',
	'priority'        => 120,
	'default'         => 20,
	'transport'       => 'postMessage',
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => '==',
			'value'    => 'menu-stacked-advanced',
		),
	),
	'choices'         => array(
		'min'  => 5,
		'max'  => 80,
		'step' => 1,
	),
) );

// Editor.
Kirki::add_field( 'wpbf', array(
	'type'            => 'editor',
	'settings'        => 'menu_stacked_wysiwyg',
	'label'           => __( 'Content beside Logo', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'default'         => '',
	'priority'        => 130,
	'transport'       => 'postMessage',
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => '==',
			'value'    => 'menu-stacked-advanced',
		),
		array(
			'setting'  => 'menu_alignment',
			'operator' => '!=',
			'value'    => 'center',
		),
	),
) );

// Background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_stacked_bg_color',
	'label'           => __( 'Logo Area Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'default'         => '#ffffff',
	'priority'        => 140,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => '==',
			'value'    => 'menu-stacked-advanced',
		),
	),
	'choices'         => array(
		'alpha' => true,
	),
) );

/* Fields - Off canvas */

// Off canvas headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'off_canvas_headline',
		'label'           => esc_html__( 'Off Canvas Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_menu_options',
		'priority'        => 200,
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => 'in',
				'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			],
		],
	]
);

// Full screen headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'full_screen_headline',
		'label'           => esc_html__( 'Full Screen Settings', 'wpbfpremium' ),
		'section'         => 'wpbf_menu_options',
		'priority'        => 200,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => '==',
				'value'    => 'menu-full-screen',
			],
		],
	]
);

// Off canvas hamburger color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_off_canvas_hamburger_color',
	'label'           => __( 'Hamburger Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'default'         => '#6d7680',
	'priority'        => 210,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
		),
	),
) );

// Off canvas hamburger size.
Kirki::add_field( 'wpbf', array(
	'type'            => 'input_slider',
	'label'           => __( 'Hamburger Icon Size', 'wpbfpremium' ),
	'settings'        => 'menu_off_canvas_hamburger_size',
	'section'         => 'wpbf_menu_options',
	'priority'        => 220,
	'default'         => '18px',
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
		),
	),
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'menu_off_canvas_hamburger_size_separator',
		'section'         => 'wpbf_menu_options',
		'priority'        => 230,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => 'in',
				'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
			],
		],
	]
);

// Push menu.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'menu_off_canvas_push',
	'label'           => __( 'Push Menu', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'priority'        => 240,
	'transport'       => 'postMessage',
	'default'         => 0,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
		),
	),
) );

// Off canvas background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_off_canvas_bg_color',
	'label'           => __( 'Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'default'         => '#ffffff',
	'priority'        => 250,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
		),
	),
) );

// Off canvas submenu arrow color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_off_canvas_submenu_arrow_color',
	'label'           => __( 'Sub Menu Arrow Color', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'priority'        => 260,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
		),
	),
) );

// Menu width.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'label'           => __( 'Menu Width', 'wpbfpremium' ),
	'settings'        => 'menu_off_canvas_width',
	'section'         => 'wpbf_menu_options',
	'priority'        => 270,
	'default'         => 400,
	'transport'       => 'postMessage',
	'tab'             => 'general',
	'choices'         => array(
		'min'  => 300,
		'max'  => 500,
		'step' => 10,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
		),
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'menu_overlay_separator',
		'section'         => 'wpbf_menu_options',
		'priority'        => 280,
		'tab'             => 'design',
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => 'in',
				'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			],
		],
	]
);

// Off canvas overlay.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'menu_overlay',
	'label'           => __( 'Overlay', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'priority'        => 290,
	'default'         => 0,
	'tab'             => 'design',
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
		),
	),
) );

// Off canvas overlay color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'menu_overlay_color',
	'label'           => __( 'Overlay Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_menu_options',
	'default'         => 'rgba(0,0,0,.5)',
	'priority'        => 300,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => 'in',
			'value'    => array( 'menu-off-canvas', 'menu-off-canvas-left' ),
		),
		array(
			'setting'  => 'menu_overlay',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

/* Fields - Custom menu */

if ( is_plugin_active( 'bb-plugin/fl-builder.php' ) || is_plugin_active( 'elementor-pro/elementor-pro.php' ) ) {

	// Separator.
	new \Kirki\Pro\Field\Divider(
		[
			'settings' => 'menu_custom_separator',
			'section'  => 'wpbf_menu_options',
			'tab'      => 'general',
			'priority' => 999998,
		]
	);

	// Custom menu.
	Kirki::add_field( 'wpbf', array(
		'type'        => 'code',
		'label'       => __( 'Custom Menu', 'wpbfpremium' ),
		'description' => __( 'Replace the default menu with a saved Beaver Builder or Elementor template. <br><br><strong>Example:</strong><br>[elementor-template id="xxx"]<br>[fl_builder_insert_layout id="xxx"]', 'wpbfpremium' ), //esc_html maybe
		'settings'    => 'menu_custom',
		'section'     => 'wpbf_menu_options',
		'priority'    => 999999,
		'tab'         => 'general',
		'choices'     => array(
			'language' => 'html',
		),
	) );

}

/* Fields - Submenu */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'sub_menu_animation_separator',
		'section'         => 'wpbf_sub_menu_options',
		'priority'        => 20,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'menu_position',
				'operator' => '!=',
				'value'    => 'menu-off-canvas',
			],
			[
				'setting'  => 'menu_position',
				'operator' => '!=',
				'value'    => 'menu-off-canvas-left',
			],
			[
				'setting'  => 'menu_position',
				'operator' => '!=',
				'value'    => 'menu-full-screen',
			],
		],
	]
);

// Animation.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'sub_menu_animation',
	'label'           => __( 'Sub Menu Animation', 'wpbfpremium' ),
	'section'         => 'wpbf_sub_menu_options',
	'default'         => 'fade',
	'priority'        => 21,
	'multiple'        => 1,
	'tab'             => 'general',
	'choices'         => array(
		'fade'     => __( 'Fade', 'wpbfpremium' ),
		'down'     => __( 'Down', 'wpbfpremium' ),
		'up'       => __( 'Up', 'wpbfpremium' ),
		'zoom-in'  => __( 'Zoom In', 'wpbfpremium' ),
		'zoom-out' => __( 'Zoom Out', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => '!=',
			'value'    => 'menu-off-canvas',
		),
		array(
			'setting'  => 'menu_position',
			'operator' => '!=',
			'value'    => 'menu-off-canvas-left',
		),
		array(
			'setting'  => 'menu_position',
			'operator' => '!=',
			'value'    => 'menu-full-screen',
		),
	),
	'partial_refresh' => array(
		'sub_menu_animation' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Animation duration.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'label'           => __( 'Duration', 'wpbfpremium' ),
	'settings'        => 'sub_menu_animation_duration',
	'section'         => 'wpbf_sub_menu_options',
	'priority'        => 22,
	'default'         => 250,
	'tab'             => 'general',
	'choices'         => array(
		'min'  => 50,
		'max'  => 1000,
		'step' => 10,
	),
	'active_callback' => array(
		array(
			'setting'  => 'menu_position',
			'operator' => '!=',
			'value'    => 'menu-off-canvas',
		),
		array(
			'setting'  => 'menu_position',
			'operator' => '!=',
			'value'    => 'menu-off-canvas-left',
		),
		array(
			'setting'  => 'menu_position',
			'operator' => '!=',
			'value'    => 'menu-full-screen',
		),
	),
	'partial_refresh' => array(
		'sub_menu_animation_duration' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

/* Fields - Mobile menu */

// Separator.
new \Kirki\Pro\Field\Headline(
	[
		'settings'        => 'mobile_menu_overlay_separator',
		'section'         => 'wpbf_mobile_menu_options',
		'label'           => __( 'Off Canvas Settings', 'wpbfpremium' ),
		'priority'        => 29,
		'active_callback' => [
			[
				'setting'  => 'mobile_menu_options',
				'operator' => '==',
				'value'    => 'menu-mobile-off-canvas',
			],
		],
	]
);

// Off canvas width.
Kirki::add_field( 'wpbf', array(
	'type'            => 'dimension',
	'label'           => __( 'Menu Width', 'wpbfpremium' ),
	'description'     => __( 'Default: 320px', 'wpbfpremium' ),
	'settings'        => 'mobile_menu_width',
	'section'         => 'wpbf_mobile_menu_options',
	'priority'        => 30,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'mobile_menu_options',
			'operator' => '==',
			'value'    => 'menu-mobile-off-canvas',
		),
	),
) );

// Off canvas overlay.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'mobile_menu_overlay',
	'label'           => __( 'Overlay', 'wpbfpremium' ),
	'section'         => 'wpbf_mobile_menu_options',
	'priority'        => 31,
	'default'         => 0,
	'tab'             => 'design',
	'active_callback' => array(
		array(
			'setting'  => 'mobile_menu_options',
			'operator' => '==',
			'value'    => 'menu-mobile-off-canvas',
		),
	),
) );

// Off canvas overlay color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'mobile_menu_overlay_color',
	'label'           => __( 'Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_mobile_menu_options',
	'default'         => 'rgba(0,0,0,.5)',
	'priority'        => 32,
	'transport'       => 'postMessage',
	'tab'             => 'design',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'mobile_menu_options',
			'operator' => '==',
			'value'    => 'menu-mobile-off-canvas',
		),
		array(
			'setting'  => 'mobile_menu_overlay',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
