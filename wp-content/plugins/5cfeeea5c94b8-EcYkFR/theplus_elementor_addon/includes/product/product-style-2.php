<?php 
	global $post,$product;
	$background_image='';
	$image_html = "";
	if ( has_post_thumbnail() ) {
			$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );					
	} else if ( wc_placeholder_img_src() ) {
			$image_html = wc_placeholder_img( 'shop_catalog' );
	}
	$product_id=get_the_ID();
	$data_attr='';
	if($layout=='metro'){
		if ( has_post_thumbnail() ) {
			$data_attr=theplus_loading_bg_image($product_id);
		}else{
			$data_attr = theplus_loading_image_grid($product_id,'background');
		}		
	}
	$catalog_mode='';
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="product-list-content">
	
		<?php if($layout!='metro'){ ?>
			<div class="product-content-image">
			<?php
				do_action('theplus_product_badge');
				$attachment_ids = $product->get_gallery_image_ids();
				if ($attachment_ids) {
					if($layout!='metro'){ ?>
						<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php the_title_attribute(array('echo' => 0)); ?>" class="product-image">
						<?php if ( ! get_post_meta( $attachment_ids[0], '_woocommerce_exclude_image', true ) ) { ?>
							<span class="product-image hover-image"><?php echo wp_get_attachment_image( $attachment_ids[0], 'shop_catalog' ); ?></span>
						<?php } ?>
						<?php echo $image_html; ?>
						</a>
					<?php }
				}else{
					if($layout!='metro'){
						if ( has_post_thumbnail() ) { ?>
							<a href="<?php echo esc_url(get_the_permalink()); ?>" class="product-image" title="<?php the_title_attribute(array('echo' => 0)); ?>">
								<?php include THEPLUS_INCLUDES_URL. 'product/format-image.php'; ?>
							</a>
						<?php }else{ ?>
							<div class="product-image">
								<?php echo theplus_loading_image_grid($product_id); ?>
							</div>
						<?php }
					}
				} ?>
				<div class="product-quick-view"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="quick-view-btn"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
			</div>
		<?php } ?>
		
		<div class="post-content-bottom">
			<?php include THEPLUS_INCLUDES_URL. 'product/post-meta-title.php'; ?>
			<div class="hover-content-price">
			<?php include THEPLUS_INCLUDES_URL. 'product/product-price.php'; ?>
				<?php if(empty($display_cart_button) || $display_cart_button!='yes'){ ?>
				<div class="wrapper-cart-hover-hidden add-cart-btn">
					<?php $_product = wc_get_product( $product_id );
					if( $_product->is_type( 'simple' ) ) { ?>
						<div class="product-add-to-cart" ><a title="<?php echo esc_attr__('Add to Cart','theplus'); ?>" href="?add-to-cart=<?php echo esc_attr($product_id); ?>" rel="nofollow" data-product_id="<?php echo esc_attr($product_id); ?>" data-product_sku="" class="add_to_cart add_to_cart_button product_type_simple ajax_add_to_cart"><span class="text"><span><?php echo esc_html__('Add to cart','theplus'); ?></span></span><span class="icon"><span class="sr-loader-icon"></span><span class="check"></span></span></a></div>
					<?php }else{ ?>
						<div class="product-add-to-cart" ><a rel="nofollow" href="<?php echo esc_url(get_the_permalink()); ?>" data-quantity="1" data-product_id="<?php echo esc_attr($product_id); ?>" data-product_sku="" class="add_to_cart add_to_cart_button product_type_simple " data-added-text=""><span class="text"><span><?php echo esc_html__('Select options','theplus'); ?></span></span><span class="icon"><span class="sr-loader-icon"></span><span class="check"></span></span></a></div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php if($layout=='metro'){ ?>
				<div class="product-quick-view"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="quick-view-btn"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
			<?php } ?>
		</div>
		
		<?php if($layout=='metro'){ ?>
			<div class="product-bg-image-metro" <?php echo $data_attr; ?>><?php do_action('theplus_product_badge'); ?></div>
		<?php } ?>
		
	</div>
</article>