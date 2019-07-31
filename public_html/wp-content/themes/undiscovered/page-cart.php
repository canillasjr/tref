<?php get_header('blogs') ?>
	<h1 class="cart-title">Your Cart</h1>
<?php
	
	echo do_shortcode('[woocommerce_cart]');
?>
<?php get_footer();?>