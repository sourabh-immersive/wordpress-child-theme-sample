<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products">
		
		<div class="product-add-on">
			<div class="product-add-one">
				<?php
				$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'Product Add-Ons', 'woocommerce' ) );

				if ( $heading ) :
					?>
					<h4><?php echo esc_html( $heading ); ?></h4>
				<?php endif; ?>
				<?php woocommerce_product_loop_start(); ?>
				<div class="swiper-container addonproductswiper">
  					<div class="swiper-wrapper">  						
					<?php $countupsell= 0; foreach ( $upsells as $upsell ) : ?>
						<?php 
							$product = wc_get_product( $upsell->get_id() );
							if(!empty($product && $product->get_status() == 'publish' && $product->get_stock_status() != 'outofstock')){ 
						    if ( has_post_thumbnail( $upsell->get_id() ) ){      
						        $attachment_ids[0] = get_post_thumbnail_id( $upsell->get_id() );
						        $mobile_images = wp_get_attachment_image_src( $attachment_ids[0], 'thumbnail' );
						         
						        if($mobile_images){
						          $mobile_image = $mobile_images[0];
						          $mobile_image_width = $mobile_images[1];
						          $mobile_image_height = $mobile_images[2];
						        } else {
						          $mobile_image = esc_url( wc_placeholder_img_src() );
						          $mobile_image_width = '300';
						          $mobile_image_height = '300';
						        }     
						    } else{
						        $mobile_image = esc_url( wc_placeholder_img_src() );
						        $mobile_image_width = '100';
						        $mobile_image_height = '100';
						    }
						?>
							<div class="swiper-slide"> 
						      	<div class="add-on-products-right">
									<div class="view-product-add-on">
							            <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $mobile_image; ?> 800w" sizes="(max-width: 600px) 480px, 800px" src="<?php echo $mobile_image; ?>" alt="<?php echo $product->get_title();?>" loading="lazy" width="<?php echo $mobile_image_width; ?>" height="<?php echo $mobile_image_height; ?>">
							            <a class="quick-vew-hover button yith-wcqv-button" href="#" data-product_id="<?php echo $product->get_id(); ?>" style="zoom: 1;">Quick-View</a>
							        </div>
							        <a href="<?php echo get_permalink( $product->get_id() );?>"><h5><?php echo $product->get_title();?></h5></a>
							        <div class="price-add-on">
							            <?php if ( $price_html = $product->get_price_html() ) : ?>
					                        <span class="price"><?php echo $price_html; ?></span>
					                    <?php endif; ?> 
							        </div>
							    </div>
							</div>
						<?php
						/*$post_object = get_post( $upsell->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						wc_get_template_part( 'content', 'product' );*/
						} else {
							$countupsell++;
						}
						?>
							
					<?php endforeach;
						if($countupsell != 0 ){ echo "<script>jQuery('.addonsingleSlider').hide();</script>"; }
					?>
					</div>
					<div class="swiper-button-next swiperNextaddon swiperNext"></div>
		    		<div class="swiper-button-prev swiperPrevaddon swiperPrev"></div>
				</div> 


				<?php woocommerce_product_loop_end(); ?>
			</div>
		</div>
	</section>

	<?php
endif;

wp_reset_postdata();
