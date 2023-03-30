<?php
/**
 * kirki
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Extend existing Customizer Settings
 */
function wpbf_kirki_premium() {

	/* Panels */

	// Scripts
	Kirki::add_panel( 'scripts_panel', array(
		'priority'			=>		6,
		'title'				=>		__( 'Scripts & Styles', 'wpbf' ),
	) );

	/* Sections – Scripts */

	// Header
	Kirki::add_section( 'wpbf_header_scripts', array(
		'title'				=>			esc_attr__( 'Header', 'wpbfpremium' ),
		'panel'				=>			'scripts_panel',
		'priority'			=>			100,
	) );

	// Footer
	Kirki::add_section( 'wpbf_footer_scripts', array(
		'title'				=>			esc_attr__( 'Footer', 'wpbfpremium' ),
		'panel'				=>			'scripts_panel',
		'priority'			=>			200,
	) );

	/* Sections – Typography */

	// Adobe Fonts
	Kirki::add_section( 'wpbf_typekit_options', array(
		'title'				=>			esc_attr__( 'Adobe Fonts', 'wpbfpremium' ),
		'panel'				=>			'typo_panel',
		'priority'			=>			800,
	) );

	// Custom Fonts
	Kirki::add_section( 'wpbf_custom_fonts_options', array(
		'title'				=>			esc_attr__( 'Custom Fonts', 'wpbfpremium' ),
		'panel'				=>			'typo_panel',
		'priority'			=>			900,
	) );

	/* Sections – General */

	// Social Media Icons
	Kirki::add_section( 'wpbf_social_icons_options', array(
		'title'				=>			esc_attr__( 'Social Media Icons', 'wpbfpremium' ),
		'panel'				=>			'layout_panel',
		'priority'			=>			1100,
	) );

	/* Sections – Navigation */

	// Sticky Navigation
	Kirki::add_section( 'wpbf_sticky_menu_options', array(
		'title'				=>			esc_attr__( 'Sticky Navigation', 'wpbfpremium' ),
		'panel'				=>			'header_panel',
		'priority'			=>			300,
	) );

	// Navigation Effects
	Kirki::add_section( 'wpbf_menu_effect_options', array(
		'title'				=>			esc_attr__( 'Navigation Hover Effects', 'wpbfpremium' ),
		'panel'				=>			'header_panel',
		'priority'			=>			400,
	) );

	// Navigation Effects
	Kirki::add_section( 'wpbf_cta_button_options', array(
		'title'				=>			esc_attr__( 'Call to Action Button', 'wpbfpremium' ),
		'panel'				=>			'header_panel',
		'priority'			=>			450,
	) );

	// Transparent Header
	Kirki::add_section( 'wpbf_transparent_header_options', array(
		'title'				=>			esc_attr__( 'Transparent Header', 'wpbfpremium' ),
		'panel'				=>			'header_panel',
		'priority'			=>			500,
	) );

	/* Fields – General */

	// Separator
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-52921',
		'section'			=>			'wpbf_404_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			100,
	) );

	// 404
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'code',
		'label'				=>			esc_attr__( 'Custom 404 Page', 'wpbfpremium' ),
		'description'		=>			__( 'Replace the default 404 page with your custom layout. <br><br>Example:<br>[elementor-template id="xxx"]<br>[fl_builder_insert_layout id="xxx"]', 'wpbfpremium' ),
		'settings'			=>			'404_custom',
		'section'			=>			'wpbf_404_options',
		'priority'			=>			100,
		'choices'			=>			array(
			'language'		=>			'html',
		),
	) );

	// Social Sortable
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'sortable',
		'settings'			=>			'social_sortable',
		'label'				=>			esc_attr__( 'Icons', 'wpbfpremium' ),
		'description'		=>			esc_attr__( 'Display social media icons in your pre-header, footer or template file by using the [social] shortcode.', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'default'			=>			array(),
		'choices'			=> array(
			'facebook'		=>			esc_attr__( 'Facebook', 'wpbfpremium' ),
			'twitter'		=>			esc_attr__( 'Twitter', 'wpbfpremium' ),
			'pinterest'		=>			esc_attr__( 'Pinterest', 'wpbfpremium' ),
			'youtube'		=>			esc_attr__( 'Youtube', 'wpbfpremium' ),
			'instagram'		=>			esc_attr__( 'Instagram', 'wpbfpremium' ),
			'vimeo'			=>			esc_attr__( 'Vimeo', 'wpbfpremium' ),
			'soundcloud'	=>			esc_attr__( 'Soundcloud', 'wpbfpremium' ),
			'linkedin'		=>			esc_attr__( 'LinkedIn', 'wpbfpremium' ),
			'yelp'			=>			esc_attr__( 'Yelp', 'wpbfpremium' ),
			'behance'		=>			esc_attr__( 'Behance', 'wpbfpremium' ),
			'spotify'		=>			esc_attr__( 'Spotify', 'wpbfpremium' ),
			'reddit'		=>			esc_attr__( 'Reddit', 'wpbfpremium' ),
		),
		'priority'			=>			1,
	) );

	// Facebook
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'facebook_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Facebook URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'facebook',
			),
		),
	) );

	// Twitter
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'twitter_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Twitter URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'twitter',
			),
		),
	) );

	// Pinterest
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'pinterest_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Pinterest URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'pinterest',
			),
		),
	) );

	// Youtube
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'youtube_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Youtube URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'youtube',
			),
		),
	) );

	// Instagram
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'instagram_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Instagram URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'instagram',
			),
		),
	) );

	// Vimeo
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'vimeo_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Vimeo URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'vimeo',
			),
		),
	) );

	// Soundcloud
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'soundcloud_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Soundcloud URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'soundcloud',
			),
		),
	) );

	// LinkedIn
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'linkedin_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'LinkedIn URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'linkedin',
			),
		),
	) );

	// Yelp
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'yelp_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Yelp URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'yelp',
			),
		),
	) );

	// Behance
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'behance_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Behance URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'behance',
			),
		),
	) );

	// Spotify
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'spotify_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Spotify URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'spotify',
			),
		),
	) );

	// Reddit
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'url',
		'settings'			=>			'reddit_link',
		'transport'			=>			'postMessage',
		'label'				=>			esc_attr__( 'Reddit URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			10,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'social_sortable',
			'operator'		=>			'in',
			'value'			=>			'reddit',
			),
		),
	) );

	// Separator
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-523261407',
		'section'			=>			'wpbf_social_icons_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			20,
	) );

	// Social Shapes
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'social_shapes',
		'label'				=>			esc_attr__( 'Style', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'default'			=>			'none',
		'priority'			=>			20,
		'multiple'			=>			1,
		'choices'			=>			array(
			'wpbf-social-shape-plain'		=>			esc_attr__( 'Plain', 'wpbfpremium' ),
			'wpbf-social-shape-rounded'		=>			esc_attr__( 'Rounded', 'wpbfpremium' ),
			'wpbf-social-shape-boxed'		=>			esc_attr__( 'Boxed', 'wpbfpremium' ),
		),
	) );

	// Social Styles
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'social_styles',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'default'			=>			'wpbf-social-style-default',
		'priority'			=>			20,
		'multiple'			=>			1,
		'choices'			=>			array(
			'wpbf-social-style-default'		=>			esc_attr__( 'Default', 'wpbfpremium' ),
			'wpbf-social-style-grey'		=>			esc_attr__( 'Grey', 'wpbfpremium' ),
			'wpbf-social-style-brand'		=>			esc_attr__( 'Brand Colors', 'wpbfpremium' ),
			'wpbf-social-style-filled'		=>			esc_attr__( 'Filled', 'wpbfpremium' ),
		),
	) );

	// Social Size
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'social_sizes',
		'label'				=>			esc_attr__( 'Size', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'default'			=>			'wpbf-social-size-small',
		'priority'			=>			20,
		'multiple'			=>			1,
		'choices'			=>			array(
			'wpbf-social-size-small'		=>			esc_attr__( 'Small', 'wpbfpremium' ),
			'wpbf-social-size-large'		=>			esc_attr__( 'Large', 'wpbfpremium' ),
		),
	) );

	// Social Font Size
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'social_font_size',
		'label'				=>			esc_attr__( 'Font Size', 'wpbfpremium' ),
		'section'			=>			'wpbf_social_icons_options',
		'priority'			=>			20,
		'default'			=>			14,
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'12',
			'max'			=>			'32',
			'step'			=>			'1',
		),
	) );

	/* Fields – Blog Layouts */

	$archives = apply_filters( 'wpbf_archives', array( 'archive' ) );

	foreach ( $archives as $archive ) {

		/* Grid */

		// Grid Headline
		Kirki::add_field( 'wpbf', array(
			'type'				=>			'custom',
			'settings'			=>			$archive . '-separator-7554568',
			'section'			=>			'wpbf_' . $archive . '_options',
			'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Grid Layout Settings', 'wpbfpremium' ) .'</h3>',
			'priority'			=>			100,
			'active_callback'	=>			array(
				array(
				'setting'		=>			$archive . '_layout',
				'operator'		=>			'==',
				'value'			=>			'grid',
				),
			),
		) );

		// Gap
		Kirki::add_field( 'wpbf', array(
			'type'				=>			'select',
			'settings'			=>			$archive . '_grid_gap',
			'label'				=>			esc_attr__( 'Grid Gap', 'wpbf-premium' ),
			'section'			=>			'wpbf_' . $archive . '_options',
			'default'			=>			'small',
			'priority'			=>			100,
			'multiple'			=>			1,
			'choices'			=>			array(
				'small'			=>			esc_attr__( 'Small', 'wpbfpremium' ),
				'medium'		=>			esc_attr__( 'Medium', 'wpbfpremium' ),
				'large'			=>			esc_attr__( 'Large', 'wpbfpremium' ),
				'xlarge'		=>			esc_attr__( 'xLarge', 'wpbfpremium' ),
				'collapse'		=>			esc_attr__( 'Collapse', 'wpbfpremium' ),
			),
			'active_callback'	=>			array(
				array(
				'setting'		=>			$archive . '_layout',
				'operator'		=>			'==',
				'value'			=>			'grid',
				),
			),
		) );

		// Masonry
		Kirki::add_field( 'wpbf', array(
			'type'				=>			'toggle',
			'settings'			=>			$archive . '_grid_masonry',
			'label'				=>			esc_attr__( 'Masonry Effect', 'wpbfpremium' ),
			'section'			=>			'wpbf_' . $archive . '_options',
			'default'			=>			'0',
			'priority'			=>			105,
			'active_callback'	=>			array(
				array(
				'setting'		=>			$archive . '_layout',
				'operator'		=>			'==',
				'value'			=>			'grid',
				),
			),
		) );

	}

	/* Fields – Typography (Page) */

	// Bold Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'page_bold_color',
		'label'				=>			esc_attr__( 'Bold Text Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_font_options',
		'priority'			=>			3,
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'alpha'			=>			true,
		)
	) );

	// Line Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_line_height',
		'label'				=>			esc_attr__( 'Line Height', 'wpbfpremium' ),
		'section'			=>			'wpbf_font_options',
		'priority'			=>			4,
		'default'			=>			'1.7',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'.1',
		),
	) );

	/* Fields – Typography (Menu) */

	// Letter Spacing
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'menu_letter_spacing',
		'label'				=>			esc_attr__( 'Letter Spacing', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_font_options',
		'priority'			=>			3,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'-2',
			'max'			=>			'5',
			'step'			=>			'.5',
		),
	) );

	// Text Transform
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'menu_text_transform',
		'label'				=>			esc_attr__( 'Text transform', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_font_options',
		'default'			=>			'none',
		'priority'			=>			4,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'uppercase'		=>			esc_attr__( 'Uppercase', 'wpbfpremium' ),
		),
	) );

	/* Fields – Typography (H1) */

	// Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'page_h1_font_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_h1_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		)
	) );

	// Line Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h1_line_height',
		'label'				=>			esc_attr__( 'Line Height', 'wpbfpremium' ),
		'section'			=>			'wpbf_h1_options',
		'priority'			=>			4,
		'default'			=>			'1.2',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'.1',
		),
	) );

	// Letter Spacing
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h1_letter_spacing',
		'label'				=>			esc_attr__( 'Letter Spacing', 'wpbfpremium' ),
		'section'			=>			'wpbf_h1_options',
		'priority'			=>			5,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'-2',
			'max'			=>			'5',
			'step'			=>			'.5',
		),
	) );

	// Text Transform
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'page_h1_text_transform',
		'label'				=>			esc_attr__( 'Text transform', 'wpbfpremium' ),
		'section'			=>			'wpbf_h1_options',
		'default'			=>			'none',
		'priority'			=>			6,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'uppercase'		=>			esc_attr__( 'Uppercase', 'wpbfpremium' ),
		),
	) );

	/* Fields – Typography (H2) */

	// Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'page_h2_font_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_h2_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		)
	) );

	// Line Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h2_line_height',
		'label'				=>			esc_attr__( 'Line Height', 'wpbfpremium' ),
		'section'			=>			'wpbf_h2_options',
		'priority'			=>			4,
		'default'			=>			'1.2',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'.1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h2_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Letter Spacing
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h2_letter_spacing',
		'label'				=>			esc_attr__( 'Letter Spacing', 'wpbfpremium' ),
		'section'			=>			'wpbf_h2_options',
		'priority'			=>			5,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'-2',
			'max'			=>			'5',
			'step'			=>			'.5',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h2_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Text Transform
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'page_h2_text_transform',
		'label'				=>			esc_attr__( 'Text transform', 'wpbfpremium' ),
		'section'			=>			'wpbf_h2_options',
		'default'			=>			'none',
		'priority'			=>			6,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'uppercase'		=>			esc_attr__( 'Uppercase', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h2_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	/* Fields – Typography (H3) */

	// Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'page_h3_font_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_h3_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		)
	) );

	// Line Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h3_line_height',
		'label'				=>			esc_attr__( 'Line Height', 'wpbfpremium' ),
		'section'			=>			'wpbf_h3_options',
		'priority'			=>			4,
		'default'			=>			'1.2',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'.1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h3_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Letter Spacing
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h3_letter_spacing',
		'label'				=>			esc_attr__( 'Letter Spacing', 'wpbfpremium' ),
		'section'			=>			'wpbf_h3_options',
		'priority'			=>			5,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'-2',
			'max'			=>			'5',
			'step'			=>			'.5',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h3_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Text Transform
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'page_h3_text_transform',
		'label'				=>			esc_attr__( 'Text transform', 'wpbfpremium' ),
		'section'			=>			'wpbf_h3_options',
		'default'			=>			'none',
		'priority'			=>			6,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'uppercase'		=>			esc_attr__( 'Uppercase', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h3_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	/* Fields – Typography (H4) */

	// Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'page_h4_font_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_h4_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		)
	) );

	// Line Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h4_line_height',
		'label'				=>			esc_attr__( 'Line Height', 'wpbfpremium' ),
		'section'			=>			'wpbf_h4_options',
		'priority'			=>			4,
		'default'			=>			'1.2',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'.1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h4_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Letter Spacing
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h4_letter_spacing',
		'label'				=>			esc_attr__( 'Letter Spacing', 'wpbfpremium' ),
		'section'			=>			'wpbf_h4_options',
		'priority'			=>			5,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'-2',
			'max'			=>			'5',
			'step'			=>			'.5',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h4_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Text Transform
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'page_h4_text_transform',
		'label'				=>			esc_attr__( 'Text transform', 'wpbfpremium' ),
		'section'			=>			'wpbf_h4_options',
		'default'			=>			'none',
		'priority'			=>			6,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'uppercase'		=>			esc_attr__( 'Uppercase', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h4_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	/* Fields – Typography (H5) */

	// Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'page_h5_font_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_h5_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		)
	) );

	// Line Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h5_line_height',
		'label'				=>			esc_attr__( 'Line Height', 'wpbfpremium' ),
		'section'			=>			'wpbf_h5_options',
		'priority'			=>			4,
		'default'			=>			'1.2',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'.1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h5_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Letter Spacing
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h5_letter_spacing',
		'label'				=>			esc_attr__( 'Letter Spacing', 'wpbfpremium' ),
		'section'			=>			'wpbf_h5_options',
		'priority'			=>			5,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'-2',
			'max'			=>			'5',
			'step'			=>			'.5',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h5_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Text Transform
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'page_h5_text_transform',
		'label'				=>			esc_attr__( 'Text transform', 'wpbfpremium' ),
		'section'			=>			'wpbf_h5_options',
		'default'			=>			'none',
		'priority'			=>			6,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'uppercase'		=>			esc_attr__( 'Uppercase', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h5_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	/* Fields – Typography (H6) */

	// Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'page_h6_font_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_h6_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		)
	) );

	// Line Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h6_line_height',
		'label'				=>			esc_attr__( 'Line Height', 'wpbfpremium' ),
		'section'			=>			'wpbf_h6_options',
		'priority'			=>			4,
		'default'			=>			'1.2',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'.1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h6_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Letter Spacing
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'page_h6_letter_spacing',
		'label'				=>			esc_attr__( 'Letter Spacing', 'wpbfpremium' ),
		'section'			=>			'wpbf_h6_options',
		'priority'			=>			5,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'-2',
			'max'			=>			'5',
			'step'			=>			'.5',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h6_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Text Transform
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'page_h6_text_transform',
		'label'				=>			esc_attr__( 'Text transform', 'wpbfpremium' ),
		'section'			=>			'wpbf_h6_options',
		'default'			=>			'none',
		'priority'			=>			6,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'uppercase'		=>			esc_attr__( 'Uppercase', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_h6_toggle',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	/* Fields – Adobe Fonts */

	// Toggle
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'enable_typekit',
		'label'				=>			esc_attr__( 'Enable Adobe Fonts', 'wpbfpremium' ),
		'section'			=>			'wpbf_typekit_options',
		'default'			=>			'0',
		'priority'			=>			'1'
	));

	// ID
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'text',
		'settings'			=>			'typekit_id',
		'label'				=>			esc_attr__( 'Adobe Fonts ID', 'wpbfpremium' ),
		'section'			=>			'wpbf_typekit_options',
		'default'			=>			'iel4zhm',
		'priority'			=>			'2',
		'active_callback'	=>			array(
			array(
			'setting'		=>			'enable_typekit',
			'operator'		=>			'==',
			'value'			=>			'1',
			)
		),
	));

	// Fonts
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'repeater',
		'label'				=>			esc_attr__( 'Adobe Fonts', 'wpbfpremium' ),
		'settings'			=>			'typekit_fonts',
		'priority'			=>			'3',
		'section'			=>			'wpbf_typekit_options',
		'row_label'			=>			array(
			'type'			=>			'text',
			'value'			=>			esc_attr__( 'Adobe Font', 'wpbfpremium' ),
			),
		'default'			=>			array(
			array(
			'font_name'		=>			'Sofia Pro',
			'font_css_name'	=>			'sofia-pro',
			'font_variants' =>			array( 'regular', 'italic', '700', '700italic' ),
			),
		),
		'fields'			=>			array(
			'font_name'		=>			array(
				'type'		=>			'text',
				'label'		=>			esc_attr__( 'Name', 'wpbfpremium' ),
			),
			'font_css_name'	=>			array(
				'type'		=>			'text',
				'label'		=>			esc_attr__( 'Font Family', 'wpbfpremium' ),
			),
			'font_variants'	=>			array(
				'type'		=>			'select',
				'label'		=>			esc_attr__( 'Variants', 'wpbfpremium' ),
				'multiple'	=>			18,
				'choices'	=>			array(
					'100'		=>		esc_attr__( '100', 'wpbfpremium' ),
					'100italic'	=>		esc_attr__( '100italic', 'wpbfpremium' ),
					'200'		=>		esc_attr__( '200', 'wpbfpremium' ),
					'200italic'	=>		esc_attr__( '200italic', 'wpbfpremium' ),
					'300'		=>		esc_attr__( '300', 'wpbfpremium' ),
					'300italic'	=>		esc_attr__( '300italic', 'wpbfpremium' ),
					'regular'	=>		esc_attr__( 'regular', 'wpbfpremium' ),
					'italic'	=>		esc_attr__( 'italic', 'wpbfpremium' ),
					'500'		=>		esc_attr__( '500', 'wpbfpremium' ),
					'500italic'	=>		esc_attr__( '500italic', 'wpbfpremium' ),
					'600'		=>		esc_attr__( '600', 'wpbfpremium' ),
					'600italic'	=>		esc_attr__( '600italic', 'wpbfpremium' ),
					'700'		=>		esc_attr__( '700', 'wpbfpremium' ),
					'700italic'	=>		esc_attr__( '700italic', 'wpbfpremium' ),
					'800'		=>		esc_attr__( '800', 'wpbfpremium' ),
					'800italic'	=>		esc_attr__( '800italic', 'wpbfpremium' ),
					'900'		=>		esc_attr__( '900', 'wpbfpremium' ),
					'900italic'	=>		esc_attr__( '900italic', 'wpbfpremium' ),
				)
			),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'enable_typekit',
			'operator'		=>			'==',
			'value'			=>			'1'
			)
		)
	));

	/* Fields – Custom Fonts */

	// Toggle
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'enable_custom_fonts',
		'label'				=>			esc_attr__( 'Enable Custom Fonts', 'wpbfpremium' ),
		'section'			=>			'wpbf_custom_fonts_options',
		'default'			=>			'0',
		'priority'			=>			'1'
	));

	// Fonts
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'repeater',
		'label'				=>			esc_attr__( 'Custom Fonts', 'wpbfpremium' ),
		'settings'			=>			'custom_fonts',
		'priority'			=>			'3',
		'section'			=>			'wpbf_custom_fonts_options',
		'row_label'			=>			array(
			'type'			=>			'text',
			'value'			=>			esc_attr__( 'Custom Font', 'wpbfpremium' ),
			),
		'default'			=>			array(
			array(
			'font_name'		=>			'Kitten',
			'font_css_name'	=>			'kitten, sans-serif',
			'font_woff'		=>			false,
			'font_woff2'	=>			false,
			'font_ttf'		=>			false,
			'font_svg'		=>			false,
			'font_eot'		=>			false
			),
		),
		'fields'			=>		array(
			'font_name'		=>		array(
				'type'		=>		'text',
				'label'		=>		esc_attr__( 'Name', 'wpbfpremium' ),
			),
			'font_css_name'	=>		array(
				'type'		=>		'text',
				'label'		=>		esc_attr__( 'Font Family', 'wpbfpremium' ),
			),
			'font_woff'		=>		array(
				'type'		=>		'upload',
				'mime_type'	=>		array(),
				'label'		=>		esc_attr__( 'Woff', 'wpbfpremium' ),
			),
			'font_woff2'	=>		array(
				'type'		=>		'upload',
				'mime_type'	=>		array(),
				'label'		=>		esc_attr__( 'Woff2', 'wpbfpremium' ),
			),
			'font_ttf'		=>		array(
				'type'		=>		'upload',
				'mime_type'	=>		array(),
				'label'		=>		esc_attr__( 'TTF', 'wpbfpremium' ),
			),
			'font_svg'		=>		array(
				'type'		=>		'upload',
				'mime_type'	=>		array(),
				'label'		=>		esc_attr__( 'SVG', 'wpbfpremium' ),
			),
			'font_eot'		=>		array(
				'type'		=>		'upload',
				'mime_type'	=>		array(),
				'label'		=>		esc_attr__( 'EOT', 'wpbfpremium' ),
			),
		),
		'active_callback'	=>		array(
			array(
			'setting'		=>		'enable_custom_fonts',
			'operator'		=>		'==',
			'value'			=>		'1'
			)
		)
	));

	/* Fields – Sticky Navigation */

	$i = 0;

	// Toggle
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'menu_sticky',
		'label'				=>			esc_attr__( 'Sticky Navigation', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'0',
		'priority'			=>			$i++,
	) );

	// Logo
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'image',
		'settings'			=>			'menu_active_logo',
		'label'				=>			esc_attr__( 'Logo', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'!=',
			'value'			=>			'',
			),
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Hide Logo
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'menu_active_hide_logo',
		'label'				=>			esc_attr__( 'Hide Logo', 'wpbfpremium' ),
		'description'		=>			esc_attr__('Hides the logo from the sticky navigation.', 'wpbfpremium'),
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'0',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-stacked', 'menu-stacked-advanced', 'menu-centered' ),
			),
		)
	) );

	// Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'label'				=>			esc_attr__( 'Menu Height', 'wpbfpremium' ),
		'settings'			=>			'menu_active_height',
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'default'			=>			'20',
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
		'choices'			=>			array(
			'min'			=>			'5',
			'max'			=>			'80',
			'step'			=>			'1',
		),
	) );

	// Logo Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_stacked_bg_color',
		'label'				=>			esc_attr__( 'Logo Area Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'#ffffff',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-stacked-advanced',
			),
			array(
			'setting'		=>			'menu_active_hide_logo',
			'operator'		=>			'==',
			'value'			=>			false,
			)
		),
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_bg_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'#f5f5f7',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Font Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_font_color',
		'label'				=>			esc_attr__( 'Font Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Font Color Alt
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_font_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Logo Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_logo_color',
		'label'				=>			esc_attr__( 'Logo Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'==',
			'value'			=>			'',
			),
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Logo Color Alt
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_logo_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'==',
			'value'			=>			'',
			),
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Tagline Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_tagline_color',
		'label'				=>			esc_attr__( 'Tagline Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'==',
			'value'			=>			'',
			),
			array(
			'setting'		=>			'menu_logo_description',
			'operator'		=>			'==',
			'value'			=>			true,
			)
		)
	) );

	// Separator
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-7016863',
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Box Shadow
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'menu_active_box_shadow',
		'label'				=>			esc_attr__( 'Box Shadow', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			0,
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		),
	) );

	// Box Shadow Blur
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'menu_active_box_shadow_blur',
		'label'				=>			esc_attr__( 'Blur', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'default'			=>			5,
		'choices'			=>			array(
			'min'			=>			'0',
			'max'			=>			'50',
			'step'			=>			'1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_active_box_shadow',
			'operator'		=>			'==',
			'value'			=>			1,
			),
		),
	) );

	// Box Shadow Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_box_shadow_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'rgba(0,0,0,.15)',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_active_box_shadow',
			'operator'		=>			'==',
			'value'			=>			1,
			),
		),
	) );

	// Separator
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-8931407',
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Delay
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'dimension',
		'label'				=>			esc_attr__( 'Delay', 'wpbfpremium' ),
		'settings'			=>			'menu_active_delay',
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'default'			=>			'',
		'description'		=>			esc_attr__( 'Set a delay after the sticky navigation should appear. Default: 300px', 'wpbfpremium' ),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Animation
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'radio-buttonset',
		'settings'			=>			'menu_active_animation',
		'label'				=>			esc_attr__( 'Animation', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'none',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'fade'			=>			esc_attr__( 'Fade In', 'wpbfpremium' ),
			'slide'			=>			esc_attr__( 'Slide Down', 'wpbfpremium' ),
			'scroll'		=>			esc_attr__( 'Hide on Scroll', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Animation Duration
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'label'				=>			esc_attr__( 'Animation Duration', 'wpbfpremium' ),
		'settings'			=>			'menu_active_animation_duration',
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'default'			=>			'200',
		'choices'			=>			array(
			'min'			=>			'50',
			'max'			=>			'1000',
			'step'			=>			'10',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_active_animation',
			'operator'		=>			'!==',
			'value'			=>			'none',
			),
			array(
			'setting'		=>			'menu_active_animation',
			'operator'		=>			'!==',
			'value'			=>			'scroll',
			),
		)
	) );

	// Off Canvas Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'active-off-canvas-headline',
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Off Canvas Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			)
		)
	) );

	// Full Screen Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'active-full-screen-headline',
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Full Screen Menu Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-full-screen',
			)
		)
	) );

	// Off Canvas Hamburger Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_active_off_canvas_hamburger_color',
		'label'				=>			esc_attr__( 'Icon Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
			),
		)
	) );

	// Mobile Menu Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'active-mobile-menu-headline',
		'section'			=>			'wpbf_sticky_menu_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Mobile Menu Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' )
			)
		)
	) );

	// Mobile Menu Hamburger Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'mobile_menu_active_hamburger_bg_color',
		'label'				=>			esc_attr__( 'Hamburger Icon Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' )
			),
			array(
			'setting'		=>			'mobile_menu_hamburger_style',
			'operator'		=>			'==',
			'value'			=>			'filled',
			)
		)
	) );

	// Mobile Menu Hamburger Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'mobile_menu_active_hamburger_color',
		'label'				=>			esc_attr__( 'Icon Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' )
			)
		)
	) );

	/* Fields – Pre Header */

	// Toggle
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'pre_header_sticky',
		'label'				=>			esc_attr__( 'Sticky Pre Header', 'wpbfpremium' ),
		'section'			=>			'wpbf_pre_header_options',
		'default'			=>			'0',
		'priority'			=>			0,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'pre_header_layout',
			'operator'		=>			'!=',
			'value'			=>			'none',
			),
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			)
		)
	));

	/* Fields – CTA Button */

	$i = 0;

	// Toggle
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'cta_button',
		'label'				=>			esc_attr__( 'Display Call to Action Button', 'wpbfpremium' ),
		'description'		=>			esc_attr__( 'You can declare the Call to Action Button manually by assigning the "wpbf-cta-menu-item" class to your menu-item of choice. Ticking this setting will display the Call to Action Button as the last element inside your main navigation.', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
	) );

	// Toggle
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'cta_button_mobile',
		'label'				=>			esc_attr__( 'Display Call to Action Button (Mobile)', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'cta_button',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Button Text
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'text',
		'settings'			=>			'cta_button_text',
		'label'				=>			esc_attr__( 'Text', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'cta_button',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Button Link
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'link',
		'settings'			=>			'cta_button_url',
		'label'				=>			esc_attr__( 'URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'cta_button',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Target
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'cta_button_target',
		'label'				=>			esc_attr__( 'Open in a new Tab', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'cta_button',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Border Radius
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'cta_button_border_radius',
		'label'				=>			esc_attr__( 'Border Radius', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'default'			=>			'0',
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'min'			=>			'0',
			'max'			=>			'100',
			'step'			=>			'1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'cta_button',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Separator
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-843375',
		'section'			=>			'wpbf_cta_button_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			$i++,
	) );

	// Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_background_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Background Color Hover
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_background_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Font Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_font_color',
		'label'				=>			esc_attr__( 'Font Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Font Color Hover
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_font_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Transparent Header
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'cta_button_transparent_header_headline',
		'section'			=>			'wpbf_cta_button_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Transparent Header', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			$i++,
	) );

	// Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_transparent_background_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Background Color Hover
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_transparent_background_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Font Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_transparent_font_color',
		'label'				=>			esc_attr__( 'Font Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Font Color Hover
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_transparent_font_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Sticky Navigation
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'cta_button_sticky_header_headline',
		'section'			=>			'wpbf_cta_button_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Sticky Navigation', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			$i++,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_sticky_background_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Background Color Hover
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_sticky_background_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Font Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_sticky_font_color',
		'label'				=>			esc_attr__( 'Font Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	// Font Color Hover
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'cta_button_sticky_font_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_cta_button_options',
		'priority'			=>			$i++,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_sticky',
			'operator'		=>			'==',
			'value'			=>			true,
			),
		)
	) );

	/* Fields – Transparent Header */

	// Logo
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'image',
		'settings'			=>			'menu_transparent_logo',
		'label'				=>			esc_attr__( 'Logo', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			0,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'!=',
			'value'			=>			'',
			)
		)
	) );

	// Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_background_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			1,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Font Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_font_color',
		'label'				=>			esc_attr__( 'Font Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			2,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Font Color Alt
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_font_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	// Logo Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_logo_color',
		'label'				=>			esc_attr__( 'Logo Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'==',
			'value'			=>			'',
			),
		)
	) );

	// Logo Color Alt
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_logo_color_alt',
		'label'				=>			esc_attr__( 'Hover', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'==',
			'value'			=>			'',
			),
		)
	) );

	// Tagline Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_tagline_color',
		'label'				=>			esc_attr__( 'Tagline Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_sticky_menu_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'custom_logo',
			'operator'		=>			'==',
			'value'			=>			'',
			),
			array(
			'setting'		=>			'menu_logo_description',
			'operator'		=>			'==',
			'value'			=>			true,
			)
		)
	) );

	// Off Canvas Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'menu-transparent-off-canvas-headline',
		'section'			=>			'wpbf_transparent_header_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Off Canvas Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			4,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			)
		)
	) );

	// Full Screen Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'menu-transparent-full-screen-headline',
		'section'			=>			'wpbf_transparent_header_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Full Screen Menu Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			5,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-full-screen',
			)
		)
	) );

	// Off Canvas Hamburger Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_hamburger_color',
		'label'				=>			esc_attr__( 'Icon Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			6,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
			),
		)
	) );

	// Mobile Menu Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'menu-transparent-mobile-headline',
		'section'			=>			'wpbf_transparent_header_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Mobile Menu Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			7,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'!=',
			'value'			=>			'menu-mobile-default',
			)
		)
	) );

	// Mobile Menu Hamburger Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_hamburger_bg_color_mobile',
		'label'				=>			esc_attr__( 'Hamburger Icon Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			8,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'!=',
			'value'			=>			'menu-mobile-default',
			),
			array(
			'setting'		=>			'mobile_menu_hamburger_style',
			'operator'		=>			'==',
			'value'			=>			'filled',
			)
		)
	) );

	// Mobile Menu Hamburger Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_transparent_hamburger_color_mobile',
		'label'				=>			esc_attr__( 'Icon Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_transparent_header_options',
		'priority'			=>			9,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'!=',
			'value'			=>			'menu-mobile-default',
			)
		)
	) );

	/* Fields – Sub Menu */

	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-99985',
		'section'			=>			'wpbf_sub_menu_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			7,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-off-canvas',
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-off-canvas-left',
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-full-screen',
			),
		)
	) );

	// Animation
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'sub_menu_animation',
		'label'				=>			esc_attr__( 'Sub Menu Animation', 'wpbfpremium' ),
		'section'			=>			'wpbf_sub_menu_options',
		'default'			=>			'fade',
		'priority'			=>			7,
		'multiple'			=>			1,
		'choices'			=>			array(
			'fade'			=>			esc_attr__( 'Fade', 'wpbfpremium' ),
			'down'			=>			esc_attr__( 'Down', 'wpbfpremium' ),
			'up'			=>			esc_attr__( 'Up', 'wpbfpremium' ),
			'zoom-in'		=>			esc_attr__( 'Zoom In', 'wpbfpremium' ),
			'zoom-out'		=>			esc_attr__( 'Zoom Out', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-off-canvas',
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-off-canvas-left',
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-full-screen',
			),
		)
	) );

	// Animation Duration
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'label'				=>			esc_attr__( 'Duration', 'wpbf' ),
		'settings'			=>			'sub_menu_animation_duration',
		'section'			=>			'wpbf_sub_menu_options',
		'priority'			=>			8,
		'default'			=>			'250',
		'choices'			=>			array(
			'min'			=>			'50',
			'max'			=>			'1000',
			'step'			=>			'10',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-off-canvas',
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-off-canvas-left',
			),
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'!=',
			'value'			=>			'menu-full-screen',
			),
		)
	) );

	/* Fields – Mobile Menu */

	// Off Canvas Width
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'dimension',
		'label'				=>			esc_attr__( 'Menu Width', 'wpbfpremium' ),
		'description'		=>			esc_attr__( 'Default: 320px', 'wpbfpremium' ),
		'settings'			=>			'mobile_menu_width',
		'section'			=>			'wpbf_mobile_menu_options',
		'priority'			=>			7,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'==',
			'value'			=>			'menu-mobile-off-canvas',
			),
		)
	) );

	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-47399',
		'section'			=>			'wpbf_mobile_menu_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			30,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'==',
			'value'			=>			'menu-mobile-off-canvas',
			),
		)
	) );

	// Off Canvas Overlay
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'mobile_menu_overlay',
		'label'				=>			esc_attr__( 'Overlay', 'wpbfpremium' ),
		'section'			=>			'wpbf_mobile_menu_options',
		'priority'			=>			31,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'==',
			'value'			=>			'menu-mobile-off-canvas',
			),
		)
	) );

	// Off Canvas Overlay Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'mobile_menu_overlay_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_mobile_menu_options',
		'default'			=>			'rgba(0,0,0,.5)',
		'priority'			=>			32,
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'mobile_menu_options',
			'operator'		=>			'==',
			'value'			=>			'menu-mobile-off-canvas',
			),
			array(
			'setting'		=>			'mobile_menu_overlay',
			'operator'		=>			'==',
			'value'			=>			true,
			)
		)
	) );

	/* Fields – Custom Menu */

	if ( is_plugin_active( 'bb-plugin/fl-builder.php' ) || is_plugin_active( 'elementor-pro/elementor-pro.php' ) ) {

		Kirki::add_field( 'wpbf', array(
			'type'				=>			'custom',
			'settings'			=>			'separator-61123',
			'section'			=>			'wpbf_menu_options',
			'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
			'priority'			=>			999998,
		) );

		// Custom Menu
		Kirki::add_field( 'wpbf', array(
			'type'				=>			'code',
			'label'				=>			esc_attr__( 'Custom Menu', 'wpbfpremium' ),
			'description'		=>			__( 'Paste your shortcode to replace the default menu with your Custom Menu. <br><br>Example:<br>[elementor-template id="xxx"]<br>[fl_builder_insert_layout id="xxx"]', 'wpbfpremium' ), //esc_html maybe
			'settings'			=>			'menu_custom',
			'section'			=>			'wpbf_menu_options',
			'priority'			=>			999999,
			'choices'			=>			array(
				'language'		=>			'html',
			),
		) );

	} 

	/* Fields – Stacked (Advanced) */

	// Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'stacked-advanced-headline',
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Advanced Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			100,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-stacked-advanced',
			)
		)
	) );

	// Alignment
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'radio-image',
		'settings'			=>			'menu_alignment',
		'label'				=>			esc_attr__( 'Menu Alignment', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'left',
		'priority'			=>			110,
		'multiple'			=>			1,
		'choices'			=>			array(
			'left'			=>			WPBF_PREMIUM_URI . '/inc/customizer/img/align-left.jpg',
			'center'		=>			WPBF_PREMIUM_URI . '/inc/customizer/img/align-center.jpg',
			'right'			=>			WPBF_PREMIUM_URI . '/inc/customizer/img/align-right.jpg',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-stacked-advanced',
			)
		)
	) );

	// WYSIWYG
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'wysiwyg',
		'settings'			=>			'menu_stacked_wysiwyg',
		'label'				=>			esc_attr__( 'Content beside Logo', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'',
		'priority'			=>			120,
		'transport'			=>			'postMessage',
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-stacked-advanced',
			),
			array(
			'setting'		=>			'menu_alignment',
			'operator'		=>			'!=',
			'value'			=>			'center',
			)
		),
	) );

	// Logo Height
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'label'				=>			esc_attr__( 'Logo Area Height', 'wpbf' ),
		'settings'			=>			'menu_stacked_logo_height',
		'section'			=>			'wpbf_menu_options',
		'priority'			=>			130,
		'default'			=>			'20',
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-stacked-advanced',
			)
		),
		'choices'			=>			array(
			'min'			=>			'5',
			'max'			=>			'80',
			'step'			=>			'1',
		),
	) );

	// Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_stacked_bg_color',
		'label'				=>			esc_attr__( 'Logo Area Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'#ffffff',
		'priority'			=>			140,
		'transport'			=>			'postMessage',
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-stacked-advanced',
			)
		),
		'choices'			=>			array(
			'alpha'			=>			true,
		),
	) );

	/* Fields – Off Canvas */

	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'off-canvas-headline',
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Off Canvas Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			200,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			)
		)
	) );

	// Headline
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'full-screen-headline',
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'<h3 style="padding:15px 10px; background:#fff; margin:0;">'. __( 'Full Screen Menu Settings', 'wpbfpremium' ) .'</h3>',
		'priority'			=>			200,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'==',
			'value'			=>			'menu-full-screen',
			)
		)
	) );

	// Push Menu
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'menu_off_canvas_push',
		'label'				=>			esc_attr__( 'Push Menu', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'priority'			=>			210,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			),
		)
	) );

	// Menu Width
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'label'				=>			esc_attr__( 'Menu Width', 'wpbfpremium' ),
		'settings'			=>			'menu_off_canvas_width',
		'section'			=>			'wpbf_menu_options',
		'priority'			=>			220,
		'default'			=>			'400',
		'choices'			=>			array(
			'min'			=>			'300',
			'max'			=>			'500',
			'step'			=>			'10',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			),
		)
	) );

	// Off Canvas Hamburger Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_off_canvas_hamburger_color',
		'label'				=>			esc_attr__( 'Icon Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'#6D7680',
		'priority'			=>			230,
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
			),
		)
	) );

	// Off Canvas Background Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_off_canvas_bg_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'#ffffff',
		'priority'			=>			240,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ),
			),
		)
	) );

	// Off Canvas Submenu Arrow Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_off_canvas_submenu_arrow_color',
		'label'				=>			esc_attr__( 'Sub Menu Arrow Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'priority'			=>			250,
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			),
		)
	) );

	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-08349',
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			260,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			),
		)
	) );

	// Off Canvas Overlay
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'menu_overlay',
		'label'				=>			esc_attr__( 'Overlay', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'priority'			=>			260,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			),
		)
	) );

	// Off Canvas Overlay Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_overlay_color',
		'label'				=>			esc_attr__( 'Background Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_options',
		'default'			=>			'rgba(0,0,0,.5)',
		'priority'			=>			270,
		'transport'			=>			'postMessage',
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_position',
			'operator'		=>			'in',
			'value'			=>			array( 'menu-off-canvas', 'menu-off-canvas-left' ),
			),
			array(
			'setting'		=>			'menu_overlay',
			'operator'		=>			'==',
			'value'			=>			true,
			)
		)
	) );

	/* Fields – Navigation Effects */

	// Effect
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'menu_effect',
		'label'				=>			esc_attr__( 'Hover Effect', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_effect_options',
		'default'			=>			'none',
		'priority'			=>			1,
		'multiple'			=>			1,
		'choices'			=>			array(
			'none'			=>			esc_attr__( 'None', 'wpbfpremium' ),
			'underlined'	=>			esc_attr__( 'Underline', 'wpbfpremium' ),
			'boxed'			=>			esc_attr__( 'Box', 'wpbfpremium' ),
			'modern'		=>			esc_attr__( 'Modern', 'wpbfpremium' ),
		),
	) );

	// Animation
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'select',
		'settings'			=>			'menu_effect_animation',
		'label'				=>			esc_attr__( 'Animation', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_effect_options',
		'default'			=>			'fade',
		'priority'			=>			1,
		'multiple'			=>			1,
		'choices'			=>			array(
			'fade'			=>			esc_attr__( 'Fade', 'wpbfpremium' ),
			'slide'			=>			esc_attr__( 'Slide', 'wpbfpremium' ),
			'grow'			=>			esc_attr__( 'Grow', 'wpbfpremium' ),
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_effect',
			'operator'		=>			'!=',
			'value'			=>			'none',
			),
			array(
			'setting'		=>			'menu_effect',
			'operator'		=>			'!=',
			'value'			=>			'modern',
			)
		)
	) );

	// Alignment
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'radio-image',
		'settings'			=>			'menu_effect_alignment',
		'label'				=>			esc_attr__( 'Alignment', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_effect_options',
		'default'			=>			'center',
		'priority'			=>			2,
		'choices'			=>			array(
			'left'			=>			WPBF_PREMIUM_URI . '/inc/customizer/img/align-left.jpg',
			'center'		=>			WPBF_PREMIUM_URI . '/inc/customizer/img/align-center.jpg',
			'right'			=>			WPBF_PREMIUM_URI . '/inc/customizer/img/align-right.jpg',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_effect_animation',
			'operator'		=>			'==',
			'value'			=>			'slide',
			),
			array(
			'setting'		=>			'menu_effect',
			'operator'		=>			'!=',
			'value'			=>			'modern',
			),
			array(
			'setting'		=>			'menu_effect',
			'operator'		=>			'!=',
			'value'			=>			'none',
			)
		)
	) );

	// Color
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'color',
		'settings'			=>			'menu_effect_color',
		'label'				=>			esc_attr__( 'Color', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_effect_options',
		'priority'			=>			3,
		'choices'			=>			array(
			'alpha'			=>			true,
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_effect',
			'operator'		=>			'!=',
			'value'			=>			'none',
			),
		)
	) );

	// Size (Underlined)
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'menu_effect_underlined_size',
		'label'				=>			esc_attr__( 'Size', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_effect_options',
		'priority'			=>			4,
		'default'			=>			'2',
		'choices'			=>			array(
			'min'			=>			'1',
			'max'			=>			'5',
			'step'			=>			'1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_effect',
			'operator'		=>			'==',
			'value'			=>			'underlined',
			),
		)
	) );

	// Border Radius (Boxed)
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'slider',
		'settings'			=>			'menu_effect_boxed_radius',
		'label'				=>			esc_attr__( 'Border Radius', 'wpbfpremium' ),
		'section'			=>			'wpbf_menu_effect_options',
		'priority'			=>			5,
		'default'			=>			'0',
		'choices'			=>			array(
			'min'			=>			'0',
			'max'			=>			'50',
			'step'			=>			'1',
		),
		'active_callback'	=>			array(
			array(
			'setting'		=>			'menu_effect',
			'operator'		=>			'==',
			'value'			=>			'boxed',
			),
			array(
			'setting'		=>			'menu_effect_animation',
			'operator'		=>			'!=',
			'value'			=>			'slide',
			)
		)
	) );

	/* Fields – Footer */

	// Sticky
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'toggle',
		'settings'			=>			'footer_sticky',
		'label'				=>			esc_attr__( 'Sticky Footer', 'wpbfpremium' ),
		'section'			=>			'wpbf_footer_options',
		'default'			=>			'0',
		'priority'			=>			0,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'page_boxed',
			'operator'		=>			'!=',
			'value'			=>			true,
			),
		)
	) );

	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-174793',
		'section'			=>			'wpbf_footer_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			4,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'footer_layout',
			'operator'		=>			'!=',
			'value'			=>			'none',
			)
		)
	) );

	// Theme Author
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'text',
		'settings'			=>			'footer_theme_author_name',
		'label'				=>			esc_attr__( 'Theme Author', 'wpbfpremium' ),
		'section'			=>			'wpbf_footer_options',
		'priority'			=>			4,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'footer_layout',
			'operator'		=>			'!=',
			'value'			=>			'none',
			)
		)
	) );

	// Theme Author URL
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'text',
		'settings'			=>			'footer_theme_author_url',
		'label'				=>			esc_attr__( 'URL', 'wpbfpremium' ),
		'section'			=>			'wpbf_footer_options',
		'priority'			=>			4,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'footer_layout',
			'operator'		=>			'!=',
			'value'			=>			'none',
			)
		)
	) );

	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-306305',
		'section'			=>			'wpbf_footer_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			4,
		'active_callback'	=>			array(
			array(
			'setting'		=>			'footer_layout',
			'operator'		=>			'!=',
			'value'			=>			'none',
			)
		)
	) );

	Kirki::add_field( 'wpbf', array(
		'type'				=>			'custom',
		'settings'			=>			'separator-41749',
		'section'			=>			'wpbf_footer_options',
		'default'			=>			'<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
		'priority'			=>			20,
	) );

	// Custom Footer
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'code',
		'label'				=>			esc_attr__( 'Custom Footer', 'wpbfpremium' ),
		'description'		=>			__( 'Paste your shortcode to populate a saved row/template throughout your website. <br><br>Examples:<br>[elementor-template id="xxx"]<br>[fl_builder_insert_layout id="xxx"]', 'wpbfpremium' ), //esc_html maybe
		'settings'			=>			'footer_custom',
		'section'			=>			'wpbf_footer_options',
		'priority'			=>			20,
		'choices'			=>			array(
			'language'		=>			'html',
		),
	) );

	/* Fields – Scripts & Styles */

	// Head
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'code',
		'settings'			=>			'head_scripts',
		'section'			=>			'wpbf_header_scripts',
		'label'				=>			esc_attr__( 'Head Code', 'wpbfpremium' ),
		'description'		=>			esc_attr__( 'Runs inside the head tag.', 'wpbfpremium' ),
		'priority'			=>			1,
		'choices'			=>			array(
			'language'		=>			'html',
		),
	) );

	// Header
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'code',
		'settings'			=>			'header_scripts',
		'section'			=>			'wpbf_header_scripts',
		'label'				=>			esc_attr__( 'Header Code', 'wpbfpremium' ),
		'description'		=>			esc_attr__( 'Runs after the opening body tag.', 'wpbfpremium' ),
		'priority'			=>			2,
		'choices'			=>			array(
			'language'		=>			'html',
		),
	) );

	// Footer
	Kirki::add_field( 'wpbf', array(
		'type'				=>			'code',
		'settings'			=>			'footer_scripts',
		'section'			=>			'wpbf_footer_scripts',
		'label'				=>			esc_attr__( 'Footer Code', 'wpbfpremium' ),
		'description'		=>			esc_attr__( 'Add Scripts (Google Analytics, etc.) here. Runs before the closing body tag (wp_footer).', 'wpbfpremium' ),
		'priority'			=>			1,
		'choices'			=>			array(
			'language'		=>			'html',
		),
	) );

}
add_action( 'after_setup_theme', 'wpbf_kirki_premium' );

/**
 * Custom Controls
 */
function wpbf_custom_controls( $wp_customize ) {

	if( class_exists( 'WPBF_Customize_Responsive_Input_Slider' ) ) {

		// Sticky Navigation Logo Size
		$wp_customize->add_setting( 'menu_active_logo_size_desktop',
			array()
		);

		$wp_customize->add_setting( 'menu_active_logo_size_tablet',
			array()
		);

		$wp_customize->add_setting( 'menu_active_logo_size_mobile',
			array()
		);

		$wp_customize->add_control( new WPBF_Customize_Responsive_Input_Slider(
			$wp_customize,
			'menu_active_logo_size',
			array(
				'label'	=> esc_attr__( 'Logo Width', 'wpbfpremium' ),
				'section' => 'wpbf_sticky_menu_options',
				'settings' => 'menu_active_logo_size_desktop',
				'priority' => 3,
				'choices'			=>			array(
					'min'			=>			'0',
					'max'			=>			'500',
					'step'			=>			'1',
				),
				'active_callback' => function() { return get_theme_mod( 'custom_logo' ) && get_theme_mod( 'menu_sticky' ) ? true : false; }
			)
		));

		$wp_customize->add_control( new WPBF_Customize_Responsive_Input_Slider(
			$wp_customize,
			'menu_active_logo_size',
			array(
				'label'	=> esc_attr__( 'Logo Width', 'wpbfpremium' ),
				'section' => 'wpbf_sticky_menu_options',
				'settings' => 'menu_active_logo_size_tablet',
				'priority' => 3,
				'choices'			=>			array(
					'min'			=>			'0',
					'max'			=>			'500',
					'step'			=>			'1',
				),
				'active_callback' => function() { return get_theme_mod( 'custom_logo' ) && get_theme_mod( 'menu_sticky' ) ? true : false; }
			)
		));

		$wp_customize->add_control( new WPBF_Customize_Responsive_Input_Slider(
			$wp_customize,
			'menu_active_logo_size',
			array(
				'label'	=> esc_attr__( 'Logo Width', 'wpbfpremium' ),
				'section' => 'wpbf_sticky_menu_options',
				'settings' => 'menu_active_logo_size_mobile',
				'priority' => 3,
				'choices'			=>			array(
					'min'			=>			'0',
					'max'			=>			'500',
					'step'			=>			'1',
				),
				'active_callback' => function() { return get_theme_mod( 'custom_logo' ) && get_theme_mod( 'menu_sticky' ) ? true : false; }
			)
		));

	}

	// stop here if WPBF_Customize_Font_Size_Control class doesn't exist
	if( !class_exists( 'WPBF_Customize_Font_Size_Control' ) ) return;

	// Responsive Font Sizes (Text)
	$wp_customize->add_setting( 'page_font_size_desktop',
		array(
			'default' => '16px'
		)
	);

	$wp_customize->add_setting( 'page_font_size_tablet',
		array()
	);

	$wp_customize->add_setting( 'page_font_size_mobile',
		array()
	);

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_font_options',
			'settings' => 'page_font_size_desktop',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_font_options',
			'settings' => 'page_font_size_tablet',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_font_options',
			'settings' => 'page_font_size_mobile',
			'priority' => 2,
		)
	));

	// Responsive Font Sizes (H1)
	$wp_customize->add_setting( 'page_h1_font_size_desktop',
		array(
			'default' => '32px'
		)
	);

	$wp_customize->add_setting( 'page_h1_font_size_tablet',
		array()
	);

	$wp_customize->add_setting( 'page_h1_font_size_mobile',
		array()
	);

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h1_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h1_options',
			'settings' => 'page_h1_font_size_desktop',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h1_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h1_options',
			'settings' => 'page_h1_font_size_tablet',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h1_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h1_options',
			'settings' => 'page_h1_font_size_mobile',
			'priority' => 2,
		)
	));

	// Responsive Margin Settings (H1)
	// $wp_customize->add_setting( 'page_h1_margin_desktop',
	// 	array(
	// 		'default' => '20px'
	// 	)
	// );

	// $wp_customize->add_setting( 'page_h1_margin_tablet',
	// 	array()
	// );

	// $wp_customize->add_setting( 'page_h1_margin_mobile',
	// 	array()
	// );

	// $wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
	// 	$wp_customize,
	// 	'page_h1_margin',
	// 	array(
	// 		'label'	=> esc_attr__( 'Margin Bottom', 'wpbfpremium' ),
	// 		'section' => 'wpbf_h1_options',
	// 		'settings' => 'page_h1_margin_desktop',
	// 		'priority' => 2,
	// 	)
	// ));

	// $wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
	// 	$wp_customize,
	// 	'page_h1_margin',
	// 	array(
	// 		'label'	=> esc_attr__( 'Margin Bottom', 'wpbfpremium' ),
	// 		'section' => 'wpbf_h1_options',
	// 		'settings' => 'page_h1_margin_tablet',
	// 		'priority' => 2,
	// 	)
	// ));

	// $wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
	// 	$wp_customize,
	// 	'page_h1_margin',
	// 	array(
	// 		'label'	=> esc_attr__( 'Margin Bottom', 'wpbfpremium' ),
	// 		'section' => 'wpbf_h1_options',
	// 		'settings' => 'page_h1_margin_mobile',
	// 		'priority' => 2,
	// 	)
	// ));

	// Responsive Font Sizes (H2)
	$wp_customize->add_setting( 'page_h2_font_size_desktop',
		array(
			'default' => '28px'
		)
	);

	$wp_customize->add_setting( 'page_h2_font_size_tablet',
		array()
	);

	$wp_customize->add_setting( 'page_h2_font_size_mobile',
		array()
	);

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h2_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h2_options',
			'settings' => 'page_h2_font_size_desktop',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h2_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h2_options',
			'settings' => 'page_h2_font_size_tablet',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h2_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h2_options',
			'settings' => 'page_h2_font_size_mobile',
			'priority' => 2,
		)
	));

	// Responsive Font Sizes (H3)
	$wp_customize->add_setting( 'page_h3_font_size_desktop',
		array(
			'default' => '24px'
		)
	);

	$wp_customize->add_setting( 'page_h3_font_size_tablet',
		array()
	);

	$wp_customize->add_setting( 'page_h3_font_size_mobile',
		array()
	);

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h3_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h3_options',
			'settings' => 'page_h3_font_size_desktop',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h3_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h3_options',
			'settings' => 'page_h3_font_size_tablet',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h3_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h3_options',
			'settings' => 'page_h3_font_size_mobile',
			'priority' => 2,
		)
	));

	// Responsive Font Sizes (H4)
	$wp_customize->add_setting( 'page_h4_font_size_desktop',
		array(
			'default' => '20px'
		)
	);

	$wp_customize->add_setting( 'page_h4_font_size_tablet',
		array()
	);

	$wp_customize->add_setting( 'page_h4_font_size_mobile',
		array()
	);

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h4_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h4_options',
			'settings' => 'page_h4_font_size_desktop',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h4_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h4_options',
			'settings' => 'page_h4_font_size_tablet',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h4_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h4_options',
			'settings' => 'page_h4_font_size_mobile',
			'priority' => 2,
		)
	));

	// Responsive Font Sizes (H5)
	$wp_customize->add_setting( 'page_h5_font_size_desktop',
		array(
			'default' => '16px'
		)
	);

	$wp_customize->add_setting( 'page_h5_font_size_tablet',
		array()
	);

	$wp_customize->add_setting( 'page_h5_font_size_mobile',
		array()
	);

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h5_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h5_options',
			'settings' => 'page_h5_font_size_desktop',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h5_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h5_options',
			'settings' => 'page_h5_font_size_tablet',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h5_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h5_options',
			'settings' => 'page_h5_font_size_mobile',
			'priority' => 2,
		)
	));

	// Responsive Font Sizes (H6)
	$wp_customize->add_setting( 'page_h6_font_size_desktop',
		array(
			'default' => '16px'
		)
	);

	$wp_customize->add_setting( 'page_h6_font_size_tablet',
		array()
	);

	$wp_customize->add_setting( 'page_h6_font_size_mobile',
		array()
	);

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h6_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h6_options',
			'settings' => 'page_h6_font_size_desktop',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h6_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h6_options',
			'settings' => 'page_h6_font_size_tablet',
			'priority' => 2,
		)
	));

	$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
		$wp_customize,
		'page_h6_font_size',
		array(
			'label'	=> esc_attr__( 'Font Size', 'wpbfpremium' ),
			'section' => 'wpbf_h6_options',
			'settings' => 'page_h6_font_size_mobile',
			'priority' => 2,
		)
	));

	/* Blog Layouts */

	$archives = apply_filters( 'wpbf_archives', array( 'archive' ) );

	// Grid
	foreach ( $archives as $archive ) {

		$priority = 110;

		$wp_customize->add_setting( $archive . '_grid_mobile',
			array(
				'default' => '1',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_setting( $archive . '_grid_tablet',
			array(
				'default' => '2',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_setting( $archive . '_grid_desktop',
			array(
				'default' => '3',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
			$wp_customize,
			$archive . '_grid',
			array(
				'label'	=> esc_attr__( 'Posts per Row', 'wpbfpremium' ),
				'section' => 'wpbf_' . $archive . '_options',
				'settings' => $archive . '_grid_desktop',
				'priority' => $priority++,
				'active_callback' => function() use ($archive) { return get_theme_mod( $archive . '_layout' ) == 'grid' ? true : false; },
			)
		));

		$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
			$wp_customize,
			$archive . '_grid',
			array(
				'label'	=> esc_attr__( 'Posts per Row', 'wpbfpremium' ),
				'section' => 'wpbf_' . $archive . '_options',
				'settings' => $archive . '_grid_tablet',
				'priority' => $priority++,
				'active_callback' => function() use ($archive) { return get_theme_mod( $archive . '_layout' ) == 'grid' ? true : false; },
			)
		));

		$wp_customize->add_control( new WPBF_Customize_Font_Size_Control(
			$wp_customize,
			$archive . '_grid',
			array(
				'label'	=> esc_attr__( 'Posts per Row', 'wpbfpremium' ),
				'section' => 'wpbf_' . $archive . '_options',
				'settings' => $archive . '_grid_mobile',
				'priority' => $priority++,
				'active_callback' => function() use ($archive) { return get_theme_mod( $archive . '_layout' ) == 'grid' ? true : false; },
			)
		));

	}

}
add_action( 'customize_register' , 'wpbf_custom_controls' );