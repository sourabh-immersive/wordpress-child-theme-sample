<?php
// Only show this if we're looking at a product page
if ( ! is_singular( 'product' ) ) {
    return;
}

global $product;
$productid = $product->get_id(); 
/*$productid = 2209;*/
$images = acf_photo_gallery('product_feature_gallery', $productid);
//Check if return array has anything in it
if( count($images) ): ?>
  <div class="swiper-container productfeaturedgalleryswiper">
    <div class="swiper-wrapper"><?php
      foreach($images as $image):

        $id = $image['id']; 
        $title = $image['title'];
        $caption= $image['caption'];
        $full_image_url= $image['full_image_url']; 
        $custom_image_url = acf_photo_gallery_resize_image($full_image_url, 600, 500); 
        $thumbnail_image_url= $image['thumbnail_image_url'];
        $full_image_urls = wp_get_attachment_image_src($id, 'medium');
        $url= $image['url']; 
        ?>
          <!-- Slides -->
            <div class="swiper-slide">
              <img srcset="<?php echo $thumbnail_image_url; ?> 480w,<?php echo $custom_image_url; ?> 800w" sizes="(max-width: 600px) 480px, 800px" src="<?php echo $custom_image_url; ?>" alt="<?php echo $title;?>"> 
              <p><?php echo $caption; ?></p>
           </div>
    <?php endforeach; ?>
    </div>
    <div class="swiper-button-next swiperNextFeatured swiperNext"></div>
    <div class="swiper-button-prev swiperPrevFeatured swiperPrev"></div>
  </div>        
<?php endif; ?>