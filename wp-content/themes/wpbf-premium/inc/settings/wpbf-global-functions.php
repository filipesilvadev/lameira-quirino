<?php
/**
 * Theme Settings Functions
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Settings
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Responsive Breakpoints
 */
function wpbf_dequeue_responsive_css() {

	if ( wpbf_has_responsive_breakpoints() ) {

		wp_dequeue_style( 'wpbf-responsive' );
		wp_deregister_style( 'wpbf-responsive' );

		// WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {

			wp_dequeue_style( 'wpbf-woocommerce-smallscreen' );
			wp_deregister_style( 'wpbf-woocommerce-smallscreen' );

		}

	}

}
add_action( 'wp_enqueue_scripts', 'wpbf_dequeue_responsive_css', 100 );

/**
 * White Label Theme
 */
function wpbf_white_label_theme( $themes ) {

	// vars
	$wpbf_settings = is_multisite() ? get_blog_option( 1, 'wpbf_settings' ) : get_option( 'wpbf_settings' );

	$theme_data = array(
		'name' 				=> isset( $wpbf_settings['wpbf_theme_name'] ) ? $wpbf_settings['wpbf_theme_name'] : '',
		'description' 		=> isset( $wpbf_settings['wpbf_theme_description'] ) ? $wpbf_settings['wpbf_theme_description'] : '',
		'tags'				=> isset( $wpbf_settings['wpbf_theme_tags'] ) ? $wpbf_settings['wpbf_theme_tags'] : '',
		'company_name' 		=> isset( $wpbf_settings['wpbf_theme_company_name'] ) ? $wpbf_settings['wpbf_theme_company_name'] : '',
		'company_url' 		=> isset( $wpbf_settings['wpbf_theme_company_url'] ) ? $wpbf_settings['wpbf_theme_company_url'] : '',
		'screenshot_url' 	=> isset( $wpbf_settings['wpbf_theme_screenshot'] ) ? $wpbf_settings['wpbf_theme_screenshot'] : '',
	);
		
	if ( !empty( $theme_data['name'] ) ) {
		
		$themes['page-builder-framework']['name'] = $theme_data['name'];

		foreach ( $themes as $theme_key => $theme ) {
			if ( isset( $theme['parent'] ) && 'Page Builder Framework' == $theme['parent'] ) {
				$themes[ $theme_key ]['parent'] = $theme_data['name'];
			}
		}
		
	}

	if ( !empty( $theme_data['description'] ) ) {
		$themes['page-builder-framework']['description'] = $theme_data['description'];
	}

	if ( !empty( $theme_data['tags'] ) ) {
		$themes['page-builder-framework']['tags'] = $theme_data['tags'];
	}

	if ( !empty( $theme_data['company_name'] ) ) {
		$company_url = empty( $theme_data['company_url'] ) ? '#' : $theme_data['company_url'];
		$themes['page-builder-framework']['author'] = $theme_data['company_name'];
		$themes['page-builder-framework']['authorAndUri'] = '<a href="' . $company_url . '">' . $theme_data['company_name'] . '</a>';
	}

	if ( !empty( $theme_data['screenshot_url'] ) ) {
		$themes['page-builder-framework']['screenshot'] = array( $theme_data['screenshot_url'] );
	}
	
	return $themes;

}
add_filter( 'wp_prepare_themes_for_js', 'wpbf_white_label_theme' );

/**
 * White Label Premium Add-On
 */
function wpbf_white_label_plugin( $plugins ) {

	// vars
	$wpbf_settings  = is_multisite() ? get_blog_option( 1, 'wpbf_settings' ) : get_option( 'wpbf_settings' );
	$add_on			= 'wpbf-premium/wpbf-premium.php';

	$plugin_data = array(
		'name'			=> isset( $wpbf_settings['wpbf_plugin_name'] ) ? $wpbf_settings['wpbf_plugin_name'] : '',
		'description'	=> isset( $wpbf_settings['wpbf_plugin_description'] ) ? $wpbf_settings['wpbf_plugin_description'] : '',
		'company_name'	=> isset( $wpbf_settings['wpbf_theme_company_name'] ) ? $wpbf_settings['wpbf_theme_company_name'] : '',
		'company_url'	=> isset( $wpbf_settings['wpbf_theme_company_url'] ) ? $wpbf_settings['wpbf_theme_company_url'] : '',
	);

	if ( !empty( $plugin_data['name'] ) ) {
		$plugins[$add_on]['Name'] = $plugin_data['name'];
		$plugins[$add_on]['Title'] = $plugin_data['name'];
	}

	if ( !empty( $plugin_data['description'] ) ) {
		$plugins[$add_on]['Description'] = $plugin_data['description'];
	}

	if ( !empty( $plugin_data['company_name'] ) ) {
		$plugins[$add_on]['Author'] = $plugin_data['company_name'];
		$plugins[$add_on]['AuthorName'] = $plugin_data['company_name'];
	}

	if ( !empty( $plugin_data['company_url'] ) ) {
		$plugins[$add_on]['AuthorURI'] = $plugin_data['company_url'];
		$plugins[$add_on]['PluginURI'] = $plugin_data['company_url'];
	}

	return $plugins;

}
add_filter( 'all_plugins', 'wpbf_white_label_plugin' );

/**
 * Rename Premium Add-On
 */
function wpbf_white_label_plugin_name( $plugin_name ) {

	$wpbf_settings	= get_option( 'wpbf_settings' );

	if( !empty( $wpbf_settings['wpbf_plugin_name'] ) ) {
		$plugin_name = $wpbf_settings['wpbf_plugin_name'];
	}

	return $plugin_name;

}
add_filter( 'wpbf_premium_plugin_name', 'wpbf_white_label_plugin_name' );

/**
 * Rename Theme
 */
function wpbf_white_label_theme_name( $theme_name ) {

	$wpbf_settings	= get_option( 'wpbf_settings' );

	if( !empty( $wpbf_settings['wpbf_theme_name'] ) ) {
		$theme_name = $wpbf_settings['wpbf_theme_name'];
	}

	return $theme_name;

}
add_filter( 'wpbf_premium_theme_name', 'wpbf_white_label_theme_name' );

/**
 * Review Notice
 *
 * Disable Review Notice if Plugin/Theme has been white labeled to not expose the creator of the website
 * To manually disable the review notice add "add_filter( 'wpbf_premium_review_notice', '__return_false' );" to your child-theme's functions.php
 */
function wpbf_disable_review_notice() {

	$wpbf_settings	= get_option( 'wpbf_settings' );

	if( !empty( $wpbf_settings['wpbf_plugin_name'] ) || !empty( $wpbf_settings['wpbf_theme_name'] ) ) {
		add_filter( 'wpbf_premium_review_notice', '__return_false' );
	}

}
add_action( 'admin_init', 'wpbf_disable_review_notice' );

/**
 * Performance Settings
 *
 * Helper Functions
 */

// Compile CSS
function wpbf_compile_customizer_css( $output ) {
	$output = 'file';
	return $output;
}

// Disable Emojis Tiny MCE
function wpbf_disable_emojis_tinymce( $plugins ) {

	if( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}

}

// Disable Embeds Tiny MCE
function wpbf_disable_embeds_tiny_mce_plugins( $plugins ) {

	return array_diff( $plugins, array( 'wpembed' ) );

}

// Embed Rewrite Rules
function wpbf_disable_embeds_rewrite_rules( $rules ) {

	foreach( $rules as $rule => $rewrite ) {
		if( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[$rule] );
		}
	}

	return $rules;

}

// Disable RSS Feed
function wpbf_disable_rss_feed() {

	wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );

}

// Disable Emojis
function wpbf_disable_emojis() {

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'wpbf_disable_emojis_tinymce' );
	add_filter( 'emoji_svg_url', '__return_false' );

}

// Disable Embeds
function wpbf_disable_embeds() {

	global $wp;
	$wp->public_query_vars = array_diff( $wp->public_query_vars, array( 'embed' ) );

	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	add_filter( 'embed_oembed_discover', '__return_false' );
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );

	add_filter( 'tiny_mce_plugins', 'wpbf_disable_embeds_tiny_mce_plugins' );
	add_filter( 'rewrite_rules_array', 'wpbf_disable_embeds_rewrite_rules' );

}

// Remove jQuery Migrate
function wpbf_remove_jquery_migrate( &$scripts ) {

	if( !is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
	}

}

/**
 * Performance Settings
 *
 * Getting Started
 */
$wpbf_settings = get_option( 'wpbf_settings' );

if( isset( $wpbf_settings['wpbf_clean_head'] ) ) {

	$wpbf_performance = $wpbf_settings['wpbf_clean_head'];

	// Compile inline CSS
	if ( in_array( 'css_file', $wpbf_performance ) ) {

		add_filter( 'wpbf_css_output', 'wpbf_compile_customizer_css' );

	}

	// Remove Feed Links
	if ( in_array( 'remove_feed', $wpbf_performance ) ) {

		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );

	}

	// Remove RSD Link
	if ( in_array( 'remove_rsd', $wpbf_performance ) ) {

		// remove rsd link
		remove_action( 'wp_head', 'rsd_link' );

	}

	// Remove wlwmanifest
	if ( in_array( 'remove_wlwmanifest', $wpbf_performance ) ) {

		remove_action( 'wp_head', 'wlwmanifest_link' );

	}

	// Remove WP Generator Tag
	if ( in_array( 'remove_generator', $wpbf_performance ) ) {

		remove_action( 'wp_head', 'wp_generator' );

	}

	// Remove Shortlink
	if ( in_array( 'remove_shortlink', $wpbf_performance ) ) {

		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );

	}

	// Disable RSS
	if ( in_array( 'disable_rss_feed', $wpbf_performance ) ) {

		add_action( 'do_feed', 'wpbf_disable_rss_feed', 1 );
		add_action( 'do_feed_rdf', 'wpbf_disable_rss_feed', 1 );
		add_action( 'do_feed_rss', 'wpbf_disable_rss_feed', 1 );
		add_action( 'do_feed_rss2', 'wpbf_disable_rss_feed', 1 );
		add_action( 'do_feed_atom', 'wpbf_disable_rss_feed', 1 );
		add_action( 'do_feed_rss2_comments', 'wpbf_disable_rss_feed', 1 );
		add_action( 'do_feed_atom_comments', 'wpbf_disable_rss_feed', 1 );

	}

	// Disable Emojis
	if ( in_array( 'disable_emojis', $wpbf_performance ) ) {

		add_action( 'init', 'wpbf_disable_emojis' );

	}

	// Disable Embeds
	if ( in_array( 'disable_embeds', $wpbf_performance ) ) {

		add_action( 'init', 'wpbf_disable_embeds', 9999 );

	}

	// Remove jQuery Migrate
	if ( in_array( 'remove_jquery_migrate', $wpbf_performance ) ) {

		add_filter( 'wp_default_scripts', 'wpbf_remove_jquery_migrate' );

	}

}