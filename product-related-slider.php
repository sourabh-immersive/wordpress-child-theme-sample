<?php
// Only show this if we're looking at a product page
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $product;

    /*// bail if the product has no upsells before we output anything
    if ( ! $product->get_upsell_ids() ) {
        return;
    }  */ 

    // Show the product's upsells
    woocommerce_related_products(array(
        'posts_per_page' => -1,
        'orderby'        => 'date'
    ));