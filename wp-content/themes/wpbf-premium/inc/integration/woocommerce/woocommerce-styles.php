<?php
/**
 * Dynamic WooCommerce CSS
 *
 * Holds Customizer WooCommerce CSS styles
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Do WooCommerce customizer CSS
 */
function wpbf_premium_woo_customizer_css() {

	$breakpoint_desktop = wpbf_breakpoint_desktop() . 'px';

	// Menu Item Dropdown Buttons.
	$button_bg_color               = get_theme_mod( 'button_bg_color' );
	$button_text_color             = get_theme_mod( 'button_text_color' );
	$button_bg_color_alt           = get_theme_mod( 'button_bg_color_alt' );
	$button_text_color_alt         = get_theme_mod( 'button_text_color_alt' );
	$button_primary_bg_color       = get_theme_mod( 'button_primary_bg_color' );
	$button_primary_text_color     = get_theme_mod( 'button_primary_text_color' );
	$button_primary_bg_color_alt   = get_theme_mod( 'button_primary_bg_color_alt' );
	$button_primary_text_color_alt = get_theme_mod( 'button_primary_text_color_alt' );

	if ( $button_bg_color || $button_text_color ) {

		echo '.wpbf-woo-menu-item .wpbf-button {';

		if ( $button_bg_color ) {

			echo sprintf( 'background: %s;', esc_attr( $button_bg_color ) );

		}

		if ( $button_text_color ) {

			echo sprintf( 'color: %s;', esc_attr( $button_text_color ) );

		}

		echo '}';

	}

	if ( $button_bg_color_alt || $button_text_color_alt ) {

		echo '.wpbf-woo-menu-item .wpbf-button:hover {';

		if ( $button_bg_color_alt ) {

			echo sprintf( 'background: %s;', esc_attr( $button_bg_color_alt ) );

		}

		if ( $button_text_color_alt ) {

			echo sprintf( 'color: %s;', esc_attr( $button_text_color_alt ) );

		}

		echo '}';

	}

	if ( $button_primary_bg_color || $button_primary_text_color ) {

		echo '.wpbf-woo-menu-item .wpbf-button-primary {';

		if ( $button_primary_bg_color ) {

			echo sprintf( 'background: %s;', esc_attr( $button_primary_bg_color ) );

		}

		if ( $button_primary_text_color ) {

			echo sprintf( 'color: %s;', esc_attr( $button_primary_text_color ) );

		}

		echo '}';

	}

	if ( $button_primary_bg_color || $button_primary_text_color ) {

		echo '.wpbf-woo-menu-item .wpbf-button-primary:hover {';

		if ( $button_primary_bg_color_alt ) {

			echo sprintf( 'background: %s;', esc_attr( $button_primary_bg_color_alt ) );

		}

		if ( $button_primary_text_color_alt ) {

			echo sprintf( 'color: %s;', esc_attr( $button_primary_text_color_alt ) );

		}

		echo '}';

	}

	// Quick View.
	$woocommerce_loop_quick_view_overlay_color    = get_theme_mod( 'woocommerce_loop_quick_view_overlay_color' );
	$woocommerce_loop_quick_view_font_size        = get_theme_mod( 'woocommerce_loop_quick_view_font_size' );
	$woocommerce_loop_quick_view_font_color       = get_theme_mod( 'woocommerce_loop_quick_view_font_color' );
	$woocommerce_loop_quick_view_background_color = get_theme_mod( 'woocommerce_loop_quick_view_background_color' );

	if ( $woocommerce_loop_quick_view_overlay_color ) {

		echo '.wpbf-woo-quick-view-modal {';

			echo sprintf( 'background: %s;', esc_attr( $woocommerce_loop_quick_view_overlay_color ) );

		echo '}';

	}

	if ( $woocommerce_loop_quick_view_font_size || $woocommerce_loop_quick_view_font_color || $woocommerce_loop_quick_view_background_color ) {

		echo '.wpbf-woo-quick-view {';

		if ( $woocommerce_loop_quick_view_font_size ) {
			echo sprintf( 'font-size: %s;', esc_attr( $woocommerce_loop_quick_view_font_size ) );
		}

		if ( $woocommerce_loop_quick_view_font_color ) {
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_loop_quick_view_font_color ) );
		}

		if ( $woocommerce_loop_quick_view_background_color ) {
			echo sprintf( 'background-color: %s;', esc_attr( $woocommerce_loop_quick_view_background_color ) );
		}

		echo '}';

	}

	if ( $woocommerce_loop_quick_view_font_color ) {

		echo '.wpbf-woo-quick-view:hover {';

		echo sprintf( 'color: %s;', esc_attr( $woocommerce_loop_quick_view_font_color ) );

		echo '}';

	}

	// Cart Popup
	$woocommerce_menu_item_dropdown_popup = get_theme_mod( 'woocommerce_menu_item_dropdown_popup' );

	if( $woocommerce_menu_item_dropdown_popup ) {

		echo '@media screen and (max-width: '. esc_attr( $breakpoint_desktop ) .') {';

		echo '.wpbf-woo-menu-item-popup-overlay {';

			echo 'display: none !important;';

		echo '}';

		echo '}';

	}

	// Off Canvas Sidebar
	$woocommerce_loop_off_canvas_sidebar_font_color       = get_theme_mod( 'woocommerce_loop_off_canvas_sidebar_font_color' );
	$woocommerce_loop_off_canvas_sidebar_background_color = get_theme_mod( 'woocommerce_loop_off_canvas_sidebar_background_color' );
	$woocommerce_loop_off_canvas_sidebar_overlay_color    = get_theme_mod( 'woocommerce_loop_off_canvas_sidebar_overlay_color' );

	if ( $woocommerce_loop_off_canvas_sidebar_font_color || $woocommerce_loop_off_canvas_sidebar_background_color ) {

		echo '.wpbf-woo-off-canvas-sidebar-button {';

		if ( $woocommerce_loop_off_canvas_sidebar_font_color ) {
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_loop_off_canvas_sidebar_font_color ) );
		}

		if ( $woocommerce_loop_off_canvas_sidebar_background_color ) {
			echo sprintf( 'background-color: %s;', esc_attr( $woocommerce_loop_off_canvas_sidebar_background_color ) );
		}

		echo '}';

	} elseif( $button_primary_bg_color || $button_primary_text_color ) {

		echo '.wpbf-woo-off-canvas-sidebar-button {';

		if ( $button_primary_text_color ) {
			echo sprintf( 'color: %s;', esc_attr( $button_primary_text_color ) );
		}

		if ( $button_primary_bg_color ) {
			echo sprintf( 'background-color: %s;', esc_attr( $button_primary_bg_color ) );
		}

		echo '}';

	}

	if ( $woocommerce_loop_off_canvas_sidebar_overlay_color ) {

		echo '.wpbf-woo-off-canvas-sidebar-overlay {';
			echo sprintf( 'background-color: %s;', esc_attr( $woocommerce_loop_off_canvas_sidebar_overlay_color ) );
		echo '}';

	}

}
add_action( 'wpbf_after_customizer_css', 'wpbf_premium_woo_customizer_css', 20 );
