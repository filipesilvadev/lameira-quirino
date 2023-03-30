<?php
/**
 * WooCommerce Integration
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// stop here if WooCommerce isn't active
if ( !class_exists( 'WooCommerce' ) ) return;

// WooCommerce Customizer Settings.
require_once WPBF_PREMIUM_DIR . 'inc/integration/woocommerce/wpbf-kirki-woocommerce.php';

// WooCommerce Functions.
require_once WPBF_PREMIUM_DIR . 'inc/integration/woocommerce/woocommerce-functions.php';

// WooCommerce Quick View.
require_once WPBF_PREMIUM_DIR . 'inc/integration/woocommerce/woocommerce-quick-view.php';

// WooCommerce Customizer Styles.
require_once WPBF_PREMIUM_DIR . 'inc/integration/woocommerce/woocommerce-styles.php';

// WooCommerce Responsive Styles.
require_once WPBF_PREMIUM_DIR . 'inc/integration/woocommerce/woocommerce-responsive-styles.php';

/**
 * Scripts & Styles
 */
function wpbf_premium_woocommerce_scripts() {

	wp_enqueue_style( 'wpbf-premium-woocommerce', WPBF_PREMIUM_URI . 'css/wpbf-premium-woocommerce.css', '', WPBF_PREMIUM_VERSION );

	wp_enqueue_script( 'wpbf-premium-woocommerce', WPBF_PREMIUM_URI . 'js/wpbf-premium-woocommerce.js', array( 'jquery' ), WPBF_PREMIUM_VERSION, true );

	if ( get_theme_mod( 'woocommerce_loop_quick_view' ) !== 'disabled' ) {
	
		wp_enqueue_script( 'wpbf-premium-woocommrece-siema', WPBF_PREMIUM_URI . 'js/siema.min.js', array( 'jquery' ), WPBF_PREMIUM_VERSION, true );

		wp_localize_script( 'wpbf-premium-woocommerce', 'wpbf_woo_quick_view', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

	if( get_theme_mod( 'woocommerce_loop_infinite_scroll' ) == 'enabled' && ( is_shop() || is_product_category() ) ) {

		wp_enqueue_script( 'wpbf-premium-woocommerce-infinite-scroll', WPBF_PREMIUM_URI . 'js/wpbf-premium-woo-infinite-scroll.js', array( 'jquery' ), WPBF_PREMIUM_VERSION, true );
		
		wp_localize_script( 'wpbf-premium-woocommerce-infinite-scroll', 'wpbf_scroll_objects', array(
			'next_Selector'    => 'a.next.page-numbers',
			'item_Selector'    => '.product',
			'content_Selector' => '.products',
			'image_loader'     => WPBF_PREMIUM_URI . 'assets/img/loader.gif'
			)
		);
		
	}

}
add_action( 'wp_enqueue_scripts', 'wpbf_premium_woocommerce_scripts', 11 );
