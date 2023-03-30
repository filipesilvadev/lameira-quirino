<?php
/**
 * Footer customizer settings.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/* Fields - Widget footer */

// Widgets.
Kirki::add_field( 'wpbf', array(
	'type'            => 'radio_buttonset',
	'settings'        => 'footer_widgets',
	'label'           => __( 'Footer Widgets', 'wpbfpremium' ),
	'section'         => 'wpbf_widget_footer_options',
	'default'         => 'disabled',
	'priority'        => 0,
	'multiple'        => 1,
	'choices'         => array(
		'disabled' => '0',
		'one'      => '1',
		'two'      => '2',
		'three'    => '3',
		'four'     => '4',
		'five'     => '5',
	),
	'partial_refresh' => array(
		'footer_widgets' => array(
			'selector'        => '.wpbf-widget-footer',
			'render_callback' => function () {
				return wpbf_construct_widget_footer();
			},
		),
	),
) );

// Width.
Kirki::add_field( 'wpbf', array(
	'type'            => 'dimension',
	'label'           => __( 'Footer Width', 'wpbfpremium' ),
	'description'     => __( 'Default: 1200px', 'wpbfpremium' ),
	'settings'        => 'footer_widgets_width',
	'section'         => 'wpbf_widget_footer_options',
	'priority'        => 1,
	'transport'       => 'postMessage',
	'active_callback' => array(
		array(
			'setting'  => 'footer_widgets',
			'operator' => '!=',
			'value'    => 'disabled',
		),
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'footer_widgets_separator',
		'section'         => 'wpbf_widget_footer_options',
		'priority'        => 1,
		'active_callback' => [
			[
				'setting'  => 'footer_widgets',
				'operator' => '!=',
				'value'    => 'disabled',
			],
		],
	]
);

// Background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'footer_widgets_bg_color',
	'label'           => __( 'Background Color', 'wpbfpremium' ),
	'section'         => 'wpbf_widget_footer_options',
	'default'         => '#f5f5f7',
	'transport'       => 'postMessage',
	'priority'        => 1,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'footer_widgets',
			'operator' => '!=',
			'value'    => 'disabled',
		),
	),
) );

// Headline color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'footer_widgets_headline_color',
	'label'           => __( 'Headline Color', 'wpbfpremium' ),
	'section'         => 'wpbf_widget_footer_options',
	'transport'       => 'postMessage',
	'priority'        => 2,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'footer_widgets',
			'operator' => '!=',
			'value'    => 'disabled',
		),
	),
) );

// Font color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'footer_widgets_font_color',
	'label'           => __( 'Font Color', 'wpbfpremium' ),
	'section'         => 'wpbf_widget_footer_options',
	'transport'       => 'postMessage',
	'priority'        => 2,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'footer_widgets',
			'operator' => '!=',
			'value'    => 'disabled',
		),
	),
) );

// Accent color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'footer_widgets_accent_color',
	'label'           => __( 'Accent Color', 'wpbfpremium' ),
	'section'         => 'wpbf_widget_footer_options',
	'priority'        => 3,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'footer_widgets',
			'operator' => '!=',
			'value'    => 'disabled',
		),
	),
) );

// Accent color alt.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'footer_widgets_accent_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_widget_footer_options',
	'priority'        => 4,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'footer_widgets',
			'operator' => '!=',
			'value'    => 'disabled',
		),
	),
) );

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'            => 'input_slider',
	'label'           => __( 'Font Size', 'wpbfpremium' ),
	'settings'        => 'footer_widgets_font_size',
	'section'         => 'wpbf_widget_footer_options',
	'priority'        => 11,
	'default'         => '14px',
	'transport'       => 'postMessage',
	'active_callback' => array(
		array(
			'setting'  => 'footer_widgets',
			'operator' => '!=',
			'value'    => 'disabled',
		),
	),
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
) );

/* Fields - Footer */

// Sticky.
Kirki::add_field( 'wpbf', array(
	'type'            => 'toggle',
	'settings'        => 'footer_sticky',
	'label'           => __( 'Sticky Footer', 'wpbfpremium' ),
	'section'         => 'wpbf_footer_options',
	'default'         => 0,
	'priority'        => 0,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'page_boxed',
			'operator' => '!=',
			'value'    => true,
		),
		array(
			'setting'  => 'footer_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'footer_sticky_separator',
		'section'         => 'wpbf_footer_options',
		'priority'        => 0,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'page_boxed',
				'operator' => '!=',
				'value'    => true,
			],
			[
				'setting'  => 'footer_layout',
				'operator' => '!=',
				'value'    => 'none',
			],
		],
	]
);

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'footer_theme_author_separator',
		'section'         => 'wpbf_footer_options',
		'priority'        => 4,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'footer_layout',
				'operator' => '!=',
				'value'    => 'none',
			],
		],
	]
);

// Theme author.
Kirki::add_field( 'wpbf', array(
	'type'            => 'text',
	'settings'        => 'footer_theme_author_name',
	'label'           => __( 'Theme Author', 'wpbfpremium' ),
	'section'         => 'wpbf_footer_options',
	'priority'        => 4,
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'footer_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
	'partial_refresh' => array(
		'footer_theme_author_name' => array(
			'container_inclusive' => true,
			'selector'            => '#footer',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/footer' );
			},
		),
	),
) );

// Theme author URL.
Kirki::add_field( 'wpbf', array(
	'type'            => 'text',
	'settings'        => 'footer_theme_author_url',
	'label'           => __( 'URL', 'wpbfpremium' ),
	'section'         => 'wpbf_footer_options',
	'priority'        => 4,
	'transport'       => 'postMessage',
	'tab'             => 'general',
	'active_callback' => array(
		array(
			'setting'  => 'footer_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'footer_theme_author_url_separator',
		'section'         => 'wpbf_footer_options',
		'priority'        => 4,
		'tab'             => 'general',
		'active_callback' => [
			[
				'setting'  => 'footer_layout',
				'operator' => '!=',
				'value'    => 'none',
			],
		],
	]
);

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'footer_custom_separator',
		'section'  => 'wpbf_footer_options',
		'priority' => 20,
		'tab'      => 'general',
	]
);

// Custom footer.
Kirki::add_field( 'wpbf', array(
	'type'        => 'code',
	'label'       => __( 'Custom Footer', 'wpbfpremium' ),
	'description' => __( 'Add a saved Beaver Builder or Elementor template to the footer area of your website. <br><br><strong>Example:</strong><br>[elementor-template id="xxx"]<br>[fl_builder_insert_layout id="xxx"]', 'wpbfpremium' ),
	'settings'    => 'footer_custom',
	'section'     => 'wpbf_footer_options',
	'priority'    => 20,
	'tab'         => 'general',
	'choices'     => array(
		'language' => 'html',
	),
) );
