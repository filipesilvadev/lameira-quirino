<?php
/**
 * Options
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Settings
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load Metaboxes
 */
function wpbf_premium_metabox_setup() {

	add_action( 'add_meta_boxes', 'wpbf_premium_add_metaboxes', 20 );
	add_action( 'save_post', 'wpbf_premium_meta_save', 10, 2 );

}
add_action( 'load-post.php', 'wpbf_premium_metabox_setup' );
add_action( 'load-post-new.php', 'wpbf_premium_metabox_setup' );

/**
 * Metaboxes
 */
function wpbf_premium_add_metaboxes() {

	// Get public Post Types
	$post_types = get_post_types( array( 'public' => true ) );

	// Remove Post Types from array
	unset( $post_types['wpbf_hooks'], $post_types['elementor_library'], $post_types['fl-builder-template'] );

	// Add Options Metabox
	add_meta_box( 'wpbf_header', esc_html__( 'Transparent Header', 'wpbfpremium' ), 'wpbf_premium_options_metabox', $post_types, 'side', 'default' );

}

/**
 * Options Metabox
 */
function wpbf_premium_options_metabox( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'wpbf_premium_options_nonce' );
	$wpbf_stored_meta = get_post_meta( $post->ID );

	if (!isset( $wpbf_stored_meta['wpbf_premium_options'][0] ) ) {
		$wpbf_stored_meta['wpbf_premium_options'][0] = false;
	}

	$mydata = $wpbf_stored_meta['wpbf_premium_options'][0];

	if ( strpos( $mydata, 'transparent-header') !== false ) {
		$transparent_header = 'transparent-header';
	} else {
		$transparent_header = false;
	}

	?>

	<div>
		<input id="transparent-header" type="checkbox" name="wpbf_premium_options[]" value="transparent-header" <?php checked( $transparent_header, 'transparent-header' ); ?> />
		<label for="transparent-header"><?php _e( 'Transparent Header', 'wpbfpremium' ); ?></label>
	</div>

<?php }

function wpbf_premium_meta_save( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['wpbf_premium_options_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['wpbf_premium_options_nonce'] ), basename( __FILE__ ) ) ) ? true : false;

	// stop here if is autosave, revision or nonce is invalid
	if( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	// stop if current user can't edit posts
	if( !current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// save options metadata
	$checked = array();

	if ( isset( $_POST['wpbf_premium_options'] ) ) {

		if ( in_array( 'transparent-header', $_POST['wpbf_premium_options'] ) !== false ) {

			$checked[] = 'transparent-header';

		}

	}

	update_post_meta( $post_id, 'wpbf_premium_options', $checked );

}