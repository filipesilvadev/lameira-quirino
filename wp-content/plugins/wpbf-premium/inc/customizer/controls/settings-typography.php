<?php
/**
 * Typography customizer settings.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/* Sections */

// Adobe Fonts.
Kirki::add_section( 'wpbf_typekit_options', array(
	'title'    => __( 'Adobe Fonts', 'wpbfpremium' ),
	'panel'    => 'typo_panel',
	'priority' => 800,
) );

// Custom fonts.
Kirki::add_section( 'wpbf_custom_fonts_options', array(
	'title'    => __( 'Custom Fonts', 'wpbfpremium' ),
	'panel'    => 'typo_panel',
	'priority' => 900,
) );

/* Fields - Adobe fonts */

// Toggle.
new \Kirki\Field\Toggle(
	[
		'settings' => 'enable_typekit',
		'label'    => esc_html__( 'Adobe Fonts', 'wpbfpremium' ),
		'section'  => 'wpbf_typekit_options',
		'default'  => 0,
		'priority' => 1,
	]
);

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'enable_typekit_separator',
		'section'  => 'wpbf_typekit_options',
		'priority' => 1,
		'active_callback' => [
			[
				'setting'  => 'enable_typekit',
				'operator' => '==',
				'value'    => '1',
			],
		],
	]
);

// Adobe Fonts ID
Kirki::add_field( 'wpbf', array(
	'type'            => 'text',
	'settings'        => 'typekit_id',
	'label'           => __( 'Adobe Fonts ID', 'wpbfpremium' ),
	'section'         => 'wpbf_typekit_options',
	'default'         => 'iel4zhm',
	'priority'        => '2',
	'active_callback' => array(
		array(
			'setting'  => 'enable_typekit',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

// Fonts.
Kirki::add_field( 'wpbf', array(
	'type'            => 'repeater',
	'label'           => __( 'Adobe Fonts', 'wpbfpremium' ),
	'settings'        => 'typekit_fonts',
	'priority'        => '3',
	'section'         => 'wpbf_typekit_options',
	'row_label'       => array(
		'type'  => 'text',
		'value' => __( 'Adobe Font', 'wpbfpremium' ),
	),
	'default'         => array(
		array(
			'font_name'     => 'Sofia Pro',
			'font_css_name' => 'sofia-pro',
			'font_variants' => array( 'regular', 'italic', '700', '700italic' ),
		),
	),
	'fields'          => array(
		'font_name'     => array(
			'type'  => 'text',
			'label' => __( 'Name', 'wpbfpremium' ),
		),
		'font_css_name' => array(
			'type'  => 'text',
			'label' => __( 'Font Family', 'wpbfpremium' ),
		),
		'font_variants' => array(
			'type'     => 'select',
			'label'    => __( 'Variants', 'wpbfpremium' ),
			'multiple' => 18,
			'choices'  => array(
				'100'       => __( '100', 'wpbfpremium' ),
				'100italic' => __( '100italic', 'wpbfpremium' ),
				'200'       => __( '200', 'wpbfpremium' ),
				'200italic' => __( '200italic', 'wpbfpremium' ),
				'300'       => __( '300', 'wpbfpremium' ),
				'300italic' => __( '300italic', 'wpbfpremium' ),
				'regular'   => __( 'regular', 'wpbfpremium' ),
				'italic'    => __( 'italic', 'wpbfpremium' ),
				'500'       => __( '500', 'wpbfpremium' ),
				'500italic' => __( '500italic', 'wpbfpremium' ),
				'600'       => __( '600', 'wpbfpremium' ),
				'600italic' => __( '600italic', 'wpbfpremium' ),
				'700'       => __( '700', 'wpbfpremium' ),
				'700italic' => __( '700italic', 'wpbfpremium' ),
				'800'       => __( '800', 'wpbfpremium' ),
				'800italic' => __( '800italic', 'wpbfpremium' ),
				'900'       => __( '900', 'wpbfpremium' ),
				'900italic' => __( '900italic', 'wpbfpremium' ),
			),
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_typekit',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

/* Fields - Custom fonts */

// Toggle.
new \Kirki\Field\Toggle(
	[
		'settings' => 'enable_custom_fonts',
		'label'    => esc_html__( 'Custom Fonts', 'wpbfpremium' ),
		'section'  => 'wpbf_custom_fonts_options',
		'default'  => 0,
		'priority' => 1,
	]
);

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings' => 'enable_custom_fonts_separator',
		'section'  => 'wpbf_custom_fonts_options',
		'priority' => 1,
		'active_callback' => [
			[
				'setting'  => 'enable_custom_fonts',
				'operator' => '==',
				'value'    => '1',
			],
		],
	]
);

// Fonts.
Kirki::add_field( 'wpbf', array(
	'type'            => 'repeater',
	'label'           => __( 'Custom Fonts', 'wpbfpremium' ),
	'settings'        => 'custom_fonts',
	'priority'        => '3',
	'section'         => 'wpbf_custom_fonts_options',
	'row_label'       => array(
		'type'  => 'text',
		'value' => __( 'Custom Font', 'wpbfpremium' ),
	),
	'default'         => array(
		array(
			'font_name'     => 'Kitten',
			'font_css_name' => 'kitten, sans-serif',
			'font_woff'     => false,
			'font_woff2'    => false,
			'font_ttf'      => false,
			'font_svg'      => false,
			'font_eot'      => false,
		),
	),
	'fields'          => array(
		'font_name'     => array(
			'type'  => 'text',
			'label' => __( 'Name', 'wpbfpremium' ),
		),
		'font_css_name' => array(
			'type'  => 'text',
			'label' => __( 'Font Family', 'wpbfpremium' ),
		),
		'font_woff'     => array(
			'type'      => 'upload',
			'mime_type' => array(),
			'label'     => __( 'Woff', 'wpbfpremium' ),
		),
		'font_woff2'    => array(
			'type'      => 'upload',
			'mime_type' => array(),
			'label'     => __( 'Woff2', 'wpbfpremium' ),
		),
		'font_ttf'      => array(
			'type'      => 'upload',
			'mime_type' => array(),
			'label'     => __( 'TTF', 'wpbfpremium' ),
		),
		'font_svg'      => array(
			'type'      => 'upload',
			'mime_type' => array(),
			'label'     => __( 'SVG', 'wpbfpremium' ),
		),
		'font_eot'      => array(
			'type'      => 'upload',
			'mime_type' => array(),
			'label'     => __( 'EOT', 'wpbfpremium' ),
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_custom_fonts',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

/* Fields - Menu font */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'menu_font_family_divider',
		'section'         => 'wpbf_menu_font_options',
		'priority'        => 3,
	]
);

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'      => 'slider',
	'settings'  => 'menu_letter_spacing',
	'label'     => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'   => 'wpbf_menu_font_options',
	'priority'  => 3,
	'default'   => '0',
	'transport' => 'postMessage',
	'choices'   => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'     => 'select',
	'settings' => 'menu_text_transform',
	'label'    => __( 'Text transform', 'wpbfpremium' ),
	'section'  => 'wpbf_menu_font_options',
	'default'  => 'none',
	'priority' => 4,
	'multiple' => 1,
	'choices'  => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
) );

/* Fields - Sub Menu font */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'sub_menu_font_family_divider',
		'section'         => 'wpbf_sub_menu_font_options',
		'priority'        => 3,
	]
);

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'      => 'slider',
	'settings'  => 'sub_menu_letter_spacing',
	'label'     => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'   => 'wpbf_sub_menu_font_options',
	'priority'  => 3,
	'default'   => '0',
	'transport' => 'postMessage',
	'choices'   => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'     => 'select',
	'settings' => 'sub_menu_text_transform',
	'label'    => __( 'Text transform', 'wpbfpremium' ),
	'section'  => 'wpbf_sub_menu_font_options',
	'default'  => 'none',
	'priority' => 4,
	'multiple' => 1,
	'choices'  => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
) );

/* Fields - Text */

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Font Size', 'wpbfpremium' ),
	'section'           => 'wpbf_font_options',
	'settings'          => 'page_font_size',
	'priority'          => 1,
	'transport'         => 'postMessage',
	'default'           => json_encode(
		array(
			'desktop' => '16px',
			'tablet'  => '',
			'mobile'  => '',
		)
	),
	'choices'           => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

/* Fields - H1 */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'page_h1_toggle_divider',
		'section'         => 'wpbf_h1_options',
		'priority'        => 2,
	]
);

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Font Size', 'wpbfpremium' ),
	'section'           => 'wpbf_h1_options',
	'settings'          => 'page_h1_font_size',
	'priority'          => 2,
	'transport'         => 'postMessage',
	'default'           => json_encode(
		array(
			'desktop' => '32px',
			'tablet'  => '',
			'mobile'  => '',
		)
	),
	'choices'           => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

// Color.
Kirki::add_field( 'wpbf', array(
	'type'     => 'color',
	'settings' => 'page_h1_font_color',
	'label'    => __( 'Color', 'wpbfpremium' ),
	'section'  => 'wpbf_h1_options',
	'priority' => 3,
	'choices'  => array(
		'alpha' => true,
	),
) );

// Line height.
Kirki::add_field( 'wpbf', array(
	'type'      => 'slider',
	'settings'  => 'page_h1_line_height',
	'label'     => __( 'Line Height', 'wpbfpremium' ),
	'section'   => 'wpbf_h1_options',
	'priority'  => 4,
	'default'   => '1.2',
	'transport' => 'postMessage',
	'choices'   => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '.1',
	),
) );

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'      => 'slider',
	'settings'  => 'page_h1_letter_spacing',
	'label'     => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'   => 'wpbf_h1_options',
	'priority'  => 5,
	'default'   => '0',
	'transport' => 'postMessage',
	'choices'   => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'     => 'select',
	'settings' => 'page_h1_text_transform',
	'label'    => __( 'Text transform', 'wpbfpremium' ),
	'section'  => 'wpbf_h1_options',
	'default'  => 'none',
	'priority' => 6,
	'multiple' => 1,
	'choices'  => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
) );

/* Fields - H2 */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'page_h2_toggle_divider',
		'section'         => 'wpbf_h2_options',
		'priority'        => 2,
	]
);

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Font Size', 'wpbfpremium' ),
	'section'           => 'wpbf_h2_options',
	'settings'          => 'page_h2_font_size',
	'priority'          => 2,
	'transport'         => 'postMessage',
	'default'           => json_encode(
		array(
			'desktop' => '28px',
			'tablet'  => '',
			'mobile'  => '',
		)
	),
	'choices'           => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

// Color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'page_h2_font_color',
	'label'     => __( 'Color', 'wpbfpremium' ),
	'section'   => 'wpbf_h2_options',
	'priority'  => 3,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Line height.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h2_line_height',
	'label'           => __( 'Line Height', 'wpbfpremium' ),
	'section'         => 'wpbf_h2_options',
	'priority'        => 4,
	'default'         => '1.2',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '.1',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h2_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h2_letter_spacing',
	'label'           => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'         => 'wpbf_h2_options',
	'priority'        => 5,
	'default'         => '0',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h2_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'page_h2_text_transform',
	'label'           => __( 'Text transform', 'wpbfpremium' ),
	'section'         => 'wpbf_h2_options',
	'default'         => 'none',
	'priority'        => 6,
	'multiple'        => 1,
	'choices'         => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h2_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

/* Fields - H3 */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'page_h3_toggle_divider',
		'section'         => 'wpbf_h3_options',
		'priority'        => 2,
	]
);

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Font Size', 'wpbfpremium' ),
	'section'           => 'wpbf_h3_options',
	'settings'          => 'page_h3_font_size',
	'priority'          => 2,
	'transport'         => 'postMessage',
	'default'           => json_encode(
		array(
			'desktop' => '24px',
			'tablet'  => '',
			'mobile'  => '',
		)
	),
	'choices'           => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

// Color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'page_h3_font_color',
	'label'     => __( 'Color', 'wpbfpremium' ),
	'section'   => 'wpbf_h3_options',
	'priority'  => 3,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Line height.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h3_line_height',
	'label'           => __( 'Line Height', 'wpbfpremium' ),
	'section'         => 'wpbf_h3_options',
	'priority'        => 4,
	'default'         => '1.2',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '.1',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h3_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h3_letter_spacing',
	'label'           => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'         => 'wpbf_h3_options',
	'priority'        => 5,
	'default'         => '0',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h3_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'page_h3_text_transform',
	'label'           => __( 'Text transform', 'wpbfpremium' ),
	'section'         => 'wpbf_h3_options',
	'default'         => 'none',
	'priority'        => 6,
	'multiple'        => 1,
	'choices'         => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h3_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

/* Fields - H4 */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'page_h4_toggle_divider',
		'section'         => 'wpbf_h4_options',
		'priority'        => 2,
	]
);

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Font Size', 'wpbfpremium' ),
	'section'           => 'wpbf_h4_options',
	'settings'          => 'page_h4_font_size',
	'priority'          => 2,
	'transport'         => 'postMessage',
	'default'           => json_encode(
		array(
			'desktop' => '20px',
			'tablet'  => '',
			'mobile'  => '',
		)
	),
	'choices'           => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

// Color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'page_h4_font_color',
	'label'     => __( 'Color', 'wpbfpremium' ),
	'section'   => 'wpbf_h4_options',
	'priority'  => 3,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Line height.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h4_line_height',
	'label'           => __( 'Line Height', 'wpbfpremium' ),
	'section'         => 'wpbf_h4_options',
	'priority'        => 4,
	'default'         => '1.2',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '.1',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h4_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h4_letter_spacing',
	'label'           => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'         => 'wpbf_h4_options',
	'priority'        => 5,
	'default'         => '0',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h4_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'page_h4_text_transform',
	'label'           => __( 'Text transform', 'wpbfpremium' ),
	'section'         => 'wpbf_h4_options',
	'default'         => 'none',
	'priority'        => 6,
	'multiple'        => 1,
	'choices'         => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h4_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

/* Fields - H5 */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'page_h5_toggle_divider',
		'section'         => 'wpbf_h5_options',
		'priority'        => 2,
	]
);

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Font Size', 'wpbfpremium' ),
	'section'           => 'wpbf_h5_options',
	'settings'          => 'page_h5_font_size',
	'priority'          => 2,
	'transport'         => 'postMessage',
	'default'           => json_encode(
		array(
			'desktop' => '16px',
			'tablet'  => '',
			'mobile'  => '',
		)
	),
	'choices'           => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

// Color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'page_h5_font_color',
	'label'     => __( 'Color', 'wpbfpremium' ),
	'section'   => 'wpbf_h5_options',
	'priority'  => 3,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Line height.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h5_line_height',
	'label'           => __( 'Line Height', 'wpbfpremium' ),
	'section'         => 'wpbf_h5_options',
	'priority'        => 4,
	'default'         => '1.2',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '.1',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h5_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h5_letter_spacing',
	'label'           => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'         => 'wpbf_h5_options',
	'priority'        => 5,
	'default'         => '0',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h5_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'page_h5_text_transform',
	'label'           => __( 'Text transform', 'wpbfpremium' ),
	'section'         => 'wpbf_h5_options',
	'default'         => 'none',
	'priority'        => 6,
	'multiple'        => 1,
	'choices'         => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h5_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

/* Fields - H6 */

// Separator.
new \Kirki\Pro\Field\Divider(
	[
		'settings'        => 'page_h6_toggle_divider',
		'section'         => 'wpbf_h6_options',
		'priority'        => 2,
	]
);

// Font size.
Kirki::add_field( 'wpbf', array(
	'type'              => 'responsive_input_slider',
	'label'             => __( 'Font Size', 'wpbfpremium' ),
	'section'           => 'wpbf_h6_options',
	'settings'          => 'page_h6_font_size',
	'priority'          => 2,
	'transport'         => 'postMessage',
	'default'           => json_encode(
		array(
			'desktop' => '16px',
			'tablet'  => '',
			'mobile'  => '',
		)
	),
	'choices'           => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'sanitize_callback' => wpbf_kirki_sanitize_helper( 'wp_filter_nohtml_kses' ),
) );

// Color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'page_h6_font_color',
	'label'     => __( 'Color', 'wpbfpremium' ),
	'section'   => 'wpbf_h6_options',
	'priority'  => 3,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Line height.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h6_line_height',
	'label'           => __( 'Line Height', 'wpbfpremium' ),
	'section'         => 'wpbf_h6_options',
	'priority'        => 4,
	'default'         => '1.2',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '.1',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h6_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Letter spacing.
Kirki::add_field( 'wpbf', array(
	'type'            => 'slider',
	'settings'        => 'page_h6_letter_spacing',
	'label'           => __( 'Letter Spacing', 'wpbfpremium' ),
	'section'         => 'wpbf_h6_options',
	'priority'        => 5,
	'default'         => '0',
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '-2',
		'max'  => '5',
		'step' => '.5',
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h6_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Text transform.
Kirki::add_field( 'wpbf', array(
	'type'            => 'select',
	'settings'        => 'page_h6_text_transform',
	'label'           => __( 'Text transform', 'wpbfpremium' ),
	'section'         => 'wpbf_h6_options',
	'default'         => 'none',
	'priority'        => 6,
	'multiple'        => 1,
	'choices'         => array(
		'none'       => __( 'None', 'wpbfpremium' ),
		'lowercase'  => __( 'Lowercase', 'wpbfpremium' ),
		'uppercase'  => __( 'Uppercase', 'wpbfpremium' ),
		'capitalize' => __( 'Capitalize', 'wpbfpremium' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'page_h6_toggle',
			'operator' => '==',
			'value'    => true,
		),
	),
) );
