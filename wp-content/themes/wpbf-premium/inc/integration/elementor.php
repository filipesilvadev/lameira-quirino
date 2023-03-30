<?php
/**
 * Elementor Integration
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Fix Elementor line-height issue
 * 
 * https://github.com/pojome/elementor/issues/3197
 */
function wpbf_elementor_line_height_fix() {

	$line_height_h1 = get_theme_mod( 'page_h1_line_height' );
	$line_height_h2 = get_theme_mod( 'page_h2_line_height' );
	$line_height_h3 = get_theme_mod( 'page_h3_line_height' );
	$line_height_h4 = get_theme_mod( 'page_h4_line_height' );
	$line_height_h5 = get_theme_mod( 'page_h5_line_height' );
	$line_height_h6 = get_theme_mod( 'page_h6_line_height' );

	if( $line_height_h1 ) {

	echo '.elementor-widget-heading h1.elementor-heading-title, .elementor-widget-heading h2.elementor-heading-title, .elementor-widget-heading h3.elementor-heading-title, .elementor-widget-heading h4.elementor-heading-title, .elementor-widget-heading h5.elementor-heading-title, .elementor-widget-heading h6.elementor-heading-title {';
	echo sprintf( 'line-height: %s;', esc_attr( $line_height_h1 ) );
	echo '}';

	}

	if( $line_height_h2 ) {

	echo '.elementor-widget-heading h2.elementor-heading-title {';
	echo sprintf( 'line-height: %s;', esc_attr( $line_height_h2 ) );
	echo '}';

	}

	if( $line_height_h3 ) {

	echo '.elementor-widget-heading h3.elementor-heading-title {';
	echo sprintf( 'line-height: %s;', esc_attr( $line_height_h3 ) );
	echo '}';

	}

	if( $line_height_h4 ) {

	echo '.elementor-widget-heading h4.elementor-heading-title {';
	echo sprintf( 'line-height: %s;', esc_attr( $line_height_h4 ) );
	echo '}';

	}

	if( $line_height_h5 ) {

	echo '.elementor-widget-heading h5.elementor-heading-title {';
	echo sprintf( 'line-height: %s;', esc_attr( $line_height_h5 ) );
	echo '}';

	}

	if( $line_height_h6 ) {

	echo '.elementor-widget-heading h6.elementor-heading-title {';
	echo sprintf( 'line-height: %s;', esc_attr( $line_height_h6 ) );
	echo '}';

	}

}
add_action( 'wpbf_before_customizer_css', 'wpbf_elementor_line_height_fix', 20 );