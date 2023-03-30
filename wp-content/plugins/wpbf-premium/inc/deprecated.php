<?php
/**
 * Deprecated.
 *
 * @package Page Builder Framework Premium Add-On
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Credit shortcode (deprecated).
 *
 * @param array $atts The shortcode attributes.
 *
 * @return string The credit output.
 */
function wpbf_footer_credit( $atts ) {

	extract(
		shortcode_atts(
			array(
				'url'  => 'https://wp-pagebuilderframework.com/',
				'name' => 'Page Builder Framework',
			),
			$atts
		)
	);

	return '<a href="' . esc_url( $url ) . '" rel="nofollow">' . esc_html( $name ) . '</a>';

}
add_shortcode( 'credit', 'wpbf_footer_credit' );

/**
 * Construct sticky navigation (deprecated).
 *
 * Will be removed with 3.0!
 */
function wpbf_sticky_navigation() {

	// $menu_position = get_theme_mod( 'menu_position' );

	// if ( 'menu-vertical-left' === $menu_position ) {
	// 	return;
	// }

	$menu_sticky = get_theme_mod( 'menu_sticky' );

	if ( $menu_sticky ) {

		// Variables.
		$menu_active_delay              = get_theme_mod( 'menu_active_delay' );
		$menu_active_animation          = get_theme_mod( 'menu_active_animation' );
		$menu_active_animation_duration = get_theme_mod( 'menu_active_animation_duration' );

		// Construct
		$sticky_navigation  = 'data-sticky="true"';
		$sticky_navigation .= $menu_active_delay ? ' data-sticky-delay="' . esc_attr( $menu_active_delay ) . '"' : ' data-sticky-delay="300px"';
		$sticky_navigation .= $menu_active_animation ? ' data-sticky-animation="' . esc_attr( $menu_active_animation ) . '"' : false;
		$sticky_navigation .= $menu_active_animation_duration ? ' data-sticky-animation-duration="' . esc_attr( $menu_active_animation_duration ) . '"' : ' data-sticky-animation-duration="200"';

		echo $sticky_navigation;

	}

}

/**
 * Transparent header (deprecated).
 *
 * Add class to .wpbf-navigation if transparent header body class exists.
 * Will be removed with 3.0!
 */
function wpbf_transparent_header() {

	$classes = get_body_class();

	if ( in_array( 'wpbf-transparent-header', $classes, true ) ) {
		echo ' wpbf-navigation-transparent';
	}

}
