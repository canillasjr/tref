<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
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
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><span style="padding-right:20px;">Price:</span><?php echo $price_html; ?></span>
<?php endif; ?>
