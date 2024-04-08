<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		 <div class="swiper-container mySwipermainProduct">
            <ul class="swiper-wrapper main-product-gallery">
		<?php
		/*if ( $post_thumbnail_id ) {
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}*/
		$html='';
		$attachment_ids = $product->get_gallery_image_ids();

		if ( $post_thumbnail_id ) {
			if ( $attachment_ids && $product->get_image_id() ) {
				$thumbnailID = get_post_thumbnail_id($post_thumbnail_id);
				$full_image_urls = wp_get_attachment_image_src($post_thumbnail_id, 'full');
				$alt_text = get_post_meta( $thumbnailID, '_wp_attachment_image_alt', true );
                /*echo $alt_text;*/ 
                if ( ! empty( $alt_text ) ) {
                    $alt_text = $alt_text;
                } else {
                    $alt_text = get_the_title($post->ID); 
                }
				/*echo "<pre style='display:none'>";print_r($full_image_url);echo "</pre>";*/
				if($full_image_urls){
					$full_image_url = $full_image_urls[0];
          			$attachment_image_width = $full_image_urls[1];
          			$attachment_image_height = $full_image_urls[2];
				} else {
					$full_image_url = esc_url( wc_placeholder_img_src() );
          			$attachment_image_width = '300';
          			$attachment_image_height = '300';
				}
				
				$image_url = wp_get_attachment_image_src($post_thumbnail_id, 'woocommerce_single');
				$html .= '<li class="swiper-slide">';
			    $html .= '<p class="zoom-in-gallery" href="'.$full_image_url.'"  data-size="'.$attachment_image_width.'x'.$attachment_image_height.'"><img src="'.$full_image_url.'" alt="'.$alt_text.'"/><i class="fa fa-search-plus" aria-hidden="true"></i></p>';
			    $html .= '</li>';
				foreach ( $attachment_ids as $attachment_id ) {
					$full_image_urls = wp_get_attachment_image_src($attachment_id, 'full');
					$thumbnailID = get_post_thumbnail_id($attachment_id);
					$alt_text = get_post_meta( $thumbnailID, '_wp_attachment_image_alt', true );
					if ( ! empty( $alt_text ) ) {
                    	$alt_text = $alt_text;
	                } else {
	                    $alt_text = get_the_title($post->ID); 
	                }
					if($full_image_urls){
						$full_image_url = $full_image_urls[0];
	          			$attachment_image_width = $full_image_urls[1];
	          			$attachment_image_height = $full_image_urls[2];
					}  else {
						$full_image_url = esc_url( wc_placeholder_img_src() );
	          			$attachment_image_width = '300';
	          			$attachment_image_height = '300';
					}
					$image_url = wp_get_attachment_image_src($attachment_id, 'woocommerce_single');
					$html .= '<li class="swiper-slide">';
				    $html .= '<p class="zoom-in-gallery" href="'.$full_image_url.'"  data-size="'.$attachment_image_width.'x'.$attachment_image_height.'"><img src="'.$full_image_url.'" alt="'.$alt_text.'"/><i class="fa fa-search-plus" aria-hidden="true"></i></p>';
				    $html .= '</li>';
				}
			} else{
				if ( $post_thumbnail_id ) {
					//$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
					$full_image_urls = wp_get_attachment_image_src($post_thumbnail_id, 'full');
					$thumbnailID = get_post_thumbnail_id($post_thumbnail_id);
					$alt_text = get_post_meta( $thumbnailID, '_wp_attachment_image_alt', true );
					if ( ! empty( $alt_text ) ) {
                    	$alt_text = $alt_text;
	                } else {
	                    $alt_text = get_the_title($post->ID); 
	                }
					if($full_image_urls){
						$full_image_url = $full_image_urls[0];
	          			$attachment_image_width = $full_image_urls[1];
	          			$attachment_image_height = $full_image_urls[2];
					} else {
						$full_image_url = esc_url( wc_placeholder_img_src() );
	          			$attachment_image_width = '300';
	          			$attachment_image_height = '300';
					}
					$image_url = wp_get_attachment_image_src($post_thumbnail_id, 'woocommerce_single');
					$html = '<li class="swiper-slide">';
				    $html .= '<p class="zoom-in-gallery" href="'.$full_image_url.'"  data-size="'.$attachment_image_width.'x'.$attachment_image_height.'"><img src="'.$full_image_url.'" alt="'.$alt_text.'"/><i class="fa fa-search-plus" aria-hidden="true"></i></p>';
				    $html .= '</li>';
				} else {
					$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
					$html .= '</div>';
				}
			}
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
?>
	</ul>
	<div class="swiper-button-next swiperNextMainProduct swiperNext"></div>
    <div class="swiper-button-prev swiperPrevMainProduct swiperPrev"></div>
	</div>
		<?php
		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>

<style>

</style>