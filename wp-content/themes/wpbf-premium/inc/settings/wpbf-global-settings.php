<?php
/**
 * Settings
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Settings
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get CPT's
 */
function wpbf_get_cpts( $third_party = false, $as_archives = false ) {

	// Get public Post Types
	$post_types = get_post_types( array( 'public' => true ) );

	// Remove Post Types from array
	unset(
		$post_types['wpbf_hooks'],
		$post_types['elementor_library'],
		$post_types['fl-builder-template'],
		$post_types['attachment']
	);

	if( $third_party ) {
		unset(
			$post_types['page'],
			$post_types['post']
		);
	}

	// Remove Product CPT if WooCommerce if active
	if( class_exists( 'WooCommerce' ) ) {
		unset( $post_types['product'] );
	}

	// Remove Download CPT if EDD if active
	if( class_exists( 'Easy_Digital_Downloads' ) ) {
		unset( $post_types['download'] );
	}

	if( $as_archives ) {

		// Construct archives array from remaining CPT's
		foreach( $post_types as $post_type ) {
			$post_types[$post_type .'-archive'] = ucfirst( $post_type ) .' '. __( 'Archives', 'wpbfpremium' );
			unset( $post_types[$post_type] );
		}

	}

	return $post_types;

}

/**
 * Settings
 */
function wpbf_premium() {

	// Register Settings
	register_setting( 'wpbf-premium-group', 'wpbf_settings' );

	// Sections
	$template_settings_link		= '<a href="https://wp-pagebuilderframework.com/docs/global-template-settings/" target="_blank" class="dashicons dashicons-editor-help"></a>';
	$performance_settings_link	= '<a href="https://wp-pagebuilderframework.com/docs/performance-settings/" target="_blank" class="dashicons dashicons-editor-help"></a>';
	$white_label_settings_link	= '<a href="https://wp-pagebuilderframework.com/docs/white-label/" target="_blank" class="dashicons dashicons-editor-help"></a>';
	$blog_layout_settings	    = '<a href="https://wp-pagebuilderframework.com/docs/advanced-blog-layouts/" target="_blank" class="dashicons dashicons-editor-help"></a>';
	$child_theme_generator_link	= '<a href="https://wp-pagebuilderframework.com/child-theme-generator/" target="_blank">Child Theme Generator</a>';

	add_settings_section( 'wpbf-global-tempalte-settings', sprintf( __( 'Global Template Settings %1s', 'wpbfpremium' ), $template_settings_link), '', 'wpbf-premium-settings' );
	add_settings_section( 'wpbf-blog-layout-settings', sprintf( __( 'Blog Layouts %1s', 'wpbfpremium' ), $blog_layout_settings), '', 'wpbf-premium-settings' );
	add_settings_section( 'wpbf-performance-settings', sprintf( __( 'Performance Settings %1s', 'wpbfpremium' ), $performance_settings_link), '', 'wpbf-premium-settings' );
	add_settings_section( 'wpbf-responsive-breakpoints-settings', __( 'Responsive Breakpoints', 'wpbfpremium' ), '', 'wpbf-premium-settings' );
	add_settings_section( 'wpbf-white-label-general-settings', sprintf( __( 'White Label %s', 'wpbfpremium' ), $white_label_settings_link ), '', 'wpbf-premium-settings' );
	add_settings_section( 'wpbf-white-label-plugin-settings', __( 'Plugin', 'wpbfpremium' ), '', 'wpbf-premium-settings' );
	add_settings_section( 'wpbf-white-label-theme-settings', __( 'Theme', 'wpbfpremium' ), '', 'wpbf-premium-settings' );

	// Fields
	add_settings_field( 'wpbf_blog_layouts', __( 'Blog Layout Settings', 'wpbfpremium' ) . '<p class="description" style="margin-top: 10px;">' . __( 'Enables additional Blog Layout Settings in the Customizer.', 'wpbfpremium' ) . '</p>', 'wpbf_blog_layouts_callback', 'wpbf-premium-settings', 'wpbf-blog-layout-settings' );
	add_settings_field( 'wpbf_fullwidth_global', __( 'Full Width', 'wpbfpremium' ), 'wpbf_fullwidth_global_callback', 'wpbf-premium-settings', 'wpbf-global-tempalte-settings' );
	add_settings_field( 'wpbf_removetitle_global', __( 'Remove Title', 'wpbfpremium' ), 'wpbf_removetitle_global_callback', 'wpbf-premium-settings', 'wpbf-global-tempalte-settings' );
	add_settings_field( 'wpbf_transparent_header_global', __( 'Transparent Header', 'wpbfpremium' ), 'wpbf_transparent_header_global_callback', 'wpbf-premium-settings', 'wpbf-global-tempalte-settings' );
	add_settings_field( 'wpbf_clean_head', __( 'Performance Settings', 'wpbfpremium' ), 'wpbf_performance_callback', 'wpbf-premium-settings', 'wpbf-performance-settings' );
	add_settings_field( 'wpbf_breakpoint_desktop', __( 'Desktop', 'wpbfpremium' ), 'wpbf_breakpoint_desktop_callback', 'wpbf-premium-settings', 'wpbf-responsive-breakpoints-settings' );
	add_settings_field( 'wpbf_breakpoint_medium', __( 'Tablet', 'wpbfpremium' ), 'wpbf_breakpoint_medium_callback', 'wpbf-premium-settings', 'wpbf-responsive-breakpoints-settings' );
	add_settings_field( 'wpbf_breakpoint_mobile', __( 'Mobile', 'wpbfpremium' ), 'wpbf_breakpoint_mobile_callback', 'wpbf-premium-settings', 'wpbf-responsive-breakpoints-settings' );
	add_settings_field( 'wpbf_theme_company_name', __( 'Company Name', 'wpbfpremium' ), 'wpbf_theme_company_name_callback', 'wpbf-premium-settings', 'wpbf-white-label-general-settings' );
	add_settings_field( 'wpbf_theme_company_url', __( 'Company URL', 'wpbfpremium' ), 'wpbf_theme_company_url_callback', 'wpbf-premium-settings', 'wpbf-white-label-general-settings' );
	add_settings_field( 'wpbf_theme_name', __( 'Name', 'wpbfpremium' ), 'wpbf_theme_name_callback', 'wpbf-premium-settings', 'wpbf-white-label-theme-settings' );
	add_settings_field( 'wpbf_theme_description', __( 'Description', 'wpbfpremium' ), 'wpbf_theme_description_callback', 'wpbf-premium-settings', 'wpbf-white-label-theme-settings' );
	add_settings_field( 'wpbf_theme_tags', __( 'Tags', 'wpbfpremium' ), 'wpbf_theme_tags_callback', 'wpbf-premium-settings', 'wpbf-white-label-theme-settings' );
	add_settings_field( 'wpbf_theme_screenshot', __( 'Screenshot', 'wpbfpremium' ), 'wpbf_theme_screenshot_callback', 'wpbf-premium-settings', 'wpbf-white-label-theme-settings' );
	add_settings_field( 'wpbf_plugin_name', __( 'Name', 'wpbfpremium' ), 'wpbf_plugin_name_callback', 'wpbf-premium-settings', 'wpbf-white-label-plugin-settings' );
	add_settings_field( 'wpbf_plugin_description', __( 'Description', 'wpbfpremium' ), 'wpbf_plugin_description_callback', 'wpbf-premium-settings', 'wpbf-white-label-plugin-settings' );

}
add_action( 'admin_init', 'wpbf_premium' );

/**
 * Full Width Callback
 */
function wpbf_fullwidth_global_callback() {

	// vars
	$post_types    = wpbf_get_cpts();
	$wpbf_settings = get_option( 'wpbf_settings' );

	// Loop through Post Types
	foreach( $post_types as $post_type ) {

		$full_width_global = false;

		if( isset( $wpbf_settings['wpbf_fullwidth_global'] ) && in_array( $post_type, $wpbf_settings['wpbf_fullwidth_global'] ) ) {
			$full_width_global = $post_type;
		}

		echo '<label><input type="checkbox" name="wpbf_settings[wpbf_fullwidth_global][]" value="'.$post_type.'" '. checked( $full_width_global, $post_type, false ) .' />'. ucfirst( $post_type ) .'</label>';
		echo '<br>';

	}

}

/**
 * Remove Title Callback
 */
function wpbf_removetitle_global_callback() {

	// vars
	$post_types    = wpbf_get_cpts();
	$wpbf_settings = get_option( 'wpbf_settings' );

	// Loop through Post Types
	foreach( $post_types as $post_type ) {

		$remove_title_global = false;

		if( isset( $wpbf_settings['wpbf_removetitle_global'] ) && in_array( $post_type, $wpbf_settings['wpbf_removetitle_global'] ) ) {
			$remove_title_global = $post_type;
		}

		echo '<label><input type="checkbox" name="wpbf_settings[wpbf_removetitle_global][]" value="'.$post_type.'" '. checked( $remove_title_global, $post_type, false ) .' />'. ucfirst( $post_type ) .'</label>';
		echo '<br>';

	}

}

/**
 * Transparent Header Callback
 */
function wpbf_transparent_header_global_callback() {

	// vars
	$post_types    = wpbf_get_cpts();
	$wpbf_settings = get_option( 'wpbf_settings' );

	// Loop through Post Types
	foreach( $post_types as $post_type ) {

		$transparent_header_global = false;

		if( isset( $wpbf_settings['wpbf_transparent_header_global'] ) && in_array( $post_type, $wpbf_settings['wpbf_transparent_header_global'] ) ) {
			$transparent_header_global = $post_type;
		}

		echo '<label><input type="checkbox" name="wpbf_settings[wpbf_transparent_header_global][]" value="'.$post_type.'" '. checked( $transparent_header_global, $post_type, false ) .' />'. ucfirst( $post_type ) .'</label>';
		echo '<br>';

	}

	echo '<div class="wpbf-transparent-header-advanced-wrapper" style="display: none;">';

	// Advanced Settings
	$advanced_settings = array(
		'404_page'      => __( '404 Page', 'wpbfpremium' ),
		'front_page'    => __( 'Blog Page', 'wpbfpremium' ),
		'search'        => __( 'Search Results', 'wpbfpremium' ),
		'archives'      => __( 'All Archives' ),
		'post_archives' => __( 'Post Archives' )
	);

	$advanced_settings = array_merge( $advanced_settings, wpbf_get_cpts( $third_party = true, $as_archives = true ) );

	// Loop through Advanced Settings just as we did above
	foreach( $advanced_settings as $advanced_setting => $value ) {

		$transparent_header_global = false;

		if( isset( $wpbf_settings['wpbf_transparent_header_global'] ) && in_array( $advanced_setting, $wpbf_settings['wpbf_transparent_header_global'] ) ) {
			$transparent_header_global = $advanced_setting;
		}

		echo '<label><input type="checkbox" name="wpbf_settings[wpbf_transparent_header_global][]" value="'.$advanced_setting.'" '. checked( $transparent_header_global, $advanced_setting, false ) .' />'. ucfirst( $value ) .'</label>';
		echo '<br>';

	}

	echo '</div>';

	echo '<a href="#" class="wpbf-transparent-header-advanced" style="margin-top: 10px; display: inline-block; box-shadow: none;">+ Advanced</a>';

}

/**
 * Blog Layouts
 */
function wpbf_blog_layouts_callback() {

	// vars
	$archives      = wpbf_get_cpts( $third_party = true, $as_archives = true );
	$wpbf_settings = get_option( 'wpbf_settings' );

	$default_archives = array(
		'blog'			=> __( 'Blog Page', 'wpbfpremium' ),
		'search'		=> __( 'Search Results', 'wpbfpremium' )
	);

	$archives = array_merge( $default_archives, $archives );

	// Loop through archives
	foreach( $archives as $archive => $value ) {

		$blog_layouts = false;

		if( isset( $wpbf_settings['wpbf_blog_layouts'] ) && in_array( $archive, $wpbf_settings['wpbf_blog_layouts'] ) ) {
			$blog_layouts = $archive;
		}

		echo '<label><input type="checkbox" name="wpbf_settings[wpbf_blog_layouts][]" value="'. $archive .'" '. checked( $blog_layouts, $archive, false ) .' />'. ucfirst( $value ) .'</label>';
		echo '<br>';

	}

	echo '<div class="wpbf-blog-layouts-advanced-wrapper" style="display: none;">';

	// Advanced Settings
	$advanced_default_archives = array(
		'category'		=> __( 'Categories', 'wpbfpremium' ),
		'tag'			=> __( 'Tags', 'wpbfpremium' ),
		'author'		=> __( 'Author Archives' ),
		'date'			=> __( 'Date Archives', 'wpbfpremium' )
	);

	// Loop through Advanced Settings just as we did above
	foreach( $advanced_default_archives as $advanced_default_archive => $value ) {

		$blog_layouts = false;

		if( isset( $wpbf_settings['wpbf_blog_layouts'] ) && in_array( $advanced_default_archive, $wpbf_settings['wpbf_blog_layouts'] ) ) {
			$blog_layouts = $advanced_default_archive;
		}

		echo '<label><input type="checkbox" name="wpbf_settings[wpbf_blog_layouts][]" value="'.$advanced_default_archive.'" '. checked( $blog_layouts, $advanced_default_archive, false ) .' />'. ucfirst( $value ) .'</label>';
		echo '<br>';

	}

	echo '</div>';

	echo '<a href="#" class="wpbf-blog-layouts-advanced" style="margin-top: 10px; display: inline-block; box-shadow: none;">+ Advanced</a>';

}

/**
 * Performance Callback
 */
function wpbf_performance_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	if( !isset( $wpbf_settings['wpbf_clean_head'] ) ) {

		$remove_feed = $remove_rsd = $remove_wlwmanifest = $remove_generator = $remove_shortlink = $disable_emojis = $disable_embeds = $remove_jquery_migrate = $disable_rss_feed = $css_file = false;

	} else {

		$css_file              = in_array( 'css_file', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$remove_feed           = in_array( 'remove_feed', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$remove_rsd            = in_array( 'remove_rsd', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$remove_wlwmanifest    = in_array( 'remove_wlwmanifest', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$remove_generator      = in_array( 'remove_generator', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$remove_shortlink      = in_array( 'remove_shortlink', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$disable_emojis        = in_array( 'disable_emojis', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$disable_embeds        = in_array( 'disable_embeds', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$remove_jquery_migrate = in_array( 'remove_jquery_migrate', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;
		$disable_rss_feed      = in_array( 'disable_rss_feed', $wpbf_settings['wpbf_clean_head'] ) ? 1 : false;

	}

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="css_file" '. checked( $css_file, 1, false ) .' />'. __( 'Compile inline CSS', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="remove_feed" '. checked( $remove_feed, 1, false ) .' />'. __( 'Remove Feed Links', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="remove_rsd" '. checked( $remove_rsd, 1, false ) .' />'. __( 'Remove RSD', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="remove_wlwmanifest" '. checked( $remove_wlwmanifest, 1, false ) .' />'. __( 'Remove wlwmanifest', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="remove_generator" '. checked( $remove_generator, 1, false ) .' />'. __( 'Remove Generator', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="remove_shortlink" '. checked( $remove_shortlink, 1, false ) .' />'. __( 'Remove Shortlink', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="disable_emojis" '. checked( $disable_emojis, 1, false ) .' />'. __( 'Disable Emojis', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="disable_embeds" '. checked( $disable_embeds, 1, false ) .' />'. __( 'Disable Embeds', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="remove_jquery_migrate" '. checked( $remove_jquery_migrate, 1, false ) .' />'. __( 'Remove jQuery Migrate', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<label><input class="wpbf-performance-setting" type="checkbox" name="wpbf_settings[wpbf_clean_head][]" value="disable_rss_feed" '. checked( $disable_rss_feed, 1, false ) .' />'. __( 'Disable RSS Feed', 'wpbfpremium' ) .'</label>';

	echo '<br>';

	echo '<a href="#" class="wpbf-performance-select-all" style="margin-top: 10px; display: inline-block; box-shadow: none;">Select All</a>';

}

/**
 * Mobile Breakpoint Callback
 */
function wpbf_breakpoint_mobile_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$breakpoint_mobile = !empty( $wpbf_settings['wpbf_breakpoint_mobile'] ) ? $wpbf_settings['wpbf_breakpoint_mobile'] : false;

	echo '<label><input type="text" name="wpbf_settings[wpbf_breakpoint_mobile]" value="'. esc_attr( $breakpoint_mobile ) .'" placeholder="480px" /> <span class="description">'. __( 'Default: until 480px for mobiles.', 'wpbfpremium' ) .'</span></label>';

}

/**
 * Medium Breakpoint Callback
 */
function wpbf_breakpoint_medium_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$breakpoint_medium = !empty( $wpbf_settings['wpbf_breakpoint_medium'] ) ? $wpbf_settings['wpbf_breakpoint_medium'] : false;

	echo '<label><input type="text" name="wpbf_settings[wpbf_breakpoint_medium]" value="'. esc_attr( $breakpoint_medium ) .'" placeholder="768px" /> <span class="description">'. __( 'Default: above 768px for tablets.', 'wpbfpremium' ) .'</span></label>';
}

/**
 * Desktop Breakpoint Callback
 */
function wpbf_breakpoint_desktop_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$breakpoint_desktop = !empty( $wpbf_settings['wpbf_breakpoint_desktop'] ) ? $wpbf_settings['wpbf_breakpoint_desktop'] : false;

	echo '<label><input type="text" name="wpbf_settings[wpbf_breakpoint_desktop]" value="'. esc_attr( $breakpoint_desktop ) .'" placeholder="1024px" /> <span class="description">'. __( 'Default: above 1024px for desktops.', 'wpbfpremium' ) .'</span></label>';

}

/**
 * Theme Name Callback
 */
function wpbf_theme_name_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$theme_name = isset( $wpbf_settings['wpbf_theme_name'] ) ? $wpbf_settings['wpbf_theme_name'] : false;

	echo '<input type="text" name="wpbf_settings[wpbf_theme_name]" value="'. esc_html( $theme_name ) .'" />';

}

/**
 * Theme Description Callback
 */
function wpbf_theme_description_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$theme_description = isset( $wpbf_settings['wpbf_theme_description'] ) ? $wpbf_settings['wpbf_theme_description'] : false;

	echo '<input type="text" name="wpbf_settings[wpbf_theme_description]" value="'. esc_html( $theme_description ) .'" />';

}

/**
 * Theme Tags Callback
 */
function wpbf_theme_tags_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$theme_tags = isset( $wpbf_settings['wpbf_theme_tags'] ) ? $wpbf_settings['wpbf_theme_tags'] : false;

	echo '<input type="text" name="wpbf_settings[wpbf_theme_tags]" value="'. esc_html( $theme_tags ) .'" />';

}

/**
 * Theme Company Name Callback
 */
function wpbf_theme_company_name_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$theme_company_name = isset( $wpbf_settings['wpbf_theme_company_name'] ) ? $wpbf_settings['wpbf_theme_company_name'] : false;

	echo '<input type="text" name="wpbf_settings[wpbf_theme_company_name]" value="'. esc_html( $theme_company_name ) .'" />';

}

/**
 * Theme Company URL Callback
 */
function wpbf_theme_company_url_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$theme_company_url = isset( $wpbf_settings['wpbf_theme_company_url'] ) ? $wpbf_settings['wpbf_theme_company_url'] : false;

	echo '<input type="text" name="wpbf_settings[wpbf_theme_company_url]" value="'. esc_html( $theme_company_url ) .'" />';

}

/**
 * Theme Screenshot Callback
 */
function wpbf_theme_screenshot_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$theme_screenshot = isset( $wpbf_settings['wpbf_theme_screenshot'] ) ? $wpbf_settings['wpbf_theme_screenshot'] : false;

	if( function_exists( 'wp_enqueue_media' ) ) {

		wp_enqueue_media();

	} else {

		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );

	} ?>

	<input id="wpbf-screenshot" class="wpbf-screenshot-url" type="text" name="wpbf_settings[wpbf_theme_screenshot]" size="50" value="<?php echo esc_url( $theme_screenshot ); ?>">
	<a href="#" class="wpbf-screenshot-upload button-secondary"><?php echo esc_html__( 'Add or Upload File', 'wpbfpremum' ); ?></a>
	<a href="#" class="wpbf-screenshot-remove button-secondary">x</a><br>
	<label for="wpbf-screenshot" class="description"><span class="description"><?php _e( 'Recommended image size: 1200px x 900px', 'wpbfpremium' ); ?></span></label>

	</p>

<?php }

/**
 * Plugin Name
 */
function wpbf_plugin_name_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$plugin_name = isset( $wpbf_settings['wpbf_plugin_name'] ) ? $wpbf_settings['wpbf_plugin_name'] : false;

	echo '<input type="text" name="wpbf_settings[wpbf_plugin_name]" value="'. esc_html( $plugin_name ) .'" />';

}

/**
 * Plugin Name
 */
function wpbf_plugin_description_callback() {

	$wpbf_settings = get_option( 'wpbf_settings' );

	$plugin_description = isset( $wpbf_settings['wpbf_plugin_description'] ) ? $wpbf_settings['wpbf_plugin_description'] : false;

	echo '<input type="text" name="wpbf_settings[wpbf_plugin_description]" value="'. esc_html( $plugin_description ) .'" />';

}