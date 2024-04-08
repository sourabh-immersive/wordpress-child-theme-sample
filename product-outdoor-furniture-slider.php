<?php
// Only show this if we're looking at a product page
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $product;
    $productid = $product->get_id(); 
    /*$productid = 1556;*/
    $images = acf_photo_gallery('outdoor_furniture_collection_images', $productid);
    //Check if return array has anything in it
    if( count($images) ): ?>
        
        
            <div class="swiper-container mySwiper2">
            <ul class="swiper-wrapper verdana-gallery-wrapper my-gallery" itemscope itemtype="http://schema.org/ImageGallery"><?php
            foreach($images as $image):
                
                $id = $image['id']; 
                $full_image_urls = wp_get_attachment_image_src($id, 'full');
                $large_image_urls = wp_get_attachment_image_src($id, 'large');
                /*echo "<pre style='display:none'>"; print_r($full_image_urls); echo "</pre>";*/
                $title = $image['title'];
                $caption= $image['caption'];
                $alt = $image['alt'];
                $full_image_url= $image['full_image_url']; 
                $full = $full_image_urls[0];
                $large = $large_image_urls[0];
                $width = $full_image_urls[1];
                $height = $full_image_urls[2];
                $datasize = $width."x".$height;
                $custom_image_url = acf_photo_gallery_resize_image($full_image_url, 1000, 500); 
                $thumbnail_image_url= $image['thumbnail_image_url'];
                $url= $image['url']; 
                $target= $image['target']; 
                $alt = get_field('photo_gallery_alt', $id);
                $class = get_field('photo_gallery_class', $id); ?>
                  <!-- Slides -->
                    <li class="swiper-slide">
                      <p class="zoom-in-gallery" href="<?php echo $full; ?>"  data-size="<?php echo $datasize; ?>">
                        <img src="<?php echo $large; ?>" alt="<?php echo $title; ?>"/>
                        <?php if(!empty($caption)){ ?>
                          <span class="productCaption"><?php echo $caption; ?></span>
                        <?php } ?>
                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                      </p>
                   </li>
            <?php endforeach; ?>
            </ul>
        </div>
        <div thumbsSlider="" class="swiper-container mySwiper">
            <div class="swiper-wrapper">
                <?php foreach($images as $image): 
                    $thumbnail_image_url= $image['thumbnail_image_url'];
                    $title = $image['title'];
                ?>
                <div class="swiper-slide">
                  <img src="<?php echo $thumbnail_image_url; ?>" alt="<?php echo $title; ?>"/>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="swiper-button-next swiperNextoutdoor swiperNext"></div>
            <div class="swiper-button-prev swiperPrevoutdoor swiperPrev"></div>
        </div>
 <?php endif; ?>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

  <!-- Background of PhotoSwipe. 
      It's a separate element, as animating opacity is faster than rgba(). -->
  <div class="pswp__bg"></div>

  <!-- Slides wrapper with overflow:hidden. -->
  <div class="pswp__scroll-wrap">

    <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
    <!-- don't modify these 3 pswp__item elements, data is added later on. -->
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>

    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
    <div class="pswp__ui pswp__ui--hidden">

      <div class="pswp__top-bar">

        <!--  Controls are self-explanatory. Order can be changed. -->

        <div class="pswp__counter"></div>

        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

        <button class="pswp__button pswp__button--share" title="Share"></button>

        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
        <!-- element will get class pswp__preloader--active when preloader is running -->
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>

      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
          </button>

      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
          </button>

      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>

    </div>

  </div>

</div>
<script>
    
    </script>

<style>
  /*==================================
             SWIPER
===================================*/
/* remove bullet and space from the list */
.mySwiper .swiper-slide.swiper-slide-thumb-active {
    opacity: 1;
}
.mySwiper .swiper-slide {
  opacity: 0.6;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
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
  bottom: 20px;
  left: 46%;
  font-size: 20px;
  text-align: center;
  background: #10477F;
  padding: 8px 30px;
  width: auto;
  margin: 0 auto;
  position: absolute;
  text-align: center;
  justify-content: center;
  text-transform: capitalize;
}
</style>