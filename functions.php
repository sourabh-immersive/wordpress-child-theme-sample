<?php
/* Function to enqueue stylesheet from parent theme */

/**
 * Deregister dashicons on the front-end for non-logged in users
 */

function my_theme_scriptsrr() {
    // Remove dashicons.min.css
    wp_deregister_style('dashicons');
    wp_dequeue_style('dashicons');

    // Enqueue your own stylesheet
    // wp_enqueue_style('my-custom-style', get_stylesheet_directory_uri() . '/css/custom-style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_scriptsrr', 999);



add_action( 'template_redirect', 'redirect_404_to_any_url' );

function redirect_404_to_any_url() {
    $current_url = home_url($_SERVER['REQUEST_URI']);
    $url = home_url('/404/');
    $url1 = home_url('/404');
    if($current_url != $url){
        if ( is_404() ) :
          wp_redirect( $url, 301 ); 
          exit;
        endif;
    }
} 
function child_enqueue__parent_scripts() {
    wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'fontawsome-style', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_script ( 'custom-script', get_stylesheet_directory_uri() . '/js/custom-script.js?'.time() );
    /*global $post;*/
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri().'/css/custom-style.css?'.time() );

    if( !is_front_page() && !is_product() ) {
        wp_enqueue_script ( 'custom-gallery-script', get_stylesheet_directory_uri() . '/js/custom-gallery.js?'.time() );
    }
    if( is_product() ) {
        wp_enqueue_script ( 'custom-featured-script', get_stylesheet_directory_uri() . '/js/custom-featured-gallery.js?'.time() );
    }
    if(is_product() || is_product_category() || is_shop() || is_cart() || is_checkout() || is_archive()){
        wp_enqueue_style( 'custom-product-cat-style', get_stylesheet_directory_uri().'/css/custom-product-cat-style.css?'.time() );     
    }
    if(is_checkout()){
        wp_enqueue_style( 'checkout-style', get_stylesheet_directory_uri().'/css/checkout-style.css?'.time() );
        wp_enqueue_script ( 'custom-multi-checkout-script', get_stylesheet_directory_uri() . '/js/custom-multi-checkout.js?'.time(),array(), null, true ); 
    }


}

add_action( 'wp_enqueue_scripts', 'child_enqueue__parent_scripts');

function home_category_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'custom-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'catslide', 'home_category_slider' ); 

function cat_sub_menu($atts,$content=null){
    ob_start();
    include( locate_template( 'category-sub-menu.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'catmoslide', 'cat_sub_menu' ); 

function cat_page_sub_menu($atts,$content=null){
    ob_start();
    include( locate_template( 'category-page-sub-menu.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'catsubmenu', 'cat_page_sub_menu' ); 

// Testimonial Custom Post Type
function testimonial_init() {
    // set up Testimonial labels
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'testimonial',
        'add_new' => 'Add New testimonial',
        'add_new_item' => 'Add New testimonial',
        'edit_item' => 'Edit testimonial',
        'new_item' => 'New testimonial',
        'all_items' => 'All testimonials',
        'view_item' => 'View testimonial',
        'search_items' => 'Search testimonials',
        'not_found' =>  'No testimonials Found',
        'not_found_in_trash' => 'No testimonials found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Testimonials',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'testimonial'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'custom-fields',
        )
    );
    register_post_type( 'testimonial', $args );    
}
add_action( 'init', 'testimonial_init' );


function products_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'products-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productsslider', 'products_slider' ); 


function products_variable_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'product-slider-variable.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productvariableslider', 'products_variable_slider' ); 



function products_addon_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'product-addon-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productaddonslider', 'products_addon_slider' ); 

function productscat_addon_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'productcat-addon-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productcataddonslider', 'productscat_addon_slider' ); 


function products_related_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'product-related-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productrelatedslider', 'products_related_slider' ); 

function products_outdoor_furniture_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'product-outdoor-furniture-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productoutdoorfurnitureslider', 'products_outdoor_furniture_slider' ); 

function products_featured_gallery_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'product-featured-gallery-slider.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productfeaturedgalleryslider', 'products_featured_gallery_slider' ); 


function products_dimenssion_weight($atts,$content=null){
    ob_start();
    include( locate_template( 'products-dimenssion-weight.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productdimenssionweight', 'products_dimenssion_weight' );  


function products_dimenssion_weight_heading($atts,$content=null){
    ob_start();
    include( locate_template( 'products-dimenssion-weight-heading.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'productdimenssionweightheading', 'products_dimenssion_weight_heading' );  



function category_seo_content($atts,$content=null){
    ob_start();
    include( locate_template( 'category-seo-content.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'catseo', 'category_seo_content' );  



function veranda_gallery_slider($atts,$content=null){
    ob_start();
    include( locate_template( 'veranda-gallery.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'gallerysection', 'veranda_gallery_slider' );  


add_action( 'after_setup_theme', 'my_child_theme_image_size', 11 );
function my_child_theme_image_size() {
    add_image_size( 'home-thumb-cat-large-1', 408, 865, true );
    add_image_size( 'home-thumb-cat-large-2', 405, 407, true );
    add_image_size( 'home-thumb-cat-large-3', 852, 411, true );
    add_image_size( 'testimonail-image', 80, 80, true );
}

function is_mobile_device(){
    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    /*echo "<pre style='display:none'>".$ua."</pre>";*/
    $isMob = is_numeric(strpos($ua, "mobile"));
    $isMobsafa = is_numeric(strpos($ua, "mobile safari"));
    /*if($isMobsafa == '1'){
        $isMob = 0;
    }*/
    return $isMob;
}

add_filter( 'wpseo_breadcrumb_single_link' ,'wpseo_remove_breadcrumb_link', 10 ,2);
function wpseo_remove_breadcrumb_link( $link_output , $link ){
    $text_to_remove = 'Shop';  
    if( $link['text'] == $text_to_remove ) {
      $link_output = '';
    } 
    return $link_output;
}

add_filter('wpseo_breadcrumb_single_link', 'remove_breadcrumb_title' );
function remove_breadcrumb_title( $link_output) {
    $post_type = get_post_type();
    if ( $post_type === 'product' || is_product_category() ) {
        $link_url = wp_get_referer();
        if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
            $link_output = $link_output." <span class='reyrntoback'><a href='".$link_url."'> << Return to Previous Page</a></span>";
        }
    }
    return $link_output;
}

add_action( 'woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus' );
  
function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus" >+</button>';
}
  
add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus' );
  
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus" >-</button>';
}
// 2. Trigger update quantity script
  


add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );
  
function bbloomer_add_cart_quantity_plus_minus() {

   $wmc_settings = get_option( 'woo_multi_currency_params', array() );
   $multicurrency_enable = $wmc_settings['enable'];
  /* echo "<pre style='display:none;'>";echo $multicurrency_enable;print_r($wmc_settings); echo "</pre>";*/
   if(!isset($multicurrency_enable)){ 
    ?>
    <style>.woo-multi-currency.wmc-shortcode,.mobile-currancy.elementor-widget-shortcode{display: none;}</style>
    <?php
   }

   if(is_product_category() || is_shop() || is_archive() || is_search() || is_home()){ ?>
        <script>
            if(jQuery('.productcatwrapper .elementor-products-nothing-found').length>0){
               jQuery('.products-filter.sort-by .heading-filter h5').hide();
            }
        </script>
    <?php 
    }

    if(is_product_category()){
        ?>
        <script>
            jQuery( function( $ ) {
            // Configure/customize these variables.
            var showChar = 400;  // How many characters are shown by default
            var ellipsestext = "...";
            var moretext = "Read more";
            var lesstext = "Read less";
            

            var content = $('.elementor-widget-woocommerce-archive-description .term-description p').html();
            if(content != null){
                if(content.length > showChar) {
         
                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);
                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent">' + h + '<a href="" class="morelink">' + moretext + '</a></span>';
         
                    $('.elementor-widget-woocommerce-archive-description .term-description p').html(html);
                }
            }
            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $('.morecontent').removeClass("show");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $('.morecontent').addClass("show");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle();
                $(this).prev().toggle();
                return false;
            });
        });
        </script>
        <style>
            span.morecontent.show {opacity: 1;}
            span.morecontent {opacity: 0;}
            span.morecontent a.morelink {display: block !important;}
        </style>
        <?php
    }

 
   if ( is_product() || is_product_category() || is_shop()){ 

   wc_enqueue_js( "   

      $(document).on( 'click', 'form.cart button.plus,form.woocommerce-cart-form button.plus, form.cart button.minus, form.woocommerce-cart-form button.minus', function() {   
        if ($('.shop_table .actions .button').length > 0) {
            $('.shop_table .actions .button').removeAttr('disabled');
            $('.shop_table .actions .button').attr('aria-disabled','false');
        }
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
         if (isNaN(val)) {
          val = 0;
         }
         if ( $( this ).is( '.plus' ) ) {
            
            if ( max && ( max <= val ) ) {
               qty.val( max );
            } else {
               qty.val( val + step );
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min );
            } else if ( val > 1 ) {
               qty.val( val - step );
            } else if((min == 0) && val == 1){
                qty.val( val - step );
            }
         }
 
      });



    $(document).on('click','a.quick-vew-hover.button.yith-wcqv-button',function(){
        $('.xoo-cp-modal').removeClass('xoo-cp-active');
        $('.xoo-cp-opac').fadeOut(1600, 'linear');
    });

        
   " );
   } else { return; }
}

// REMOVE ADD TO CART MESSAGE
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );

remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );

if ( ! function_exists( 'yith_wcqv_customization_see_more_details' ) ) {
    add_action( 'yith_wcqv_product_summary', 'yith_wcqv_customization_see_more_details', 22 );
    function yith_wcqv_customization_see_more_details() {
        global $product;
        if ( $product ) {
            $url = get_permalink( $product->get_id() );
            echo '<div class="woocommerce-product-details__learn_more"><a class="button" href="' . esc_url( $url ) . '">' . __( 'Learn More' ) . '</a></div>';
        }
    }
}
add_filter( 'woocommerce_get_stock_html', 'filter_wc_get_stock_html', 10, 2 );
function filter_wc_get_stock_html( $html, $product ) {
    if ( ! $product->is_type('variable') && ! $product->get_manage_stock() && $product->is_in_stock() ) {
        $html = '<p class="stock in-stock">' . __( "In Stock", "woocommerce" ) . '</p>';
    }

    return $html;
}

add_action( 'woosb_before_wrap', 'before_bundle_outer_wrap', 11 );
function before_bundle_outer_wrap() {
    echo "<div class='bundle_main_wrapper'><table class='bundle_table'><tr><th colspan='2'>Products</th><th>Price</th></tr></table>";
}

add_action( 'woosb_after_wrap', 'after_bundle_outer_wrap', 11 );
function after_bundle_outer_wrap($product) {
    /*echo "<pre>"; print_r($product);*/
    $bundle_price ='';
    if(get_post_meta( $product->get_id(), 'woosb_disable_auto_price', true ) === 'on'){
        /*$bundle_price = $product->get_price();*/
        if ( $price_html = $product->get_price_html() ) :
           $bundle_price = '<table class="price"><tr><th><span>Bundle Price: </span>'.$price_html.'</th></tr></table>';
        endif;  
    } 
    echo $bundle_price."</div>";
}

/**
 * Add the code below to your theme's functions.php file
 * to add a confirm password field on the register form under My Accounts.
 */ 
function woocommerce_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
    global $woocommerce;
    extract( $_POST );
    if ( strcmp( $password, $password2 ) !== 0 ) {
        return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
    }
    return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'woocommerce_registration_errors_validation', 10, 3);

function woocommerce_register_form_password_repeat() {
    ?>
    <p class="form-row form-row-wide">
        <label for="reg_password2"><?php _e( 'Confirm password', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
    </p>
    <?php
}
add_action( 'woocommerce_register_form', 'woocommerce_register_form_password_repeat' );


remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
/**
 * Add our own action to the woocommerce_before_shop_loop_item_title hook with the same priority that woocommerce used
 */
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 */
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    /**
     * echo thumbnail HTML
     */
    function woocommerce_template_loop_product_thumbnail()
    {
        echo woocommerce_get_product_thumbnail();
    }
}

/**
 * WooCommerce Product Thumbnail
 */
if (!function_exists('woocommerce_get_product_thumbnail')) {

    /**
     * @param string $size
     * @param int $placeholder_width
     * @param int $placeholder_height
     * @return string
     */
    function woocommerce_get_product_thumbnail($size = 'full', $placeholder_width = 0, $placeholder_height = 0)
    {
        global $post, $woocommerce;
        
        //NOTE: those are PHP 7 ternary operators. Change to classic if/else if you need PHP 5.x support.
        $placeholder_width = !$placeholder_width ?
            wc_get_image_size('shop_catalog_image_width')[ 'width' ] :
            $placeholder_width;

        $placeholder_height = !$placeholder_height ?
            wc_get_image_size('shop_catalog_image_height')[ 'height' ] :
            $placeholder_height;

        /**
         * EDITED HERE: here I added a div around the <img> that will be generated
         */
        $output = '<div class="best-seller">';

        /**
         * This outputs the <img> or placeholder image. 
         * it's a lot better to use get_the_post_thumbnail() that hardcoding a text <img> tag
         * as wordpress wil add many classes, srcset and stuff.
         */
        if(has_post_thumbnail()){
            if(!empty(get_the_post_thumbnail($post->ID, $size))){
                $thumbnailID = get_post_thumbnail_id($post->ID);
                $alt_text = get_post_meta( $thumbnailID, '_wp_attachment_image_alt', true );
                /*echo $alt_text;*/ 
                if ( ! empty( $alt_text ) ) {
                    $alt_text = $alt_text;
                } else {
                    $alt_text = get_the_title($post->ID); 
                }
                /*$image_html = get_the_post_thumbnail($post->ID, 'large'); */
                $image_html = '<img src="' . get_the_post_thumbnail_url($post->ID, 'full') . '" class="attachment-large size-large wp-post-image" alt="'.$alt_text.'" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />'; 
            } else {
                $image_html = '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
            }
             


        }
        $output .= has_post_thumbnail() ?
            '<a href="'.get_the_permalink($post->ID).'" class="anchorloop">'.$image_html.'</a>' :
            '<a href="'.get_the_permalink($post->ID).'" class="anchorloop"><img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" /></a>';

       /* $output .= '<ul><li>'.do_shortcode('[yith_wcwl_add_to_wishlist product_id="'.$post->ID.'" label="" browse_wishlist_text="Wishlist" product_added_text="" already_in_wishslist_text=""]').'</li>';
        $output .= '<li><a class="add-to-cart yith-wcqv-button" href="#" data-product_id="'.$post->ID.'" style="zoom: 1;">Quick View</a></li></ul>';*/

        /** 
         * Close added div .my_new_wrapper
         */
        $output .= '</div>';

        return $output;
    }
}
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action("woocommerce_shop_loop_item_title", function () {
     global $post,$woocommerce;
   echo '<h3 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h3>';
   echo  '<div class="best-seller new"><ul><li>'.do_shortcode('[yith_wcwl_add_to_wishlist product_id="'.$post->ID.'" label="" browse_wishlist_text="Wishlist" product_added_text="" already_in_wishslist_text=""]').'</li>';
    echo '<li><a class="add-to-cart yith-wcqv-button" href="#" data-product_id="'.$post->ID.'" style="zoom: 1;">Quick View</a></li></ul></div>';
});

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 ); 


function woocommerce_custom_add_to_cart_class ( $html, $product, $args ) {

     if ( $product ) {
        $defaults = array(
            'quantity' => 1,
            'class' => implode( ' ', array_filter( array(
                'button',
                'product_type_' . $product->get_type(),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
            ) ) ),
        );
    }
    $args['class'] = apply_filters( 'woocommerce_loop_add_to_cart_args', $defaults )['class'];

    // Define the classes to be added
    $class_to_append = "add-to cart";
    $args['class'] = $args['class']." {$class_to_append}";
    /*echo $args['class'];*/

    $texted = $product->add_to_cart_text();
    if( $product->is_type('grouped') ) { $texted = 'Shop The Range'; } else { $texted = $product->add_to_cart_text(); }

    $html = sprintf( '<a href="%s" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),  
        esc_attr( $product->get_sku() ), 
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        esc_html( $texted )
    );
    // Return Add to cart button
    return $html; 
}

add_filter( "woocommerce_loop_add_to_cart_link", "woocommerce_custom_add_to_cart_class", 10, 3 );

function agreement_communication_custom_checkbox_fields() {
    echo '<div id="agreement_communication">';
    woocommerce_form_field('agreement_communication', array(
        'type' => 'checkbox',
        'class' => array('input-checkbox'),
        'label' => __('I agree to receiving special offers via e-mail from The Outdoor Scene & ChristmasLand'),
            ), WC()->checkout->get_value('agreement_communication'));
    echo '</div>';
}

add_action('woocommerce_review_order_before_submit', 'agreement_communication_custom_checkbox_fields');

add_action('woocommerce_checkout_update_order_meta', 'agreement_communication_field_update_order_meta', 10, 1);

function agreement_communication_field_update_order_meta($order_id) {

    if (!empty($_POST['agreement_communication']))
        update_post_meta($order_id, 'agreement_communication', $_POST['agreement_communication']);
}

add_action('woocommerce_admin_order_data_after_billing_address', 'display_agreement_communication_on_order_edit_pages', 10, 1);

function display_agreement_communication_on_order_edit_pages($order) {
    $agreement_communication = get_post_meta($order->get_id(), 'agreement_communication', true);
    if ($agreement_communication == 1) {
        echo '<p><strong>I agree to receiving special offers via e-mail from The Outdoor Scene & ChristmasLand: </strong> <span style="color:green;">YES</span></p>';
    } else {
        echo '<p><strong>I agree to receiving special offers via e-mail from The Outdoor Scene & ChristmasLand: </strong> <span style="color:red;">NO</span></p>';
    }
}

add_action('woocommerce_review_order_after_submit', 'bbloomer_privacy_message_below_checkout_button');

function bbloomer_privacy_message_below_checkout_button() {
    echo '<p class="understand">I understand that Outdoor.ie <a href="' . home_url('terms-and-conditions/') . '">Terms and Conditions</a> apply to this purchase and that my personal data will be processed in accordance with <a href="' . home_url('privacy-policy/') . '">Privacy Policy</a></p>';
}

add_action('wp_footer', 'reigel_custom_heading', 10, 2);

function reigel_custom_heading($field) {
    if (is_checkout()) {
        ?>
        <style>
            h3#ship-to-different-address {
                display: block !important;
            }
            .woocommerce-checkout p.woocommerce-invalid-required-field span.error {
               color: #e2401c;
               display: block !important;
               font-weight: bold;
            }
        </style>
        <script>
            jQuery(document).ready(function () {
                
                jQuery('#billing_postcode').after('<span class="warning checkout-postcode">If the Eircode is not filled in, the delivery will be delayed. Couriers have become more reliant on Eircodes and it makes the delivery easier.</span>');
                jQuery(document.body).on('change', 'select[name=billing_country]', function(){
                    var country = jQuery(this).val();
                    if(country == 'GB'){ 
                        jQuery('.woocommerce-input-wrapper .warning.checkout-postcode').remove();
                        jQuery('#billing_postcode').after('<span class="warning checkout-postcode">If the Postcodes is not filled in, the delivery will be delayed. Couriers have become more reliant on Postcodes and it makes the delivery easier.</span>');
                    } else {
                        jQuery('.woocommerce-input-wrapper .warning.checkout-postcode').remove();
                       jQuery('#billing_postcode').after('<span class="warning checkout-postcode">If the Eircodes is not filled in, the delivery will be delayed. Couriers have become more reliant on Eircodes and it makes the delivery easier.</span>');
                   }
                });
                jQuery('#shipping_postcode').after('<span class="warning checkout-postcode">If the Eircode is not filled in, the delivery will be delayed. Couriers have become more reliant on Eircodes and it makes the delivery easier.</span>');
                jQuery(document.body).on('change', 'select[name=shipping_country]', function(){ 
                    var country = jQuery(this).val();
                    if(country == 'GB'){ 
                        jQuery('.woocommerce-input-wrapper .warning.checkout-postcode').remove();
                        jQuery('#shipping_postcode').after('<span class="warning checkout-postcode">If the Postcodes is not filled in, the delivery will be delayed. Couriers have become more reliant on Postcodes and it makes the delivery easier.</span>');
                    } else {
                        jQuery('.woocommerce-input-wrapper .warning.checkout-postcode').remove();
                       jQuery('#shipping_postcode').after('<span class="warning checkout-postcode">If the Eircodes is not filled in, the delivery will be delayed. Couriers have become more reliant on Eircodes and it makes the delivery easier.</span>');
                   }
                });
            })     

        </script>
        <?php
    }
    if(is_cart()){
        ?>
        <script>
            jQuery(document).ready(function(){
                jQuery('.wc-proceed-to-checkout #pwgc-redeem-gift-card-form').remove();
                jQuery("input.qty").on("change paste keyup",function(){
                    value=jQuery(this).val();
                    name = jQuery(this).closest('td').attr('product-key');
                   jQuery("td[product-key="+name+"] input.qty").val(value)
                })
            })
            jQuery(document).on( 'click', 'form.cart button.plus,form.woocommerce-cart-form button.plus, form.cart button.minus, form.woocommerce-cart-form button.minus', function() {   
                if (jQuery('.shop_table .actions .button').length > 0) {
                    jQuery('.shop_table .actions .button').removeAttr('disabled');
                    jQuery('.shop_table .actions .button').attr('aria-disabled','false');
                }
                 var qty = jQuery( this ).parent( '.quantity' ).find( '.qty' );
                 var carqty = jQuery(this).closest('td').attr('product-key');
                 var val = parseFloat(qty.val());
                 var max = parseFloat(qty.attr( 'max' ));
                 var min = parseFloat(qty.attr( 'min' ));
                 var step = parseFloat(qty.attr( 'step' ));
                 if (isNaN(val)) {
                  val = 0;
                 }
                 if ( $( this ).is( '.plus' ) ) {
                    
                    if ( max && ( max <= val ) ) {
                       qty.val( max );
                       jQuery("td[product-key="+carqty+"] input.qty").val(max);
                    } else {
                       qty.val( val + step );
                       jQuery("td[product-key="+carqty+"] input.qty").val(val + step)
                    }
                 } else {
                    if ( min && ( min >= val ) ) {
                       qty.val( min );
                       jQuery("td[product-key="+carqty+"] input.qty").val(min)
                    } else if ( val > 1 ) {
                       qty.val( val - step );
                       jQuery("td[product-key="+carqty+"] input.qty").val(val - step)
                    } else if((min == 0) && val == 1){
                        qty.val( val - step );
                        jQuery("td[product-key="+carqty+"] input.qty").val(val - step)
                    }
                 }
         
              });

        </script>

        <?php
    }
    if ( !is_product() && !is_product_category() && !is_shop() && !is_cart() && !is_checkout() && !is_front_page() && !is_account_page() ) {

        ?>
        <script>
            function gform_format_option_label(fullLabel, fieldLabel, priceLabel, selectedPrice, price, formId, fieldId) {
                if ( formId != 1 ) { // Change 43 to your field id number.
                    return fullLabel;
                }
                if(formId == 1 && fieldId == 23){
                    return fullLabel;
                }
                priceLabel = " <span class='ginput_price'>" + gformFormatMoney(price) + '</span>';
                return fieldLabel + priceLabel; 
            }
            jQuery(window).on('load', function() {
                jQuery(function ($) {
                    $('input[name=input_1]').change(function(){
                        var value = $( 'input[name=input_1]:checked' ).val();
                        /*var led = $( 'input[name=input_37]' ).val();*/
                        if(value !='Expert Plus Edition'){
                         $('.gchoice.gchoice_1_2_1').hide();
                         $('.gchoice.gchoice_1_3_1').show();

                        } else {
                         $('.gchoice.gchoice_1_2_1').show();
                         $('.gchoice.gchoice_1_3_1').hide();
                        }
                         
                    });
                });
            })
            jQuery(document).ready(function(){
                jQuery("#gform_1 .reset_button").on('click',function(){
                  jQuery(window).scrollTop($('#gform_1').offset().top-120);
                });
            });
            jQuery(function($) {
               var scrollOffset = 50;
               /*var contentPlacement = $('.elementor-location-header').height()+40+' !important';
                $('.navigation.custom_tb_link.morenav').css('top', contentPlacement); */
                $(window).scroll(function() {
                    var windscroll = $(window).scrollTop() + $(window).height() - scrollOffset;
                    var divscroll = $('.elementor-location-footer').position().top;
                    var headerscroll = $('.elementor-location-header').position().top+600;

                    var scroll = jQuery(window).scrollTop();
                    /*if (scroll >= 300) {
                        $('.navigation.custom_tb_link.morenav').attr('style', 'top: 22% !important;');
                    } else {
                       $('.navigation.custom_tb_link.morenav').attr('style', 'top: 31% !important;');
                    }
                    */
                    if (windscroll > divscroll) {
                        $('.navigation.custom_tb_link').hide();
                    } else {
                        $('.navigation.custom_tb_link').show();
                    }  
                });
                $(".hide_show_side_nav").on("click",function(){
                    $(this).find("i").toggleClass("fa-times");
                    $(".custom_tb_link.morenav a.navigation__link").toggleClass('show');
                });
            });

        </script><?php
        }
        if(is_product()){
            global $product;
            $productid = $product->get_id(); 
            $show_custom_dimenssion_and_weight = get_field('show_custom_dimenssion_and_weight',$productid);
            $select_section_to_show = get_field('select_section_to_show',$productid);

            if( $select_section_to_show != 'Custom Dimenssion And Weight'){
                if (($product -> has_attributes() || $product -> has_dimensions() || $product -> has_weight()) || ($show_custom_dimenssion_and_weight == 'Yes') ){ ?>
                    <script>
                        jQuery('section.elementor-section.dimenaions').show();
                    </script>
                <?php } else { ?>
                     <script>
                        jQuery('section.elementor-section.dimenaions').hide();
                    </script>
                <?php }
            }
        }
        
}

function ModifyAutoComplete($fields){
   $fields['billing']['billing_postcode']['autocomplete'] = 'off';
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'ModifyAutoComplete', 10, 1 );

/**
 * Hide category product count in product archives
 */
add_filter( 'woocommerce_subcategory_count_html', '__return_false' );
function addcatagorylearnmore( $category ) {
   echo '<a class="term--learnmore-link" href="' . $category->slug . '">Read More</a>';
}
add_action( 'woocommerce_after_subcategory_title', 'addcatagorylearnmore', 10, 1 );



/* Filters */

function cs_liswitcherwoo_func() { 
    global $wp_query; 
 
    if ( 0 === (int) $wp_query->found_posts || ! woocommerce_products_will_display() ) { 
        return; 
    } 
    ob_start();
    ?>
<div id="changeviewcs"><div class="switchToGrid active"><i class="fas fa-th-large"></i></div><div class="switchToList"><i class="fas fa-th-list"></i></div></span></div>
    <?php 
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
 
}

add_shortcode('cs_liswitcherwoo', 'cs_liswitcherwoo_func'); 
add_shortcode('cs_sortingwoo', 'woocommerce_catalog_ordering');

function cs_showingwoo_func() { 
    ob_start();
    ?>
<form class="woocommerce-cshowing" method="get">
    <select onchange="this.form.submit()" name="nppg" class="nppg" aria-label="<?php esc_attr_e( 'Showing', 'woocommerce' ); ?>">
        <option value="" >Showing</option>
        <option value="10" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '10' ){ echo 'selected'; } ?>>10</option>
        <option value="20" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '20' ){ echo 'selected'; } ?>>20</option>
        <option value="30" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '30' ){ echo 'selected'; } ?>>30</option>
        <option value="40" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '40' ){ echo 'selected'; } ?>>40</option>
        <option value="50" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '50' ){ echo 'selected'; } ?>>50</option>
    </select>
    <?php wc_query_string_form_fields( null, array( 'nppg', 'submit', 'paged', 'product-page' ) ); ?>
</form>
    <?php 
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
 
}
add_shortcode('cs_showingwoo', 'cs_showingwoo_func');

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  if(isset($_GET['nppg']) && !empty($_GET['nppg'])){
    $cols = $_GET['nppg'];
    return $cols;
  }
  return $cols;
}

add_action( 'woocommerce_shop_loop_item_title', 'show_description_for_list_view' );
function show_description_for_list_view() {
    global $product; ?>
        <div class="desc-for-list" itemprop="description">
            <?php echo apply_filters( 'the_content', $product->get_short_description() ) ?>
        </div>
    <?php
}


add_action( 'xoo_cp_after_btns', 'xoo_addon_products', 10);

function xoo_addon_products(){
   if(is_product() ){
    global $product;
    if($product->is_type('variable')){
        echo do_shortcode('[productcataddonslider]');
    }
   }
}

// Remove Cross Sells From Default Position 

function jw_remove_taxonomy_description($columns) { 
    if ( $posts = $columns['description'] ){ unset($columns['description']); }
    return $columns;
}
add_filter('manage_edit-product_cat_columns','jw_remove_taxonomy_description'); 


if( function_exists('acf_add_options_page') ) {    
    acf_add_options_page();    
}

function change_backorder_message( $text, $product ){
    if ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
        $text = __( 'Available on Pre-Order', 'woocommerce' );
    }
    return $text;
}
add_filter( 'woocommerce_get_availability_text', 'change_backorder_message', 11, 2 );

// Change backorder notification - Shop page
function custom_cart_item_backorder_notification( $html, $product_id ){
    // Check if the current post has any of given terms.
    $html = __( '<p class="backorder_notification">Available on Pre-Order</p>', 'woocommerce' );
    return $html;
}
add_filter( 'woocommerce_cart_item_backorder_notification', 'custom_cart_item_backorder_notification', 10, 2 );

function add_gift_form_to_cart_custom(){
   echo '<div class="cart-coupon" >';
   wc_get_template( 'cart/apply-gift-card.php', array(), '', PWGC_PLUGIN_ROOT . 'templates/woocommerce/' );
   echo '</div>';
}
add_action('woocommerce_cart_collaterals','add_gift_form_to_cart_custom',9);
 
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
 
add_action( 'woocommerce_cart_collaterals', 'bbloomer_display_coupon_form_below_proceed_checkout' );
 
function bbloomer_display_coupon_form_below_proceed_checkout() {  ?> 
    
    <div class="cart-coupon" >
        <h3 class="underlined">Have a coupon?</h3>
        <form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
         <?php if ( wc_coupons_enabled() ) { ?>
            <div class="coupon under-proceed">
               <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" style="width: auto" /> 
               <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" style="width: auto"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
            </div>
         <?php } ?>
      </form>
    </div>
   <?php
}

add_filter( 'gform_currencies', 'gw_modify_currencies' );
function gw_modify_currencies( $currencies ) {
    $currencies['EUR']['symbol_left'] = '&#8364;';
    $currencies['EUR']['symbol_right'] = '';
    $currencies['EUR']['decimal_separator'] = '.';
    $currencies['EUR']['thousand_separator'] = ',';
    $currencies['EUR']['decimals'] = 2;
    return $currencies;
    
}

add_filter( 'gform_field_content_1', function ( $field_content, $field ) {
    if ( $field->id == 39 || $field->id == 41) {
        return str_replace( 'type=', "accept='image/*' type=", $field_content );
    }
 
    return $field_content;
}, 10, 2 );


// Adding a reset button to Gravity form
add_filter( 'gform_submit_button_1', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    $button .= '<input type="reset" value="Clear Calculation" class="gform_button button reset_button">';
    return $button;
}
 
function gravity_image_thumb() {
    
    if ( is_page('3750') && is_page('43228') && is_page('47716')) {
     ?>
    <script type="text/javascript"> 

    gform.addFilter('gform_file_upload_markup', function (html, file, up, strings, imagesUrl, response) {
         var temp_name = rgars( response, 'data/temp_filename' );
        var myFilePath = '/wp-content/uploads/gravity_forms/1-2ccbc13fe219db1c787ff4e275ea2941/tmp/';        
            var formId = up.settings.multipart_params.form_id,
            fieldId = up.settings.multipart_params.field_id;

            var fileName = myFilePath+temp_name;
            var fid = "fid"+ Math.ceil((Math.random() * (10000 - 1000)) + 1000);

            html = '<img id="'+fid+"\" src='" + fileName + "' style='width:200px;height: 200px;object-fit:contain;'/><img class='gform_delete' " + "src='" + imagesUrl + "/delete.png' "+ "onclick='gformDeleteUploadedFile(" + formId + "," + fieldId + ", this);' " + "alt='" + strings.delete_file + "' title='" + strings.delete_file + "' />";
            return html;
    });
    </script>

        <?php }

    }

add_action('wp_head','gravity_image_thumb');



remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 ); 

// Change the Number of WooCommerce Products Displayed Per Page

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page1', 20 );

function new_loop_shop_per_page1( $cols ) { 
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 32;
  return $cols;
}
 


// 1. Hide default notes
 
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
 
// 2. Create new billing field
 
add_filter( 'woocommerce_checkout_fields' , 'bbloomer_custom_order_notes' );
 
function bbloomer_custom_order_notes( $fields ) {
   $fields['billing']['new_order_notes'] = array(
      'type' => 'textarea',
      'label' => 'Order Notes',
      'class' => array('form-row-wide'),
      'clear' => true,
      'priority' => 999,
   );
   return $fields;
}
 
// 3. Save to existing order notes
 
add_action( 'woocommerce_checkout_update_order_meta', 'bbloomer_custom_field_value_to_order_notes', 10, 2 );
 
function bbloomer_custom_field_value_to_order_notes( $order_id, $data ) {
   if ( ! is_object( $order_id ) ) {
      $order = wc_get_order( $order_id );
   }
   $order->set_customer_note( isset( $data['new_order_notes'] ) ? $data['new_order_notes'] : '' );
   wc_create_order_note( $order_id, $data['new_order_notes'], true, true );
   $order->save();
}


add_filter( 'woocommerce_add_to_cart_sold_individually_found_in_cart', 'gs_redirect_to_cart' );

function gs_redirect_to_cart( $found_in_cart ) {
 if ( $found_in_cart ) {
  wp_safe_redirect( wc_get_page_permalink( 'cart' ) );
  exit;
 }
 return $found_in_cart;
}

// Enable WebP in WordPress
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
    if ( false !== strpos( $filename, '.webp' ) ) {
        $types['ext'] = 'webp';
        $types['type'] = 'image/webp';
    }

    return $types;
}

add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
function wpse_mime_types_webp( $mimes ) {
    $mimes['webp'] = 'image/webp';

  return $mimes;
}

// Auto uncheck "Ship to a different address"
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

function menu_navigation($atts,$content=null){
    ob_start();
    include( locate_template( 'menu-navigation.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'menunav', 'menu_navigation' ); 


add_filter( 'woocommerce_dropdown_variation_attribute_options_args', static function( $args ) {
    $args['class'] = 'variationSelect';
    return $args;
}, 2 );


add_filter( 'wp_get_nav_menu_items', 'prefix_nav_menu_classes', 10, 3 );

function prefix_nav_menu_classes($items, $menu, $args) {
    _wp_menu_item_classes_by_context($items);
    return $items;
}

add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

/* products to  collect in store: */
add_filter( 'wc_local_pickup_plus_get_package_pickup_items_field_html', 'local_html' ,10,3);
function local_html( $field_html, $get_package_id, $get_package ){
    
    $substr = '<p class="woocommerce-shipping-contents">';
    $attachment = '<p>Products to collect in store:</p>';
    $field_html = str_replace($substr, $substr.$attachment, $field_html);
    return $field_html; 
   
}
add_filter( 'wp_get_nav_menu_object', 'override_wp_get_nav_menu_object', 10, 2 );
function override_wp_get_nav_menu_object( $menu_obj, $menu ) {

    if ( ! is_object( $menu_obj ) ) {
        $menu_obj = (object) array( 'name' => '' );
    }

    return $menu_obj;
}

// Make zip/postcode field optional
add_filter( 'woocommerce_default_address_fields' , 'change_postcode_to_optional_checkout' );
function change_postcode_to_optional_checkout( $fields ) {
$fields['postcode']['required'] = false;
return $fields;
}


add_filter( 'woocommerce_states', 'custom_woocommerce_states' );

function custom_woocommerce_states( $states ) {

  $states['GB'] = array(
    '' => 'Select an option…',
    'LND' => 'London',
    'ABE' => 'Aberdeen City',
    'ABD' => 'Aberdeenshire',
    'ANS' => 'Angus',
    'AGB' => 'Argyll and Bute',
    'CLK' => 'Clackmannanshire',
    'DGY' => 'Dumfries and Galloway',
    'DND' => 'Dundee City',
    'EAY' => 'East Ayrshire',
    'EDU' => 'East Dunbartonshire',
    'ELN' => 'East Lothian',
    'ERW' => 'East Renfrewshire',
    'EDH' => 'Edinburgh, City of',
    'ELS' => 'Eilean Siar',
    'FAL' => 'Falkirk',
    'FIF' => 'Fife',
    'GLG' => 'Glasgow City',
    'HLD' => 'Highland',
    'IVC' => 'Inverclyde',
    'MLN' => 'Midlothian',
    'MRY' => 'Moray',
    'NAY' => 'North Ayrshire',
    'NLK' => 'North Lanarkshire',
    'ORK' => 'Orkney Islands',
    'PKN' => 'Perth and Kinross',
    'RFW' => 'Renfrewshire',
    'SCB' => 'Scottish Borders',
    'ZET' => 'Shetland Islands',
    'SAY' => 'South Ayrshire',
    'SLK' => 'South Lanarkshire',
    'STG' => 'Stirling',
    'WDU' => 'West Dunbartonshire',
    'WLN' => 'West Lothian',
    'ANN' => 'Antrim and Newtownabbey',
    'AND' => 'Ards and North Down',
    'ABC' => 'Armagh City, Banbridge and Craigavon',
    'BFS' => 'Belfast City',
    'CCG' => 'Causeway Coast and Glens',
    'DRS' => 'Derry and Strabane',
    'FMO' => 'Fermanagh and Omagh',
    'LBC' => 'Lisburn and Castlereagh',
    'MEA' => 'Mid and East Antrim',
    'MUL' => 'Mid-Ulster',
    'NMD' => 'Newry, Mourne and Down',
    'BDG' => 'Barking and Dagenham',
    'BNE' => 'Barnet'
  );

  return $states;
}


function show_gallery_images_slider($attr){
    ob_start();
    $id = $attr['id'];
    $first = strtok($id, '_');
    if( have_rows($id, 'option') ): ?>
      <div id="<?php echo $id ?>" class="swiper-container mySwiper2 mySwipermainProduct mySwipermain<?php echo $id ?>">
        <ul class="swiper-wrapper verdana-gallery-wrapper my-gallery-<?php echo $id ?>">
          <?php while( have_rows($id, 'option') ): the_row(); 
            $image = get_sub_field('gallery_image','option');
            /*echo "<pre style='display:none'>"; print_r($image); echo "</pre>";*/
            $thumbsize = 'thumbnail';
            $thumb = $image['sizes'][ $thumbsize ];
            $full = $image['url'];
            $alt = $image['alt'];
            $width = $image['width'];
            $height = $image['height'];
            $large = $image['sizes']['medium_large'];
            $custom_image_url = acf_photo_gallery_resize_image($full, 1200, 650);      
            $caption = get_sub_field('gallery_caption','option');
            $datasize = $width."x".$height;
            if(!empty($image)){
          ?>

          <li class="swiper-slide">
            <p class="zoom-in-gallery" href="<?php echo $full; ?>"  data-size="<?php echo $datasize; ?>">
              <img src="<?php echo $full; ?>" alt="<?php echo $alt; ?>"/>
              <?php if(!empty($caption)){ ?>
                <span class="productCaption"><?php echo $caption; ?></span>
              <?php } ?>
              <i class="fa fa-arrows-alt" aria-hidden="true"></i>
            </p>
          </li>

      <?php } endwhile; ?>
      </ul>
          <div class="swiper-button-next swiperNextMain<?php echo $id ?> swiperNext"></div>
          <div class="swiper-button-prev swiperPrevMain<?php echo $id ?> swiperPrev"></div>
      </div>
      <div thumbsSlider="" class="swiper-container mySwiper mySwiperthumbnails mySwiperthumb<?php echo $id ?>">
        <div class="swiper-wrapper">
          <?php while( have_rows($id, 'option') ): the_row();
            $image = get_sub_field('gallery_image','option');
            $thumbsize = 'thumbnail';
            $thumb = $image['sizes'][ $thumbsize ];
            $alt = $image['alt'];
            if(!empty($image)){
          ?>
          <div class="swiper-slide">
            <img src="<?php echo $thumb; ?>"  alt="<?php echo $alt; ?>"/>
          </div>
          <?php } endwhile; ?>
        </div>
          <div class="swiper-button-next swiperNextMain<?php echo $id ?> swiperNext"></div>
          <div class="swiper-button-prev swiperPrevMain<?php echo $id ?> swiperPrev"></div>
      </div>
      <script>
        jQuery(document).ready(function(){
        /* Main Product gallery */
          var mySwiperthumb<?php echo $id ?> = new Swiper(".mySwiperthumb<?php echo $id ?>", {
            loop: false,
            
            slidesPerView: 3,
            freeMode: true,
            watchSlidesProgress: true,
            navigation: {
              nextEl: ".swiperNextMain<?php echo $id ?>",
              prevEl: ".swiperPrevMain<?php echo $id ?>",
            },
            breakpointsInverse: true,
                breakpoints: {
                  499: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                    // slidesPerGroup: 2,
                  },
                  768: {
                    slidesPerView: 5,
                    spaceBetween: 10,
                    // slidesPerGroup: 2,
                  },

                  1084: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                    // slidesPerGroup: 3,
                  }
                }
          });
          var mySwipermain<?php echo $id ?> = new Swiper(".mySwipermain<?php echo $id ?>", {
            loop: false,
            spaceBetween: 10,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
              renderBullet: function(index, className) {
                return '<span class="' + className + '">' + (index + 1) + "</span>";
              }
            },
             // Navigation arrows
            navigation: {
              nextEl: ".swiperNextMain<?php echo $id ?>",
              prevEl: ".swiperPrevMain<?php echo $id ?>",
            },
            thumbs: {
              swiper: mySwiperthumb<?php echo $id ?>,
            },
          });
        /* Main Product gallery */

        initPhotoSwipeFromDOM1(".my-gallery-<?php echo $id ?>",mySwipermain<?php echo $id ?>);
    });
      </script><?php
      endif; ?>
      <?php
      return ob_get_clean();
}
add_shortcode('show-gallery-images', 'show_gallery_images_slider');

add_shortcode('pro-desc', 'product_description_h1');
function product_description_h1(){
    if ( ! is_singular( 'product' ) ) {
        return;
    }
    global $product;
    $id = $product->get_id(); 
    $str = get_the_content($id); 
  //$str = preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $str);
    echo $str = apply_filters( 'the_content', $str );
} 

add_shortcode('pro-short-desc', 'product_short_description_h1');
function product_short_description_h1(){
    if ( ! is_singular( 'product' ) ) {
        return;
    }
    global $product;
    $id = $product->get_id(); 
    $str = get_the_excerpt($id); 
  //$str = preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $str);
    echo $str = apply_filters( 'the_content', $str );
}   

//
add_filter( 'wpseo_next_rel_link', '__return_false' );
add_filter( 'wpseo_prev_rel_link', '__return_false' );


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
    $current_screen = get_current_screen(); 
    if ( strpos($current_screen->id, 'edit-product_cat') === false) {
        return;
    } else {
       echo '<style>
        .show_in_menu--qef-type-radio-- ol {
          list-style-type: none;
        }
        </style>';
    }
}

function woocommerce_template_loop_category_title_override1( $category ) { ?>
    <h6 class="woocommerce-loop-category__title">
        <?php echo esc_html( $category->name ); ?>
    </h6><?php
}
add_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title_override1', 10 );

add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );
function custom_woocommerce_get_catalog_ordering_args( $args ) {
  $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    if ( 'new_default_list' == $orderby_value ) {
        /*$args['orderby'] = 'menu_order meta_value_num';
        $args['order'] = 'asc';
        $args['meta_key'] = '_price';*/
        $args['meta_key'] = '_price';
        $args['orderby']  = ['menu_order' => 'asc','meta_value_num' => 'asc']; 
    }
    if ( 'new_default_list_featured' == $orderby_value ) {
        /*$args['orderby'] = 'menu_order meta_value_num';
        $args['order'] = 'asc';
        $args['meta_key'] = '_price';*/
        $args['meta_key'] = '_featured';
        $args['orderby']  = ['meta_value_num' => 'desc']; 
    }
    return $args; 
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );
function custom_woocommerce_catalog_orderby( $sortby ) {
    $sortby['new_default_list'] = 'Custom Order, then Price: low to high';
    $sortby['new_default_list_featured'] = 'Sort by featured products';
    return $sortby;
}

 //Add product new column in administration
add_filter( 'manage_edit-product_columns', 'woo_product_weight_column', 20 );
function woo_product_weight_column( $columns ) {

    $columns['sort_menu_order'] = esc_html__( 'Menu Order', 'woocommerce' );
        return $columns;

}
/**
* make column sortable
*/
function order_column_register_sortable($columns){
  $columns['sort_menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_edit-product_sortable_columns','order_column_register_sortable');

// Populate weight column
add_action( 'manage_product_posts_custom_column', 'woo_product_weight_column_data', 2 );
function woo_product_weight_column_data( $column ) {
    global $post;

    if ( $column == 'sort_menu_order' ) {
            $postval = get_post( $post->ID);
            $menu_order_new = $postval->menu_order;
            
    ?>
    <input type="text" name="menuorder" id="id_<?php echo $post->ID;?>" data-productid="<?php echo $post->ID;?>" value="<?php  echo $menu_order_new; ?>"  class="menuorder"/>
    <?php     
    }
}


add_action('admin_head', 'my_column_width');

function my_column_width() {
    echo '<style type="text/css">';
    echo 'table.wp-list-table .column-sort_weight { width: 101px; text-align: left!important;padding: 5px;}';
    echo 'table.wp-list-table .column-wpseo-score { width: 101px; text-align: left!important;padding: 5px;}';
    echo '.menuorder{ width: 101px; }';
    echo '#rwpp-container a.nav-tab:first-child {display: none;}';
    echo '</style>';
}   

// this code adds jQuery script to website footer that allows to send AJAX request
add_action( 'admin_footer', 'misha_jquery_event' );
function misha_jquery_event(){
 
    echo "<script>jQuery(function($){
    var weight_val;
    var pr_id;  
        jQuery('.menuorder').on('input', function(){
            weight_val = $(this).val();
            pr_id=$(this).attr('data-productid');
            var dataVariable = {
                'action': 'productmetasave', 
                'product_id': pr_id,
                'value':weight_val            
            };
            jQuery.ajax({
                url: ajaxurl, 
                type: 'POST',
                data: dataVariable, 
                success: function (response) {
                    if(response==1){
                    location.reload(true);
                    }else{
                         console.log('Failed To update menu-order ');
                    }               
                }
            });
        });
    });</script>";
 
}
 
// this small piece of code can process our AJAX request
add_action( 'wp_ajax_productmetasave', 'misha_process_ajax' );
function misha_process_ajax(){
    if($_POST['product_id'] && $_POST['value'] ){        
        $arg=array('ID' => $_POST['product_id'],'menu_order' => $_POST['value']);
            $rs = wp_update_post($arg);
            if($rs){
                echo "1";
            }else{
                echo "0";
            }
        }
 
    die();
}


// Related posts on blog page

// Make Product "Featured" column sortable on Admin products list
add_filter( 'manage_edit-product_sortable_columns', 'products_featured_sortable_column' );
function products_featured_sortable_column( $columns ) {
     $columns['featured'] = 'featured';

     return $columns;
}

add_filter('posts_clauses', 'orderby_product_visibility', 10, 2 );
function orderby_product_visibility( $clauses, $wp_query ) {
    global $wpdb;

    $taxonomy  = 'product_visibility';
    $term      = 'featured';

    if ( isset( $wp_query->query['orderby'] ) && $term == $wp_query->query['orderby'] ) {
        $clauses['join'] .=<<<SQL
LEFT OUTER JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.ID={$wpdb->term_relationships}.object_id
LEFT OUTER JOIN {$wpdb->term_taxonomy} USING (term_taxonomy_id)
LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
SQL;
        $clauses['where']   .= " AND (taxonomy = '{$taxonomy}' OR taxonomy IS NULL)";
        $clauses['groupby']  = "object_id";
        $clauses['orderby']  = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
        $clauses['orderby'] .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
    }
    return $clauses;
} 

/*add_action( 'woocommerce_archive_description', 'ts_add_to_category_description', 10 ); 
function ts_add_to_category_description() {
    if ( !is_product_category() ) return;

    ?>
    <script>
        
    </script>
    <?php
}*/

function wc_add_new_product_flash() {
    global $product;
    $productid = $product->get_id(); 
    $mark_as_new_product = get_field('mark_as_new_product',$productid);

    if( $mark_as_new_product == 'Yes'){ 
        echo '<span class="onsale newflash">NEW</span>';
    }
    
}
add_action( 'woocommerce_before_shop_loop_item_title', 'wc_add_new_product_flash' );
add_action( 'woocommerce_product_thumbnails', 'wc_add_new_product_flash',10 );


add_filter( 'woocommerce_grouped_price_html', 'bbloomer_grouped_price_range_delete', 10, 3 );
 
function bbloomer_grouped_price_range_delete( $price, $product, $child_prices ) {
$price = '';
return $price;
} 


add_filter('woocommerce_sale_flash', 'gs_change_sale_text'); 
function gs_change_sale_text() { 
    return '<span class="onsale">SALE</span>'; 
}
/*
function my_gallery_shortcode( $output = '', $atts, $content = false, $tag = false ) {
$return = $output; // fallback

// retrieve content of your own gallery function
$my_result = get_my_gallery_content( $atts );

// boolean false = empty, see http://php.net/empty
if( !empty( $my_result ) ) {
    $return = $my_result;
}

return $return;
}

add_filter( 'post_gallery', 'my_gallery_shortcode', 10, 4 );
*/


function get_my_gallery_content ( $atts ) {

global $post;
// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
}

$html5 = current_theme_supports( 'html5', 'gallery' );
extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post ? $post->ID : 0,
    'itemtag'    => $html5 ? 'figure'     : 'dl',
    'icontag'    => $html5 ? 'div'        : 'dt',
    'captiontag' => $html5 ? 'figcaption' : 'dd',
    'columns'    => 3,
    'size'       => 'medium',
    'include'    => '',
    'exclude'    => '',
    'link'       => '',
), $atts, 'gallery'));

$id = intval($id);
if ( 'RAND' == $order )
    $orderby = 'none';

if ( !empty($include) ) {
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
    }
} elseif ( !empty($exclude) ) {
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
} else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
}

if ( empty($attachments) )
    return '';

if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
        $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
}

$itemtag = tag_escape($itemtag);
$captiontag = tag_escape($captiontag);
$icontag = tag_escape($icontag);
$valid_tags = wp_kses_allowed_html( 'post' );
if ( ! isset( $valid_tags[ $itemtag ] ) )
    $itemtag = 'dl';
if ( ! isset( $valid_tags[ $captiontag ] ) )
    $captiontag = 'dd';
if ( ! isset( $valid_tags[ $icontag ] ) )
    $icontag = 'dt';

$columns = intval($columns);
$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
$float = is_rtl() ? 'right' : 'left';

$selector = "gallery-{$instance}";

$gallery_style = $gallery_div = '';

/**
 * Filter whether to print default gallery styles.
 *
 * @since 3.1.0
 *
 * @param bool $print Whether to print default gallery styles.
 *                    Defaults to false if the theme supports HTML5 galleries.
 *                    Otherwise, defaults to true.
 */
if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
    $gallery_style = "
    <style type='text/css'>
        #{$selector} {
            margin: auto;
        }
        #{$selector} .gallery-item {
            float: {$float};
            margin-top: 10px;
            text-align: center;
            width: {$itemwidth}%;
        }
        #{$selector} img {
            border: 2px solid #cfcfcf;
        }
        #{$selector} .gallery-caption {
            margin-left: 0;
        }
        .postgal{
            width:100% !important;
            float:none !important;
        }
        .postgal .thumbnails {
            display: flex;
        }
        .postgal a.woocommerce-main-image.zoom img {
            width: auto !important;
            display: block;
            margin: 0 auto;
        }
        /* see gallery_shortcode() in wp-includes/media.php */
    </style>\n\t\t";
}

$size_class = sanitize_html_class( $size );
$gallery_div = "<div id='$selector-sausage' class='postgal gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} images'>";

/**
 * Filter the default gallery shortcode CSS styles.
 *
 * @since 2.5.0
 *
 * @param string $gallery_style Default gallery shortcode CSS styles.
 * @param string $gallery_div   Opening HTML div container for the gallery shortcode output.
 */
$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

$i = 0;
$first_image = reset($attachments);
$first_image_url = wp_get_attachment_image_url( $first_image->ID, 'full', true, false);
$output .= '<a href="'.$first_image_url.'" itemprop="image" class="woocommerce-main-image zoom">';

$output .= '<img src="'.$first_image_url.'">';
$output .= '</a>';

$output .= '<div class="thumbnails">';

foreach ( $attachments as $id => $attachment ) {
    $output .= '<div class="thumbnail_div">'; 
    if ( ! empty( $link ) && 'file' === $link )
        $image_output = wp_get_attachment_link( $id, $size, false, false );
    elseif ( ! empty( $link ) && 'none' === $link )
        $image_output = wp_get_attachment_image( $id, $size, false );
    else
        $image_output = wp_get_attachment_link( $id, $size, true, false );

    $image_meta  = wp_get_attachment_metadata( $id );

    $orientation = '';
    if ( isset( $image_meta['height'], $image_meta['width'] ) )
        $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

    if ( $captiontag && trim( $attachment->post_excerpt ) ) {
        $image_output .= "
            <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
            " . wptexturize( $attachment->post_excerpt ) . "
            </{$captiontag}>";
    }
 
    $image_output .= "</{$itemtag}>";
    
    $output .= $image_output;
    $output .= '</div>'; 

}

if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
    $output .= "
        <br style='clear: both' />";
}

$output .= "
    </div>\n</div>\n";

return $output;
}


/*add_action( 'wp_print_scripts', 'wra_filter_scripts', 100000 );
add_action( 'wp_print_footer_scripts', 'wra_filter_scripts', 100000 );

function wra_filter_scripts() {
    if(is_checkout()){
        wp_deregister_script( 'thwmscf-frontend-js' );
        wp_dequeue_script( 'thwmscf-frontend-js' );
    }
    
}*/



add_action( 'woocommerce_after_add_to_cart_form', 'bbloomer_echo_variation_info' );
 
function bbloomer_echo_variation_info() {
   global $product;
   if ( ! $product->is_type( 'variable' ) ) return;
   $full_image_urls = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
   if($full_image_urls){
        $full_image_url = $full_image_urls[0];
        $attachment_image_width = $full_image_urls[1];
        $attachment_image_height = $full_image_urls[2];
        $datasize = $attachment_image_width."x".$attachment_image_height;
    } else {
        $full_image_url = esc_url( wc_placeholder_img_src() );
        $attachment_image_width = '300';
        $attachment_image_height = '300';
        $datasize = $attachment_image_width."x".$attachment_image_height;
    }
   
   wc_enqueue_js( "
      $(document).on('found_variation', 'form.cart', function( event, variation ) {
        var main_image = '$full_image_url'; 
        var main_datasize = '$datasize'; 
        var currentimage = $('form.cart').attr('current-image');
        /*console.log(currentimage)*/
        if(variation && variation.image && variation.image.src && variation.image.src.length > 1){
         var height = variation.image.full_src_h;   
         var width = variation.image.full_src_w;  
         var datasize = width+'x'+height;
         $('.mySwipermainProduct').find('.swiper-slide-active img').attr('src',variation.image.full_src);    
         $('.mySwipermainProduct').find('.swiper-slide-active p.zoom-in-gallery').attr('href',variation.image.full_src);    
         $('.mySwipermainProduct').find('.swiper-slide-active p.zoom-in-gallery').attr('data-size',datasize);    
         $('.mySwiperthumbnails').find('.swiper-slide-active img').attr('src',variation.image.full_src);  
        } else {
            $('.mySwipermainProduct').find('.swiper-slide-active img').attr('src',main_image);    
            $('.mySwipermainProduct').find('.swiper-slide-active p.zoom-in-gallery').attr('href',main_image);    
            $('.mySwipermainProduct').find('.swiper-slide-active p.zoom-in-gallery').attr('data-size',main_datasize);    
            $('.mySwiperthumbnails').find('.swiper-slide-active img').attr('src',main_image);
        }
      })
   " );
}


function change_cart_suggestion_get_template_part ( $template, $name ) {
//your code here
    $template = get_stylesheet_directory().'/woocommerce/cart-sugguestion.php';
    /*echo $template;*/
    return $template;
}

add_filter( 'cart_suggestion_get_template_part', 'change_cart_suggestion_get_template_part', 10, 2 );


add_filter('woocommerce_style_smallscreen_breakpoint','woo_custom_breakpoint');
function woo_custom_breakpoint($px) {
  $px = '767px';
  return $px;
}

//
function remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );
 wp_dequeue_style( 'wc-blocks-style' );
} 
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

/*
* Add sample products to cart
*/
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

    // print_r($_POST);

    // die; 
    $cart_info = '';
    if(!empty($_POST['product']))
    {        
        foreach($_POST['product'] as $products)
    {
       

        $product_id = $products['p_g_id'];       
        $quantity = $products['p_qty'];
        $quantity = empty($quantity) ? 1 : wc_stock_amount($quantity);
        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
        $product_status = get_post_status($product_id);    
        $cart_total = 0;
      
    
   
        // Remember to add $cart_item_data to WC->cart->add_to_cart
        if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {

            
//echo "passed";    
            do_action('woocommerce_ajax_added_to_cart', $product_id);
    
            if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                wc_add_to_cart_message(array($product_id => $quantity), true);
            }
            $_product = wc_get_product( $product_id );
           // print_r($cart);

           $cart = WC()->cart->get_cart();

            foreach($cart as $cart_data)
            {   
                if($cart_data['product_id'] == $product_id)
                {
                    /* echo 'iff';
                    echo '<br>'; */
                    $cart_quantity = $cart_data['quantity'];
                   
                    $line_subtotal = round($cart_data['line_subtotal']);
                    $line_subtotal_tax = round($cart_data['line_subtotal_tax']);
                    $cart_total = $line_subtotal + $line_subtotal_tax;
                    //echo '<br>';
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );
    
                    $cart_info .= '<div class="cart-last-added-item-modal-list">
				<div class="cart-last-added-item-modal-list-item">
					<div class="cart-last-added-item-modal-list-item-main-row">
					    <div class="cart-last-added-item-modal-list-item-main-col-image">
					        <a href="'.get_permalink($product_id).'">
						        <div class="cart-last-added-item-modal-list-item-image">
						            <div class="simg-container-fit-contain simg-container">
						            	<div class="simg-picture"><img src="'.$image[0].'" width="300" height="285" alt="'.$_product->get_name().'" ></div>
						            </div>
						        </div>
					        </a>
					    </div>
						<div class="cart-last-added-item-modal-list-item-main-col-info">
						    <div class="cart-last-added-item-modal-list-item-title">
						        <a href="'.get_permalink($product_id).'">'.$_product->get_name().'</a>
						    </div>
						    <div class="cart-variation-list-custom">
						    							    </div>
						    <div class="cart-last-added-item-modal-list-item-price-row">
						        <div class="cart-last-added-item-modal-list-item-price-col-info">
						            <span class="cart-last-added-item-modal-list-item-qty-label">
						                Quantity:
						            </span>
						            <span class="cart-last-added-item-modal-list-item-qty-value">
						            '.$cart_quantity.'</span>
						        </div>
						        <div class="cart-last-added-item-modal-list-item-price-col-value">
									<span class="price-formatted" data-control="priceFormatted">
										<span class="woocommerce-Price-amount amount">'.wc_price($_product->get_price()).'</span>
								</div>
		    				</div>
						</div>
					</div>
				</div>
			</div>';
                    
                }
                $cart_total += $cart_total;
            } // EO cart foreach loop
            
           //echo $cart_total;
            
           
        } else {
    
            $data = array(
                'error' => true,
                'msg' => 'Limit exceeded',
                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
    
            
        }
    }       
    $data = array(
        'error' => false,
        'msg' => 'Product successfully added to your cart',
        'cart_qty'=> WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_subtotal(),
        'cart_info' => $cart_info,
        // 'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
    );
    }
    else{
        $data = array(
            'error' => true,
            'msg' => 'Please choose the quantity of items you wish to add to your cart…',
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );
    }
   
    //wc_get_template('xoo-cp-content.php','','',get_stylesheet_directory_uri().'/added-to-cart-popup-woocommerce/');
    echo wp_send_json($data);
    WC_AJAX :: get_refreshed_fragments();
    
	// $cart_item_key = $_POST['hash'];
   // $product_id = $_POST['product'];
 //    $quantity = $_POST['quantity'];

    // echo 'dd: '.$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    // echo '<br>';
    //$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
   // $variation_id = absint($_POST['variation_id']);
    // This is where you extra meta-data goes in
    // $cart_item_data = $_POST['meta'];
   
    wp_die();
}
error_reporting(0);
add_action( 'woocommerce_before_add_to_cart_button', 'show_subtotal_preview_sale2' );
function show_subtotal_preview_sale2() {
    global $product;
    // compatible Grouped product ids
    //$specific_product_ids = array(52131,42689,42336,42228,42226,41939,34904,28916,28396,28844,28317,41809,41811,23820); // Change with your specific product IDs
    // Only load the code for grouped product type and specific product ids
    if( $product && $product->is_type( 'grouped' ) /*&& in_array($product->get_id(), $specific_product_ids)*/ ) {
        $total_price = 0;
        foreach( $product->get_children() as $child_id ) {
            $child_product = wc_get_product( $child_id );
            if ($child_product && $child_product->is_type( 'variable' )) {
                continue; // skip variable products
            }
            $child_quantity = isset( $_POST['quantity'][$child_id] ) ? $_POST['quantity'][$child_id] : 0;
            $child_price = $child_product->get_sale_price() ? $child_product->get_sale_price() : $child_product->get_regular_price();
            $total_price += $child_price * $child_quantity;
        }
        $subtotal_preview = '€' . number_format( $total_price, 2 );
        echo '<p class="subtotal-preview">' . $subtotal_preview . '</p>';
        ?>
        <script>
            jQuery(document).ready(function($) {
                $('input.qty').change(function() {
                    updateSubtotal();
                });
                $('button.plus').on('click', function() {
                    setTimeout(function() {
                        updateSubtotal();
                    }, 100);
                });
                $('button.minus').on('click', function() {
                    setTimeout(function() {
                        updateSubtotal();
                    }, 100);
                });
                function updateSubtotal() {
                    var total_price = 0;
                    $('input.qty').each(function() {
                        var child_id = $(this).attr('name').replace('quantity[', '').replace(']', '');
                        var child_quantity = parseInt($(this).val()) || 0;
                        var child_price = 0;
                        if ($('#product-' + child_id + ' .grouped-price ins .woocommerce-Price-amount bdi').length) {
                            // products with sale price
                            child_price = parseFloat($('#product-' + child_id + ' .grouped-price ins .woocommerce-Price-amount bdi').text().replace(/[^0-9\.]/g, ''));
                        } else {
                            // products with regular price
                            child_price = parseFloat($('#product-' + child_id + ' .grouped-price .woocommerce-Price-amount bdi').text().replace(/[^0-9\.]/g, ''));
                        }
                        total_price += child_quantity * child_price;
                    });
                    $('.subtotal-preview').text('€' + total_price.toFixed(2));
                }
            });
        </script>
        <?php
    }
}
/*cart recommendation scroll fix*/
function add_quick_view_modal_style() {
  if (is_page(array(46882))) { 
    wp_enqueue_style('quick-view-modal', '/path/to/quick-view-modal.css');
    wp_enqueue_script('quick-view-modal', '/path/to/quick-view-modal.js', array('jquery'), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'add_quick_view_modal_style');

function add_quick_view_modal_script() {
  if (is_page(array(46882))) { 
    wp_add_inline_script('quick-view-modal', '
      document.addEventListener("DOMContentLoaded", function() {
        const body = document.body;

        // Function to check if the quick view modal is open
        function isQuickViewModalOpen() {
          return document.querySelector(".woolentorquickview-open") !== null;
        }

        // Add/remove overflow hidden based on quick view modal status
        function updateBodyOverflow() {
          if (isQuickViewModalOpen()) {
            body.style.overflow = "hidden";
          } else {
            body.style.overflow = "";
          }
        }

        // Add event listener for DOM changes
        const observer = new MutationObserver(function(mutations) {
          mutations.forEach(function(mutation) {
            if (mutation.target.classList.contains("woolentorquickview-open")) {
              updateBodyOverflow();
            }
          });
        });

        // Start observing changes to the DOM
        observer.observe(document.documentElement, { attributes: true, childList: true, subtree: true });

        // Initial check of quick view modal status
        updateBodyOverflow();

        // Add event listener for close button click
        const closeButton = document.querySelector(".htcloseqv");
        if (closeButton) {
          closeButton.addEventListener("click", function() {
            body.style.overflow = "";
          });
        }
      });
    ');
  }
}
add_action('wp_enqueue_scripts', 'add_quick_view_modal_script');
//
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates'); 
add_filter('pre_site_transient_update_plugins','remove_core_updates'); 
add_filter('pre_site_transient_update_themes','remove_core_updates');
//
/*cart cross sell popup add2cart success*/
function cart_cross_sell_popup_add2cart_success() {
    if (is_cart()) {
       // wp_enqueue_style( 'product-added-popup', get_template_directory_uri() . '/css/product-added-popup.css', array(), '1.0' );
        wp_add_inline_script( 'jquery', '
            jQuery(document).ready(function($) {
                $(document.body).on(\'added_to_cart\', function() {
                    // Get the quick view modal element and close button
                    var $quickViewModal = $(\'#htwlquick-viewmodal\');
                    var $closeButton = $quickViewModal.find(\'.htcloseqv\');
                    
                    // If the modal and close button exist, simulate a click on the close button
                    if ($quickViewModal.length && $closeButton.length) {
                        $closeButton.trigger(\'click\');

                        // Show a popup message
                        var $popup = $(\'<div class="product-added-popup">Product Successfully Added</div>\');
                        $(\'body\').append($popup);
                        setTimeout(function() {
                            $popup.fadeOut(\'fast\', function() {
                                $popup.remove();
                            });
                        }, 3000);
                    }
                });
            });
        ' );
    }
}
add_action( 'wp_enqueue_scripts', 'cart_cross_sell_popup_add2cart_success' );
/*remove bundled products from the parent product for smart product types woosb*/
add_filter( 'woocommerce_order_get_items', 'woosb_exclude_bundled_from_order', 10, 1 );
function woosb_exclude_bundled_from_order( $items ) {
	foreach ( $items as $key => $item ) {
		if ( $item->meta_exists( '_woosb_parent_id' ) ) {
			unset( $items[ $key ] );
		}
	}
	return $items;
}
/*GA4 Analytics*/
function ga4_analytics() {
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y9ZE1JDB3X"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', 'G-Y9ZE1JDB3X');
    </script>
    <?php
}
add_action('wp_head', 'ga4_analytics');
//
function temp_custom_dashboard_css() {
    echo '<style>
	tr.inactive,
	div.woocommerce-message.updated,
	div#gf_dashboard_message{
    display:none!important;
}
</style>';
}
add_action( 'admin_head', 'temp_custom_dashboard_css' );
/*gutenberg*/
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post', '__return_false', 10);
function disable_wbe_theme_support() {
remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'disable_wbe_theme_support' );

function set_custom_image_headers($headers) {
    $image_types = array('jpg', 'jpeg', 'png', 'gif', 'svg'); // Add or modify image extensions as needed

    if (in_array(pathinfo($_SERVER['REQUEST_URI'], PATHINFO_EXTENSION), $image_types)) {
        $headers['Cache-Control'] = 'public, max-age=604800'; // Adjust max-age as needed (604800 seconds = 1 week)
    }

    return $headers;
}
add_filter('wp_headers', 'set_custom_image_headers');

add_shortcode('top-most-parent', 'jts_get_term_child_categories');

function jts_get_term_child_categories() {
    
    $term = get_queried_object();

    $child_categories = get_terms( $term->taxonomy, array(
        'parent'    => $term->term_id,
        'hide_empty' => false
    ) );

    // print_r($child_categories);

    if (empty($child_categories)) {
        return 'No child categories found for the top-level parent category.';
    }

    $output = '<div class="swiper mySwiper swiperParentCat"><div class="swiper-wrapper">';
    foreach ($child_categories as $child_category) {
        $term_link = get_term_link( $child_category );
        $thumbnail_id = get_woocommerce_term_meta( $child_category->term_id, 'thumbnail_id', true );
        $image        = wp_get_attachment_url( $thumbnail_id );
        $output .= '<div class="swiper-slide"><a href="'. $term_link .'"><div class="Cate2Card"><img src="'.$image.'" alt="" width="50" height="50" />';
        $output .= '<h3>' . esc_html($child_category->name) . '</h3>';
        $output .= '</div></a></div>';
    }
    $output .= '</div><div class="swiperNavigationbtnsWrap"><div class="swiper-button-prevCaT"><img src="https://stg-theoutdoorscene-l1aprstaging.kinsta.cloud/wp-content/uploads/2024/04/Vector-right.png" /></div><div class="swiper-button-nextCaT"><img src="https://stg-theoutdoorscene-l1aprstaging.kinsta.cloud/wp-content/uploads/2024/04/Vector-left.png" /></div></div></div>';

    return $output;
}

function get_parent_category_content($atts,$content=null){
    ob_start();
    include( locate_template( 'parent-category-content.php', false, false ) ); 
    return ob_get_clean();          
}
add_shortcode( 'parent_cat_content', 'get_parent_category_content' );

add_shortcode('sub_categories_from_parent', 'get_sub_categories_from_parent');

function get_sub_categories_from_parent() {
    
    $term = get_queried_object();

    $child_categories = get_terms( $term->taxonomy, array(
        'parent'    => $term->term_id,
        'hide_empty' => false
    ) );

    if (empty($child_categories)) {
        return 'No child categories found for the top-level parent category.';
    }

    $output = '<div class="grid_categories_of_parent">';
    foreach ($child_categories as $child_category) {
        $term_link = get_term_link( $child_category );
        $thumbnail_id = get_woocommerce_term_meta( $child_category->term_id, 'thumbnail_id', true );
        $image        = wp_get_attachment_url( $thumbnail_id );
        $output .= '<div class="grid-wrapbox"><a href="'. $term_link .'"><img src="'.$image.'" alt="" width="600" height="400" />';
        $output .= '<h3>' . esc_html($child_category->name) . '</h3>';
        $output .= '</a></div>';
    }
    $output .= '</div>';

    return $output;
}

// add_action( 'wp_print_styles', 'my_deregister_styles');
// function my_deregister_styles()    { 
//    wp_deregister_style( 'dashicons-css' ); 
//    wp_dequeue_style( 'woolentor-widgets-pro-css' );
//    wp_deregister_style( 'woolentor-widgets-pro-css' );
// }

// function add_rel_preload($html, $handle, $href, $media) {
    
//     if (is_admin())
//         return $html;

//      $html = <<<EOT
// <link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' />
// EOT;
//     return $html;
// }
// add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );

// add_action( 'wp_footer', 'register_wp_footer' );
// function register_wp_footer() { 
//     wp_enqueue_style( 'dashicons', '/wp-includes/css/dashicons.min.css');
// }

// function smartwp_defer_js_parsing( $url ) {
//     if(is_admin()) return $url; //Skip admin JS files
//     if(is_user_logged_in()) return $url; //Skip if user is logged in
//     if(false === strpos($url, '.js')) return $url; //If it's not a JS file skip
//     if(strpos($url, 'jquery.js')) return $url; //Don't defer jQuery
//     if(strpos($url, 'jquery.min.js')) return $url; 
//     return str_replace(' src', ' defer src', $url); //defer JS file
//    }

// add_filter( 'script_loader_tag', 'smartwp_defer_js_parsing', 10 );