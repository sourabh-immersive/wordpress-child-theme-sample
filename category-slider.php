<?php

/*extract( shortcode_atts( array(
	'posts' => -1,
  ), $attr) );*/
$taxonomy     = 'product_cat';
$orderby      = 'name';  
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';  
$empty        = 0;
$args = array(
 'taxonomy'     => $taxonomy,
 'orderby'      => $orderby,
 'show_count'   => $show_count,
 'pad_counts'   => $pad_counts,
 'hierarchical' => $hierarchical,
 'title_li'     => $title,
 'hide_empty'   => $empty, 
 'meta_query' => array(
    array(
        'key'     => 'show_on_home_page',     // Adjust to your needs!
        'value'   => 'Yes',   // Adjust to your needs!
        'compare' => '=',         // Default
    )
)
); 
$all_categories = get_categories( $args );
/*echo "<pre>"; print_r($all_categories); echo "</pre>";die('okka');*/
$count =count($all_categories);
$i = 1;
$j = 1;
?>
<?php if($count != 0) { ?>
<?php if(is_mobile_device() == 1) { ?>
<div class="swiper-container catswiper"> 
	<div class="swiper-wrapper product_gallery">
		<?php foreach($all_categories as $cat){  
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
			$mobile_images = wp_get_attachment_image_src( $thumbnail_id, 'woocommerce_thumbnail' );		
			
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
								<img  src="<?php echo $mobile_image; ?>" alt="<?php echo $cat->name;?>"> 
								<p><?php echo $cat->name; ?></p>
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
<?php } else { ?>
<div class="swiper-container catswiper"> 
	<div class="swiper-wrapper product_gallery">
		<?php foreach($all_categories as $cat){  
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
			$mobile_images = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );		
			$full_images = wp_get_attachment_image_src( $thumbnail_id);	
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
								<p><?php echo $cat->name; ?></p>
							<img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $first_image; ?> 800w" sizes="(max-width: 600px) 480px, 600px" src="<?php echo $first_image; ?>" alt="<?php echo $cat->name;?>"> 
						
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
									<p><?php echo $cat->name; ?></p>
								<img srcset="<?php echo $mobile_image; ?> 480w,<?php echo $cat_image; ?> 800w" sizes="(max-width: 600px) 480px, 600px" src="<?php echo $cat_image; ?>" alt="<?php echo $cat->name;?>"> 
							
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
								<p><?php echo $cat->name; ?></p> 
								<img srcset="<?php echo $mobile_images[0]; ?> 480w,<?php echo $cat_image; ?> 800w" sizes="(max-width: 600px) 480px, 600px" src="<?php echo $cat_image; ?>" alt="<?php echo $cat->name;?>">
								
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
<?php } ?>	
<?php } ?>