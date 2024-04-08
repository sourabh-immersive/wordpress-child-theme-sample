<?php 
$tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'name',
    'terms'    => 'featured',
    'operator' => 'IN', // or 'NOT IN' to exclude feature products
);
$args = array(
    'post_type'         => 'product',
    /*'meta_key'          => 'total_sales',
    'orderby'           => 'meta_value_num',
    'order'             => 'DESC',*/
    'numberposts'       => 14,
    'post_status'       => array('publish'),
    'tax_query'           => $tax_query   

);
$best_selling_products = get_posts( $args );

/*$args = array(
    'status'     => array('publish'),
    'limit'      => 14,
    'type'       => array('grouped' )
);
$best_selling_products = wc_get_products( $args );*/

/*echo "<pre>"; print_r($best_selling_products); echo "</pre>";*/
$count =count($best_selling_products);
$i = 1;
$j = 1; 

?>
<style>
    #mbestproductswiper{
        display: none;
    }
    @media screen and (max-width: 840px){
        #mbestproductswiper{
            display: block;
        }
        #mdbestproductswiper{
            display: none;
        }
    }
</style>
<?php /*if(is_mobile_device() == 1) {*/ ?>
  <div id="mbestproductswiper" class="swiper-container bestproductswiper bestproductswipermobile">
  <div class="swiper-wrapper">
    <?php foreach($best_selling_products as $prod){ 
      $product = wc_get_product( $prod->ID );
      if ( has_post_thumbnail( $prod->ID ) ){      
        $attachment_ids[0] = get_post_thumbnail_id( $prod->ID );
        $mobile_images = wp_get_attachment_image_src( $attachment_ids[0], 'woocommerce_thumbnail' );
         
        if($mobile_images){
          $mobile_image = $mobile_images[0];
          $mobile_image_width = $mobile_images[1];
          $mobile_image_height = $mobile_images[2];
        } else {
          $mobile_image = esc_url( wc_placeholder_img_src() );
          $mobile_image_width = '300';
          $mobile_image_height = '300';
        }

        $attachments = wp_get_attachment_image_src($attachment_ids[0], 'shop_single' ); 
        if($attachments){
          $attachment = $attachments[0];
          $attachment_image_width = $attachments[1];
          $attachment_image_height = $attachments[2];
        } else {
          $attachment = esc_url( wc_placeholder_img_src() );
          $attachment_image_width = '300';
          $attachment_image_height = '300';
        }

      } else{
        $mobile_image = esc_url( wc_placeholder_img_src() );
        $mobile_image_width = '300';
        $mobile_image_height = '300';
      }
    ?>
    <div class="swiper-slide"> 
      <div class=" product_main_container"> 
        <div class="product_left_sec">
          <ul class="product_list">
            <li class="product_list_item">
              <a href="<?php echo get_permalink( $product->get_id() );?>">
                <div class="product_img">
                  <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $attachment; ?> 800w" sizes="(max-width: 600px) 480px, 800px" src="<?php echo $mobile_image; ?>" alt="<?php echo $product->get_title();?>" loading="lazy" width="<?php echo $mobile_image_width; ?>" height="<?php echo $mobile_image_height; ?>"> 
                </div>
                <div class="product_overlay">
                  <div class="product_info">
                    <div class="product_name"><?php echo $product->get_title();?></div>                
                    <div class="price_box">
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                        <span class="price"><?php echo $price_html; ?></span>
                      <?php endif; ?>                   
                    </div>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  <?php } ?>
  </div><!-- end of swiper-wrapper -->
   <!--  <div class="swiper-pagination"></div> -->
   <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>-->
  </div>
<?php /*} else {*/ ?>
  <div id="mdbestproductswiper" class="swiper-container bestproductswiper">
  <div class="swiper-wrapper">
    <?php foreach($best_selling_products as $prod){ 
      $product = wc_get_product( $prod->ID );
      if ( has_post_thumbnail( $prod->ID ) ){      
        $attachment_ids[0] = get_post_thumbnail_id( $prod->ID );
        /*echo $attachment_ids[0].'tester';*/
        $attachments = wp_get_attachment_image_src($attachment_ids[0], 'full' ); 
        if($attachments){
          $attachment = $attachments[0];
          $attachment_image_width = $attachments[1];
          $attachment_image_height = $attachments[2];
        } else {
          $attachment = esc_url( wc_placeholder_img_src() );
          $attachment_image_width = '300';
          $attachment_image_height = '300';
        }
                 
        $mobile_images = wp_get_attachment_image_src( $attachment_ids[0], 'woocommerce_thumbnail' );
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
        $attachment = esc_url( wc_placeholder_img_src() );
        $mobile_image = esc_url( wc_placeholder_img_src() );        
        $attachment_image_width = '300';
        $mobile_image_width = '300';
        $mobile_image_height = '300';
        $attachment_image_height = '300';
      }
        
    ?>
    <?php if($i==1){ ?>
    <div class="swiper-slide"> 
    <div class=" product_main_container"> 
      <div class="product_left_sec">
        <ul class="product_list"> 
          <li class="product_list_item">
            <a href="<?php echo get_permalink( $product->get_id() );?>">
              <div class="product_img">
                <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $attachment; ?> 800w" sizes="(max-width: 600px) 480px, 800px" src="<?php echo $attachment; ?>" alt="<?php echo $product->get_title();?>" loading="lazy" width="<?php echo $attachment_image_width; ?>" height="<?php echo $attachment_image_height; ?>"> 
              </div>
              <div class="product_overlay">
                <div class="product_info">
                  <div class="product_name"><?php echo $product->get_title();?></div>
                  <div class="price_box">
                    <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <span class="price"><?php echo $price_html; ?></span>
                    <?php endif; ?>                
                  </div>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <?php } else { ?>
        <?php if($i==2){ ?>
          <div class="product_right_sec">
        <?php } ?>
            <ul class="product_list">
                <li class="product_list_item">
                  <a href="<?php echo get_permalink( $product->get_id() );?>">
                    <div class="product_img">
                      <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $attachment; ?> 800w" sizes="(max-width: 600px) 480px, 800px" src="<?php echo $attachment; ?>" alt="<?php echo $product->get_title();?>" loading="lazy" width="<?php echo $attachment_image_width; ?>" height="<?php echo $attachment_image_height; ?>"> 
                    </div>
                    <div class="product_overlay">
                      <div class="product_info">
                        <div class="product_name"><?php echo $product->get_title();?></div>
                        <div class="price_box">
                          <?php if ( $price_html = $product->get_price_html() ) : ?>
                            <span class="price"><?php echo $price_html; ?></span>
                          <?php endif; ?>                       
                        </div>
                      </div>
                    </div>
                  </a>
              </li>
            </ul>
          <?php if($i==7 || $j == $count){ ?></div><!-- end of right_img_sec --> <?php } ?> 
        <?php } ?>
        <?php if($i==7 || $j == $count){ ?></div><!-- end of swiper-slide --></div><?php } ?>
        <?php if($i==7){ $i = 1; } else { $i++; } ?>
      <?php $j++; } ?>
    </div><!-- end of swiper-wrapper -->
   <!--  <div class="swiper-pagination"></div> -->
   <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
  </div>
<?php /*}*/ ?>
