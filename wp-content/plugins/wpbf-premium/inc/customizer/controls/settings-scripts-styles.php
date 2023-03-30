<?php
/**
 * Scripts & Styles customizer settings.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/* Panel */

// Scripts.
Kirki::add_panel( 'scripts_panel', array(
	'priority' => 6,
	'title'    => __( 'Scripts & Styles', 'wpbfpremium' ),
) );

/* Sections */

// Header.
Kirki::add_section( 'wpbf_header_scripts', array(
	'title'    => __( 'Header', 'wpbfpremium' ),
	'panel'    => 'scripts_panel',
	'priority' => 100,
) );

// Footer.
Kirki::add_section( 'wpbf_footer_scripts', array(
	'title'    => __( 'Footer', 'wpbfpremium' ),
	'panel'    => 'scripts_panel',
	'priority' => 200,
) );

/* Fields */

// Head.
Kirki::add_field( 'wpbf', array(
	'type'        => 'code',
	'settings'    => 'head_scripts',
	'section'     => 'wpbf_header_scripts',
	'label'       => __( 'Head Code', 'wpbfpremium' ),
	'description' => __( 'Runs inside the head tag.', 'wpbfpremium' ),
	'priority'    => 1,
	'choices'     => array(
		'language' => 'html',
	),
) );

// Header.
Kirki::add_field( 'wpbf', array(
	'type'        => 'code',
	'settings'    => 'header_scripts',
	'section'     => 'wpbf_header_scripts',
	'label'       => __( 'Header Code', 'wpbfpremium' ),
	'description' => __( 'Runs after the opening body tag.', 'wpbfpremium' ),
	'priority'    => 2,
	'choices'     => array(
		'language' => 'html',
	),
) );

// Footer.
Kirki::add_field( 'wpbf', array(
	'type'        => 'code',
	'settings'    => 'footer_scripts',
	'section'     => 'wpbf_footer_scripts',
	'label'       => __( 'Footer Code', 'wpbfpremium' ),
	'description' => __( 'Add Scripts (Google Analytics, etc.) here. Runs before the closing body tag (wp_footer hook).', 'wpbfpremium' ),
	'priority'    => 1,
	'choices'     => array(
		'language' => 'html',
	),
) );
