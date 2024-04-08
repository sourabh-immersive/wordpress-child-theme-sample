<?php
/*echo "<pre>";print_r($atts); echo "</pre>";*/
$taxonomy     	= 'product_cat';
$orderby      	= 'name';  
$show_count   	= 0;      // 1 for yes, 0 for no
$pad_counts   	= 0;      // 1 for yes, 0 for no
$hierarchical 	= 1;      // 1 for yes, 0 for no  
$title       	= '';  
$empty        	= 0;



/*echo "<pre style='display:none'>";echo $menu_list;echo "</pre>";*/

if( ! is_product_category() ) {
	if(isset($atts['parent'])){
		$parent_slug    = $atts['parent'];
		$parent = get_term_by('slug', $parent_slug, 'product_cat');
		$cat_id = $parent->term_id;
	}	
} else {
	$category = get_queried_object();
	if ($category->parent > 0){
    	$cat_id = $category->parent;
    } else {
    	$cat_id = $category->term_id;
    }
    /*echo "<pre>".$cat_id."</pre>";*/
}
if(empty($cat_id)){
	return;
}
    $children = get_terms(
        array(
        	'taxonomy' => $taxonomy,
        	'child_of' => $cat_id, 
        	'hide_empty' => false,
			'meta_query' => array(
			    array(
			        'key'     => 'show_in_menu',     // Adjust to your needs!
			        'value'   => 'Yes',   // Adjust to your needs!
			        'compare' => '=',         // Default
			    )
			)
        )
    );
    /*echo "<pre style='display:none'>";print_r($children);echo "</pre>";*/
    if ($children) {
    	?>
    	<ul class="swiper-container catswapswiper catswapswipernav custom_sub_menu">
    		<div class="swiper-wrapper">
		<?php foreach($children as $cat) { 
			$woo_cat_slug = $cat->slug;
			$cat_link = get_term_link( $woo_cat_slug, 'product_cat' );
			$image = get_field('menu_image', $cat);
			$size = 'full'; 
			if( $image ) {
			    $menu_image = wp_get_attachment_image_src( $image['id'], $size );
			    $menu_image = $menu_image[0];
			} else {
				$menu_image = esc_url( get_stylesheet_directory_uri()."/images/default-cat.png" );
			}
		?>
			<li class="mega-menu-column mega-menu-columns-1-of-12 swiper-slide">
				<div class="mega_menus">			
					<a href="<?php echo $cat_link; ?>">
						<img src="<?php echo $menu_image; ?>">
						<?php 
							$laststring = substr($cat->name, 0, strrpos( $cat->name, ' ')); 
							echo $laststring."<span>".str_replace($laststring, "",$cat->name)."</span>";
						?>					
					</a>
				</div>
			</li>
		<?php } ?>
		</div>
		<div class="swiper-button-next swiperNextcats1 swiperNext"></div>
    	<div class="swiper-button-prev swiperPrevcats1 swiperPrev"></div>
		</ul><?php
    }
