<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<style type="text/css">
	.entry-summary .price{
		    font-size: 25px !important;
		    color: #554466 !important;
	}
</style>
<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<div class="selected-variation-custom-field">

			 		 <?php
			 				$custom_data = array();
			 				foreach ($available_variations as $prod_variation) :
			 				    // get some vars to work with
			 				    $variation_id = $prod_variation['variation_id'];
			 				    $variation_object = get_post($variation_id);
			 				    $asin = get_post_meta( $variation_object->ID, '_sku', true);
									$price = get_post_meta( $variation_object->ID, '_price', true);
									$SKU = $product->get_sku();
			 				    $custom_data[$variation_id] = array(
			 				        "ASIN" => $asin , "price" => $price , 'SKU' => $SKU
			 				    );
			 				endforeach;
			 			?>

		 </div>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( '&times;', 'woocommerce' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
?>
<script>
	jQuery( document ).ready( function() {
    var variation_custom_fields = <?php echo json_encode($custom_data); ?>,
        variations_data = JSON.parse( jQuery('form.variations_form').first().attr( 'data-product_variations' ) ),
        $price = jQuery('.entry-summary .price'); // see DIV above

		var custom_field_value = new Array();
  jQuery('table.variations').on('change', 'select', function() {
        var $select = jQuery(this),
            attribute_name = $select.attr('name'),
            selected_value = $select.val();


        // Loop over the variations_data until we find a matching attribute value
        // We then use the variation_id to get the value from variation_custom_fields
        jQuery.each(variations_data, function() {
            if( this.attributes[ attribute_name ] &&  this.attributes[ attribute_name ] === selected_value ) {
                custom_field_value = variation_custom_fields[ this.variation_id ];
								return false; // break
            }
        });

        // doing this outside the loop above ensures that the DIV gets emptied out when it should
				if(custom_field_value['price'] != null)
					// $price.text( '$' + custom_field_value['price'] );
					var htmld = '<span class="price-single">Price: </span><span class="woocommerce-Price-amount amount">$ '+custom_field_value['price']+'</span>';
					$price.html(htmld);
    });
});
</script>
