<?php 
if( ! is_product_category() ) {	
    return;
}
$category = get_queried_object();
/*echo "<pre style='display:none'>";print_r($category);echo "</pre>";*/

if( have_rows('seo_content_section',$category) ): ?>
	<div class="first-left-hand-side">
		<?php while( have_rows('seo_content_section',$category) ): the_row();
			$image = get_sub_field('seo_image',$category);			
            $size = 'shop_single';
            $thumb = $image['sizes'][ $size ];
            $heading = get_sub_field('seo_heading',$category);
            $values = get_sub_field('seo_content',$category);
            if(empty($thumb)){
            	$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
            	$mobile_images = wp_get_attachment_image_src( $thumbnail_id, 'woocommerce_single' );
            	if(!empty($mobile_images)){
					//$thumb = $mobile_images[0];
					$thumb = $image['url'];
				} else {
					$thumb = esc_url( wc_placeholder_img_src() );
				}
            }
        ?>
        <div class="middle-section-categories">
			<div class="product-category-left-side">
			    <h3><?php echo ucwords(strtolower($heading)); ?></h3>
			    <p><?php echo $values; ?></p>
			</div>
			<div class="product-category-right-side">
			    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
			</div>
		</div>
		<?php endwhile; ?>
	</div>
<?php endif; ?>