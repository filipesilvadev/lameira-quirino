<?php $product_id=get_the_ID(); ?>
<div class="wrapper-cart-price">
	<?php $product = new WC_Product( $product_id ); ?>
	<span class="price"><?php echo $product->get_price_html(); ?></span>
</div>