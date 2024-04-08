<?php
// Only show this if we're looking at a product page
if ( ! is_singular( 'product' ) ) {
    return;
}

global $product;
$productid = $product->get_id(); 
$show_custom_dimenssion_and_weight = get_field('show_custom_dimenssion_and_weight',$productid);
$select_section_to_show = get_field('select_section_to_show',$productid);

if( $select_section_to_show == 'Custom Dimenssion And Weight'){ 
 echo "<h2>Dimensions & Weight</h2>";
} else {
    if($product -> has_attributes() || $product -> has_dimensions() || $product -> has_weight()){
        if( $product->has_attributes()){
            echo "<h2>Additional Information</h2>";
        } else {
            echo "<h2>Dimensions & Weight</h2>";
        }
    } else { ?>
        <script>jQuery("section.dimenaions").hide();</script><?php 
    }
}