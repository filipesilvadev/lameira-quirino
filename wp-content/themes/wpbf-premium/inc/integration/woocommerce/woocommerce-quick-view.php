<?php
/**
 * WooCommerce Quick View
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */

namespace WPBF\WooCommerce\Quickview;

use WC_Product;
use WC_Product_Data_Store_CPT;

class QuickView {

	public function __construct() {

		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'add_button' ), 11 );

		add_action( 'wp_ajax_wpbf_woo_quick_view', array( $this, 'ajax_handler_view' ) );
		add_action( 'wp_ajax_nopriv_wpbf_woo_quick_view', array( $this, 'ajax_handler_view' ) );

		add_action( 'wp_ajax_wpbf_woo_quick_view_add_to_cart', array( $this, 'add_to_cart' ) );
		add_action( 'wp_ajax_nopriv_wpbf_woo_quick_view_add_to_cart', array( $this, 'add_to_cart' ) );
	}

	public function add_to_cart() {

		try {
			$product_id   = absint( $_POST['product_id'] );
			$is_variation = sanitize_text_field( $_POST['is_variation'] );
			$quantity     = absint( $_POST['quantity'] );

			if ( $is_variation === 'true' ) {

				$variations   = $_POST['variations'];
				$variation_id = $this->find_matching_product_variation_id( $product_id, $variations );

				WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations );

			} else {

				WC()->cart->add_to_cart( $product_id, $quantity );

			}

		} catch ( \Exception $e ) {
			// do nothing if there is an uncaught exception.
		}

		exit;

	}

	/*
	* Find matching product variation
	*
	* @param int $product_id
	* @param array $attributes
	* @return int Matching variation ID or 0.
	*/
	function find_matching_product_variation_id( $product_id, $attributes ) {

		return ( new \WC_Product_Data_Store_CPT() )->find_matching_product_variation(
			new \WC_Product( $product_id ),
			$attributes
		);

	}

	public function ajax_handler_view() {

		if ( ! isset( $_POST['product_id'] ) ) {
			exit;
		}

		$product_id = absint( $_POST['product_id'] );

		// wp_query for the product.
		wp( 'p=' . $product_id . '&post_type=product' );

		while ( have_posts() ) : the_post(); ?>

            <div class="wpbf-woo-quick-view-modal-content">
                <div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>
					<?php $this->feature_image(); ?>
                    <div class="summary entry-summary">
                        <div class="summary-content">
							<?php $this->quickview_content(); ?>
                        </div>
                    </div>
                </div>
            </div>

		<?php endwhile;

		exit;

	}

	/**
	 * Show Gallery Images
	 *
	 * Check if there is more than one gallery image
	 */
	public function quick_view_show_gallery_images(){

		global $product;

		$gallery_ids = $product->get_gallery_attachment_ids();

		if(count($gallery_ids) > 1){

			foreach( $gallery_ids as $attachment_id ) {
				$image_link = wp_get_attachment_url( $attachment_id );
				return '<img src="'.  $image_link .'"/>';
			}

		}

	}

	/**
	 * Quick View Gallery Buttons
	 *
	 * Displays Gallery Buttons if there is more than one gallery image
	 */
	public function show_slide_navi(){

		global $product;

		$gallery_ids = $product->get_gallery_attachment_ids();

		if(count($gallery_ids) > 1){

			return '<button class="wpbf-quik-view-gallery-prev wpbff wpbff-arrow-left"></button>
			<button class="wpbf-quik-view-gallery-next wpbff wpbff-arrow-right"></button>';

		}

	}

	/**
	 * Quick View Gallery
	 *
	 * Construct Quick View Gallery
	 */
	public function feature_image() {
		/** @var \WC_Product $product */
		global $product;

		if ( has_post_thumbnail() ) {

			$attachment_ids[0] = get_post_thumbnail_id( $product->id );
			$attachment        = wp_get_attachment_image_src($attachment_ids[0], 'full' );
			$has_gallery       = count( $product->get_gallery_attachment_ids() ) > 1 ? true : false;
			$gallery_start     = $has_gallery ? '<div id="wpbf-woo-quick-view-gallery" class="wpbf-siema">' : false;
			$gallery_end       = $has_gallery ? '</div>' : false;

			$img  = '<div class="images">';
			$img .= $gallery_start;
			$img .= '<img src="'.  $attachment[0] .'"/>';
			$img .= $this->quick_view_show_gallery_images();
			$img .= $gallery_end;
			$img .= $this->show_slide_navi() . '</div>';

			echo $img;

		} else {
		 	echo sprintf( '<div class="images"><img src="%s" alt="%s" /></div>', wc_placeholder_img_src(), __( 'Placeholder', 'wpbfpremium' ) );
		}

	}

	/**
	 * Quick View Content
	 *
	 * Construct Quick View Content
	 */
	public function quickview_content() {
		// Title
		woocommerce_template_single_title();

		// Rating
		woocommerce_template_single_rating();

		// Price
		woocommerce_template_single_price();

		// Excerpt
		woocommerce_template_single_excerpt();

		// Quantity & Add to cart button
		woocommerce_template_single_add_to_cart();

		// Meta
		woocommerce_template_single_meta();
	}

	/**
	 * Quick View Button
	 *
	 * Add Quick View Button to Products
	 */
	public function add_button() {

		if ( get_theme_mod( 'woocommerce_loop_quick_view' ) == 'disabled' ) return;

		global $product;

		echo '<a href="javascript:void(0)" id="product_id_' . $product->get_id() . '" class="wpbf-woo-quick-view" data-product_id="' . $product->get_id() . '" aria-hidden="true">' . esc_attr( apply_filters( 'wpbf_woo_quick_view_label', __( 'Quick View', 'wpbfpremium' ) ) ) . '</a>';

	}

	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;

	}

}

QuickView::get_instance();