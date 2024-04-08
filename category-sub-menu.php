<?php
	/*echo "<pre>";print_r($atts); echo "</pre>";*/
	$taxonomy     	= 'product_cat';
	$orderby      	= 'name';  
	$show_count   	= 0;      // 1 for yes, 0 for no
	$pad_counts   	= 0;      // 1 for yes, 0 for no
	$hierarchical 	= 1;      // 1 for yes, 0 for no  
	$title       	= '';  
	$empty        	= 0;
	if(isset($atts['parent'])){
		$parent_slug    = $atts['parent'];
		$parent = get_term_by('slug', $parent_slug, 'product_cat');


		$args = array(
			'taxonomy'     => $taxonomy,
			'child_of'     => 0,
			'parent'       => $parent->term_id,
			'show_count'   => $show_count, 
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty,
			'meta_query' => array(
			    array(
			        'key'     => 'show_in_menu',     // Adjust to your needs!
			        'value'   => 'Yes',   // Adjust to your needs!
			        'compare' => '=',         // Default
			    )
			)
		);
		$all_categories = get_categories($args);
	}
	

	if(is_mobile_device() == 1) { ?>
		<ul id="<?php echo $parent_slug; ?>" class="swiper-container catswapswiper catswapswiper-<?php echo $parent_slug; ?> custom_sub_menu">
		    <div class="swiper-wrapper">
			<?php 
				foreach($all_categories as $cat) { 
					$woo_cat_slug = $cat->slug;
					$cat_link = get_term_link( $woo_cat_slug, 'product_cat' );
					$image = get_field('menu_image', $cat);
					$size = 'full'; 
					if( $image ) {
					    $menu_image = wp_get_attachment_image_src( $image['id'], $size );
					    $menu_image = $menu_image[0];
					} else {
						$menu_image = esc_url( get_stylesheet_directory_uri()."/images/default-cat.png" );
					} ?>
					<li class="mega-menu-column mega-menu-columns-1-of-12 swiper-slide">
						<div class="mega_menus">			
							<a href="<?php echo $cat_link; ?>">
								<img src="<?php echo $menu_image; ?>">
								<?php /*echo $cat->name;*/ ?>
								<?php 
									$laststring = substr($cat->name, 0, strrpos( $cat->name, ' ')); 
									echo $laststring."<span>".str_replace($laststring, "",$cat->name)."</span>";
								?>					
							</a>
						</div>
					</li>
			<?php 
				} 
				if (isset($atts['page_id'])) {
					$pages_id = explode(',', $atts['page_id']);
					foreach ($pages_id as $page_id) { 
						$image = get_field('menu_image', $page_id);
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
							<a href="<?php echo get_permalink($page_id); ?>">
								<img src="<?php echo $menu_image; ?>">
								<span><?php $laststring = substr(get_the_title($page_id), 0, strrpos( get_the_title($page_id), ' ')); 
									echo $laststring."<span>".str_replace($laststring, "",get_the_title($page_id))."</span>"; ?></span>
							</a>
						</div>
					</li>
						<?php
					}
				} ?>
			</div>
			<div class="swiper-button-next swiperNextcats swiperNext"></div>
			<div class="swiper-button-prev swiperPrevcats swiperPrev"></div>
		</ul>
<?php } else { ?>

	<ul id="<?php echo $parent_slug; ?>" class="swiper-container catswapswiper catswapswipernav custom_sub_menu">
	    <div class="swiper-wrapper">
			<?php 
			foreach($all_categories as $cat) { 
				$woo_cat_slug = $cat->slug;
				$cat_link = get_term_link( $woo_cat_slug, 'product_cat' );
				$image = get_field('menu_image', $cat);
				$size = 'full'; 
				if( $image ) {
				    $menu_image = wp_get_attachment_image_src( $image['id'], $size );
				    $menu_image = $menu_image[0];
				} else {
					$menu_image = esc_url( get_stylesheet_directory_uri()."/images/default-cat.png" );
				} ?>
				<li class="mega-menu-column mega-menu-columns-1-of-12 swiper-slide">
					<div class="mega_menus">			
						<a href="<?php echo $cat_link; ?>">
							<img src="<?php echo $menu_image; ?>">
							<?php /*echo $cat->name;*/ ?>
							<?php 
								$laststring = substr($cat->name, 0, strrpos( $cat->name, ' ')); 
								echo $laststring."<span>".str_replace($laststring, "",$cat->name)."</span>";
							?>					
						</a>
					</div>
				</li>
		<?php 
			}
			if (isset($atts['page_id'])) {
				$pages_id = explode(',', $atts['page_id']);
					foreach ($pages_id as $page_id) { 
						$image = get_field('menu_image', $page_id);
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
							<a href="<?php echo get_permalink($page_id); ?>">
								<img src="<?php echo $menu_image; ?>">
								<span><?php $laststring = substr(get_the_title($page_id), 0, strrpos( get_the_title($page_id), ' ')); 
									echo $laststring."<span>".str_replace($laststring, "",get_the_title($page_id))."</span>"; ?></span>
							</a>
						</div>
					</li>
					<?php
				}
			} ?>
		</div>
		<div class="swiper-button-next swiperNextcats1 swiperNext"></div>
		<div class="swiper-button-prev swiperPrevcats1 swiperPrev"></div>
	</ul>
<?php } ?>