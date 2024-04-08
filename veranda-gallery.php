<?php
// Only show this if we're looking at a product page
    /*echo "<pre>";print_r($atts);echo "</pre>";*/
    /*$productid = 1556;*/
    if($atts['page'] == 'verdana'){
      $show_gallery = get_field('show_varanda_gallery', 'option');
    } else if($atts['page'] == 'kitchen') {
      $show_gallery = get_field('show_kitchen_gallery', 'option');
    }
    
    if($show_gallery != 'Yes'){ 
      return;
    }
    if($atts['page'] == 'verdana'){
      if( have_rows('veranda_galley', 'option') ): ?>

      <div class="swiper-container mySwiper2 myswiper3">
        <ul class="swiper-wrapper my-gallery">
          <?php while( have_rows('veranda_galley', 'option') ): the_row(); 
            $image = get_sub_field('gallery_image','option');
            /*echo "<pre>"; print_r($image); echo "</pre>";*/
            $thumbsize = 'thumbnail';
            $thumb = $image['sizes'][ $thumbsize ];
            $full = $image['url'];
            $alt = $image['alt'];
            $custom_image_url = acf_photo_gallery_resize_image($full, 1000, 500);      
            $caption = get_sub_field('gallery_caption','option');
            $width = $image['width'];
            $height = $image['height'];
            $datasize = $width."x".$height;
          ?>
          <li class="swiper-slide">
            <p class="zoom-in-gallery" href="<?php echo $full; ?>"  data-size="<?php echo $datasize; ?>">
              <img src="<?php echo $full; ?>"  alt="<?php echo $alt; ?>"/>
              <?php if(!empty($caption)){ ?>
                <span class="productCaption"><?php echo $caption; ?></span>
              <?php } ?>
              <i class="fa fa-arrows-alt" aria-hidden="true"></i>
            </p>
          </li>

      <?php endwhile; ?>
      </ul>
      </div>
      <div thumbsSlider="" class="swiper-container mySwiper myswiperthumb">
        <div class="swiper-wrapper">
          <?php while( have_rows('veranda_galley', 'option') ): the_row();
            $image = get_sub_field('gallery_image','option');
            $thumbsize = 'thumbnail';
            $alt = $image['alt'];
            $thumb = $image['sizes'][ $thumbsize ];
          ?>
          <div class="swiper-slide">
            <img src="<?php echo $thumb; ?>"  alt="<?php echo $alt; ?>"/>
          </div>
          <?php endwhile; ?>
        </div>
          <div class="swiper-button-next swiperNextoutdoor swiperNext"></div>
          <div class="swiper-button-prev swiperPrevoutdoor swiperPrev"></div>
      </div>
    <?php endif;  ?>
  <?php } else if($atts['page'] == 'kitchen') { 
    if( have_rows('kitchen_gallery', 'option') ): ?>

      <div class="swiper-container mySwiper2 myswiper3">
        <ul class="swiper-wrapper my-gallery">
          <?php while( have_rows('kitchen_gallery', 'option') ): the_row(); 
            $image = get_sub_field('gallery_image','option');
            /*echo "<pre style='display:none'>"; print_r($image); echo "</pre>";*/
            $thumbsize = 'thumbnail'; 
            $thumb = $image['sizes'][ $thumbsize ];
            $full = $image['url'];
            $alt = $image['alt'];
            $custom_image_url = acf_photo_gallery_resize_image($full, 1000, 500);      
            $caption = get_sub_field('gallery_caption','option');
            $width = $image['width'];
            $height = $image['height'];
            $datasize = $width."x".$height; 
          ?>
          <li class="swiper-slide">
            <p class="zoom-in-gallery" href="<?php echo $full; ?>"  data-size="<?php echo $datasize; ?>">
              <img src="<?php echo $full; ?>"  alt="<?php echo $alt; ?>"/>
              <span class="productCaption"><?php echo $caption; ?></span>
              <i class="fa fa-arrows-alt" aria-hidden="true"></i>
            </p>
          </li>

      <?php endwhile; ?>
      </ul>
      </div>
      <div thumbsSlider="" class="swiper-container mySwiper myswiperthumb">
        <div class="swiper-wrapper">
          <?php while( have_rows('kitchen_gallery', 'option') ): the_row();
            $image = get_sub_field('gallery_image','option');
            $thumbsize = 'thumbnail';
            $thumb = $image['sizes'][ $thumbsize ];
            $alt = $image['alt'];
          ?>
          <div class="swiper-slide">
            <img src="<?php echo $thumb; ?>"  alt="<?php echo $alt; ?>"/>
          </div>
          <?php endwhile; ?>
        </div>
          <div class="swiper-button-next swiperNextoutdoor swiperNext"></div>
          <div class="swiper-button-prev swiperPrevoutdoor swiperPrev"></div>
      </div>
    <?php endif;  ?>
  <?php } ?>

<script>
  
</script>
<style>
 
.mySwiper .swiper-slide.swiper-slide-thumb-active {
    opacity: 1;
}
.mySwiper .swiper-slide {
  border: 1px solid #fff;
  padding: 7px 7px 0px 7px;
  background: #fff;
  box-shadow: 0 0 15px 0 #ccc;
  border-radius: 3px;
}
.swiper-container.mySwiper {
    padding-bottom: 10px;
}
p.zoom-in-gallery{
  margin-bottom: 0;
}
p.zoom-in-gallery i {
  position: absolute;
  bottom: 9px;
  left: 2px;
  z-index: 9999;
  font-size: 30px;
  color: #111;
  background: #fff;
  padding: 13px;
  border-radius: 50%;
  cursor: pointer;
}
ul.swiper-wrapper {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
.mySwiper.swiper-container img, .mySwiper2.swiper-container img {
  width: 100%;
  height: auto;
}
.mySwiper.swiper-container, .mySwiper2.swiper-container {
  max-width: 100%;
}

.mySwiper2.swiper-container.swiper-slide, .mySwiper.swiper-container.swiper-slide {
  text-align: center;
  width: 80%;
}
span.productCaption {
    position: absolute;
    bottom: 0;
    bottom: 7px;
    left: 0;
    z-index: 9999;
    font-size: 30px;
    color: #fff;
    width: 100%;
    text-align: center;
    background: #686060a6;
}
.swiperNext::before, .swiperPrev::before{
  font-size: 25px;
    color: #fff;
    position: absolute;
    z-index: 99999;
    background: #10477f;
    font-family: 'FontAwesome';
    width: 34px;
    text-align: center;
    border-radius: 50px;
    height: 36px;
}
.swiperNext::before {
    content: "\f105";  
    left: -34px;
    line-height: 37px;
    padding: 0 14px !important;
}
.swiperPrev::before {
    content: "\f104";    
    line-height: 36px;
}
</style>