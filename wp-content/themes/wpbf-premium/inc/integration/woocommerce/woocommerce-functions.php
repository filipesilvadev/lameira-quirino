<?php
/**
 * WooCommerce Functions
 *
 * @package Page Builder Framework Premium Add-On
 * @subpackage Integration
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Image Flip
 *
 * Add wpbf-woo-has-gallery Post class
 */
function wpbf_woo_loop_image_flip_post_class( $classes ) {

	if( get_theme_mod( 'woocommerce_loop_image_flip' ) == 'disabled' ) return $classes;

	if( 'product' == get_post_type() ) {

		global $product;

		$attachment_ids = $product->get_gallery_image_ids();

		if( $attachment_ids ) {
			$classes[] = 'wpbf-woo-has-gallery';
		}

	}

	return $classes;

}
add_filter( 'post_class', 'wpbf_woo_loop_image_flip_post_class', 30 );

/**
 * Image Flip
 *
 * Construct
 */
function wpbf_woo_loop_image_flip_construct() {

	if( get_theme_mod( 'woocommerce_loop_image_flip' ) == 'disabled' ) return;

	global $product;

	$attachment_ids = $product->get_gallery_image_ids();

	if ( $attachment_ids ) {

		$attachment_ids			= array_values( $attachment_ids );
		$secondary_image_id		= $attachment_ids['0'];
		$secondary_image_alt	= get_post_meta( $secondary_image_id, '_wp_attachment_image_alt', true );
		$secondary_image_title	= get_the_title( $secondary_image_id );

		echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '',
			array(
				'class' => 'attachment-woocommerce_thumbnail wp-post-image wp-post-image-secondary',
				'alt' => $secondary_image_alt,
				'title' => $secondary_image_title
			)
		);

	}

}
add_action( 'woocommerce_before_shop_loop_item_title', 'wpbf_woo_loop_image_flip_construct', 11 );

/**
 * Menu Item
 *
 * Add menu-item-has-children class to WooCommerce Menu Item if Dropdown is being displayed
 */
function wpbf_woo_menu_item_class_children( $css_classes ) {

	if ( WC()->cart->get_cart() && get_theme_mod( 'woocommerce_menu_item_dropdown' ) !== 'hide' ) {

		$css_classes .= ' menu-item-has-children';

		if( get_theme_mod( 'woocommerce_menu_item_dropdown_popup' ) ) {
			$css_classes .= ' wpbf-woo-menu-item-popup';
		}

	}

	return $css_classes;

}
add_filter( 'wpbf_woo_menu_item_classes', 'wpbf_woo_menu_item_class_children' );

/**
 * Menu Item
 *
 * Before Menu Item
 */
function wpbf_woo_menu_item_premium() {

	// vars
	$label		= apply_filters( 'wpbf_woo_menu_item_label', __( 'Cart', 'wpbfpremium' ) );
	$cart_total	= WC()->cart->get_cart_total();
	$separator	= apply_filters( 'wpbf_woo_menu_item_separator', __( '-', 'wpbfpremium' ) );

	// construct
	$menu_item = '';

	if( get_theme_mod( 'woocommerce_menu_item_label' ) !== 'hide' ) $menu_item .= '<span class="wpbf-woo-menu-item-label">'. esc_html( $label ) .'</span>';
	if( get_theme_mod( 'woocommerce_menu_item_amount' ) !== 'hide' ) $menu_item .= '<span class="wpbf-woo-menu-item-total">' . wp_kses_data( $cart_total ) . '</span>';
	if( get_theme_mod( 'woocommerce_menu_item_amount' ) !== 'hide' ) $menu_item .= '<span class="wpbf-woo-menu-item-separator">'. esc_html( $separator ) .'</span>';

	return $menu_item;

}
add_filter( 'wpbf_woo_before_menu_item', 'wpbf_woo_menu_item_premium' );

/**
 * Menu Item
 *
 * Dropdown
 */
function wpbf_woo_do_menu_item_dropdown() {

	// vars
	$label				= apply_filters( 'wpbf_woo_menu_item_label', __( 'Cart', 'wpbfpremium' ) );
	$cart_items			= WC()->cart->get_cart();
	$cart_url			= wc_get_cart_url();
	$checkout_url		= wc_get_checkout_url();
	$cart_button		= get_theme_mod( 'woocommerce_menu_item_dropdown_cart_button' );
	$checkout_button	= get_the_title( 'woocommerce_menu_item_dropdown_checkout_button' );

	// construct
	$menu_item = '';

	if( $cart_items && get_theme_mod( 'woocommerce_menu_item_dropdown' ) !== 'hide' ) {

		$menu_item .= '<ul class="wpbf-woo-sub-menu">';
		$menu_item .= '<li>';

		$menu_item .= '<div class="wpbf-woo-sub-menu-table-wrap">';

			$menu_item .= '<table class="wpbf-table">';

			$menu_item .= '<thead>';

				$menu_item .= '<tr>';

				$menu_item .= '<th>'. __( 'Product/s', 'wpbfpremium' ) .'</th>';
				$menu_item .= '<th>'. __( 'Quantity', 'wpbfpremium' ) .'</th>';

				$menu_item .= '</tr>';

			$menu_item .= '</thead>';

				$menu_item .= '<tbody>';

				foreach( $cart_items as $cart_item => $values ) { 

					// vars
					$product	= wc_get_product( $values['data']->get_id() );
					$item_name	= $product->get_title();
					$quantity	= $values['quantity'];
					$image		= $product->get_image();
					$link		= $product->get_permalink();
					// $price		= $product->get_price();

					$menu_item .= '<tr>';

						$menu_item .= '<td>';
						$menu_item .= '<div class="wpbf-woo-sub-menu-product-wrap">';
						if( $image ) {
						$menu_item .= '<a class="wpbf-woo-sub-menu-image-wrap" href="'. esc_url( $link ) .'">';
						$menu_item .= $image;
						$menu_item .= '</a>';
						}
						$menu_item .= '<a class="wpbf-woo-sub-menu-title-wrap" href="'. esc_url( $link ) .'">';
						$menu_item .= $item_name;
						$menu_item .= '</a>';
						$menu_item .= '</div>';
						$menu_item .= '</td>';

						$menu_item .= '<td>';
						$menu_item .= $quantity;
						$menu_item .= '</td>';

					$menu_item .= '</tr>';

				}

				$menu_item .= '</tbody>';

			$menu_item .= '</table>';

		$menu_item .= '</div>';

		$menu_item .= '<div class="wpbf-woo-sub-menu-summary-wrap">';

			$menu_item .= '<div>'. __( 'Subtotal', 'wpbfpremium' ) .'</div>';
			$menu_item .= '<div>'. WC()->cart->get_cart_subtotal() .'</div>';

		$menu_item .= '</div>';

		if( $cart_button !== 'hide' || $checkout_button !== 'hide' ) {

			$menu_item .= '<div class="wpbf-woo-sub-menu-button-wrap">';
				if( $cart_button !== 'hide' ) $menu_item .= '<a href="'. esc_url( $cart_url ) .'" class="wpbf-button">'. esc_html( $label ) .'</a>';
				if( $checkout_button !== 'hide' ) $menu_item .= '<a href="'. esc_url( $checkout_url ) .'" class="wpbf-button wpbf-button-primary">'. __( 'Checkout', 'wpbfpremium' ) .'</a>';
			$menu_item .= '</div>';

		}

		$menu_item .= '</li>';
		$menu_item .= '</ul>';

	}

	return $menu_item;

}
add_filter( 'wpbf_woo_menu_item_dropdown', 'wpbf_woo_do_menu_item_dropdown' );

/**
 * Menu Item Dropdown (Cart) Popup Overlay
 */
function wpbf_woo_menu_item_dropdown_popup_overlay() {

	if( get_theme_mod( 'woocommerce_menu_item_dropdown_popup' ) ) {
		echo '<div class="wpbf-woo-menu-item-popup-overlay"></div>';
	}

}
add_action( 'wpbf_body_close', 'wpbf_woo_menu_item_dropdown_popup_overlay' );

/**
 * Off Canvas Sidebar
 */
function wpbf_woo_off_canvas_sidebar() {

	if( get_theme_mod( 'woocommerce_loop_off_canvas_sidebar' ) !== 'enabled' ) return;

	echo '<div class="wpbf-woo-off-canvas-sidebar">';
	echo '<i class="wpbf-close wpbff wpbff-times" aria-hidden="true"></i>';

	if ( !dynamic_sidebar( 'wpbf-woocommerce-off-canvas-sidebar' ) ) {

		if( current_user_can( 'edit_theme_options' ) ) {

			?>

			<div class="widget no-widgets">
				<?php _e( 'Your Off Canvas Sidebar Widgets will appear here.', 'wpbfpremium' ); ?><br>

				<?php if( is_customize_preview() ) { ?>

					<a href="javascript:void(0)" onclick="parent.wp.customize.panel('widgets').focus()"><?php _e( 'Add Widgets', 'page-builder-framework' ); // WPCS: XSS ok. ?></a>

				<?php } else { ?>

					<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'><?php _e( 'Add Widgets', 'wpbfpremium' ); ?></a>

				<?php } ?>

			</div>

			<?php

		}

	}

	echo '</div>';
	echo '<div class="wpbf-woo-off-canvas-sidebar-overlay"></div>';
	echo '<button class="wpbf-woo-off-canvas-sidebar-button" aria-hidden="true">';
	echo apply_filters( 'wpbf_woo_off_canvas_sidebar_icon', '<i class="wpbff wpbff-search"></i>' );
	echo '&nbsp;';
	echo apply_filters( 'wpbf_woo_off_canvas_sidebar_label', __( 'Filter', 'wpbfpremium' ) );
	echo '</button>';

}
add_action( 'woocommerce_before_shop_loop', 'wpbf_woo_off_canvas_sidebar', 10 );

/**
 * Off Canvas Sidebar Widget Area
 */
function wpbf_woo_off_canvas_sidebar_widget_area() {

	if( get_theme_mod( 'woocommerce_loop_off_canvas_sidebar' ) !== 'enabled' ) return;

	// Shop Page Sidebar
	register_sidebar( array(
		'id'			=> 'wpbf-woocommerce-off-canvas-sidebar',
		'name'			=> __( 'WooCommerce Off Canvas Sidebar', 'page-builder-framework' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="wpbf-widgettitle">',
		'after_title'	=> '</h4>',
		'description'	=> __( 'This Off Canvas Sidebar is being displayed on WooCommerce Archive Pages.', 'page-builder-framework' ),
	) );

}
add_action( 'widgets_init', 'wpbf_woo_off_canvas_sidebar_widget_area' );

/**
 * Off Canvas Sidebar Filter (Icon)
 */
function wpbf_woo_off_canvas_sidebar_icon( $icon ) {

	if( get_theme_mod( 'woocommerce_loop_off_canvas_sidebar_icon' ) == 'hamburger' ) {
		$icon = '<i class="wpbff wpbff-hamburger"></i>';
	}

	return $icon;

}
add_filter( 'wpbf_woo_off_canvas_sidebar_icon', 'wpbf_woo_off_canvas_sidebar_icon' );

/**
 * Off Canvas Sidebar Filter (Label)
 */
function wpbf_woo_off_canvas_sidebar_label( $label ) {

	$newlabel = get_theme_mod( 'woocommerce_loop_off_canvas_sidebar_label' );

	if( $newlabel ) {
		$label = esc_html( $newlabel );
	}

	return $label;

}
add_filter( 'wpbf_woo_off_canvas_sidebar_label', 'wpbf_woo_off_canvas_sidebar_label' );

/**
 * Distraction Free Checkout
 */
function wpbf_woo_distraction_free_checkout() {

	if( !is_checkout() ) return;
	if( !get_theme_mod( 'woocommerce_distraction_free_checkout' ) ) return;

	remove_action( 'wpbf_header', 'wpbf_do_header' );
	add_action( 'wpbf_header', 'wpbf_woo_do_distraction_free_checkout' );

}
add_action( 'wp', 'wpbf_woo_distraction_free_checkout' );

function wpbf_woo_do_distraction_free_checkout() {
	?>

	<header id="header" class="wpbf-page-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

		<?php do_action( 'wpbf_header_open' ); ?>

		<div class="wpbf-navigation wpbf-distraction-free">

			<div class="wpbf-container wpbf-container-center wpbf-visible-large wpbf-nav-wrapper">

				<?php get_template_part( 'inc/template-parts/logo/logo' ); ?>

			</div>

			<div class="wpbf-container wpbf-mobile-menu-hamburger wpbf-hidden-large wpbf-mobile-nav-wrapper">
				
				<?php get_template_part( 'inc/template-parts/logo/logo-mobile' ); ?>

			</div>

		</div>

		<?php do_action( 'wpbf_header_close' ); ?>

	</header>

	<?php
}