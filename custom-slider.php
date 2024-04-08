 <?php
 /*
Template Name: Custom slider
 */

$all_categories = get_field('feature_category_data', 'option');
if(!empty($all_categories)){
$count = count($all_categories);
$i = 1;
$j = 1;
if($count != 0) { ?>
<style>
    #mcatswiper{
        display: none;
    }
    @media screen and (max-width: 840px){
        #mcatswiper{
            display: block;
        }
        #dcatswiper{
            display: none;
        }
    }
</style>
<?php /*if(is_mobile_device() == 1) {*/ ?>
<div id="mcatswiper" class="swiper-container catswiper"> 
    <div class="swiper-wrapper product_gallery">
        <?php foreach($all_categories as $category){  
            $cat = $category['feature_category'];
            $cat_heading = $category['feature_category_title'];
            /*echo $cat_heading."<pre>";print_r($cat);echo "</pre>";die('test');*/
           $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $mobile_images = wp_get_attachment_image_src( $thumbnail_id, 'medium' );     
            $cat_images = wp_get_attachment_image_src( $thumbnail_id, 'shop_single' );
            $full_images = wp_get_attachment_image_src( $thumbnail_id,'full');
            if(!empty($cat_images)){
                $first_image = $cat_images[0];
            } else {
                $first_image = $full_images[0];
            }
            if(!empty($mobile_images)){
                $mobile_image = $mobile_images[0];
            } else {
                $mobile_image = esc_url( wc_placeholder_img_src() );
            }
            $woo_cat_slug = $cat->slug;
            $cat_link = get_term_link( $woo_cat_slug, 'product_cat' );
            ?>
                <div class="swiper-slide">
                    <div class="left_img_sec">
                        <div class="left_img_inner">
                            <a href="<?php echo $cat_link; ?>">
                                
                                <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $first_image; ?> 800w" sizes="(max-width: 600px) 480px, 600px" src="<?php echo $mobile_image; ?>" alt="<?php echo $cat->name;?>"> 
                                <p><?php if(!empty($cat_heading)){ echo $cat_heading; } else { echo $cat->name; } ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            
        <?php  } ?>
    <!-- Add Pagination -->
    
    
    </div><!-- end of swiper-wrapper -->
    <!-- <div class="swiper-pagination"></div> -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<?php /*} else {*/ ?>
<div id="dcatswiper" class="swiper-container catswiper"> 
    <div class="swiper-wrapper product_gallery">
        <?php foreach($all_categories as $category) {  
            $cat = $category['feature_category'];
            $cat_heading = $category['feature_category_title'];
            /*echo $cat_heading."<pre>";print_r($cat);echo "</pre>"; */
            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $mobile_images = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );     
            $full_images = wp_get_attachment_image_src( $thumbnail_id,'full'); 
            if(!empty($full_images)){
                $full_image = $full_images[0];
            } else {
                $full_image = esc_url( wc_placeholder_img_src() );
            }
            if(!empty($mobile_images)){
                $mobile_image = $mobile_images[0];
            } else {
                $mobile_image = esc_url( wc_placeholder_img_src() );
            }
            $woo_cat_slug = $cat->slug;
            $cat_link = get_term_link( $woo_cat_slug, 'product_cat' );
            if($i==1){ 
                $cat_images = wp_get_attachment_image_src( $thumbnail_id, 'home-thumb-cat-large-1' );
                if(!empty($cat_images)){
                    $first_image = $cat_images[0];
                } else {
                    $first_image = $full_image;
                }
                
            ?>
                <div class="swiper-slide">
                <div class="left_img_sec">
                    <div class="left_img_inner">
                        <a href="<?php echo $cat_link; ?>">
                                <p><?php if(!empty($cat_heading)){ echo $cat_heading; } else { echo $cat->name; } ?></p>
                            <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $full_image; ?> 800w" sizes="(max-width: 600px) 480px, 600px" src="<?php echo $full_image; ?>" alt="<?php echo $cat->name;?>"> 
                        
                        </a>
                    </div>
                </div>
            <?php } else { ?>
                <?php 
                    
                    $cat_images = wp_get_attachment_image_src( $thumbnail_id, 'home-thumb-cat-large-2' );
                    /*echo "<pre style='display:none;'>";print_r($cat_images);echo "</pre>";*/
                    if(!empty($cat_images)){
                        $cat_image = $cat_images[0];
                    } else {                        
                        $cat_image = $full_image;
                    }
                    
                ?>
                <?php if($i==2){ ?>
                <div class="right_img_sec">
                <?php } ?>
                    <?php if($i!=4){ ?>
                    <div class="right_img_half">
                        <div class="right_img_half_inner"> 
                            <a href="<?php echo $cat_link; ?>">
                                    <p><?php if(!empty($cat_heading)){ echo $cat_heading; } else { echo $cat->name; } ?></p>
                                <img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $full_image; ?> 800w" sizes="(max-width: 600px) 480px, 600px" src="<?php echo $full_image; ?>" alt="<?php echo $cat->name;?>"> 
                            
                            </a>
                        </div>
                    </div>
                    
                    <?php }  else { ?>
                        <?php 
                        $cat_images = wp_get_attachment_image_src( $thumbnail_id, 'home-thumb-cat-large-3' );
                        if(!empty($cat_images)){
                            $cat_image = $cat_images[0];
                        } else {                        
                            $cat_image = $full_image;
                        }
                    ?>
                    <div>
                        <div class="right_img_half_inner last_img">
                            <a href="<?php echo $cat_link; ?>"> 
                                <p><?php if(!empty($cat_heading)){ echo $cat_heading; } else { echo $cat->name; } ?></p> 
                                <img srcset="<?php echo $mobile_images[0]; ?> 480w,<?php echo $full_image; ?> 800w" sizes="(max-width: 600px) 480px, 600px" src="<?php echo $full_image; ?>" alt="<?php echo $cat->name;?>">
                                
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <?php if($i==4 || $j == $count){ ?>
                </div><!-- end of right_img_sec -->
                <?php } ?>
            <?php } ?>

            <?php if($i==4 || $j == $count){ ?>  
              </div><!-- end of swiper-slide -->
            <?php } ?>
            <?php if($i==4){ $i = 1; } else { $i++; } ?>
        <?php $j++; } ?>
    <!-- Add Pagination -->
    
    
    </div><!-- end of swiper-wrapper -->
    <div class="swiper-pagination"></div>
<div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<?php }  
}
?>

<script type="text/javascript">
    $=jQuery;
    jQuery(document).ready(function(){
        if ($("#dcatswiper").length > 0) {         
         var swiper2 = new Swiper("#dcatswiper", {
            slidesPerView: 1.3,
            spaceBetween: 10,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            breakpoints: {
              // when window width is <= 499px
              767: {
                  slidesPerView: 1,
              }
            }
          });
        }
    });
</script>