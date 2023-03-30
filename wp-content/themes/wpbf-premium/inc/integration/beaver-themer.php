<?php
/**
 * Beaver Themer
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// stop here if Beaver Builder & Beaver Themer aren't active
if( !class_exists( 'FLThemeBuilderLoader' ) || !class_exists( 'FLBuilderLoader' ) ) return;

/**
 * Add Beaver Themer Header/Footer Support
 */
function wpbf_bb_header_footer_support() {

	add_theme_support( 'fl-theme-builder-headers' );
	add_theme_support( 'fl-theme-builder-footers' );
	add_theme_support( 'fl-theme-builder-parts' );

}
add_action( 'after_setup_theme', 'wpbf_bb_header_footer_support' );

/**
 * Remove Headers
 */
function wpbf_header_footer_render() {

	// Get the header ID.
	$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();
	
	// If we have a header, remove the theme header and hook in Theme Builder's.
	if ( ! empty( $header_ids ) ) {
		remove_action( 'wpbf_header', 'wpbf_do_header' );
		add_action( 'wpbf_header', 'FLThemeBuilderLayoutRenderer::render_header' );
	}
	
	// Get the footer ID.
	$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();
	
	// If we have a footer, remove the theme footer and hook in Theme Builder's.
	if ( ! empty( $footer_ids ) ) {
		remove_action( 'wpbf_footer', 'wpbf_do_footer' );
		add_action( 'wpbf_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
	}

}
add_action( 'wp', 'wpbf_header_footer_render' );

/**
 * Parts
 */
function wpbf_register_part_hooks() {
	
	return array(
		array(
			'label' => 'Page',
			'hooks' => array(
				'wpbf_body_open' => 'Page Open',
				'wpbf_body_close'  => 'Page Close',
			)
		),
		array(
			'label' => 'Header',
			'hooks' => array(
				'wpbf_before_header' => 'Before Header',
				'wpbf_after_header'  => 'After Header',
				'wpbf_header_open' => 'Header Open',
				'wpbf_header_close'  => 'Header Close',
			)
		),
		array(
			'label' => 'Footer',
			'hooks' => array(
				'wpbf_before_footer' => 'Before Footer',
				'wpbf_after_footer'  => 'After Footer',
				'wpbf_footer_open' => 'Footer Open',
				'wpbf_footer_close'  => 'Footer Close',
			)
		),
	);
}
add_filter( 'fl_theme_builder_part_hooks', 'wpbf_register_part_hooks' );

/**
 * Remove Header if selected in the Theme
 */
function wpbf_remove_beaver_themer_header() {

	// don't take it further if we're on archives
	if( !is_singular() ) return;

	$options		= get_post_meta( get_the_ID(), 'wpbf_options', true );
	$remove_header	= $options ? in_array( 'remove-header', $options ) : false;

	if( $remove_header ) {
		remove_action( 'wpbf_header', 'FLThemeBuilderLayoutRenderer::render_header' );
	}

}
add_action( 'wp', 'wpbf_remove_beaver_themer_header' );

/**
 * Remove Footer if selected in the Theme
 */
function wpbf_remove_beaver_themer_footer() {

	// don't take it further if we're on archives
	if( !is_singular() ) return;

	$options		= get_post_meta( get_the_ID(), 'wpbf_options', true );
	$remove_footer	= $options ? in_array( 'remove-footer', $options ) : false;

	if( $remove_footer ) {
		remove_action( 'wpbf_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
	}

}
add_action( 'wp', 'wpbf_remove_beaver_themer_footer' );