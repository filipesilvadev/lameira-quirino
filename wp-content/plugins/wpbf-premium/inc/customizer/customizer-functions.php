<?php
/**
 * Customizer functions.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Post message script.
 *
 * Add post message script to customizer.
 */
function wpbf_premium_customizer_js() {
	wp_enqueue_script( 'wpbf-premium-postmessage', WPBF_PREMIUM_URI . 'inc/customizer/js/postmessage.js', array( 'jquery', 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'wpbf_premium_customizer_js' );

/**
 * Customizer scripts & styles.
 */
function wpbf_premium_customizer_scripts_styles() {

	// We don't currently need that but keep it in case we want to add custom JS to the customizer.
	// wp_enqueue_script( 'wpbf-premium-customizer', WPBF_PREMIUM_URI . '/inc/customizer/js/wpbf-customizer.js', array( 'jquery' ), false, true );

	// Add custom color palette.
	$colors = wpbf_color_palette();

	// Stop if no custom colors are selected.
	if ( empty( $colors ) ) {
		return;
	}

	$colors = wp_json_encode( wpbf_color_palette() );

	wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $colors . ';' );

}
add_action( 'customize_controls_print_styles', 'wpbf_premium_customizer_scripts_styles' );

/**
 * Add Premium Add-On menu variations.
 *
 * @param array $choices The menu variations.
 *
 * @return array The updated menu variations.
 */
add_filter( 'wpbf_menu_position', function ( $choices ) {

	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
	}

	$choices['menu-stacked-advanced'] = esc_attr__( 'Stacked (Advanced)', 'wpbfpremium' );
	// $choices['menu-vertical-left']    = esc_attr__( 'Vertical (left)', 'wpbfpremium' );
	$choices['menu-off-canvas']      = esc_attr__( 'Off Canvas (Right)', 'wpbfpremium' );
	$choices['menu-off-canvas-left'] = esc_attr__( 'Off Canvas (Left)', 'wpbfpremium' );
	$choices['menu-full-screen']     = esc_attr__( 'Full Screen', 'wpbfpremium' );

	if ( is_plugin_active( 'bb-plugin/fl-builder.php' ) || is_plugin_active( 'elementor-pro/elementor-pro.php' ) ) {
		$choices['menu-elementor'] = esc_attr__( 'Custom Menu', 'wpbfpremium' );
	}

	return $choices;

} );

/**
 * Add Premium Add-On mobile menu variations.
 *
 * @param array $choices The menu variations.
 *
 * @return array The updated menu variations.
 */
add_filter( 'wpbf_mobile_menu_options', function ( $choices ) {

	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
	}

	$choices['menu-mobile-off-canvas'] = esc_attr__( 'Off Canvas', 'wpbfpremium' );

	if ( is_plugin_active( 'bb-plugin/fl-builder.php' ) || is_plugin_active( 'elementor-pro/elementor-pro.php' ) ) {
		$choices['menu-mobile-elementor'] = esc_attr__( 'Custom Menu', 'wpbfpremium' );
	}

	return $choices;

} );

/**
 * Allow font uploads.
 *
 * @param array $mime_types The mime types.
 *
 * @return array The updated mime types.
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

if ( ! function_exists( 'wpbf_get_theme_mod_value' ) ) {

	/**
	 * Helper function to get theme_mod array values by key.
	 *
	 * @param array $array The decoded theme_mod array.
	 * @param string $key The array key.
	 * @param boolean $default The default to check against.
	 * @param booleon $print_default Wether the default value should be returned.
	 *
	 * @return mixed The key value.
	 */
	function wpbf_get_theme_mod_value( $array, $key, $default = false, $print_default = false ) {

		// Stop here if we have no array and we don't want to print a default.
		if ( ! $array && ! $print_default ) {
			return false;
		}

		// Initialize value.
		$value = false;

		// If we want to return a default, let's adjust the value.
		if ( $default && $print_default ) {
			$value = $default;
		}

		// Get & set the value by key if we have one.
		$value = isset( $array[$key] ) ? $array[$key] : $value;

		// If we don't want to return a default and the saved
		// value matches default, we set value back to false.
		if ( $default && ! $print_default ) {
			$value = $default === $value ? false : $value;
		}

		return $value;

	}

}
