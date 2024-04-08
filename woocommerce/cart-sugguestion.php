<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
extract($berocket_cart_suggestion_widget);
/*$BeRocket_cart_suggestion = BeRocket_cart_suggestion::getInstance();
$related_products = apply_filters('berocket_cart_suggestion_get_products', array(), $count);*/
$relargs = array(
    'post_type' =>'br_suggestion',
    'numberposts' => 1
);
$related_product = wp_get_recent_posts($relargs);
$reltproducts = get_post_meta( $related_product[0]['ID'], 'br_suggestion', true  );
/*echo "<pre style='display:none'>".print_r($reltproducts['products'])."</pre>";*/
$related_products = array_values($reltproducts['products']);
if (! empty($related_products) ) { 
    $args = array(
        'post_type'         => array('product', 'product_variation'),
        'post__in'          => $related_products,
        'posts_per_page'    => '-1',
        'orderby'           => 'rand',
        'post_status'       => 'publish'
    );
} else {
    return;
}
 
$loop = new WP_Query( $args ); 
    
if ($loop->have_posts()) :  ?>
  <section class="br_cart_suggestions related products Related-products">

        <div class="related-produucts-bottom "><?php
            if ( $title ) :      ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            <div class="swiper-container relatedproductswiper">
            <div class="swiper-wrapper">               
                <?php 
                while ($loop->have_posts()) : $loop->the_post(); global $product, $post;
                    $product = wc_get_product(get_the_ID());
                    $post = get_post( get_the_ID() );
                    if ( !$product->is_visible() ) continue;
                    wc_get_template_part( 'content', 'relatedproduct' );
                endwhile; ?>
            </div>
            <div class="swiper-button-next swiper-button-next1 swiperNext"></div>
            <div class="swiper-button-prev swiper-button-prev1 swiperPrev"></div>
        </div>

        <?php /*woocommerce_product_loop_end();*/ ?>
        </div>
    </section>
    <?php
endif;

wp_reset_query();