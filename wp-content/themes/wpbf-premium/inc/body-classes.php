<?php
/**
 * Body Classes
 *
 * @package Page Builder Framework Premium Add-On
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Body Classes
 */
function wpbf_premium_body_classes( $classes ) {

	$push_menu		= get_theme_mod( 'menu_off_canvas_push' );
	$menu_position	= get_theme_mod( 'menu_position' );

	if( $push_menu && $menu_position == 'menu-off-canvas' ) {
		$classes[] = 'wpbf-push-menu-right';
	}

	if( $push_menu && $menu_position == 'menu-off-canvas-left' ) {
		$classes[] = 'wpbf-push-menu-left';
	}

	if( wpbf_has_responsive_breakpoints() ) {

		$classes[] = 'wpbf-responsive-breakpoints';

		$classes[] = 'wpbf-mobile-breakpoint-' . wpbf_breakpoint_mobile();
		$classes[] = 'wpbf-medium-breakpoint-' . wpbf_breakpoint_medium();
		$classes[] = 'wpbf-desktop-breakpoint-' . wpbf_breakpoint_desktop();

	}

	if( get_theme_mod( 'woocommerce_loop_infinite_scroll' ) == 'enabled' ) {
		$classes[] = 'wpbf-woo-infinite-scroll';
	}

	return $classes;

}
add_filter( 'body_class', 'wpbf_premium_body_classes' );