<?php
/**
 * Premium Add-On customizer settings.
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

function wpbf_kirki_premium() {

	// Load customizer helpers & setup.
	// We do this outside the conditional logic to make sure it is always available.
	// One function in here is used on the frontend so it must exist.
	require_once WPBF_PREMIUM_DIR . 'inc/customizer/controls/settings-helpers.php';

	// Stop if Kirki doesn't exist.
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	// Only load customizer settings if we are above or equal the minimum required version.
	if ( ! version_compare( WPBF_VERSION, WPBF_MIN_VERSION, '>=' ) ) {
		return;
	}

	// Make sure we can call is_plugin_active.
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
	}

	// Load textdomain. This is required to make strings translatable.
	load_plugin_textdomain( 'wpbfpremium', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

	// Load customizer settings.
	require_once WPBF_PREMIUM_DIR . 'inc/customizer/controls/settings-scripts-styles.php';
	require_once WPBF_PREMIUM_DIR . 'inc/customizer/controls/settings-typography.php';
	require_once WPBF_PREMIUM_DIR . 'inc/customizer/controls/settings-general.php';
	require_once WPBF_PREMIUM_DIR . 'inc/customizer/controls/settings-header.php';
	require_once WPBF_PREMIUM_DIR . 'inc/customizer/controls/settings-blog-layouts.php';
	require_once WPBF_PREMIUM_DIR . 'inc/customizer/controls/settings-footer.php';

}
add_action( 'after_setup_theme', 'wpbf_kirki_premium', 9 );
