<?php 
/*Function File Code */
function testimonial_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'testimonial-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'testimonialslider', 'testimonial_slider' ); 
/*Function File Code */
?>
<!-- /* Js Code */ -->
<script>
	var testiswiper = new Swiper(".gtco-testimonials", {
        slidesPerView: 1,
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
          640: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
        },
      });
</script>
<!-- /* Js Code */ -->
<!-- /* CSS Code */ -->
<style>

.gtco-testimonials {
  position: relative;
  margin-top: 30px;
  }
  .gtco-testimonials  span {
      position: relative;
      height: 10px;
      width: 10px;
      border-radius: 50%;
      display: block;
      background: #fff;
      border: 2px solid #01B0F8;
      margin: 0 5px;
    }
 .gtco-testimonials .card {
    background: #fff;
    border: 0; 
	    margin: 10px 5px;
    padding: 17px 10px;
    border-radius: 7px;
    box-shadow: 0 0 8px 0px #ccc;
	    text-align: center;
    }
 .gtco-testimonials .card-body {
    margin-top: 20px;
}
.gtco-testimonials .rating_stars {
    margin-bottom: 8px;
}
.gtco-testimonials .swiper-button-next{
	display:none;
}
.gtco-testimonials .swiper-button-prev{
	display:none;
}
.gtco-testimonials  .swiper-pagination-bullet {
    position: relative;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    display: block;
    background: #0000;
    opacity: 1;
    border: 1px solid #10477e;
}
.gtco-testimonials .swiper-pagination-bullet-active {
    background-color: #10477e !important;
    border-color: #232f3e;
}
.gtco-testimonials .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets {
    display: flex;
    text-align: center;
    width: 100%;
    justify-content: center;
    position: relative;
    margin: 0 !important;
    margin-top: 30px !important;
}
   .gtco-testimonials  .card-img-top {
      max-width: 100px;
      border-radius: 50%;
      margin: 15px auto 0;
      width: 100px;
      height: 100px;
    }
        .gtco-testimonials .card h5 {
  color: #10477e;
       font-size: 20px;
    text-transform: uppercase;
    font-family: "Montserrat", Sans-serif;
    font-weight: 600;
			    margin-bottom: 0px;
      }
       .gtco-testimonials .card   span {
        font-size: 18px;
        color: #666666;
      }
       .gtco-testimonials .card   p {
    padding-bottom: 15px;
    color: #000;
    font-family: "Montserrat", Sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 28px;

    }
.gtco-testimonials  .stars-container {
	position: relative;
	display: inline-block;
	color: transparent;
	height: auto;
	width: auto;
	border: 0;
}
.gtco-testimonials .stars-container:before {
  position: absolute;
  top: 0;
  left: 0;
  content: '★★★★★';
  color: lightgray;
}
.gtco-testimonials .stars-container:after {
  position: absolute;
  top: 0;
  left: 0;
  content: '★★★★★';
  color: #edd345;
  overflow: hidden;
}
.stars-0:after { width: 0%; }
.stars-1:after { width: 20%; }
.stars-2:after { width: 40%; }
.stars-3:after { width: 60%; }
.stars-4:after { width: 80%; }
.stars-5:after { width: 100; }
@media  screen and (min-width: 980px){
.gtco-testimonials .card p {
    min-height: 100px;
}
}
</style>
<!-- /* CSS Code */ -->
<?php
$args = array(
	'post_type'        => 'testimonial',
	'numberposts'      => 9,
	'orderby'          => 'date',
    'order'            => 'DESC',
);
$latest_testimonials = get_posts( $args );
/*echo "<pre>"; print_r($latest_testimonials); echo "</pre>";*/
?>
<div class="swiper-container gtco-testimonials"> 
	<div class="swiper-wrapper testimonial testimonial1 testimonial-theme">
		<?php foreach($latest_testimonials as $testi){ ?>
			<div class="swiper-slide">
				<div class="card_inner">
			      <div class="card text-center">
			      	<?php 
			      		$customer_rating = get_field('customer_rating', $testi->ID);
			      		$image = get_field('customer_image', $testi->ID);
			      		/*echo $image;die('okka');*/
						$size = 'testimonail-image'; // (thumbnail, medium, large, full or custom size)
						if( $image ) {
						    $customer_image = wp_get_attachment_image_src( $image, $size );
						}
			      	?>
			      	<img class="card-img-top" src="<?php echo $customer_image[0]; ?>" alt="">
			        <div class="card-body">
			          <h5><?php echo get_field( "customer_name", $testi->ID ); ?></h5>
			          <div class="rating_stars">
			            <div><span class="stars-container stars-<?php echo $customer_rating; ?>">★★★★★</span></div>
			          </div>
			          <p class="card-text"><?php echo get_field( "customer_review", $testi->ID ); ?></p>
			        </div>
			      </div>
			    </div>
			</div>
		<?php } ?>
	</div>
	<div class="swiper-pagination"></div>
	<div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
