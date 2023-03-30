<?php
/**
 * Blog Layouts customizer settings.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/* Fields */

$archives = apply_filters( 'wpbf_archives', array( 'archive' ) );

foreach ( $archives as $archive ) {

	// Headline.
	new \Kirki\Pro\Field\Headline(
		[
			'settings'        => $archive . '_grid_layout_headline',
			'label'           => esc_html__( 'Grid Layout Settings', 'wpbfpremium' ),
			'section'         => 'wpbf_' . $archive . '_options',
			'priority'        => 100,
			'active_callback' => [
				[
					'setting'  => $archive . '_layout',
					'operator' => '==',
					'value'    => 'grid',
				]
			]
		]
	);

	// Grid.
	Kirki::add_field( 'wpbf', array(
		'type'              => 'responsive_input',
		'settings'          => $archive . '_grid',
		'label'             => __( 'Posts per Row', 'wpbfpremium' ),
		'section'           => 'wpbf_' . $archive . '_options',
		'priority'          => 110,
		'default'           => json_encode(
			array(
				'desktop' => '3',
				'tablet'  => '2',
				'mobile'  => '1',
			)
		),
		'active_callback'   => array(
			array(
				'setting'  => $archive . '_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
		'sanitize_callback' => wpbf_kirki_sanitize_helper( 'absint' ),
	) );

	// Gap.
	Kirki::add_field( 'wpbf', array(
		'type'            => 'select',
		'settings'        => $archive . '_grid_gap',
		'label'           => __( 'Grid Gap', 'wpbf-premium' ),
		'section'         => 'wpbf_' . $archive . '_options',
		'default'         => 'small',
		'priority'        => 120,
		'multiple'        => 1,
		'choices'         => array(
			'small'    => __( 'Small', 'wpbfpremium' ),
			'medium'   => __( 'Medium', 'wpbfpremium' ),
			'large'    => __( 'Large', 'wpbfpremium' ),
			'xlarge'   => __( 'xLarge', 'wpbfpremium' ),
			'collapse' => __( 'Collapse', 'wpbfpremium' ),
		),
		'active_callback' => array(
			array(
				'setting'  => $archive . '_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	) );

	// Masonry.
	Kirki::add_field( 'wpbf', array(
		'type'            => 'toggle',
		'settings'        => $archive . '_grid_masonry',
		'label'           => __( 'Masonry Effect', 'wpbfpremium' ),
		'section'         => 'wpbf_' . $archive . '_options',
		'default'         => 0,
		'priority'        => 130,
		'active_callback' => array(
			array(
				'setting'  => $archive . '_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	) );

	// Separator.
	new \Kirki\Pro\Field\Divider(
		[
			'settings' => $archive . '_infinite_scroll_separator',
			'section'  => 'wpbf_' . $archive . '_options',
			'priority' => 140,
		]
	);

	// Infinite Scroll.
	Kirki::add_field( 'wpbf', array(
		'type'     => 'toggle',
		'settings' => $archive . '_infinite_scroll',
		'label'    => __( 'Infinite Scroll', 'wpbfpremium' ),
		'section'  => 'wpbf_' . $archive . '_options',
		'default'  => 0,
		'priority' => 150,
	) );

}

/* Fields – Typography (page) */

// Bold color.
Kirki::add_field( 'wpbf', array(
	'type'      => 'color',
	'settings'  => 'page_bold_color',
	'label'     => __( 'Bold Text Color', 'wpbfpremium' ),
	'section'   => 'wpbf_font_options',
	'priority'  => 3,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Line height.
Kirki::add_field( 'wpbf', array(
	'type'      => 'slider',
	'settings'  => 'page_line_height',
	'label'     => __( 'Line Height', 'wpbfpremium' ),
	'section'   => 'wpbf_font_options',
	'priority'  => 4,
	'default'   => '1.7',
	'transport' => 'postMessage',
	'choices'   => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '.1',
	),
) );
