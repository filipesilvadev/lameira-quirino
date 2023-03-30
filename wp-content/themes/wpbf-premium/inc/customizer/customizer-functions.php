<?php
/**
 * Customizer Functions
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Post Message
 */
function wpbf_premium_customizer_js() {
	wp_enqueue_script( 'wpbf-premium-postmessage', WPBF_PREMIUM_URI . 'inc/customizer/js/postmessage.js', array(  'jquery', 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init' , 'wpbf_premium_customizer_js' );

/**
 * Customizer Scripts & Styles
 */
function wpbf_premium_customizer_scripts_styles() {
	wp_enqueue_script( 'wpbf-premium-customizer', WPBF_PREMIUM_URI . '/inc/customizer/js/wpbf-customizer.js', array( 'jquery' ), false, true );
}
add_action( 'customize_controls_print_styles' , 'wpbf_premium_customizer_scripts_styles' );

/**
 * Premium Add-On Menu Variations
 */
add_filter( 'wpbf_menu_position', function( $choices ) {

	$choices['menu-stacked-advanced'] = esc_attr__( 'Stacked (advanced)', 'wpbfpremium' );
	$choices['menu-off-canvas']       = esc_attr__( 'Off Canvas (right)', 'wpbfpremium' );
	$choices['menu-off-canvas-left']  = esc_attr__( 'Off Canvas (left)', 'wpbfpremium' );
	$choices['menu-full-screen']      = esc_attr__( 'Full Screen', 'wpbfpremium' );
	$choices['menu-elementor']        = esc_attr__( 'Custom Menu', 'wpbfpremium' );

	return $choices;

});

/**
 * Premium Add-On Mobile Menu Variations
 */
add_filter( 'wpbf_mobile_menu_options', function( $choices ) {

	$choices['menu-mobile-off-canvas'] = esc_attr__( 'Off Canvas', 'wpbfpremium' );
	$choices['menu-mobile-elementor']  = esc_attr__( 'Custom Menu', 'wpbfpremium' );

	return $choices;

});

/**
 * Allow Font Uploads
 */
function wpbf_add_custom_upload_mimes( $mime_types ) {

	$mime_types['otf']   = 'application/x-font-otf';
	$mime_types['woff']  = 'application/x-font-woff';
	$mime_types['woff2'] = 'application/x-font-woff2';
	$mime_types['ttf']   = 'application/x-font-ttf';
	$mime_types['svg']   = 'image/svg+xml';
	$mime_types['eot']   = 'application/vnd.ms-fontobject';

	return $mime_types;

}
add_filter( 'upload_mimes', 'wpbf_add_custom_upload_mimes', 0 );