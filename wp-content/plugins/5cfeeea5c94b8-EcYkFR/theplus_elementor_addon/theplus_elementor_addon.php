<?php
/*
* Plugin Name: The Plus Addons for Elementor Page Builder
* Plugin URI: https://elementor.theplusaddons.com/
* Description: Ultimate collection of Addons for Elementor Page Builder and proudly developed by POSIMYTH Themes Team.
* Version: 1.4.3
* Author: POSIMYTH Themes
* Author URI: http://posimyththemes.com
* Text Domain: theplus
* Elementor tested up to: 2.5.11
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
defined( 'THEPLUS_VERSION' ) or define( 'THEPLUS_VERSION', '1.4.3' );
define( 'THEPLUS_FILE__', __FILE__ );

define( 'THEPLUS_PATH', plugin_dir_path( __FILE__ ) );
define( 'THEPLUS_PBNAME', plugin_basename(__FILE__) );
define( 'THEPLUS_PNAME', basename( dirname(__FILE__)) );
define( 'THEPLUS_URL', plugins_url( '/', __FILE__ ) );
define( 'THEPLUS_ASSETS_URL', THEPLUS_URL . 'assets/' );
define( 'THEPLUS_INCLUDES_URL', THEPLUS_PATH . 'includes/' );
define( 'THEPLUS_TYPE', 'code' );



/* theplus language plugins loaded */
function theplus_pluginsLoaded() {
	load_plugin_textdomain( 'theplus', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'theplus_elementor_load_notice' );
		return;
	}
	// Elementor widget loader
	if(THEPLUS_TYPE=='store'){
		add_action( 'admin_init', 'theplus_plugin_updater', 0 );
	}
    require( THEPLUS_PATH . 'widgets_loader.php' );
}
add_action( 'plugins_loaded', 'theplus_pluginsLoaded' );

/* theplus elementor load notice */
function theplus_elementor_load_notice() {	
	$plugin = 'elementor/elementor.php';	
	if ( theplus_elementor_activated() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) { return; }
		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
		$admin_notice = '<p>' . esc_html__( 'Something Missing : It\'s Elementor. You already installed that, Please activate Elementor, Unless The Plus Addons will not be working.', 'theplus' ) . '</p>';
		$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'theplus' ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) { return; }
		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		$admin_notice = '<p>' . esc_html__( 'Something Missing : It\'s Elementor. Please install Elementor, Unless The Plus Addons will not be working.', 'theplus' ) . '</p>';
		$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'theplus' ) ) . '</p>';
	}
	echo '<div class="notice notice-error is-dismissible">'.$admin_notice.'</div>';
}

/**
	* Plugin Updater	
*/
function theplus_plugin_updater() {
	
    $purchase_key = get_option( 'theplus_purchase_code' );
	$license_key=$purchase_key['tp_api_key'];
	$verify_api=theplus_check_api_status();
    // setup the updater
	if(!empty($license_key) && !empty($verify_api) && $verify_api==1){
		$edd_updater = new Theplus_SL_Plugin_Updater( TP_PLUS_SL_STORE_URL, __FILE__, array(
			'version' => THEPLUS_VERSION,
			'license' => $license_key,		
			'item_id'       => TP_PLUS_SL_ITEM_ID,
			'author' => 'POSIMYTH Themes',
			'url'           => home_url(),
			'beta' => false,
		));
	}
}

/**
 * Redirect to options page
 *
 * @since v1.0.0
 */
 /*
 function theplus_activate() {
    add_option('theplus_activation_redirect', true);
}
register_activation_hook(__FILE__, 'theplus_activate');

function theplus_redirect_pro_version() {
    if (get_option('theplus_activation_redirect', false)) {
        delete_option('theplus_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("admin.php?page=theplus_purchase_code");
        }
    }
}
add_action('admin_init', 'theplus_redirect_pro_version');
*/
/**
	* Elementor activated or not
*/
if ( ! function_exists( 'theplus_elementor_activated' ) ) {
	
	function theplus_elementor_activated() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();
		
		return isset( $installed_plugins[ $file_path ] );
	}
}