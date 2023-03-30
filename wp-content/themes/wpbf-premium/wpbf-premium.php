<?php
/**
 * Plugin Name: Page Builder Framework Premium Addon
 * Plugin URI: https://wp-pagebuilderframework.com
 * Description: Premium Add-On for Page Builder Framework
 * Version: 2.1.0.2
 * Author: David Vongries
 * Author URI: https://mapsteps.com
 * Text Domain: wpbfpremium
 *
 * @package Page_Builder_Framework_Premium_Add_On
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Constants.
define( 'WPBF_PREMIUM_THEME_DIR', get_template_directory() );
define( 'WPBF_PREMIUM_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPBF_PREMIUM_TEMPLATES_DIR', plugin_dir_path( __FILE__ ) . 'inc/templates/' );
define( 'WPBF_PREMIUM_URI', plugin_dir_url( __FILE__ ) );
define( 'WPBF_PREMIUM_LICENSE_PAGE', 'wpbf-premium&tab=license' );
define( 'WPBF_PREMIUM_STORE_URL', 'https://wp-pagebuilderframework.com' );
define( 'WPBF_PREMIUM_THEME_NAME', 'Page Builder Framework' );
define( 'WPBF_PREMIUM_PLUGIN_NAME', 'Page Builder Framework Premium Addon' );
define( 'WPBF_PREMIUM_ITEM_ID', 8707 );
define( 'WPBF_PREMIUM_VERSION', '2.1.0.2' );

/**
 * Plugin Updater
 */
if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include dirname( __FILE__ ) . '/assets/edd/EDD_SL_Plugin_Updater.php';
}

/**
 * Plugin Updater
 *
 * @return void
 */
function wpbf_premium_plugin_updater() {

	$license_key = trim( get_option( 'wpbf_premium_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater(
		WPBF_PREMIUM_STORE_URL,
		__FILE__,
		array(
			'version' => WPBF_PREMIUM_VERSION,
			'license' => $license_key,
			'item_id' => WPBF_PREMIUM_ITEM_ID,
			'author'  => 'David Vongries',
			'beta'    => false,
		)
	);

}
add_action( 'admin_init', 'wpbf_premium_plugin_updater', 0 );

/**
 * Load Textdomain
 */
function wpbf_premium_textdomain() {
	load_plugin_textdomain( 'wpbfpremium', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'wpbf_premium_textdomain' );

// PAnD.
require_once WPBF_PREMIUM_DIR . 'assets/pand/persist-admin-notices-dismissal.php';

/**
 * Plugin Activation
 */
function wpbf_premium_activation() {

	// phpcs:ignore -- 'true' string is ok here.
	if ( ! current_user_can( 'activate_plugins' ) || 'true' == get_option( 'wpbf_premium_plugin_activated' ) ) {
		return;
	}

	add_option( 'wpbf_premium_install_date', current_time( 'mysql' ) );
	add_option( 'wpbf_premium_plugin_activated', 'true' );

}
add_action( 'init', 'wpbf_premium_activation' );

/**
 * Helper Transients
 */
$theme = wp_get_theme();

// Set Transient if Page Builder Framework is not active.
if ( 'Page Builder Framework' === $theme->name || 'Page Builder Framework' === $theme->parent_theme ) {

	delete_transient( 'wpbf_not_active' );

} else {

	set_transient( 'wpbf_not_active', true );

}

// Set Transient if old version of Page Builder Framework is active.
if ( 'wpbf' === $theme->get( 'TextDomain' ) || 'wpbf' === $theme->get( 'Template' ) ) {

	set_transient( 'wpbf_old_theme', true );

} else {

	delete_transient( 'wpbf_old_theme' );

}

/**
 * Get License Expiration Date
 */
function wpbf_premium_get_expiration_date() {

	$license_key = trim( get_option( 'wpbf_premium_license_key' ) );

	// return false if we don't have a license key.
	if ( ! $license_key ) {
		return false;
	}

	$url = home_url();
	$api = "https://wp-pagebuilderframework.com/?edd_action=check_license&item_id=8707&license={$license_key}&url={$url}";

	$request = wp_remote_get( $api );

	// return false if we have an error.
	if ( is_wp_error( $request ) ) {
		return false;
	}

	$body = wp_remote_retrieve_body( $request );

	$data = json_decode( $body, true );

	$expiration = isset( $data['expires'] ) ? $data['expires'] : false;

	return $expiration;

}

/**
 * Save Expiration Date in Transient
 */
if ( ! get_transient( 'wpbf_expiration_date' ) ) {

	$expiration_date = wpbf_premium_get_expiration_date();

	if ( false !== $expiration_date ) {

		if ( 'lifetime' === $expiration_date ) {
			set_transient( 'wpbf_expiration_date', $expiration_date, 7 * DAY_IN_SECONDS );
		} else {
			set_transient( 'wpbf_expiration_date', $expiration_date, 2 * MINUTE_IN_SECONDS );
		}
	}
}

/**
 * Admin Notices
 */
function wpbf_premium_admin_notices() {

	$expiration_date = get_transient( 'wpbf_expiration_date' );

	// License Expiration Message.
	if ( 'lifetime' !== $expiration_date && $expiration_date ) {
		$expiration_time = strtotime( $expiration_date );

		$notification_expiration_time = strtotime( '-28 days', $expiration_time );

		if ( $notification_expiration_time <= current_time( 'timestamp' ) ) {

			$class       = 'notice notice-error';
			$license_key = trim( get_option( 'wpbf_premium_license_key' ) );
			$renew_url   = 'https://wp-pagebuilderframework.com/checkout/?edd_license_key=' . $license_key . '&download_id=8707';
			$plugin_name = apply_filters( 'wpbf_premium_plugin_name', WPBF_PREMIUM_PLUGIN_NAME );
			// translators: %1%s: time diff string, %2$s: url string.
			$description = sprintf( __( 'Your License expires in <strong>%1$s</strong>. <a href="%2$s" target="_blank">Renew your License</a> to keep getting Feature Updates & Premium Support.', 'wpbfpremium' ), human_time_diff( current_time( 'timestamp' ), $expiration_time ), $renew_url );

			// translators: %1%s: class name, %2$s: plugin name, %3$s: license information.
			printf( '<div class="%1$s"><p><strong>%2$s</strong><br>%3$s</p></div>', $class, $plugin_name, $description ); // phpcs:ignore -- is ok, since we use printf

		}
	}

	// Stop here if current user cannot manage options.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Notice if Premium Add-On is active but Page Builder Framework is not installed/activated.
	if ( ( get_transient( 'wpbf_not_active' ) ) ) {

		$class       = 'notice notice-error';
		$plugin_name = apply_filters( 'wpbf_premium_plugin_name', WPBF_PREMIUM_PLUGIN_NAME );
		$theme_name  = apply_filters( 'wpbf_premium_plugin_name', WPBF_PREMIUM_THEME_NAME );
		// translators: %1$s: theme name, %2$s: plugin name.
		$message = sprintf( __( 'You need to install/activate the <strong>%1$s</strong> theme for <strong>%2$s</strong> to work!', 'wpbfpremium' ), $theme_name, $plugin_name );

		// translators: %1$s: class name, %2$s: text.
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); // phpcs:ignore -- is ok, since we use printf

	}

	// Migration notice if old version of Page Builder Framework is installed.
	if ( ( get_transient( 'wpbf_old_theme' ) ) ) {

		$class           = 'notice notice-error';
		$caution_button  = '<span style="text-transform:uppercase; background: #dc3232; border-radius:3px; color: #fff; padding: 10px 15px; font-size: 12px; margin-right: 5px; display: inline-block;">Caution!</span>';
		$migration_guide = '<a href="https://wp-pagebuilderframework.com/docs/migration-guide/" target="_blank">Migration Guide</a>';
		// translators: %1$s: caution button, %2$s: migration guide.
		$message = sprintf( __( '%1$s Action required! Please update Page Builder Framework to the latest version. For help, please have a look at the %2$s.', 'wpbfpremium' ), $caution_button, $migration_guide );
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); // phpcs:ignore -- is safe.

	}

	// Stop here if we are on a Multisite installation and not on the main site.
	if ( is_multisite() && ! is_main_site() ) {
		return;
	}

	// License Key Activation Notice.
	$status = get_option( 'wpbf_premium_license_status' );

	if ( 'valid' !== $status ) {

		$class            = 'notice notice-error';
		$license_page_url = get_admin_url() . 'themes.php?page=' . WPBF_PREMIUM_LICENSE_PAGE . '';
		$docs_url         = 'https://wp-pagebuilderframework.com/docs-category/installation/';
		$plugin_name      = apply_filters( 'wpbf_premium_plugin_name', WPBF_PREMIUM_PLUGIN_NAME );
		// translators: %1$s: license page url, %2$s: plugin name, %3$s: documentation url.
		$description = sprintf( __( 'Please <a href="%1$s">activate your license key</a> to receive updates for <strong>%2$s</strong>. <a href="%3$s" target="_blank">Help</a>', 'wpbfpremium' ), $license_page_url, $plugin_name, $docs_url );

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $description ); // phpcs:ignore -- is safe.

	}

	// Stop here if Review Notice has been disabled manually or by White Label Settings.
	if ( ! apply_filters( 'wpbf_premium_review_notice', true ) ) {
		return;
	}

	// Stop here if Review Notice has been dismissed.
	if ( ! PAnD::is_admin_notice_active( 'review-theme-notice-forever' ) ) {
		return;
	}

	// Review Notice.
	$install_date = get_option( 'wpbf_premium_install_date', '' );

	if ( empty( $install_date ) ) {
		return;
	}

	$diff = round( ( time() - strtotime( $install_date ) ) / 24 / 60 / 60 );

	if ( $diff < 5 ) {
		return;
	}

	$emoji      = '😍';
	$review_url = 'https://wordpress.org/support/theme/page-builder-framework/reviews/?rate=5#new-post';
	$link_start = '<a href="' . $review_url . '" target="_blank">';
	$link_end   = '</a>';
	// translators: %1$s: emoji, %2$s: link start tag, %3$s: link end tag.
	$notice   = sprintf( __( '%1$s Love using Page Builder Framework? - That\'s Awesome! Help us spread the word and leave us a %2$s 5-star review %3$s in the WordPress repository.', 'wpbfpremium' ), $emoji, $link_start, $link_end );
	$btn_text = __( 'Sure! You deserve it!', 'wpbfpremium' );
	$notice  .= '<br/>';
	$notice  .= "<a href=\"$review_url\" style=\"margin-top: 15px;\" target='_blank' class=\"button-primary\">$btn_text</a>";

	echo '<div data-dismissible="review-theme-notice-forever" class="notice notice-success is-dismissible">';
	echo '<p>' . $notice . '</p>'; // phpcs:ignore -- is safe.
	echo '</div>';

}
add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'wpbf_premium_admin_notices' );

/**
 * Plugin Deactivation
 */
function wpbf_premium_deactivation() {

	delete_transient( 'wpbf_not_active' );
	delete_transient( 'wpbf_old_theme' );
	delete_transient( 'wpbf_expiration_date' );
	delete_option( 'wpbf_premium_install_date' );
	delete_option( 'wpbf_premium_plugin_activated' );

}
register_deactivation_hook( __FILE__, 'wpbf_premium_deactivation' );

// Stop here if Page Builder Framework is not active.
if ( get_transient( 'wpbf_not_active' ) ) {
	return;
}

/**
 * Scripts & Styles
 */
function wpbf_premium_scripts() {

	// Premium Add-On Styles.
	wp_enqueue_style( 'wpbf-premium', WPBF_PREMIUM_URI . 'css/wpbf-premium.css', '', WPBF_PREMIUM_VERSION );

	// Premium Add-On Scripts.
	wp_enqueue_script( 'wpbf-premium', WPBF_PREMIUM_URI . 'js/site.js', array( 'jquery' ), WPBF_PREMIUM_VERSION, true );

	if ( get_theme_mod( 'menu_sticky' ) ) {

		// Sticky Navigation.
		wp_enqueue_script( 'wpbf-sticky-navigation', WPBF_PREMIUM_URI . 'assets/js/sticky-navigation.js', array( 'jquery', 'wpbf-site' ), WPBF_PREMIUM_VERSION, true );

	}

	if ( in_array( get_theme_mod( 'menu_position' ), array( 'menu-off-canvas', 'menu-off-canvas-left' ), true ) ) {

		// Off Canvas.
		wp_enqueue_script( 'wpbf-menu-off-canvas', WPBF_PREMIUM_URI . 'assets/js/off-canvas.js', array( 'jquery', 'wpbf-site' ), WPBF_PREMIUM_VERSION, true );

	}

	if ( 'menu-full-screen' === get_theme_mod( 'menu_position' ) ) {

		// Full Screen.
		wp_enqueue_script( 'wpbf-menu-full-screen', WPBF_PREMIUM_URI . 'assets/js/full-screen.js', array( 'jquery', 'wpbf-site' ), WPBF_PREMIUM_VERSION, true );

	}

	if ( 'menu-mobile-off-canvas' === get_theme_mod( 'mobile_menu_options' ) ) {

		// Full Screen Mobile.
		wp_enqueue_script( 'wpbf-mobile-menu-off-canvas', WPBF_PREMIUM_URI . 'assets/js/mobile-off-canvas.js', array( 'jquery', 'wpbf-site' ), WPBF_PREMIUM_VERSION, true );

	}

	if ( in_array( get_theme_mod( 'sub_menu_animation' ), array( 'zoom-in', 'zoom-out' ), true ) ) {

		// jQuery Transit.
		wp_enqueue_script( 'wpbf-sub-menu-animation', WPBF_PREMIUM_URI . 'assets/js/jquery.transit.min.js', array( 'jquery', 'wpbf-site' ), '0.9.12', true );

	}

}
add_action( 'wp_enqueue_scripts', 'wpbf_premium_scripts', 11 );

/**
 * Init
 */
require_once WPBF_PREMIUM_DIR . 'inc/init.php';
require_once WPBF_PREMIUM_DIR . 'assets/edd/license.php';
