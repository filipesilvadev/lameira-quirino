<?php
/**
 * Init
 *
 * @package Page_Builder_Framework_Premium_Add_On
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Theme Settings Page
 */
function wpbf_premium_menu() {
	add_theme_page( __( 'Theme Settings', 'wpbfpremium' ), __( 'Theme Settings', 'wpbfpremium' ), 'manage_options', 'wpbf-premium', 'wpbf_premium_settings' );
}
add_action( 'admin_menu', 'wpbf_premium_menu' );

/**
 * Premium Settings
 */
function wpbf_premium_settings() {
	require_once WPBF_PREMIUM_DIR . 'inc/settings/wpbf-settings-template.php';
}

/**
 * Admin Scripts & Styles
 */
function wpbf_premium_admin_scripts() {
	global $pagenow;

	// phpcs:ignore -- just checking
	if ( 'themes.php' === $pagenow && isset( $_GET['page'] ) ) {

		// phpcs:ignore -- just checking
		if ( 'wpbf-premium' !== $_GET['page'] ) {
			return;
		}

		wp_enqueue_style( 'wpbf-premium-settings', WPBF_PREMIUM_URI . 'assets/css/wpbf-premium-admin.css', array(), WPBF_PREMIUM_VERSION );
		wp_enqueue_script( 'wpbf-premium-settings', WPBF_PREMIUM_URI . 'js/wpbf-premium-admin.js', array( 'jquery' ), WPBF_PREMIUM_VERSION, true );

	}

}
add_action( 'admin_enqueue_scripts', 'wpbf_premium_admin_scripts' );

/**
 * Change Inline Style Location
 */
function wpbf_premium_change_inline_style_location() {
	return 'wpbf-premium';
}
add_filter( 'wpbf_add_inline_style', 'wpbf_premium_change_inline_style_location' );

// kirki.
require_once WPBF_PREMIUM_DIR . 'inc/customizer/wpbf-kirki.php';

// Custom Fonts.
require_once WPBF_PREMIUM_DIR . 'inc/customizer/custom-fonts.php';

// Adobe Fonts Integration.
require_once WPBF_PREMIUM_DIR . 'inc/customizer/adobe-fonts.php';

// Custom Controls.
require_once WPBF_PREMIUM_DIR . 'inc/customizer/custom-controls.php';

// Customizer Functions.
require_once WPBF_PREMIUM_DIR . 'inc/customizer/customizer-functions.php';

// Styles.
require_once WPBF_PREMIUM_DIR . 'inc/customizer/styles.php';

// Responsive Styles.
require_once WPBF_PREMIUM_DIR . 'inc/customizer/responsive.php';

// Options.
require_once WPBF_PREMIUM_DIR . 'inc/settings/options.php';

// Premium Settings.
require_once WPBF_PREMIUM_DIR . 'inc/settings/wpbf-global-settings.php';

// Settings Output.
require_once WPBF_PREMIUM_DIR . 'inc/settings/wpbf-global-functions.php';

// Body Classes.
require_once WPBF_PREMIUM_DIR . 'inc/body-classes.php';

// Blog Layouts.
require_once WPBF_PREMIUM_DIR . 'inc/blog-layouts.php';

// Helpers.
require_once WPBF_PREMIUM_DIR . 'inc/helpers.php';

// Theme Mods.
require_once WPBF_PREMIUM_DIR . 'inc/theme-mods.php';

/* Integration */

// Customizer Import Export.
require_once WPBF_PREMIUM_DIR . 'inc/integration/customizer-import-export.php';

// Custom Sections.
require_once WPBF_PREMIUM_DIR . 'inc/class-custom-sections.php';

/**
 * Plugins Loaded
 *
 * @return void
 */
function wpbf_premium_plugins_loaded() {

	// Beaver Themer.
	require_once WPBF_PREMIUM_DIR . 'inc/integration/beaver-themer.php';

	// WooCommerce.
	require_once WPBF_PREMIUM_DIR . '/inc/integration/woocommerce.php';

}
add_action( 'plugins_loaded', 'wpbf_premium_plugins_loaded' );

/**
 * Elementor Integration
 *
 * @return void
 */
function wpbf_elementor_integration() {
	require_once WPBF_PREMIUM_DIR . 'inc/integration/elementor.php';
}
add_action( 'elementor/init', 'wpbf_elementor_integration' );

/**
 * Elementor Pro Integration
 *
 * @return void
 */
function wpbf_elementor_pro_integration() {
	require_once WPBF_PREMIUM_DIR . 'inc/integration/elementor-pro.php';
}
add_action( 'elementor_pro/init', 'wpbf_elementor_pro_integration' );
