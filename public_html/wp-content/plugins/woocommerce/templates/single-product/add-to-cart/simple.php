<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<style type="text/css">
	.stock.out-of-stock{
		font-weight: bold;
    	font-style: italic;
	}
</style>

<?php
	// Availability
	$availability      = $product->get_availability();
$categ = $product->get_categories();


if(strpos(strtolower($categ), 'honey') > 0){ 
  $availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">Sold out till this season’s harvest.</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
}else{
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' .esc_html($availability['availability'] ). '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
}
	
	
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<?php
		// Get the attributes
		$attributes = $product->get_attributes();
		// Start the loop
		foreach ( $attributes as $attribute ) : ?>

		<?php
		// Check and output, adopted from /templates/single-product/product-attributes.php
		    if ( $attribute['is_taxonomy'] ) {
		        $values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
		        echo "<span class='attribute-container'><span class='attribute-label'>".substr($attribute['name'],3).": </span>" . apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ) ."</span>";
		    } else {
		        // Convert pipes to commas and display values
		        $values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
		        echo "<span class='attribute-container'><span class='attribute-label'>".substr($attribute['name'],3) .": </span>" .apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values )."</span>";
		    }
		?>
<?php endforeach; ?>

<?php 
	$tax_tags = get_the_terms( $product->id, 'product_tag' );
	if($tax_tags):
	?>
	<div class="tags-content">
	<?php
	foreach($tax_tags as $tag){
		if( $tag->name == "Meat"){
			?>
<style type="text/css">
	form.cart{
		/*display: none !important;*/
	}
</style>
			<?php
		}
	     ?>
	    
	     <?php
	}
	?>
	</div>
<?php else: ?>
	
<?php endif; ?>
	<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	 	<span class="quantity-container"><span class="quantity-label">Quantity: </span><span>
	 	<?php
	 		if ( ! $product->is_sold_individually() ) {
	 			woocommerce_quantity_input( array(
	 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
	 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
	 			) );
	 		}
	 	?>
	 	</span>
	 	</span>
	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />



		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
	<div class="note">Note: Regular Order Form</div>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<div class="search-by-tags">
	<!-- <h1 class="search-tags">Search by Tags</h1> -->
	<?php 
	$tax_tags = get_the_terms( $product->id, 'product_tag' );
	if($tax_tags):
	?>
	<div class="tags-content">
	<?php
	foreach($tax_tags as $tag){
		if( $tag->name == "Meat"){
			?>
<div class="form-order-container">
	<div class="order-form"><a href="http://www.telderersrainbowsendfarm.com/meat-order-form/" class="order-form-link">Order Form</a></div>
	<div class="note">Note: Meat Order Form</div>
</div>
			<?php
		}else if(  $tag->name == "localpickup" ){
			?>
<div class="form-order-container">
	<div class="order-form">
	<form action="http://www.telderersrainbowsendfarm.com/order-local-pick-ups/" method="POST">
		<input type="hidden" name="pname" value="<?php echo $product->get_title(); ?>">
		<input type="hidden" name="price" value="<?php echo $product->get_regular_price(); ?>">
		<input type="hidden" name="sku" value="<?php echo $product->sku; ?>">
		<input type="submit" name="submit-order" value="Order Form" class="order-form-link">
	</form>
	<div class="note">Note: Local Pick up</div>
</div>
</div>
			<?php
		}
	     ?>
	     <!-- <div class="tags-div"><a href="<?php echo get_term_link($tag); ?>"><?php echo $tag->name ?></a></div> -->
	     <?php
	}
	?>
	</div>
<?php else: ?>
	<!-- <div class=""> No Tags Found</div> -->
<?php endif; ?>
</div>
<?php endif; ?>

