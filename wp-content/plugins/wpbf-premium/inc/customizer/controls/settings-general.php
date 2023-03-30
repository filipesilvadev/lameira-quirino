<?php
/**
 * General customizer settings.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/* Sections */

// Theme colors.
Kirki::add_section( 'wpbf_global_options', array(
	'title'    => __( 'Theme Colors', 'wpbfpremium' ),
	'panel'    => 'layout_panel',
	'priority' => 250,
) );

// Social media icons.
new \Kirki\Section(
	'wpbf_social_icons_options',
	[
		'title'    => __( 'Social Media Icons', 'wpbfpremium' ),
		'panel'    => 'layout_panel',
		'priority' => 1100,
		'tabs'     => [
			'general' => [
				'label' => esc_html__( 'General', 'kirki-pro' ),
			],
			'design'  => [
				'label' => esc_html__( 'Design', 'kirki-pro' ),
			],
		],
	]
);

/* Fields - Theme colors */

// Headline.
new \Kirki\Pro\Field\Headline(
	[
		'settings'    => 'theme_colors_headline',
		// 'label'       => esc_html__( 'Theme Colors', 'wpbfpremium' ),
		'description' => esc_html__( 'These settings allow you to change the themes default color palette.', 'wpbfpremium' ),
		'section'     => 'wpbf_global_options',
		'priority'    => 0,
	]
);

// Base color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'base_color_alt_global',
	'label'     => __( 'Light Color', 'wpbfpremium' ),
	'tooltip'   => __( 'Used where a slighty darker color is necessary, compared to Light Color (Secondary).', 'wpbfpremium' ),
	'section'   => 'wpbf_global_options',
	'default'   => '#dedee5',
	'priority'  => 0,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Base color alt.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'base_color_global',
	'label'     => __( 'Light Color (Secondary)', 'wpbfpremium' ),
	'tooltip'   => __( 'Used mostly as a background color on many elements, such as sidebar widgets. ', 'wpbfpremium' ),
	'section'   => 'wpbf_global_options',
	'default'   => '#f5f5f7',
	'priority'  => 0,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'base_color_separator',
		'section'  => 'wpbf_global_options',
		'priority' => 0,
	]
);

// Brand color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'brand_color_global',
	'label'     => __( 'Dark Color', 'wpbfpremium' ),
	'tooltip'   => __( 'Used mostly for headlines or where high contrast is required. ', 'wpbfpremium' ),
	'section'   => 'wpbf_global_options',
	'default'   => '#3e4349',
	'priority'  => 0,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Brand color alt.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'brand_color_alt_global',
	'label'     => __( 'Dark Color (Secondary)', 'wpbfpremium' ),
	'tooltip'   => __( 'Used mostly for regular text. ', 'wpbfpremium' ),
	'section'   => 'wpbf_global_options',
	'default'   => '#6d7680',
	'priority'  => 0,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'brand_color_separator',
		'section'  => 'wpbf_global_options',
		'priority' => 0,
	]
);

// Accent color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'accent_color_global',
	'label'     => __( 'Accent Color', 'wpbfpremium' ),
	'tooltip'   => __( 'Used mostly for links. ', 'wpbfpremium' ),
	'section'   => 'wpbf_global_options',
	'default'   => '#3ba9d2',
	'priority'  => 0,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Accent color alt.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'accent_color_alt_global',
	'label'     => __( 'Accent Color (Hover)', 'wpbfpremium' ),
	'tooltip'   => __( 'Should be either slightly darker or lighter than Accent Color. ', 'wpbfpremium' ),
	'section'   => 'wpbf_global_options',
	'default'   => '#79c4e0',
	'priority'  => 0,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

/* Fields - 404 */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'divider-404',
		'section'  => 'wpbf_404_options',
		'priority' => 100,
	]
);

// 404.
Kirki::add_field( 'wpbf', array(
	'type'        => 'code',
	'label'       => __( 'Custom 404 Page', 'wpbfpremium' ),
	'description' => __( 'Replace the default 404 page with a saved Beaver Builder or Elementor template. <br><br><strong>Example:</strong><br>[elementor-template id="xxx"]<br>[fl_builder_insert_layout id="xxx"]', 'wpbfpremium' ),
	'settings'    => '404_custom',
	'section'     => 'wpbf_404_options',
	'priority'    => 100,
	'choices'     => array(
		'language' => 'html',
	),
) );

/* Fields - Social media icons */

// Social sortable.
Kirki::add_field( 'wpbf', array(
	'type'            => 'sortable',
	'settings'        => 'social_sortable',
	'label'           => __( 'Social Media Icons', 'wpbfpremium' ),
	'description'     => __( 'Display social media icons anywhere on your site by using the [social] shortcode.', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'general',
	'default'         => array(),
	'choices'         => wpbf_social_choices(),
	'priority'        => 1,
	'partial_refresh' => array(
		'social_sortable' => array(
			'container_inclusive' => true,
			'selector'            => '.wpbf-social-icons',
			'render_callback'     => function () {
				return wpbf_social();
			},
		),
	),
) );

$choices = wpbf_social_choices();

foreach ( $choices as $choice => $choice ) {

	Kirki::add_field( 'wpbf', array(
		'type'            => 'url',
		'settings'        => $choice . '_link',
		'transport'       => 'postMessage',
		'label'           => ucfirst( $choice ) . ' ' . __( 'URL', 'wpbfpremium' ),
		'section'         => 'wpbf_social_icons_options',
		'tab'             => 'general',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'social_sortable',
				'operator' => 'in',
				'value'    => $choice,
			),
		),
	) );

}

// Social shapes.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'social_shapes',
	'label'           => __( 'Style', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'design',
	'default'         => 'wpbf-social-shape-plain',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => array(
		'wpbf-social-shape-plain'   => __( 'Plain', 'wpbfpremium' ),
		'wpbf-social-shape-rounded' => __( 'Rounded', 'wpbfpremium' ),
		'wpbf-social-shape-boxed'   => __( 'Boxed', 'wpbfpremium' ),
	),
	'partial_refresh' => array(
		'social_shapes' => array(
			'container_inclusive' => true,
			'selector'            => '.wpbf-social-icons',
			'render_callback'     => function () {
				return wpbf_social();
			},
		),
	),
) );

// Social styles.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'social_styles',
	'label'           => __( 'Color', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'design',
	'default'         => 'wpbf-social-style-default',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => array(
		'wpbf-social-style-default' => __( 'Accent Color', 'wpbfpremium' ),
		'wpbf-social-style-grey'    => __( 'Custom', 'wpbfpremium' ),
		'wpbf-social-style-brand'   => __( 'Brand Colors', 'wpbfpremium' ),
		'wpbf-social-style-filled'  => __( 'Filled', 'wpbfpremium' ),
	),
	'partial_refresh' => array(
		'social_styles' => array(
			'container_inclusive' => true,
			'selector'            => '.wpbf-social-icons',
			'render_callback'     => function () {
				return wpbf_social();
			},
		),
	),
) );

// Social size.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'social_sizes',
	'label'           => __( 'Size', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'design',
	'default'         => 'wpbf-social-size-small',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => array(
		'wpbf-social-size-small' => __( 'Small', 'wpbfpremium' ),
		'wpbf-social-size-large' => __( 'Large', 'wpbfpremium' ),
	),
	'partial_refresh' => array(
		'social_sizes' => array(
			'container_inclusive' => true,
			'selector'            => '.wpbf-social-icons',
			'render_callback'     => function () {
				return wpbf_social();
			},
		),
	),
) );

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'social_media_icons_design_separator',
		'section'  => 'wpbf_social_icons_options',
		'priority' => 20,
		'tab'      => 'design',
	]
);

// Social background color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'social_background_color',
	'label'           => __( 'Background color', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'design',
	'priority'        => 20,
	'transport'       => 'postMessage',
	'default'         => '#f5f5f7',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'social_shapes',
			'operator' => '!=',
			'value'    => 'wpbf-social-shape-plain',
		),
		array(
			'setting'  => 'social_styles',
			'operator' => '!=',
			'value'    => 'wpbf-social-style-filled',
		),
	),
) );

// Social background color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'social_background_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'design',
	'priority'        => 20,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'social_shapes',
			'operator' => '!=',
			'value'    => 'wpbf-social-shape-plain',
		),
		array(
			'setting'  => 'social_styles',
			'operator' => '!=',
			'value'    => 'wpbf-social-style-filled',
		),
	),
) );

// Social icon color.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'social_color',
	'label'           => __( 'Icon Color', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'design',
	'priority'        => 20,
	'default'         => '#aaaaaa',
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'social_styles',
			'operator' => '==',
			'value'    => 'wpbf-social-style-grey',
		),
	),
) );

// Social icon color hover.
Kirki::add_field( 'wpbf', array(
	'type'            => 'color',
	'settings'        => 'social_color_alt',
	'label'           => __( 'Hover', 'wpbfpremium' ),
	'section'         => 'wpbf_social_icons_options',
	'tab'             => 'design',
	'priority'        => 20,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'social_styles',
			'operator' => '==',
			'value'    => 'wpbf-social-style-grey',
		),
	),
) );

// Social font size.
Kirki::add_field( 'wpbf', array(
	'type'      => 'slider',
	'settings'  => 'social_font_size',
	'label'     => __( 'Icon Size', 'wpbfpremium' ),
	'section'   => 'wpbf_social_icons_options',
	'tab'       => 'design',
	'priority'  => 20,
	'default'   => 14,
	'transport' => 'postMessage',
	'choices'   => array(
		'min'  => '12',
		'max'  => '32',
		'step' => '1',
	),
) );
