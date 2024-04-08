<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids(); ?>
<?php if ( $post_thumbnail_id ) { ?>
<div thumbsSlider="" class="swiper-container mySwiperthumbnails">
  <div class="swiper-wrapper"> <?php
  $full_image_url = wp_get_attachment_image_src($post_thumbnail_id, 'woocommerce_single');
  $thumbnailID = get_post_thumbnail_id($post_thumbnail_id);
  $alt_text = get_post_meta( $thumbnailID, '_wp_attachment_image_alt', true );
  if ( ! empty( $alt_text ) ) {
      $alt_text = $alt_text;
  } else {
      $alt_text = get_the_title($post->ID); 
  }
  if($full_image_url){
    $full_image_url = $full_image_url[0];
  } else {
    $full_image_url = esc_url( wc_placeholder_img_src() );
  }
?>        
    <div class="swiper-slide">
      <img src="<?php echo $full_image_url; ?>" alt="<?php echo $alt_text; ?>"/>
    </div><?php

if ( $attachment_ids && $product->get_image_id() ) {
    	foreach ( $attachment_ids as $attachment_id ) {
        $full_image_url = wp_get_attachment_image_src($attachment_id, 'woocommerce_single');
        $thumbnailID = get_post_thumbnail_id($attachment_id);
        $alt_text = get_post_meta( $thumbnailID, '_wp_attachment_image_alt', true );
        if ( ! empty( $alt_text ) ) {
            $alt_text = $alt_text;
        } else {
            $alt_text = get_the_title($post->ID); 
        }
        if($full_image_url){
          $full_image_url = $full_image_url[0];
        } else {
          $full_image_url = esc_url( wc_placeholder_img_src() );
        }
		//echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
        <div class="swiper-slide">
          <img src="<?php echo $full_image_url; ?>"  alt="<?php echo $alt_text; ?>"/>
        </div>
        <?php
	}
} ?>
    </div>
    <div class="swiper-button-next swiperNextMainProduct swiperNext"></div>
    <div class="swiper-button-prev swiperPrevMainProduct swiperPrev"></div>
</div>
<?php } ?>