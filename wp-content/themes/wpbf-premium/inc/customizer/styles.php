<?php
/**
 * Styles
 *
 * Holds Customizer CSS styles
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Customizer
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function wpbf_premium_before_customizer_css() {

	$breakpoint_medium = wpbf_breakpoint_medium() . 'px';
	$breakpoint_mobile = wpbf_breakpoint_mobile() . 'px';

	// Custom Fonts
	$custom_fonts = get_theme_mod( 'custom_fonts' );

	if( $custom_fonts && get_theme_mod( 'enable_custom_fonts' ) ) {

		foreach( $custom_fonts as $key => $custom_font ) {

			$font_family = $custom_font['font_css_name'];
			$eot         = $custom_font['font_eot'];
			$woff2       = $custom_font['font_woff2'];
			$woff        = $custom_font['font_woff'];
			$ttf         = $custom_font['font_ttf'];
			$svg         = $custom_font['font_svg'];

			echo '@font-face {';

				echo sprintf( 'font-family: %s;', esc_attr( $font_family ) );

				if( $eot ) {

					echo sprintf( 'src: url("%s");', wp_get_attachment_url( $eot ) );

				}

				if( $eot || $svg || $ttf || $woff2 || $woff ) {
					echo 'src:';
				}

				$sources = array();

				if( $eot ) {
					$sources[] = 'url("'. wp_get_attachment_url( $eot ) .'?#iefix") format("embedded-opentype")';
				}

				if( $woff2 ) {
					$sources[] = 'url("'. wp_get_attachment_url( $woff2 ) .'") format("woff2")';					
				}

				if( $woff ) {
					$sources[] = 'url("'. wp_get_attachment_url( $woff ) .'") format("woff")';					
				}

				if( $ttf ) {
					$sources[] = 'url("'. wp_get_attachment_url( $ttf ) .'") format("truetype")';					
				}

				if( $svg ) {
					$sources[] = 'url("'. wp_get_attachment_url( $svg ) .'#'. $font_family .'") format("svg")';					
				}

				$sources = implode(',', $sources);

				echo $sources;

				if( $eot || $svg || $ttf || $woff2 || $woff ) {
					echo ';';
				}

				echo "font-display: swap;";
				echo 'font-weight: normal;';
				echo 'font-style: normal;';

			echo '}';

		}

	}

	// Page Font Settings
	$page_line_height       = get_theme_mod( 'page_line_height' );
	$page_bold_color        = get_theme_mod( 'page_bold_color' );
	$page_font_size_desktop = get_theme_mod( 'page_font_size_desktop' );
	$page_font_size_tablet  = get_theme_mod( 'page_font_size_tablet' );
	$page_font_size_mobile  = get_theme_mod( 'page_font_size_mobile' );

	if( $page_line_height ) {
		echo 'input, optgroup, textarea, button, body {';
		echo sprintf( 'line-height: %s;', esc_attr( $page_line_height ) );
		echo '}';
	}

	if( $page_bold_color ) {
		echo 'b, strong {';
		echo sprintf( 'color: %s;', esc_attr( $page_bold_color ) );
		echo '}';
	}

	if( $page_font_size_desktop ) {
		echo 'body {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_font_size_desktop ) );
		echo '}';
	}

	if( $page_font_size_tablet ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_medium ) .') {';
		echo 'body {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_font_size_tablet ) );
		echo '}';
		echo '}';
	}

	if( $page_font_size_mobile ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo 'body {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_font_size_mobile ) );
		echo '}';
		echo '}';
	}

	// Menu Font Settings
	$menu_font_size      = get_theme_mod( 'menu_font_size' );
	$menu_letter_spacing = get_theme_mod( 'menu_letter_spacing' );
	$menu_text_transform = get_theme_mod( 'menu_text_transform' );

	if( !is_bool( $menu_letter_spacing ) || $menu_font_size || $menu_text_transform ) {
		echo '.wpbf-menu, .wpbf-mobile-menu {';
		if( $menu_font_size ) {
		echo sprintf( 'font-size: %s;', esc_attr( $menu_font_size ) );
		}
		if( !is_bool( $menu_letter_spacing ) ) {
		echo sprintf( 'letter-spacing: %s;', esc_attr( $menu_letter_spacing ) . 'px' );
		}
		if( $menu_text_transform ) {
		echo sprintf( 'text-transform: %s;', esc_attr( $menu_text_transform ) );
		} else {
		echo 'text-transform: none;';
		}
		echo '}';
	}

	// H1 Font Settings
	$page_h1_font_color        = get_theme_mod( 'page_h1_font_color' );
	$page_h1_line_height       = get_theme_mod( 'page_h1_line_height' );
	$page_h1_letter_spacing    = get_theme_mod( 'page_h1_letter_spacing' );
	$page_h1_text_transform    = get_theme_mod( 'page_h1_text_transform' );
	$page_h1_font_size_desktop = get_theme_mod( 'page_h1_font_size_desktop' );
	$page_h1_font_size_tablet  = get_theme_mod( 'page_h1_font_size_tablet' );
	$page_h1_font_size_mobile  = get_theme_mod( 'page_h1_font_size_mobile' );

	if( $page_h1_font_color || $page_h1_line_height || $page_h1_letter_spacing || $page_h1_text_transform ) {
		echo 'h1, h2, h3, h4, h5, h6 {';
		if( $page_h1_font_color ) {
		echo sprintf( 'color: %s;', esc_attr( $page_h1_font_color ) );
		}
		if( $page_h1_line_height ) {
		echo sprintf( 'line-height: %s;', esc_attr( $page_h1_line_height ) );
		}
		if( $page_h1_letter_spacing ) {
		echo sprintf( 'letter-spacing: %s;', esc_attr( $page_h1_letter_spacing ) . 'px' );
		}
		if( $page_h1_text_transform ) {
		echo sprintf( 'text-transform: %s;', esc_attr( $page_h1_text_transform ) );
		} else {
		echo 'text-transform: none;';
		}
		echo '}';
	}

	if( $page_h1_font_size_desktop ) {
		echo 'h1 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h1_font_size_desktop ) );
		echo '}';
	}

	if( $page_h1_font_size_tablet ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_medium ) .') {';
		echo 'h1 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h1_font_size_tablet ) );
		echo '}';
		echo '}';
	}

	if( $page_h1_font_size_mobile ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo 'h1 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h1_font_size_mobile ) );
		echo '}';
		echo '}';
	}

	// H2 Font Settings
	$page_h2_toggle            = get_theme_mod( 'page_h2_toggle' );
	$page_h2_line_height       = get_theme_mod( 'page_h2_line_height' );
	$page_h2_letter_spacing    = get_theme_mod( 'page_h2_letter_spacing' );
	$page_h2_text_transform    = get_theme_mod( 'page_h2_text_transform' );
	$page_h2_font_color        = get_theme_mod( 'page_h2_font_color' );
	$page_h2_font_size_desktop = get_theme_mod( 'page_h2_font_size_desktop' );
	$page_h2_font_size_tablet  = get_theme_mod( 'page_h2_font_size_tablet' );
	$page_h2_font_size_mobile  = get_theme_mod( 'page_h2_font_size_mobile' );

	if( $page_h2_toggle ) {

		if( $page_h2_line_height || !is_bool( $page_h2_letter_spacing ) || $page_h2_text_transform ) {

			echo 'h2 {';
			if( $page_h2_line_height ) {
			echo sprintf( 'line-height: %s;', esc_attr( $page_h2_line_height ) );
			}
			if( !is_bool( $page_h2_letter_spacing ) ) {
			echo sprintf( 'letter-spacing: %s;', esc_attr( $page_h2_letter_spacing ) . 'px' );
			}
			if( $page_h2_text_transform ) {
			echo sprintf( 'text-transform: %s;', esc_attr( $page_h2_text_transform ) );
			} else {
			echo 'text-transform: none;';
			}
			echo '}';

		}

	}

	if( $page_h2_font_color ) {
		echo 'h2 {';
		echo sprintf( 'color: %s;', esc_attr( $page_h2_font_color ) );
		echo '}';
	}

	if( $page_h2_font_size_desktop ) {
		echo 'h2 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h2_font_size_desktop ) );
		echo '}';
	}

	if( $page_h2_font_size_tablet ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_medium ) .') {';
		echo 'h2 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h2_font_size_tablet ) );
		echo '}';
		echo '}';
	}

	if( $page_h2_font_size_mobile ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo 'h2 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h2_font_size_mobile ) );
		echo '}';
		echo '}';
	}

	// H3 Font Settings
	$page_h3_toggle            = get_theme_mod( 'page_h3_toggle' );
	$page_h3_line_height       = get_theme_mod( 'page_h3_line_height' );
	$page_h3_letter_spacing    = get_theme_mod( 'page_h3_letter_spacing' );
	$page_h3_text_transform    = get_theme_mod( 'page_h3_text_transform' );
	$page_h3_font_color        = get_theme_mod( 'page_h3_font_color' );
	$page_h3_font_size_desktop = get_theme_mod( 'page_h3_font_size_desktop' );
	$page_h3_font_size_tablet  = get_theme_mod( 'page_h3_font_size_tablet' );
	$page_h3_font_size_mobile  = get_theme_mod( 'page_h3_font_size_mobile' );

	if( $page_h3_toggle ) {

		if( $page_h3_line_height || !is_bool( $page_h3_letter_spacing ) || $page_h3_text_transform ) {

			echo 'h3 {';
			if( $page_h3_line_height ) {
			echo sprintf( 'line-height: %s;', esc_attr( $page_h3_line_height ) );
			}
			if( !is_bool( $page_h3_letter_spacing ) ) {
			echo sprintf( 'letter-spacing: %s;', esc_attr( $page_h3_letter_spacing ) . 'px' );
			}
			if( $page_h3_text_transform ) {
			echo sprintf( 'text-transform: %s;', esc_attr( $page_h3_text_transform ) );
			} else {
			echo 'text-transform: none;';
			}
			echo '}';

		}

	}

	if( $page_h3_font_color ) {
		echo 'h3 {';
		echo sprintf( 'color: %s;', esc_attr( $page_h3_font_color ) );
		echo '}';
	}

	if( $page_h3_font_size_desktop ) {
		echo 'h3 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h3_font_size_desktop ) );
		echo '}';
	}

	if( $page_h3_font_size_tablet ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_medium ) .') {';
		echo 'h3 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h3_font_size_tablet ) );
		echo '}';
		echo '}';
	}

	if( $page_h3_font_size_mobile ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo 'h3 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h3_font_size_mobile ) );
		echo '}';
		echo '}';
	}

	// H4 Font Settings
	$page_h4_toggle            = get_theme_mod( 'page_h4_toggle' );
	$page_h4_line_height       = get_theme_mod( 'page_h4_line_height' );
	$page_h4_letter_spacing    = get_theme_mod( 'page_h4_letter_spacing' );
	$page_h4_text_transform    = get_theme_mod( 'page_h4_text_transform' );
	$page_h4_font_color        = get_theme_mod( 'page_h4_font_color' );
	$page_h4_font_size_desktop = get_theme_mod( 'page_h4_font_size_desktop' );
	$page_h4_font_size_tablet  = get_theme_mod( 'page_h4_font_size_tablet' );
	$page_h4_font_size_mobile  = get_theme_mod( 'page_h4_font_size_mobile' );

	if( $page_h4_toggle ) {

		if( $page_h4_line_height || !is_bool( $page_h4_letter_spacing ) || $page_h4_text_transform ) {

			echo 'h4 {';
			if( $page_h4_line_height ) {
			echo sprintf( 'line-height: %s;', esc_attr( $page_h4_line_height ) );
			}
			if( !is_bool( $page_h4_letter_spacing ) ) {
			echo sprintf( 'letter-spacing: %s;', esc_attr( $page_h4_letter_spacing ) . 'px' );
			}
			if( $page_h4_text_transform ) {
			echo sprintf( 'text-transform: %s;', esc_attr( $page_h4_text_transform ) );
			} else {
			echo 'text-transform: none;';
			}
			echo '}';

		}

	}

	if( $page_h4_font_color ) {
		echo 'h4 {';
		echo sprintf( 'color: %s;', esc_attr( $page_h4_font_color ) );
		echo '}';
	}

	if( $page_h4_font_size_desktop ) {
		echo 'h4 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h4_font_size_desktop ) );
		echo '}';
	}

	if( $page_h4_font_size_tablet ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_medium ) .') {';
		echo 'h4 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h4_font_size_tablet ) );
		echo '}';
		echo '}';
	}

	if( $page_h4_font_size_mobile ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo 'h4 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h4_font_size_mobile ) );
		echo '}';
		echo '}';
	}

	// H5 Settings
	$page_h5_toggle            = get_theme_mod( 'page_h5_toggle' );
	$page_h5_line_height       = get_theme_mod( 'page_h5_line_height' );
	$page_h5_letter_spacing    = get_theme_mod( 'page_h5_letter_spacing' );
	$page_h5_text_transform    = get_theme_mod( 'page_h5_text_transform' );
	$page_h5_font_color        = get_theme_mod( 'page_h5_font_color' );
	$page_h5_font_size_desktop = get_theme_mod( 'page_h5_font_size_desktop' );
	$page_h5_font_size_tablet  = get_theme_mod( 'page_h5_font_size_tablet' );
	$page_h5_font_size_mobile  = get_theme_mod( 'page_h5_font_size_mobile' );

	if( $page_h5_toggle ) {

		if( $page_h5_line_height || !is_bool( $page_h5_letter_spacing ) || $page_h5_text_transform ) {

			echo 'h5 {';
			if( $page_h5_line_height ) {
			echo sprintf( 'line-height: %s;', esc_attr( $page_h5_line_height ) );
			}
			if( !is_bool( $page_h5_letter_spacing ) ) {
			echo sprintf( 'letter-spacing: %s;', esc_attr( $page_h5_letter_spacing ) . 'px' );
			}
			if( $page_h5_text_transform ) {
			echo sprintf( 'text-transform: %s;', esc_attr( $page_h5_text_transform ) );
			} else {
			echo 'text-transform: none;';
			}
			echo '}';

		}

	}

	if( $page_h5_font_color ) {
		echo 'h5 {';
		echo sprintf( 'color: %s;', esc_attr( $page_h5_font_color ) );
		echo '}';
	}

	if( $page_h5_font_size_desktop ) {
		echo 'h5 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h5_font_size_desktop ) );
		echo '}';
	}

	if( $page_h5_font_size_tablet ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_medium ) .') {';
		echo 'h5 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h5_font_size_tablet ) );
		echo '}';
		echo '}';
	}

	if( $page_h5_font_size_mobile ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo 'h5 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h5_font_size_mobile ) );
		echo '}';
		echo '}';
	}

	// H6 Font Settings
	$page_h6_toggle            = get_theme_mod( 'page_h6_toggle' );
	$page_h6_line_height       = get_theme_mod( 'page_h6_line_height' );
	$page_h6_letter_spacing    = get_theme_mod( 'page_h6_letter_spacing' );
	$page_h6_text_transform    = get_theme_mod( 'page_h6_text_transform' );
	$page_h6_font_color        = get_theme_mod( 'page_h6_font_color' );
	$page_h6_font_size_desktop = get_theme_mod( 'page_h6_font_size_desktop' );
	$page_h6_font_size_tablet  = get_theme_mod( 'page_h6_font_size_tablet' );
	$page_h6_font_size_mobile  = get_theme_mod( 'page_h6_font_size_mobile' );

	if( $page_h6_toggle ) {

		if( $page_h6_line_height || !is_bool( $page_h6_letter_spacing ) || $page_h6_text_transform ) {

			echo 'h6 {';
			if( $page_h6_line_height ) {
			echo sprintf( 'line-height: %s;', esc_attr( $page_h6_line_height ) );
			}
			if( !is_bool( $page_h6_letter_spacing ) ) {
			echo sprintf( 'letter-spacing: %s;', esc_attr( $page_h6_letter_spacing ) . 'px' );
			}
			if( $page_h6_text_transform ) {
			echo sprintf( 'text-transform: %s;', esc_attr( $page_h6_text_transform ) );
			} else {
			echo 'text-transform: none;';
			}
			echo '}';

		}

	}

	if( $page_h6_font_color ) {
		echo 'h6 {';
		echo sprintf( 'color: %s;', esc_attr( $page_h6_font_color ) );
		echo '}';
	}

	if( $page_h6_font_size_desktop ) {
		echo 'h6 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h6_font_size_desktop ) );
		echo '}';
	}

	if( $page_h6_font_size_tablet ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_medium ) .') {';
		echo 'h6 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h6_font_size_tablet ) );
		echo '}';
		echo '}';
	}

	if( $page_h6_font_size_mobile ) {
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo 'h6 {';
		echo sprintf( 'font-size: %s;', esc_attr( $page_h6_font_size_mobile ) );
		echo '}';
		echo '}';
	}

}
add_action( 'wpbf_before_customizer_css', 'wpbf_premium_before_customizer_css', 10 );

function wpbf_premium_after_customizer_css() {

	// vars
	$breakpoint_desktop = wpbf_breakpoint_desktop() . 'px';
	$breakpoint_medium  = wpbf_breakpoint_medium() . 'px';
	$breakpoint_mobile  = wpbf_breakpoint_mobile() . 'px';

	// Blog Layouts
	$archives = apply_filters( 'wpbf_archives', array( 'archive' ) );

	foreach( $archives as $archive ) {

		$layout        = get_theme_mod( $archive . '_layout' );
		$space_between = get_theme_mod( $archive . '_post_space_between' );

		if( $layout == 'grid' && $space_between ) {

			echo '.wpbf-' . $archive . '-content .wpbf-post-grid .wpbf-article-wrapper {'; // WPCS: XSS ok.
			echo sprintf( 'margin-bottom: %s;', esc_attr( $space_between ) . 'px' );
			echo '}';

		}

	}

	// Mobile Navigation
	$mobile_menu_options       = get_theme_mod( 'mobile_menu_options', 'menu-mobile-hamburger' );
	$mobile_menu_width         = get_theme_mod( 'mobile_menu_width' );
	$mobile_menu_bg_color      = get_theme_mod( 'mobile_menu_bg_color' );
	$mobile_menu_overlay       = get_theme_mod( 'mobile_menu_overlay' );
	$mobile_menu_overlay_color = get_theme_mod( 'mobile_menu_overlay_color' );
	$mobile_menu_padding_right = get_theme_mod( 'mobile_menu_padding_right' );
	$mobile_menu_padding_left  = get_theme_mod( 'mobile_menu_padding_left' );

	if( $mobile_menu_options == 'menu-mobile-off-canvas' ) {

		if( $mobile_menu_width || $mobile_menu_bg_color ) {
			echo '.wpbf-mobile-menu-off-canvas .wpbf-mobile-menu-container {';
			if( $mobile_menu_width ) {
			echo sprintf( 'width: %s;', esc_attr( $mobile_menu_width ) );
			echo sprintf( 'right: %s;', '-' . esc_attr( $mobile_menu_width ) );
			}
			if( $mobile_menu_bg_color ) {
			echo sprintf( 'background-color: %s;', esc_attr( $mobile_menu_bg_color ) );
			}
			echo '}';
		}

		if( $mobile_menu_overlay && $mobile_menu_overlay_color ) {
			echo '.wpbf-mobile-menu-overlay {';
			echo sprintf( 'background: %s;', esc_attr( $mobile_menu_overlay_color ) );
			echo '}';
		}

		if( $mobile_menu_padding_right || $mobile_menu_padding_left ) {
			echo '.wpbf-mobile-menu-off-canvas .wpbf-close {';
			if( $mobile_menu_padding_right ) {
			echo sprintf( 'padding-right: %s;', esc_attr( $mobile_menu_padding_right ) . 'px' );
			}
			if( $mobile_menu_padding_left ) {
			echo sprintf( 'padding-left: %s;', esc_attr( $mobile_menu_padding_left ) . 'px' );
			}
			echo '}';
		}

	}

	// Stacked Advanced
	$menu_position            = get_theme_mod( 'menu_position' );
	$menu_width               = get_theme_mod( 'menu_width' );
	$menu_stacked_bg_color    = get_theme_mod( 'menu_stacked_bg_color' );
	$menu_stacked_logo_height = get_theme_mod( 'menu_stacked_logo_height' );

	if( $menu_position == 'menu-stacked-advanced' ) {

		if( $menu_width ) {
			echo '.wpbf-menu-stacked-advanced-wrapper .wpbf-container {';
			echo sprintf( 'max-width: %s;', esc_attr( $menu_width ) );
			echo '}';
		}

		if( $menu_stacked_bg_color ) {
			echo '.wpbf-menu-stacked-advanced-wrapper {';
			echo sprintf( 'background-color: %s;', esc_attr( $menu_stacked_bg_color ) );
			echo '}';
		}

		if( $menu_stacked_logo_height ) {
			echo '.wpbf-menu-stacked-advanced-wrapper {';
			echo sprintf( 'padding-top: %s;', esc_attr( $menu_stacked_logo_height ) . 'px' );
			echo sprintf( 'padding-bottom: %s;', esc_attr( $menu_stacked_logo_height ) . 'px' );
			echo '}';
		}

	}

	// Off Canvas & Full Screen
	$menu_padding                        = get_theme_mod( 'menu_padding', 20 );
	$menu_off_canvas_bg_color            = get_theme_mod( 'menu_off_canvas_bg_color' );
	$menu_off_canvas_hamburger_color     = get_theme_mod( 'menu_off_canvas_hamburger_color' );
	$menu_off_canvas_submenu_arrow_color = get_theme_mod( 'menu_off_canvas_submenu_arrow_color' );
	$menu_off_canvas_width               = get_theme_mod( 'menu_off_canvas_width' );
	$menu_overlay                        = get_theme_mod( 'menu_overlay' );
	$menu_overlay_color                  = get_theme_mod( 'menu_overlay_color' );

	if( get_theme_mod( 'menu_padding' ) && in_array( $menu_position, array( 'menu-off-canvas', 'menu-off-canvas-left' ) ) ) {
		echo '.wpbf-menu > .menu-item > a {';
		echo 'padding-left: 0px;';
		echo 'padding-right: 0px;';
		echo '}';
	}

	if( $menu_off_canvas_bg_color && in_array( $menu_position, array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ) ) ) {
		echo '.wpbf-menu-off-canvas, .wpbf-menu-full-screen {';
		echo sprintf( 'background-color: %s;', esc_attr( $menu_off_canvas_bg_color ) );
		echo '}';
	}

	if( $menu_off_canvas_hamburger_color && in_array( $menu_position, array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ) ) ) {
		echo '.wpbf-nav-item, .wpbf-nav-item a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_off_canvas_hamburger_color ) );
		echo '}';
	}

	if( $menu_off_canvas_submenu_arrow_color && in_array( $menu_position, array( 'menu-off-canvas', 'menu-off-canvas-left' ) ) ) {
		echo '.wpbf-menu-off-canvas .wpbf-submenu-toggle {';
		echo sprintf( 'color: %s;', esc_attr( $menu_off_canvas_submenu_arrow_color ) );
		echo '}';
	}

	if( $menu_off_canvas_width && $menu_position == 'menu-off-canvas' ) {
		echo '.wpbf-menu-off-canvas {';
		echo sprintf( 'width: %s;', esc_attr( $menu_off_canvas_width ) . 'px' );
		echo sprintf( 'right: %s;', '-' . esc_attr( $menu_off_canvas_width ) . 'px' );
		echo '}';

		echo '.wpbf-push-menu-right.active {';
		echo sprintf( 'left: %s;', '-' . esc_attr( $menu_off_canvas_width ) . 'px' );
		echo '}';

		echo '.wpbf-push-menu-right.active .wpbf-navigation-active {';
		echo sprintf( 'left: %s;', '-' . esc_attr( $menu_off_canvas_width ) . 'px !important' );
		echo '}';
	}

	if( $menu_off_canvas_width && $menu_position == 'menu-off-canvas-left' ) {
		echo '.wpbf-menu-off-canvas {';
		echo sprintf( 'width: %s;', esc_attr( $menu_off_canvas_width ) . 'px' );
		echo sprintf( 'left: %s;', '-' . esc_attr( $menu_off_canvas_width ) . 'px' );
		echo '}';

		echo '.wpbf-push-menu-left.active {';
		echo sprintf( 'left: %s;', esc_attr( $menu_off_canvas_width ) . 'px' );
		echo '}';

		echo '.wpbf-push-menu-left.active .wpbf-navigation-active {';
		echo sprintf( 'left: %s;', esc_attr( $menu_off_canvas_width ) . 'px !important' );
		echo '}';
	}

	if( $menu_position == 'menu-full-screen' ) {
		echo '.wpbf-menu > .menu-item > a {';
		echo sprintf( 'padding-top: %s;', esc_attr( $menu_padding ) . 'px' );
		echo sprintf( 'padding-bottom: %s;', esc_attr( $menu_padding ) . 'px' );
		echo '}';
	}

	if( $menu_overlay && $menu_overlay_color && in_array( $menu_position, array( 'menu-off-canvas', 'menu-off-canvas-left' ) ) ) {
		echo '.wpbf-menu-overlay {';
		echo sprintf( 'background: %s;', esc_attr( $menu_overlay_color ) );
		echo '}';
	}

	// Transparent Header
	$has_custom_logo                            = has_custom_logo();
	$mobile_menu_hamburger_style                = get_theme_mod( 'mobile_menu_hamburger_style' );
	$menu_transparent_background_color          = get_theme_mod( 'menu_transparent_background_color' );
	$menu_transparent_font_color                = get_theme_mod( 'menu_transparent_font_color' );
	$menu_transparent_font_color_alt            = get_theme_mod( 'menu_transparent_font_color_alt' );
	$menu_transparent_logo_color                = get_theme_mod( 'menu_transparent_logo_color' );
	$menu_transparent_logo_color_alt            = get_theme_mod( 'menu_transparent_logo_color_alt' );
	$menu_transparent_tagline_color             = get_theme_mod( 'menu_transparent_tagline_color' );
	$menu_transparent_hamburger_color_mobile    = get_theme_mod( 'menu_transparent_hamburger_color_mobile' );
	$menu_transparent_hamburger_color           = get_theme_mod( 'menu_transparent_hamburger_color' );
	$menu_transparent_hamburger_bg_color_mobile = get_theme_mod( 'menu_transparent_hamburger_bg_color_mobile' );

	if( $menu_transparent_background_color ) {
		echo '.wpbf-transparent-header .wpbf-navigation, .wpbf-transparent-header .wpbf-mobile-nav-wrapper {';
		echo sprintf( 'background-color: %s;', esc_attr( $menu_transparent_background_color ) );
		echo '}';
	}

	if( $menu_transparent_font_color ) {
		echo '.wpbf-navigation-transparent .wpbf-menu > .menu-item > a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_transparent_font_color ) );
		echo '}';
	}

	if( $menu_transparent_font_color_alt ) {
		echo '.wpbf-navigation-transparent .wpbf-menu > .menu-item > a:hover {';
		echo sprintf( 'color: %s;', esc_attr( $menu_transparent_font_color_alt ) );
		echo '}';
		echo '.wpbf-navigation-transparent .wpbf-menu > .current-menu-item > a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_transparent_font_color_alt ) . '!important' );
		echo '}';
	}

	if( $menu_transparent_logo_color && !$has_custom_logo ) {
		echo '.wpbf-navigation-transparent .wpbf-logo a, .wpbf-navigation-transparent .wpbf-mobile-logo a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_transparent_logo_color ) );
		echo '}';
	}

	if( $menu_transparent_logo_color_alt && !$has_custom_logo ) {
		echo '.wpbf-navigation-transparent .wpbf-logo a:hover, .wpbf-navigation-transparent .wpbf-mobile-logo a:hover {';
		echo sprintf( 'color: %s;', esc_attr( $menu_transparent_logo_color_alt ) );
		echo '}';
	}

	if( $menu_transparent_tagline_color && !$has_custom_logo && $menu_logo_description ) {
		echo '.wpbf-navigation-transparent .wpbf-tagline {';
		echo sprintf( 'color: %s;', esc_attr( $menu_transparent_tagline_color ) );
		echo '}';
	}

	if( $menu_transparent_hamburger_color ) {
		echo '.wpbf-navigation-transparent .wpbf-nav-item, .wpbf-navigation-transparent .wpbf-nav-item a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_transparent_hamburger_color ) );
		echo '}';
	}

	// Transparent Header Mobile
	if( in_array( $mobile_menu_options, array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' ) ) ) {

		if( $menu_transparent_hamburger_color_mobile ) {
			echo '.wpbf-navigation-transparent .wpbf-mobile-nav-item, .wpbf-navigation-transparent .wpbf-mobile-nav-item a {';
			echo sprintf( 'color: %s;', esc_attr( $menu_transparent_hamburger_color_mobile ) );
			echo '}';
		}
		if( $mobile_menu_hamburger_style == 'filled' && $menu_transparent_hamburger_bg_color_mobile ) {
			echo '.wpbf-navigation-transparent .wpbf-mobile-menu-toggle {';
			echo sprintf( 'background-color: %s;', esc_attr( $menu_transparent_hamburger_bg_color_mobile ) );
			echo '}';
		}

	}

	// Sticky Navigation
	$mobile_menu_active_hamburger_color     = get_theme_mod( 'mobile_menu_active_hamburger_color' );
	$mobile_menu_active_hamburger_bg_color  = get_theme_mod( 'mobile_menu_active_hamburger_bg_color' );
	$menu_sticky                            = get_theme_mod( 'menu_sticky' );
	$menu_active_hide_logo                  = get_theme_mod( 'menu_active_hide_logo' );
	$menu_active_logo_size                  = get_theme_mod( 'menu_active_logo_size' );
	$menu_active_logo_size_desktop          = get_theme_mod( 'menu_active_logo_size_desktop' );
	$menu_active_logo_size_tablet           = get_theme_mod( 'menu_active_logo_size_tablet' );
	$menu_active_logo_size_mobile           = get_theme_mod( 'menu_active_logo_size_mobile' );
	$menu_active_height                     = get_theme_mod( 'menu_active_height' );
	$menu_active_stacked_bg_color           = get_theme_mod( 'menu_active_stacked_bg_color' );
	$menu_active_bg_color                   = get_theme_mod( 'menu_active_bg_color' );
	$menu_active_font_color                 = get_theme_mod( 'menu_active_font_color' );
	$menu_active_font_color_alt             = get_theme_mod( 'menu_active_font_color_alt' );
	$menu_active_logo_color                 = get_theme_mod( 'menu_active_logo_color' );
	$menu_active_logo_color_alt             = get_theme_mod( 'menu_active_logo_color_alt' );
	$menu_logo_description                  = get_theme_mod( 'menu_logo_description' );
	$menu_active_tagline_color              = get_theme_mod( 'menu_active_tagline_color' );
	$menu_active_box_shadow                 = get_theme_mod( 'menu_active_box_shadow' );
	$menu_active_box_shadow_blur            = ($val = get_theme_mod( 'menu_active_box_shadow_blur' ) ) ? $val . 'px' : '5px';
	$menu_active_box_shadow_color           = ($val = get_theme_mod( 'menu_active_box_shadow_color' ) ) ? $val : 'rgba(0,0,0,.15)';
	$menu_active_off_canvas_hamburger_color = get_theme_mod( 'menu_active_off_canvas_hamburger_color' );

	if( $menu_sticky && $menu_active_hide_logo ) {

		if( $menu_position == 'menu-stacked' ) {
			echo '.wpbf-navigation-active .wpbf-logo {';
			echo 'display: none;';
			echo '}';
			echo '.wpbf-navigation-active nav {';
			echo 'margin-top: 0 !important;';
			echo '}';
		}

		if( $menu_position == 'menu-stacked-advanced' ) {
			echo '.wpbf-navigation-active .wpbf-menu-stacked-advanced-wrapper {';
			echo 'display: none;';
			echo '}';
		}

		if( $menu_position == 'menu-centered' ) {	
			echo '.wpbf-navigation-active .logo-container {';
			echo 'display: none !important;';
			echo '}';
		}

	}

	// Backwards Compatibility
	if( $menu_active_logo_size && !get_theme_mod( 'menu_logo_size_desktop' ) ) {
		echo '.wpbf-navigation-active .wpbf-logo img {';
		echo sprintf( 'height: %s;', esc_attr( $menu_active_logo_size ) . 'px' );
		echo '}';
	}

	if( $menu_active_logo_size_desktop ) {
		$suffix = is_numeric( $menu_active_logo_size_desktop ) ? 'px' : '';
		echo '.wpbf-navigation-active .wpbf-logo img {';
		echo sprintf( 'width: %s;', esc_attr( $menu_active_logo_size_desktop ) . $suffix );
		echo 'height: auto;'; // Backwards Compatibility
		echo '}';
	}

	if( $menu_active_logo_size_tablet ) {
		$suffix = is_numeric( $menu_active_logo_size_tablet ) ? 'px' : '';
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_desktop ) .') {';
		echo '.wpbf-navigation-active .wpbf-mobile-logo img {';
		echo sprintf( 'width: %s;', esc_attr( $menu_active_logo_size_tablet ) . $suffix );
		echo '}';
		echo '}';
	}

	if( $menu_active_logo_size_mobile ) {
		$suffix = is_numeric( $menu_active_logo_size_mobile ) ? 'px' : '';
		echo '@media screen and (max-width: '. esc_attr( $breakpoint_mobile ) .') {';
		echo '.wpbf-navigation-active .wpbf-mobile-logo img {';
		echo sprintf( 'width: %s;', esc_attr( $menu_active_logo_size_mobile ) . $suffix );
		echo '}';
		echo '}';
	}

	if( $menu_active_height ) {

		echo '.wpbf-navigation-active .wpbf-nav-wrapper {';
		echo sprintf( 'padding-top: %s;', esc_attr( $menu_active_height ) . 'px' );
		echo sprintf( 'padding-bottom: %s;', esc_attr( $menu_active_height ) . 'px' );
		echo '}';

		if( $menu_position == 'menu-stacked' ) {
			echo '.wpbf-navigation-active .wpbf-menu-stacked nav {';
			echo sprintf( 'margin-top: %s;', esc_attr( $menu_active_height ) . 'px' );
			echo '}';
		}

	}

	if( $menu_active_stacked_bg_color && $menu_position == 'menu-stacked-advanced' ) {
		echo '.wpbf-navigation-active .wpbf-menu-stacked-advanced-wrapper, .wpbf-transparent-header .wpbf-navigation-active .wpbf-menu-stacked-advanced-wrapper {';
		echo sprintf( 'background-color: %s;', esc_attr( $menu_active_stacked_bg_color ) );
		echo '}';
	}

	if( $menu_active_bg_color ) {
		echo '.wpbf-navigation-active, .wpbf-transparent-header .wpbf-navigation-active, .wpbf-navigation-active .wpbf-mobile-nav-wrapper {';
		echo sprintf( 'background-color: %s;', esc_attr( $menu_active_bg_color ) );
		echo '}';
	}

	if( $menu_active_logo_color && !$has_custom_logo ) {
		echo '.wpbf-navigation-active .wpbf-logo a, .wpbf-navigation-active .wpbf-mobile-logo a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_active_logo_color ) );
		echo '}';
	}

	if( $menu_active_logo_color_alt && !$has_custom_logo ) {
		echo '.wpbf-navigation-active .wpbf-logo a:hover, .wpbf-navigation-active .wpbf-mobile-logo a:hover {';
		echo sprintf( 'color: %s;', esc_attr( $menu_active_logo_color_alt ) );
		echo '}';
	}

	if( $menu_active_tagline_color && !$has_custom_logo && $menu_logo_description ) {
		echo '.wpbf-navigation-active .wpbf-tagline {';
		echo sprintf( 'color: %s;', esc_attr( $menu_active_tagline_color ) );
		echo '}';
	}

	if( $menu_active_font_color ) {
		echo '.wpbf-navigation-active .wpbf-menu > .menu-item > a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_active_font_color ) );
		echo '}';
	}
	
	if( $menu_active_font_color_alt ) {
		echo '.wpbf-navigation-active .wpbf-menu > .menu-item > a:hover {';
		echo sprintf( 'color: %s;', esc_attr( $menu_active_font_color_alt ) );
		echo '}';
		echo '.wpbf-navigation-active .wpbf-menu > .current-menu-item > a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_active_font_color_alt ) . '!important' );
		echo '}';
	}

	if( $menu_sticky && $menu_active_box_shadow ) {
		echo '.wpbf-navigation.wpbf-navigation-active {';
		echo sprintf( 'box-shadow: 0px 0px %1$s 0px %2$s;', esc_attr( $menu_active_box_shadow_blur ), esc_attr( $menu_active_box_shadow_color ) );
		echo '}';
	}

	// Sticky Off Canvas Navigation
	if( in_array( $menu_position, array( 'menu-off-canvas', 'menu-off-canvas-left', 'menu-full-screen' ) ) && $menu_active_off_canvas_hamburger_color ) {
		echo '.wpbf-navigation-active .wpbf-nav-item, .wpbf-navigation-active .wpbf-nav-item a {';
		echo sprintf( 'color: %s;', esc_attr( $menu_active_off_canvas_hamburger_color ) );
		echo '}';
	}

	// Mobile Sticky Navigation
	if( in_array( $mobile_menu_options, array( 'menu-mobile-hamburger', 'menu-mobile-off-canvas' ) ) ) {

		if( $mobile_menu_active_hamburger_color ) {
			echo '.wpbf-navigation-active .wpbf-mobile-nav-item, .wpbf-navigation-active .wpbf-mobile-nav-item a {';
			echo sprintf( 'color: %s;', esc_attr( $mobile_menu_active_hamburger_color ) );
			echo '}';
		}

		if( $mobile_menu_hamburger_style == 'filled' && $mobile_menu_active_hamburger_bg_color ) {
			echo '.wpbf-navigation-active .wpbf-mobile-menu-toggle {';
			echo sprintf( 'background-color: %s;', esc_attr( $mobile_menu_active_hamburger_bg_color ) );
			echo '}';
		}

	}

	// Call to Action Button
	$cta_button_border_radius                    = get_theme_mod( 'cta_button_border_radius' );
	$cta_button_background_color                 = get_theme_mod( 'cta_button_background_color' );
	$cta_button_font_color                       = get_theme_mod( 'cta_button_font_color' );
	$cta_button_background_color_alt             = get_theme_mod( 'cta_button_background_color_alt' );
	$cta_button_font_color_alt                   = get_theme_mod( 'cta_button_font_color_alt' );
	$cta_button_transparent_background_color     = get_theme_mod( 'cta_button_transparent_background_color' );
	$cta_button_transparent_font_color           = get_theme_mod( 'cta_button_transparent_font_color' );
	$cta_button_transparent_background_color_alt = get_theme_mod( 'cta_button_transparent_background_color_alt' );
	$cta_button_transparent_font_color_alt       = get_theme_mod( 'cta_button_transparent_font_color_alt' );
	$cta_button_sticky_background_color          = get_theme_mod( 'cta_button_sticky_background_color' );
	$cta_button_sticky_font_color                = get_theme_mod( 'cta_button_sticky_font_color' );
	$cta_button_sticky_background_color_alt      = get_theme_mod( 'cta_button_sticky_background_color_alt' );
	$cta_button_sticky_font_color_alt            = get_theme_mod( 'cta_button_sticky_font_color_alt' );

	if( $cta_button_border_radius ) {
		echo '.wpbf-menu .wpbf-cta-menu-item a {';
		echo sprintf( 'border-radius: %s;', esc_attr( $cta_button_border_radius ) . 'px' );
		echo '}';
	}

	if( $cta_button_background_color || $cta_button_font_color ) {
		echo '.wpbf-menu .wpbf-cta-menu-item a, .wpbf-mobile-menu .menu-item.wpbf-cta-menu-item a {';
		if( $cta_button_background_color ) {
		echo sprintf( 'background: %s;', esc_attr( $cta_button_background_color ) );
		}
		if( $cta_button_font_color ) {
		echo sprintf( 'color: %s;', esc_attr( $cta_button_font_color ) );
		}
		echo '}';
	}

	if( $cta_button_background_color_alt || $cta_button_font_color_alt ) {
		echo '.wpbf-menu .wpbf-cta-menu-item a:hover, .wpbf-mobile-menu .menu-item.wpbf-cta-menu-item a:hover {';
		if( $cta_button_background_color_alt ) {
		echo sprintf( 'background: %s;', esc_attr( $cta_button_background_color_alt ) );
		}
		if( $cta_button_font_color_alt ) {
		echo sprintf( 'color: %s;', esc_attr( $cta_button_font_color_alt ) );
		}
		echo '}';
	}

	if( $cta_button_transparent_background_color || $cta_button_transparent_font_color ) {
		echo '.wpbf-navigation-transparent .wpbf-menu .wpbf-cta-menu-item a {';
		if( $cta_button_transparent_background_color ) {
		echo sprintf( 'background: %s;', esc_attr( $cta_button_transparent_background_color ) );
		}
		if( $cta_button_transparent_font_color ) {
		echo sprintf( 'color: %s;', esc_attr( $cta_button_transparent_font_color ) );
		}
		echo '}';
	}

	if( $cta_button_transparent_background_color_alt || $cta_button_transparent_font_color_alt ) {
		echo '.wpbf-navigation-transparent .wpbf-menu .wpbf-cta-menu-item a:hover {';
		if( $cta_button_transparent_background_color_alt ) {
		echo sprintf( 'background: %s;', esc_attr( $cta_button_transparent_background_color_alt ) );
		}
		if( $cta_button_transparent_font_color_alt ) {
		echo sprintf( 'color: %s;', esc_attr( $cta_button_transparent_font_color_alt ) );
		}
		echo '}';
	}

	if( $cta_button_sticky_background_color || $cta_button_sticky_font_color ) {
		echo '.wpbf-navigation-active .wpbf-menu .wpbf-cta-menu-item a {';
		if( $cta_button_sticky_background_color ) {
		echo sprintf( 'background: %s;', esc_attr( $cta_button_sticky_background_color ) );
		}
		if( $cta_button_sticky_font_color ) {
		echo sprintf( 'color: %s;', esc_attr( $cta_button_sticky_font_color ) );
		}
		echo '}';
	}

	if( $cta_button_sticky_background_color_alt || $cta_button_sticky_font_color_alt ) {
		echo '.wpbf-navigation-active .wpbf-menu .wpbf-cta-menu-item a:hover {';
		if( $cta_button_sticky_background_color_alt ) {
		echo sprintf( 'background: %s;', esc_attr( $cta_button_sticky_background_color_alt ) );
		}
		if( $cta_button_sticky_font_color_alt ) {
		echo sprintf( 'color: %s;', esc_attr( $cta_button_sticky_font_color_alt ) );
		}
		echo '}';
	}

	// Navigation Effects
	$menu_effect                 = get_theme_mod( 'menu_effect' );
	$menu_effect_color           = get_theme_mod( 'menu_effect_color' );
	$menu_font_color_alt         = get_theme_mod( 'menu_font_color_alt' );
	$menu_effect_underlined_size = get_theme_mod( 'menu_effect_underlined_size', '2' );
	$menu_effect_boxed_radius    = get_theme_mod( 'menu_effect_boxed_radius', '0' );

	// Underline
	if( $menu_effect == 'underlined' ) {

		echo '.wpbf-menu-effect-underlined.wpbf-menu-animation-fade > .menu-item > a:after {';
		echo 'content: "";';
		echo '-moz-transition: opacity 0.3s;';
		echo '-o-transition: opacity 0.3s;';
		echo '-webkit-transition: opacity 0.3s;';
		echo 'transition: opacity 0.3s;';
		echo sprintf( 'height: %s;', esc_attr( $menu_effect_underlined_size ) . 'px' );
		if( $menu_effect_color ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_effect_color ) );
		} elseif( $menu_font_color_alt ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_font_color_alt ) );
		} else {
			echo 'background: #79c4e0;';
		}
		echo 'width: 100%;';
		echo 'margin: 0;';
		echo 'opacity: 0;';
		echo 'display: block;';
		echo '}';

		// Underline Fade
		echo '.wpbf-menu-effect-underlined.wpbf-menu-animation-fade > .menu-item > a:after {';
		echo 'width: 100%;';
		echo 'margin: 0;';
		echo 'opacity: 0;';
		echo 'display: block;';
		echo '}';

		// Underline Fade Hover
		echo '.wpbf-menu-effect-underlined.wpbf-menu-animation-fade .menu-item > a:hover:after {';
		echo 'opacity: 1;';
		echo '}';

		// Underline Slide
		echo '.wpbf-menu-effect-underlined.wpbf-menu-animation-slide > .menu-item > a:after {';
		echo 'content: "";';
		echo '-moz-transition: width 0.3s;';
		echo '-o-transition: width 0.3s;';
		echo '-webkit-transition: width 0.3s;';
		echo 'transition: width 0.3s;';
		echo sprintf( 'height: %s;', esc_attr( $menu_effect_underlined_size ) . 'px' );
		if( $menu_effect_color ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_effect_color ) );
		} elseif( $menu_font_color_alt ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_font_color_alt ) );
		} else {
			echo 'background: #79c4e0;';
		}
		echo 'width: 0;';
		echo 'margin: 0 auto;';
		echo 'display: block;';
		echo '}';

		// Underline Slide Align Left
		echo '.wpbf-menu-effect-underlined.wpbf-menu-align-left > .menu-item > a:after {';
		echo 'margin: 0;';
		echo '}';

		// Underline Slide Align Right
		echo '.wpbf-menu-effect-underlined.wpbf-menu-align-right > .menu-item > a:after {';
		echo 'margin: 0;';
		echo 'float: right;';
		echo '}';

		// Underline Slide Hover
		echo '.wpbf-menu-effect-underlined.wpbf-menu-animation-slide > .menu-item > a:hover:after {';
		echo 'width: 100%;';
		echo '}';

		// Underline Grow
		echo '.wpbf-menu-effect-underlined.wpbf-menu-animation-grow > .menu-item > a:after {';
		echo 'content: "";';
		echo '-moz-transition: all 0.3s;';
		echo '-o-transition: all 0.3s;';
		echo '-webkit-transition: all 0.3s;';
		echo 'transition: all 0.3s;';
		echo '-moz-transform:scale(.85);';
		echo '-ms-transform:scale(.85);';
		echo '-o-transform:scale(.85);';
		echo '-webkit-transform:scale(.85);';
		echo sprintf( 'height: %s;', esc_attr( $menu_effect_underlined_size ) . 'px' );
		if( $menu_effect_color ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_effect_color ) );
		} elseif( $menu_font_color_alt ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_font_color_alt ) );
		} else {
			echo 'background: #79c4e0;';
		}
		echo 'width: 100%;';
		echo 'margin: 0;';
		echo 'opacity: 0;';
		echo 'display: block;';
		echo '}';

		// Underline Grow Hover
		echo '.wpbf-menu-effect-underlined.wpbf-menu-animation-grow .menu-item > a:hover:after {';
		echo 'opacity: 1;';
		echo '-moz-transform:scale(1);';
		echo '-ms-transform:scale(1);';
		echo '-o-transform:scale(1);';
		echo '-webkit-transform:scale(1);';
		echo '}';

		// Underline Current Menu Item
		echo '.wpbf-menu-effect-underlined > .current-menu-item > a:after {';
		echo 'width: 100% !important;';
		echo 'opacity: 1 !important;';
		echo '-moz-transform:scale(1) !important;';
		echo '-ms-transform:scale(1) !important;';
		echo '-o-transform:scale(1) !important;';
		echo '-webkit-transform:scale(1) !important;';
		echo '}';

	}

	if( $menu_effect == 'boxed' ) {

		echo '.wpbf-menu-effect-boxed > .menu-item > a {';
		echo 'margin: 0 3px;';
		echo '}';

		// Boxed Fade
		echo '.wpbf-menu-effect-boxed.wpbf-menu-animation-fade > .menu-item > a:before {';
		echo 'content: "";';
		echo 'z-index: -1;';
		echo '-moz-transition: opacity 0.3s;';
		echo '-o-transition: opacity 0.3s;';
		echo '-webkit-transition: opacity 0.3s;';
		echo 'transition: opacity 0.3s;';
		echo $menu_effect_color ? sprintf( 'background: %s;', esc_attr( $menu_effect_color ) ) : 'background: #eeeced;';
		echo sprintf( 'border-radius: %s;', esc_attr( $menu_effect_boxed_radius ) . 'px' );
		echo 'top: 0;';
		echo 'left: 0;';
		echo 'opacity: 0;';
		echo 'height: 100%;';
		echo 'width: 100%;';
		echo 'position: absolute;';
		echo '}';

		// Box Fade Hover
		echo '.wpbf-menu-effect-boxed.wpbf-menu-animation-fade .menu-item > a:hover:before {';
		echo 'opacity: 1;';
		echo '}';

		// Boxed Slide
		echo '.wpbf-menu-effect-boxed.wpbf-menu-animation-slide > .menu-item > a:before {';
		echo 'content:"";';
		echo 'z-index: -1;';
		echo '-moz-transition: all 0.3s;';
		echo '-o-transition: all 0.3s;';
		echo '-webkit-transition: all 0.3s;';
		echo 'transition: all 0.3s;';
		echo $menu_effect_color ? sprintf( 'background: %s;', esc_attr( $menu_effect_color ) ) : 'background: #eeeced;';
		echo 'height: 100%;';
		echo 'position: absolute;';
		echo 'top: 0;';
		echo 'left: 50%;';
		echo 'width: 0;';
		echo '}';

		// Box Slide Align Left
		echo '.wpbf-menu-effect-boxed.wpbf-menu-align-left > .menu-item > a:before {';
		echo 'left:0;';
		echo '}';

		// Box Slide Align Right
		echo '.wpbf-menu-effect-boxed.wpbf-menu-align-right > .menu-item > a:before {';
		echo 'right: 0;';
		echo 'left: auto;';
		echo '}';

		// Box Slide Hover
		echo '.wpbf-menu-effect-boxed.wpbf-menu-animation-slide .menu-item > a:hover:before {';
		echo 'width: 100%;';
		echo '}';

		echo '.wpbf-menu-effect-boxed.wpbf-menu-align-center .menu-item > a:hover:before {';
		echo 'left: 0;';
		echo '}';

		// Box Grow
		echo '.wpbf-menu-effect-boxed.wpbf-menu-animation-grow > .menu-item > a:before {';
		echo 'content:"";';
		echo 'z-index: -1;';
		echo '-moz-transition: all 0.3s;';
		echo '-o-transition: all 0.3s;';
		echo '-webkit-transition: all 0.3s;';
		echo 'transition: all 0.3s;';
		echo $menu_effect_color ? sprintf( 'background: %s;', esc_attr( $menu_effect_color ) ) : 'background: #eeeced;';
		echo sprintf( 'border-radius: %s;', esc_attr( $menu_effect_boxed_radius ) . 'px' );
		echo '-moz-transform:scale(.85);';
		echo '-ms-transform:scale(.85);';
		echo '-o-transform:scale(.85);';
		echo '-webkit-transform:scale(.85);';
		echo 'height: 100%;';
		echo 'position: absolute;';
		echo 'top: 0%;';
		echo 'left: 0%;';
		echo 'width: 100%;';
		echo 'opacity: 0;';
		echo '}';

		// Box Grow Hover
		echo '.wpbf-menu-effect-boxed.wpbf-menu-animation-grow .menu-item > a:hover:before {';
		echo 'opacity: 1;';
		echo '-moz-transform:scale(1);';
		echo '-ms-transform:scale(1);';
		echo '-o-transform:scale(1);';
		echo '-webkit-transform:scale(1);';
		echo '}';

		// Box Current Menu Item
		echo '.wpbf-menu-effect-boxed > .current-menu-item > a:before {';
		echo 'opacity: 1 !important;';
		echo 'width: 100% !important;';
		echo 'left: 0 !important;';
		echo '-moz-transform:scale(1) !important;';
		echo '-ms-transform:scale(1) !important;';
		echo '-o-transform:scale(1) !important;';
		echo '-webkit-transform:scale(1) !important;';
		echo '}';

	}

	if( $menu_effect == 'modern' ) {

		echo '.wpbf-menu-effect-modern > .menu-item > a:after {';
		echo 'content:"";';
		echo 'z-index: -1;';
		echo '-moz-transition: width 0.3s;';
		echo '-o-transition: width 0.3s;';
		echo '-webkit-transition: width 0.3s;';
		echo 'transition: width 0.3s;';
		echo 'height:  15px;';
		echo 'position: absolute;';
		echo 'margin-left: -5px;';
		echo 'bottom: 10px;';
		echo 'width: 0;';
		echo 'display: block;';
		if( $menu_effect_color ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_effect_color ) );
		} elseif( $menu_font_color_alt ) {
			echo sprintf( 'background: %s;', esc_attr( $menu_font_color_alt ) );
			echo 'opacity: .3;';
		} else {
			echo 'background: #eeeced;';
		}
		echo '}';

		// Modern Hover
		$padding = $menu_padding*2-10;

		echo '.wpbf-menu-effect-modern > .menu-item > a:hover:after {';
		echo 'width: -moz-calc(100% - '. esc_attr( $padding ) .'px);';
		echo 'width: -webkit-calc(100% - '. esc_attr( $padding ) .'px);';
		echo 'width: -o-calc(100% - '. esc_attr( $padding ) .'px);';
		echo 'width: calc(100% - '. esc_attr( $padding ) .'px);';
		echo '}';

		// Modern Current Menu Item
		echo '.wpbf-menu-effect-modern > .current-menu-item > a:after {';
		echo 'width: -moz-calc(100% - '. esc_attr( $padding ) .'px);';
		echo 'width: -webkit-calc(100% - '. esc_attr( $padding ) .'px);';
		echo 'width: -o-calc(100% - '. esc_attr( $padding ) .'px);';
		echo 'width: calc(100% - '. esc_attr( $padding ) .'px);';
		echo '}';

	}

	// Footer
	$footer_sticky = get_theme_mod( 'footer_sticky' );
	$page_boxed    = get_theme_mod( 'page_boxed' );

	if( $footer_sticky && !$page_boxed ) { ?>

		html{
			height: 100%;
		}

		body, #container{
			display: flex;
			flex-direction: column;
			height: 100%;
		}

		#content{
			flex: 1 0 auto;
		}

		.wpbf-page-footer{
			flex: 0 0 auto;
		}

	<?php }

	// Others
	$social_font_size = get_theme_mod( 'social_font_size' );

	if( $social_font_size ) {
		echo '.wpbf-social-icon {';
		echo sprintf( 'font-size: %s;', esc_attr( $social_font_size ) . 'px' );
		echo '}';
	}

}
add_action( 'wpbf_after_customizer_css', 'wpbf_premium_after_customizer_css', 10 );