<?php
$args = array(
    'status'     => array('publish','draft','private'),
    'limit'      => 14,
    /*'type'       => array('variable','grouped' ),*/
    'meta_key' => 'total_sales', 
    'order'    => 'ASC',
    'orderby'  => 'meta_value_num'
);
$args1 = array(
    'post_type'         => 'product',
    'numberposts'       => 14,
    'post_status'       => array('draft','publish'),
    'meta_key'          => 'total_sales',
    'orderby'           => 'meta_value_num',
    'order'             => 'DESC',
    /*'tax_query' => array(
        array(
            'taxonomy' => 'product_type',
            'field'    => 'slug',
            'terms'    => 'variable', 
        ),
    ),*/

);
$best_selling_products1 = get_posts( $args1 );


$best_selling_products = wc_get_products( $args );
/*echo "<pre>"; print_r($best_selling_products); echo "</pre>";*/
/*echo $count =count($best_selling_products);*/
/*echo $count =count($best_selling_products);die('ooka');*/
?>
<div class="swiper-container bestproductswiper">
  <div class="swiper-wrapper">
    <?php foreach($best_selling_products1 as $prod){ 
      $product = wc_get_product( $prod->ID );
      if ( has_post_thumbnail( $prod->ID ) ){      
        $attachment_ids[0] = get_post_thumbnail_id( $prod->ID );
        $mobile_images = wp_get_attachment_image_src( $attachment_ids[0], 'woocommerce_thumbnail' );
        /*echo "<pre>"; print_r($mobile_images); echo "</pre>";*/
        if(!empty($mobile_images)){
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
        $mobile_image_width = '300';
        $mobile_image_height = '300';
      }
      $units_sold = get_post_meta( $prod->ID, 'total_sales', true );
    ?>
    <div class="swiper-slide"> 
      <div class=" product_main_container product-<?php echo $product->get_id(); ?>"> 
        <div class="product_left_sec">
          <ul class="product_list">
            <li class="product_list_item">
              <div class="product_img">
                <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $mobile_image; ?> 800w" sizes="(max-width: 600px) 480px, 800px" src="<?php echo $mobile_image; ?>" alt="<?php echo $product->get_title();?>" loading="lazy" width="<?php echo $mobile_image_width; ?>" height="<?php echo $mobile_image_height; ?> "> 
              </div>
            <div class="product_overlay">
              <div class="product_info">
                <div class="product_name"><?php echo $product->get_title();?></div>                
                <div class="product_name"><?php echo $units_sold;?></div>                
                <div class="price_box">
                  <?php if ( $price_html = $product->get_price_html() ) : ?>
                    <span class="price"><?php echo $price_html; ?></span>
                  <?php endif; ?>                  
                </div>
              </div>
            </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  <?php } ?>
  </div><!-- end of swiper-wrapper -->
   <!--  <div class="swiper-pagination"></div> -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>