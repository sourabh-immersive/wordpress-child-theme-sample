<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) :  ?>

	<section class="related products Related-products">

		<div class="related-produucts-bottom ">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php /*woocommerce_product_loop_start();*/ ?>

			<?php /*foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach;*/ ?>
			<div class="swiper-container relatedproductswiper">
  			<div class="swiper-wrapper">  						
			<?php foreach ( $related_products as $related_product ) : ?>
				<?php 

					/*echo "<pre>";print_r($related_product);echo "</pre>";die('okka');*/
					/*echo $related_product->get_id(); */
					$relproduct = wc_get_product( $related_product->get_id() );
					/*if($relproduct->is_featured()){ */
					    if ( has_post_thumbnail( $related_product->get_id() ) ){      
					        $attachment_ids[0] = get_post_thumbnail_id( $related_product->get_id() );
					        $mobile_images = wp_get_attachment_image_src( $attachment_ids[0], 'shop_catalog' );
					        if($mobile_images){
					          $mobile_image = $mobile_images[0];
					          $mobile_image_width = $mobile_images[1];
					          $mobile_image_height = $mobile_images[2];
					        } else {
					          $mobile_image = esc_url( wc_placeholder_img_src() );
					          $mobile_image_width = '300';
					          $mobile_image_height = '300';
					        }       
					    } else {
					        $mobile_image = esc_url( wc_placeholder_img_src() );
					        $mobile_image_width = '100';
					        $mobile_image_height = '100';
					    }
					    $rel_id = $relproduct->get_id();
					?>
						<div class="swiper-slide"> 
					        <div class=" Related-products-full-section"> 
						        <div class="best-seller">
						        	<img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $mobile_image; ?> 800w" sizes="(max-width: 600px) 480px, 800px" src="<?php echo $mobile_image; ?>" alt="<?php echo $relproduct->get_title();?>" loading="lazy" width="<?php echo $mobile_image_width; ?>" height="<?php echo $mobile_image_height; ?>">
						        	<ul>
					                    <li>
					                        <!-- <a class="add-to-cart" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->

					                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist product_id="'.$rel_id.'" label="" browse_wishlist_text="" product_added_text="" already_in_wishslist_text=""]'); ?>

					                    </li>
					                    <li>
					                        <a class="add-to-cart yith-wcqv-button" href="#" data-product_id="<?php echo $relproduct->get_id(); ?>" style="zoom: 1;"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
					                    </li>
					                </ul>
						        </div>
						        <h3><a href="<?php echo get_permalink( $relproduct->get_id() );?>"><?php echo $relproduct->get_title();?></a></h3>
						        <div class="price-realted-product">
					                <?php if ( $price_html = $relproduct->get_price_html() ) { ?>
				                        <span class="price"><?php echo $price_html; ?></span>
				                    <?php } else { ?>
				                    	<span class="price"></span>
				                    <?php } ?> 
					                <?php
										echo apply_filters(
											'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
											sprintf(
												'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
												esc_url( $relproduct->add_to_cart_url() ),
												esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
												esc_attr( isset( $args['class'] ) ? $args['class'] : 'button add-to cart' ),
												isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
												esc_html( $relproduct->add_to_cart_text() )
											),
											$relproduct,
											$args
										);
									?>
					            </div>
						    </div>	
						</div>			          
							
			<?php endforeach; ?>
			</div>
			<div class="swiper-button-next swiper-button-next1 swiperNext"></div>
    		<div class="swiper-button-prev swiper-button-prev1 swiperPrev"></div>
		</div>

		<?php /*woocommerce_product_loop_end();*/ ?>
		</div>
	</section>
	<?php
endif;

wp_reset_postdata();
