<?php 

//Exit if accessed directly
if(!defined('ABSPATH')){
	return; 	
}

global $xoo_cp_gl_qtyen_value;
global $woocommerce;

$cart = WC()->cart->get_cart();

$cart_item = $cart[$cart_item_key];


$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

$thumbnail 		= apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

$product_name 	=  apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
					
$product_price 	= apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

$product_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

// Meta data
$attributes = '';

//Variation
$attributes .= $_product->is_type('variable') || $_product->is_type('variation')  ? wc_get_formatted_variation($_product) : '';
// Meta data
if(version_compare( WC()->version , '3.3.0' , "<" )){
	$attributes .=  WC()->cart->get_item_data( $cart_item );
}
else{
	$attributes .=  wc_get_formatted_cart_item_data( $cart_item );
}


//Quantity input
$max_value = apply_filters( 'woocommerce_quantity_input_max', $_product->get_max_purchase_quantity(), $_product );
$min_value = apply_filters( 'woocommerce_quantity_input_min', $_product->get_min_purchase_quantity(), $_product );
$step      = apply_filters( 'woocommerce_quantity_input_step', 1, $_product );
$pattern   = apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' );

?>



<!-- <table class="xoo-cp-pdetails clearfix">
	<tr data-xoo_cp_key="<?php echo $cart_item_key; ?>">
		<td class="xoo-cp-remove"><span class="xoo-cp-icon-cross xoo-cp-remove-pd"></span></td>
		<td class="xoo-cp-pimg"><a href="<?php echo  $product_permalink; ?>"><?php echo $thumbnail; ?></a></td>
		<td class="xoo-cp-ptitle"><a href="<?php echo  $product_permalink; ?>"><?php echo $product_name; ?></a>

		<?php if($attributes): ?>
			<div class="xoo-cp-variations"><?php echo $attributes; ?></div>
		<?php endif; ?>

		<td class="xoo-cp-pprice"><?php echo  $product_price; ?></td>


		<td class="xoo-cp-pqty">
			<?php if ( $_product->is_sold_individually() || !$xoo_cp_gl_qtyen_value ): ?>
				<span><?php echo $cart_item['quantity']; ?></span>				
			<?php else: ?>
				<div class="xoo-cp-qtybox">
				<span class="xcp-minus xcp-chng">-</span>
				<input type="number" class="xoo-cp-qty" max="<?php esc_attr_e( 0 < $max_value ? $max_value : '' ); ?>" min="<?php esc_attr_e($min_value); ?>" step="<?php echo esc_attr_e($step); ?>" value="<?php echo $cart_item['quantity']; ?>" pattern="<?php esc_attr_e( $pattern ); ?>">
				<span class="xcp-plus xcp-chng">+</span></div>
			<?php endif; ?>
		</td>
	</tr>
</table>
<div class="xoo-cp-ptotal"><span class="xcp-totxt"><?php _e('Total','added-to-cart-popup-woocommerce');?> : </span><span class="xcp-ptotal"><?php echo $product_subtotal; ?></span></div> -->

<div class="card-block p-0">
	<div class="cart-last-added-item-modal-sections">
		<div class="cart-last-added-item-modal-section cart-last-added-item-modal-section-items">
			<div class="cart-last-added-item-modal-list">
				<div class="cart-last-added-item-modal-list-item">
					<div class="cart-last-added-item-modal-list-item-main-row">
					    <div class="cart-last-added-item-modal-list-item-main-col-image">
					        <a href="<?php echo  $product_permalink; ?>">
						        <div class="cart-last-added-item-modal-list-item-image">
						            <div class="simg-container-fit-contain simg-container">
						            	<div class="simg-picture">
						            		<?php echo $thumbnail; ?>
						            	</div>
						            </div>
						        </div>
					        </a>
					    </div>
						<div class="cart-last-added-item-modal-list-item-main-col-info">
						    <div class="cart-last-added-item-modal-list-item-title">
						        <a href="<?php echo  $product_permalink; ?>"><?php echo $product_name; ?></a>
						    </div>
						    <div class="cart-variation-list-custom">
						    	<?php if($attributes): ?>
									<div class="custom-variations"><?php echo $attributes; ?></div>
								<?php endif; ?>
						    </div>
						    <div class="cart-last-added-item-modal-list-item-price-row">
						        <div class="cart-last-added-item-modal-list-item-price-col-info">
						            <span class="cart-last-added-item-modal-list-item-qty-label">
						                Quantity:
						            </span>
						            <span class="cart-last-added-item-modal-list-item-qty-value">
						              	<?php echo $cart_item['quantity']; ?>
						            </span>
						        </div>
						        <div class="cart-last-added-item-modal-list-item-price-col-value">
									<span class="price-formatted" data-control="priceFormatted">
										<?php echo $product_price; ?>
									</span>
								</div>
		    				</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="cart-last-added-item-modal-section cart-last-added-item-modal-section-summary">
			<h5 class="card-title mb-0 mt-2">Basket Summary</h5>
			<hr>
			<div class="cart-summary">
				<div class="cart-summary-item">
					<div class="cart-summary-item-name">
						Total items
					</div>
					<div class="cart-summary-item-value"><?php echo $woocommerce->cart->cart_contents_count;; ?></div>
				</div>
				<div class="cart-summary-item">
					<div class="cart-summary-item-name">Items subtotal</div>
					<div class="cart-summary-item-value">
						<?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="addonSection">
	<?php 
		if ( ! $_product->get_upsell_ids() ) {
	        return;
	    }   

	    // Show the product's upsells
	    woocommerce_upsell_display();
	?>
</div>