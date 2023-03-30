<?php
/**
 * Helpers
 *
 * Collection of Helper Functions
 *
 * @package Page_Builder_Framework_Premium_Add_On
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Credit Shortcode (Deprecated)
 *
 * @param array $atts Shortcode attributes.
 * @return string Link markup.
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
 * Footer Branding
 *
 * @param array $theme_author Theme author data.
 * @return array Theme author data.
 */
function wpbf_footer_branding( $theme_author ) {

	$wpbf_settings            = get_option( 'wpbf_settings' );
	$footer_theme_author_name = get_theme_mod( 'footer_theme_author_name' );
	$footer_theme_author_url  = get_theme_mod( 'footer_theme_author_url' );

	if ( ! empty( $wpbf_settings['wpbf_theme_company_name'] ) ) {
		$theme_author['name'] = $wpbf_settings['wpbf_theme_company_name'];
	}

	if ( ! empty( $wpbf_settings['wpbf_theme_company_url'] ) ) {
		$theme_author['url'] = $wpbf_settings['wpbf_theme_company_url'];
	}

	if ( $footer_theme_author_name ) {
		$theme_author['name'] = $footer_theme_author_name;
	}

	if ( $footer_theme_author_url ) {
		$theme_author['url'] = $footer_theme_author_url;
	}

	return $theme_author;

}
add_filter( 'wpbf_theme_author', 'wpbf_footer_branding' );

/**
 * Social Icon Shortcode
 *
 * @return string HTML markup when social icons available.
 */
function wpbf_social() {

	$social_icons = get_theme_mod( 'social_sortable' );
	$icon_shape   = ' ' . get_theme_mod( 'social_shapes' );
	$icon_style   = ' ' . get_theme_mod( 'social_styles' );
	$icon_size    = ' ' . get_theme_mod( 'social_sizes' );

	if ( ! $social_icons ) {
		return '';
	}

	ob_start();

	if ( is_array( $social_icons ) && ! empty( $social_icons ) ) : ?>
	<div class="wpbf-social-icons<?php echo esc_attr( $icon_shape . $icon_style . $icon_size ); ?>">
		<?php foreach ( $social_icons as $social_icon ) : ?>
			<a class="wpbf-social-icon wpbf-social-<?php echo esc_attr( $social_icon ); ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $social_icon . '_link' ) ); ?>">
				<i class="wpbff wpbff-<?php echo esc_attr( $social_icon ); ?>" aria-hidden="true"></i>
			</a>
		<?php endforeach; ?>
	</div>
		<?php
	endif;

	return ob_get_clean();

}
add_shortcode( 'social', 'wpbf_social' );

/**
 * Responsive Youtube & Vimeo Video Shortcode
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML markup.
 */
function wpbf_responsive_video( $atts ) {

	extract(
		shortcode_atts(
			array(
				'src'    => 'https://www.youtube.com/embed/GH28y-XjHdo',
				'opt_in' => false,
			),
			$atts
		)
	);

	if ( $opt_in ) {

		$host      = false;
		$thumbnail = false;

		if ( strpos( $src, 'youtube' ) !== false ) {

			$host = 'YouTube';
			preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $src, $match );
			$id        = $match[1];
			$thumbnail = 'https://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';

		} elseif ( strpos( $src, 'vimeo' ) !== false ) {

			$host = 'Vimeo';

		}

		if ( $host ) {
			// translators: %s Host url.
			$message = sprintf( __( 'Click the button below to load the video from %s.', 'wpbfpremium' ), $host );
		} else {
			// translators: %1$s Docs url.
			$message = sprintf( __( 'Something went wrong. Please make sure you enter the embed-url as the src tag for the shortcode. <a href="%1$s" target="_blank">Help</a>', 'wpbfpremium' ), 'https://wp-pagebuilderframework.com/docs/shortcodes/#video' );
		}

		$video  = '<div class="wpbf-video-opt-in wpbf-text-center wpbf-margin-bottom">';
		$video .= '<p>' . $message . '</p>';
		$video .= $thumbnail ? '<img class="wpbf-margin-bottom wpbf-video-opt-in-image" src="' . $thumbnail . '">' : false;
		$video .= $host ? '<a href="#" class="wpbf-button wpbf-button-primary wpbf-video-opt-in-button">Load Video</a>' : false;
		$video .= '</div>';
		$video .= '<div class="wpbf-video opt-in" data-wpbf-video="' . esc_url( $src ) . '">';
		$video .= '<iframe width="1600" height="900" src="" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		$video .= '</div>';

	} else {

		$video  = '<div class="wpbf-video">';
		$video .= '<iframe width="1600" height="900" src="' . esc_url( $src ) . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		$video .= '</div>';

	}

	return $video;

}
add_shortcode( 'wpbf-responsive-video', 'wpbf_responsive_video' );

/**
 * Sticky Navigation
 */
function wpbf_sticky_navigation() {

	// vars.
	$menu_sticky                    = get_theme_mod( 'menu_sticky' );
	$menu_active_delay              = get_theme_mod( 'menu_active_delay' );
	$menu_active_animation          = get_theme_mod( 'menu_active_animation' );
	$menu_active_animation_duration = get_theme_mod( 'menu_active_animation_duration' );

	if ( $menu_sticky ) {

		$sticky_navigation  = 'data-sticky="true"';
		$sticky_navigation .= $menu_active_delay ? ' data-sticky-delay="' . esc_attr( $menu_active_delay ) . '"' : ' data-sticky-delay="300px"';
		$sticky_navigation .= $menu_active_animation ? ' data-sticky-animation="' . esc_attr( $menu_active_animation ) . '"' : false;
		$sticky_navigation .= $menu_active_animation_duration ? ' data-sticky-animation-duration="' . esc_attr( $menu_active_animation_duration ) . '"' : ' data-sticky-animation-duration="200"';

		echo $sticky_navigation; // phpcs:ignore -- is ok.

	}

}

/**
 * Transparent Header
 *
 * Add a class to .wpbf-navigation if Transparent Header body class exists
 */
function wpbf_transparent_header() {

	$classes = get_body_class();

	if ( in_array( 'wpbf-transparent-header', $classes, true ) ) {

		echo ' wpbf-navigation-transparent';

	}

}

/**
 * Transparent Header Body Class
 *
 * @param array $classes The class name array.
 * @return array
 */
function wpbf_transparent_header_body_class_2083582( $classes ) {

	if ( is_singular() ) {

		$options = get_post_meta( get_the_ID(), 'wpbf_premium_options', true );

		// Check if transparent-header is ticked.
		$transparent_header = $options ? in_array( 'transparent-header', $options, true ) : false;

		if ( $transparent_header ) {

			$classes[] = 'wpbf-transparent-header';

		} else {

			// Check for global settings.
			$wpbf_settings = get_option( 'wpbf_settings' );

			// Get the array of post types that are set to "Transparent Header" under Appearance -> Theme Settings -> Global Templat Settings.
			$transparent_header_global = isset( $wpbf_settings['wpbf_transparent_header_global'] ) ? $wpbf_settings['wpbf_transparent_header_global'] : array();

			if ( in_array( get_post_type(), $transparent_header_global, true ) ) {
				$classes[] = 'wpbf-transparent-header';
			}
		}
	} else {

		$wpbf_settings = get_option( 'wpbf_settings' );

		// Get the array of post types that are set to "Transparent Header" under Appearance -> Theme Settings -> Global Templat Settings.
		$transparent_headers_global = isset( $wpbf_settings['wpbf_transparent_header_global'] ) ? $wpbf_settings['wpbf_transparent_header_global'] : array();

		// Remove public post types from array as we've already taken care of them above.
		$transparent_headers_global = array_diff( $transparent_headers_global, get_post_types( array( 'public' => true ) ) );

		if ( ! empty( $transparent_headers_global ) ) {

			foreach ( $transparent_headers_global as $transparent_header_global ) {

				switch ( $transparent_header_global ) {

					case '404_page':
						if ( is_404() ) {
							$classes[] = 'wpbf-transparent-header';
						}
						break;
					case 'front_page':
						if ( is_home() ) {
							$classes[] = 'wpbf-transparent-header';
						}
						break;
					case 'search':
						if ( is_search() ) {
							$classes[] = 'wpbf-transparent-header';
						}
						break;
					case 'archives':
						if ( is_archive() ) {
							$classes[] = 'wpbf-transparent-header';
						}
						break;
					case 'post_archives':
						if ( is_date() || is_category() || is_author() || is_tag() ) {
							$classes[] = 'wpbf-transparent-header';
						}
						break;
					default:
						// Post Type Archives.
						// cut given value to get cpt (example: turns download_archive into download to use it in is_post_type_archive()).
						$transparent_header_global = substr( $transparent_header_global, 0, strpos( $transparent_header_global, '_' ) );

						if ( is_post_type_archive( $transparent_header_global ) ) {
							$classes[] = 'wpbf-transparent-header';
						}

						// apply to related taxonomies.
						$taxonomies = get_object_taxonomies( $transparent_header_global, 'names' );

						if ( ! empty( $taxonomies ) ) {

							foreach ( $taxonomies as $taxonomy ) {
								if ( is_tax( $taxonomy ) ) {
									$classes[] = 'wpbf-transparent-header';
								}
							}
						}
						break;

				}
			}
		}
	}

	return $classes;

}
add_filter( 'body_class', 'wpbf_transparent_header_body_class_2083582' );

/**
 * Transparent Header Logo
 *
 * @param string $custom_logo_url Custom logo url.
 * @return string Custom logo url.
 */
function wpbf_transparent_header_logo( $custom_logo_url ) {

	$classes = get_body_class();

	// check if Transparent Header is ticked & if we have a separate Logo for Transparent Headers.
	if ( in_array( 'wpbf-transparent-header', $classes, true ) && get_theme_mod( 'menu_transparent_logo' ) ) {
		$custom_logo_url = get_theme_mod( 'menu_transparent_logo' );
	}

	return $custom_logo_url;

}
add_filter( 'wpbf_logo', 'wpbf_transparent_header_logo', 20 );
add_filter( 'wpbf_logo_mobile', 'wpbf_transparent_header_logo', 20 );

/**
 * Responsive Breakpoints
 *
 * Simple check if Responsive Breakpoints are set
 */
if ( ! function_exists( 'wpbf_has_responsive_breakpoints' ) ) {

	/**
	 * Check responsive breakpoint availability
	 *
	 * @return boolean
	 */
	function wpbf_has_responsive_breakpoints() {

		$wpbf_settings = get_option( 'wpbf_settings' );

		if ( ! empty( $wpbf_settings['wpbf_breakpoint_medium'] ) || ! empty( $wpbf_settings['wpbf_breakpoint_desktop'] ) || ! empty( $wpbf_settings['wpbf_breakpoint_mobile'] ) ) {
			return true;
		} else {
			return false;
		}

	}
}

/**
 * Desktop Breakpoint
 *
 * @return int Desktop breakpoint.
 */
function wpbf_breakpoint_desktop() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	if ( ! empty( $wpbf_settings['wpbf_breakpoint_desktop'] ) ) {
		$desktop_breakpoint = (int) $wpbf_settings['wpbf_breakpoint_desktop'];
	} else {
		$desktop_breakpoint = 1024;
	}

	return $desktop_breakpoint;

}

/**
 * Medium Breakpoint
 *
 * @return int Medium breakpoint.
 */
function wpbf_breakpoint_medium() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	if ( ! empty( $wpbf_settings['wpbf_breakpoint_medium'] ) ) {
		$medium_breakpoint = (int) $wpbf_settings['wpbf_breakpoint_medium'];
	} else {
		$medium_breakpoint = 768;
	}

	return $medium_breakpoint;

}

/**
 * Mobile Breakpoint
 *
 * @return int Mobile breakpoint.
 */
function wpbf_breakpoint_mobile() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	if ( ! empty( $wpbf_settings['wpbf_breakpoint_mobile'] ) ) {
		$mobile_breakpoint = (int) $wpbf_settings['wpbf_breakpoint_mobile'];
	} else {
		$mobile_breakpoint = 480;
	}

	return $mobile_breakpoint;

}

/**
 * Remove Header/Footer
 *
 * Remove the Theme's Header & Footer on the wpbf_hooks (Custom Sections) post type for a better editing experience
 */
function wpbf_remove_header_hooks() {

	if ( is_singular( 'wpbf_hooks' ) ) {

		remove_action( 'wpbf_header', 'wpbf_do_header' );
		remove_action( 'wpbf_footer', 'wpbf_do_footer' );

	}

}
add_action( 'wp', 'wpbf_remove_header_hooks' );
