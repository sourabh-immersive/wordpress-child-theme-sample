<?php
// Only show this if we're looking at a product page
if ( ! is_singular( 'product' ) ) {
    return;
}

global $product;
$productid = $product->get_id(); 
$show_custom_dimenssion_and_weight = get_field('show_custom_dimenssion_and_weight',$productid);
$select_section_to_show = get_field('select_section_to_show',$productid);
$custom_dimenssion_and_weight_note = get_field('custom_dimenssion_and_weight_note',$productid);

if( $select_section_to_show == 'Custom Dimenssion And Weight'): ?>
    <?php if( have_rows('custom_dimenssion_and_weight',$productid) ): ?>
        <div class="demension-weight-section">
            <?php while( have_rows('custom_dimenssion_and_weight',$productid) ): the_row(); 
                $image = get_sub_field('custom_dimenssion_and_weight_image',$productid);
                $size = 'medium';
                $thumb = $image['sizes'][ $size ];
                $custom_image_url = acf_photo_gallery_resize_image($thumb, 300, 300);
                $heading = get_sub_field('custom_dimenssion_and_weight_heading',$productid);
                $values = get_sub_field('custom_dimenssion_and_weight_values',$productid);
            ?>
            <div class="demension-weight">
                <div class="demension-weight-inner">
                    <div class="weightimage">
                        <img src="<?php echo esc_url($custom_image_url); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <h3> <?php echo $heading; ?> </h3>
                        <?php if(!empty($values)) { ?>
                            <h4> <?php echo $values; ?> </h4>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>            
        </div>
        <?php if(!empty($custom_dimenssion_and_weight_note)){ ?>
            <p class="dnote"><?php echo $custom_dimenssion_and_weight_note; ?></p>
        <?php } ?>
    <?php endif; ?> 
<?php endif; ?>