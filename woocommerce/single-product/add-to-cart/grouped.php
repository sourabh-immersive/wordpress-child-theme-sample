<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.8.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart grouped_form custom_grouped_product_wrapper" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="woocommerce-grouped-product-list group_table">
		<tbody>
			<tr>
				<th colspan="2">Products</th>
				<th>Quantity</th>
			</tr>
			<?php
			$quantites_required      = false;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters(
				'woocommerce_grouped_product_columns',
				array(
					'image',
					'label',
					'quantity',					
				),
				$product
			);
			$show_add_to_cart_button = false;

			do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );

			foreach ( $grouped_products as $grouped_product_child ) {
				$post_object        = get_post( $grouped_product_child->get_id() );
				$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
				$post               = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $post );

				if ( $grouped_product_child->is_in_stock() ) {
					$show_add_to_cart_button = true;
				}

				echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';

				// Output columns for each product.
				foreach ( $grouped_product_columns as $column_id ) {
					do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );

					switch ( $column_id ) {
						case 'quantity':
							ob_start();

							if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
								woocommerce_template_loop_add_to_cart();
							} elseif ( $grouped_product_child->is_sold_individually() ) {
								echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
							} else {
								do_action( 'woocommerce_before_add_to_cart_quantity' );

								woocommerce_quantity_input(
									array(
										'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
										'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : '', // phpcs:ignore WordPress.Security.NonceVerification.Missing
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
										'placeholder' => '0',
									)
								);

								do_action( 'woocommerce_after_add_to_cart_quantity' );
							}

							$value = ob_get_clean();
							break;
						case 'label':
							$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
							$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
							if ( $grouped_product_child->backorders_require_notification() && $grouped_product_child->is_on_backorder() ) {
							$value .= wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $grouped_product_child->get_id() ) );
							}
							$value .= '</label>';
							$value .= '<div class="grouped-price">'.$grouped_product_child->get_price_html(). '</div>';
							/*$value .= '<div class="grouped-price">'.$grouped_product_child->get_price_html(). '<div class="grouped_stock">'.wc_get_stock_html( $grouped_product_child ) .'</div></div>';*/
							break;
						/*case 'price':
							$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
							break;*/
 
						case 'image':
							$image_size = array( 100,100 );
							$attachment_id = get_post_meta( $grouped_product_child->get_id(), '_thumbnail_id', true );
							$value = wp_get_attachment_image( $attachment_id, $image_size );
							break;
						default:
							$value = '';
							break;
					}

					echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

					do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
				}

				echo '</tr>';
			}
			$post = $previous_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $post );

			do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );
			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

	<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<input type="hidden" name="group_id[]" value="">
		<button type="button" class="single_add_to_cart_button button alt group_cart"><?php echo esc_html( $product->single_add_to_cart_text() ); ?>
		<span class="xoo-cp-added"></span>
		</button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<script type="text/javascript">
 	//jQuery('.sample-listing input[type="number"]').val(0); 

 	jQuery( function( $ ) {

	$(document).on('click','.group_cart',function(){
		$('.xoo-cp-added').removeClass('xoo-cp-icon-check');
		$('.xoo-cp-added').addClass('xoo-cp-icon-spinner');
		let pGroupData = [];
        let getQty = 0;
        let  pGroupId = 0 ;
        $( ".woocommerce-grouped-product-list tr.woocommerce-grouped-product-list-item" ).each(function( index ) {
        
       
        
         getQty = $(this).find('.qty').val();
        if(getQty  > 0 ) {
             pGroupId = $( this ).attr("id").split("-");
            pGroupData.push(
                {
                    p_g_id : pGroupId[1],
                    p_qty: getQty
                }
            )
           
        }
        });
        console.log(pGroupData);

		$.ajax({
	            type: 'POST',
	            url: woocommerce_params.ajax_url,
	            data: {
	                action: 'woocommerce_ajax_add_to_cart',
	                //hash: item_hash,
	                // quantity: item_quantity,
	                product : pGroupData
	            },
	            success: function(response) {
					$('.xoo-cp-added').addClass('xoo-cp-icon-check');
					$('.xoo-cp-added').removeClass('xoo-cp-icon-spinner');
					//var result = JSON.parse(response);
	            	console.log(response);

	            	/*$('.loader').hide();
	            	$('.g5shop__quantity').show();*/
	            	
	            	
	            	if(response.error == true)
	            	{	
						$('.xoo-cp-content').html(`<div class="xoo-cp-atcn xoo-cp-error"><span class="xoo-cp-icon-cross"></span>${response.msg}</div>`);
						$('.xoo-cp-opac').show();
						$('.xoo-cp-modal').addClass('xoo-cp-active');
	            		//jQuery('#'+pro_id).find('.g5shop__quantity').html('<div class="error sample-err">'+response.msg+'</div>');
	            		// $('.sample_products_cart').html();
	            		//$(this).closest('.g5shop__quantity-inner').html('<div class="error sample-err">'+response.msg+'</div>');          		
	            	}
					else{
						$('.xoo-cp-content').html(`<div class="xoo-cp-atcn xoo-cp-success"><span class="xoo-cp-icon-check"></span>${response.msg}</div><div class="card-block p-0"><div class="cart-last-added-item-modal-sections"><div class="cart-last-added-item-modal-section cart-last-added-item-modal-section-items">${response.cart_info}</div><div class="cart-last-added-item-modal-section cart-last-added-item-modal-section-summary"><h5 class="card-title mb-0 mt-2">Basket Summary</h5><hr><div class="cart-summary">
						
						<div class="cart-summary-item">
					<div class="cart-summary-item-name">
						Total items
					</div>
					<div class="cart-summary-item-value">${response.cart_qty}</div>
				</div>
				<div class="cart-summary-item">
					<div class="cart-summary-item-name">Items subtotal</div>
					<div class="cart-summary-item-value">${response.cart_total}</div>
				</div>
			</div>
		</div></div></div>`);
						$('.xoo-cp-opac').show();
						$('.xoo-cp-modal').addClass('xoo-cp-active');
					}
	            }
	        });
	});
		
		/* $(document).on('click','.group_cart',function(){			
			$('.xoo-cp-content').html('<div class="xoo-cp-atcn xoo-cp-error"><span class="xoo-cp-icon-cross"></span>Please choose the quantity of items you wish to add to your cart…</div>');
			$('.xoo-cp-opac').show();
			$('.xoo-cp-modal').addClass('xoo-cp-active');
		}); */
    /*$( document ).on( 'click', '.quantity button', function() {
    		
	        var $thisbutton = $(this);
	        var pro_id = $(this).closest('tr').attr('id');	  			   
	       // var item_hash = $( this ).attr( 'name' ).replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
	        var item_quantity = $( this ).closest('input.qty').val();
	        var currentVal = parseFloat(item_quantity);
			//alert(item_quantity);
			$('input[name="group_id"]').val(pro_id.replace('product-',''));
			var g_id = $('input[name="group_id"]').val();
	        $('#'+pro_id).find('img.loader').show();
    		//$(this).closest('.g5shop__quantity').hide();
	        // e.preventDefault();
	        // addToCart(pro_id,currentVal);
	        // return false;
	        $.ajax({
	            type: 'POST',
	            url: woocommerce_params.ajax_url,
	            data: {
	                action: 'woocommerce_ajax_add_to_cart',
	                //hash: item_hash,
	                quantity: item_quantity,
	                product : g_id
	            },
	            success: function(response) {
	            	/*$('.loader').hide();
	            	$('.g5shop__quantity').show();
	            	
	            	// var result = JSON.parse(response);
	            	// console.log(response.error);
	            	if(response.error == true)
	            	{	
	            		jQuery('#'+pro_id).find('.g5shop__quantity').html('<div class="error sample-err">'+response.msg+'</div>');
	            		// $('.sample_products_cart').html();
	            		//$(this).closest('.g5shop__quantity-inner').html('<div class="error sample-err">'+response.msg+'</div>');          		
	            	}*
	            }
	        });  
	    });*/

	});
 </script>