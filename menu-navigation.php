<?php
$menu_list = ''; // Initialize $menu_list
$theme_location = 'menu-2'; //Location 
if(isset($atts['type'])){
    $deviceType = $atts['type'];
    if(!empty($atts['type'])){
        $deviceType = $atts['type'];
    } else {
        $deviceType = 'desktop';
    }
} else {
    $deviceType = 'desktop';
}

if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
	$locations = get_nav_menu_locations();
	$menu = get_term( $locations[$theme_location], 'nav_menu' );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
	
    $menu_list  = '<div id="mega-menu-wrap-menu-1" class="mega-menu-wrap">' ."\n";
    $menu_list .= '<div class="mega-menu-toggle"><div class="mega-toggle-blocks-left"><div class="mega-toggle-block mega-menu-toggle-block mega-toggle-block-1" id="mega-toggle-block-1" tabindex="0"><span class="mega-toggle-label" role="button" aria-expanded="false"><span class="mega-toggle-label-closed"></span><span class="mega-toggle-label-open"></span></span></div></div><div class="mega-toggle-blocks-center"></div><div class="mega-toggle-blocks-right"></div></div>' ."\n";
	$menu_list .= '<ul id="mega-menu-menu-1" class="mega-menu max-mega-menu mega-menu-horizontal" data-event="hover_intent" data-effect="fade_up" data-effect-speed="200" data-effect-mobile="disabled" data-effect-speed-mobile="0" data-panel-width="body" data-mobile-force-width="body" data-second-click="go" data-document-click="collapse" data-vertical-behaviour="accordion" data-breakpoint="768" data-unbind="true" data-mobile-state="collapse_all" data-hover-intent-timeout="300" data-hover-intent-interval="100">' ."\n";

	$count = 0;
	$submenu = false;
    $previous_item_has_submenu = false;
    $newCount = 0;
    if(!empty($menu_items)){
	foreach( $menu_items as $menu_item ) {
             
        $link = $menu_item->url;
        $title = $menu_item->title;
        $path = rtrim($link, '/');
        $link_array = explode('/',$path);
    
        $classes = implode(" ",$menu_item->classes);
        if ( !$menu_item->menu_item_parent ) {
            if($menu_item->object == 'product_cat'){
                $cat_id  = $menu_item->object_id;
                $cat = get_term_by( 'id', $cat_id, 'product_cat' );
                $parent_slug = $cat->slug;
            }
            else{
               $page = end($link_array);
      
                // $parent_slug = $page;
                $parent_slug = $newCount++;
            }
            $parent_id = $menu_item->ID;
             
            $menu_list .= '<li class="mega-menu-item mega-menu-item-type-taxonomy mega-menu-item-object-product_cat mega-menu-item-has-children mega-menu-megamenu mega-align-bottom-left mega-menu-grid mega-has-description mega-menu-item-'.$menu_item->ID.' '.$classes.'">' ."\n";
            $menu_list .= '<a href="'.$link.'" class="mega-menu-link title">'.$title ."\n";
            
        }

        if ( $parent_id == $menu_item->menu_item_parent ) {
            $menu_image1 = get_field('menu_image', $menu_item);
            
            if($menu_item->object == 'product_cat'){
                $cat_id  = $menu_item->object_id;
                $cat = get_term_by( 'id', $cat_id, 'product_cat' );
                $image = get_field('menu_image', $cat); 
                $size = 'full'; 
                if($menu_image1) {
                    $menu_image = wp_get_attachment_image_src( $menu_image1['id'], $size );
                    $menu_image = $menu_image[0];

                } else {
                    if( $image ) {
                        $menu_image = wp_get_attachment_image_src( $image['id'], $size );
                        $menu_image = $menu_image[0];
                    } else {
                        $menu_image = esc_url( get_stylesheet_directory_uri()."/images/default-cat.png" );
                    }
                }
            } else if($menu_item->object == 'page'){
                
                $page_id  = $menu_item->object_id;
                $image = get_field('menu_image', $page_id);
                $size = 'full'; 
                if($menu_image1) {
                    $menu_image = wp_get_attachment_image_src( $menu_image1['id'], $size );
                    $menu_image = $menu_image[0];

                } else {
                    if( $image ) {
                        $menu_image = wp_get_attachment_image_src( $image['id'], $size );
                        $menu_image = $menu_image[0];
                    } else {
                        $menu_image = esc_url( get_stylesheet_directory_uri()."/images/default-cat.png" );
                    }
                }
            } else if($menu_item->object == 'product'){
                $page_id  = $menu_item->object_id;
                $image = get_field('menu_image', $page_id);
                $size = 'full'; 
                if($menu_image1) {
                    $menu_image = wp_get_attachment_image_src( $menu_image1['id'], $size );
                    $menu_image = $menu_image[0];

                } else {
                    if( $image ) {
                        $menu_image = wp_get_attachment_image_src( $image['id'], $size );
                        $menu_image = $menu_image[0];
                    } else {
                        $menu_image = esc_url( get_stylesheet_directory_uri()."/images/default-cat.png" );
                    }
                }
            } else {
                if($menu_image1) {
                    $menu_image = wp_get_attachment_image_src( $menu_image1['id'], $size );
                    $menu_image = $menu_image[0];

                } else {                
                    $menu_image = esc_url( get_stylesheet_directory_uri()."/images/default-cat.png" );
                }
                
            }
            if ( !$submenu ) {
                $menu_list .= '<span class="mega-indicator"></span></a>' ."\n";
                $submenu = true;
                $previous_item_has_submenu = true;
                if($deviceType == 'mobile') {
                $swiperNextcats = ' swiperNextcats';
                $swiperPrevcats = ' swiperPrevcats';
                $menu_list .= '<ul class="mega-sub-menu"><li class="mega-menu-row"><ul id="'.$parent_slug.'" class="swiper-container catswapswiper  catswapswiper-'.$parent_slug.' custom_sub_menu"><div class="swiper-wrapper">' ."\n";
                } else {
                $swiperNextcats = ' swiperNextcats1';
                $swiperPrevcats = ' swiperPrevcats1';
                    $menu_list .= '<ul class="mega-sub-menu"><li class="mega-menu-row"><ul  class="swiper-container catswapswiper catswapswipernav custom_sub_menu"><div class="swiper-wrapper">' ."\n";
                }
            }
            $laststring = substr($title, 0, strrpos( $title, ' ')); 
            $laststring = $laststring."<span>".str_replace($laststring, "",$title)."</span>";
            $menu_list .= '<li class="mega-menu-column mega-menu-columns-1-of-12 swiper-slide '.$classes.'">' ."\n";
            $menu_list .= '<div class="mega_menus">' ."\n";
            $menu_list .= '<a href="'.$link.'" class="title">'."\n";
            $menu_list .= '<img src="'.$menu_image. '">'."\n";
            $menu_list .= $laststring.'</a>' ."\n";
            $menu_list .= '</div>' ."\n";
            $menu_list .= '</li>' ."\n";
                 

            if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                $menu_list .= '</div><div class="swiper-button-next'.$swiperNextcats.' swiperNext"></div>' ."\n";
		        $menu_list .= '<div class="swiper-button-prev'.$swiperPrevcats.' swiperPrev"></div></ul></li></ul>' ."\n";
                $submenu = false;
            }

        }

        if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
            if ($previous_item_has_submenu)
                {
                    // the a link and list item were already closed
                    $previous_item_has_submenu = false; //reset
                }
                else {
                    // close a link and list item
                    $menu_list .= '</a></li>' ."\n"; 
                }
                 
            //$submenu = false;
        }

        $count++;
    }
	}
	$menu_list .= '</ul>' ."\n";
    $menu_list .= '</div>' ."\n";
} else {
    $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
}
echo $menu_list;

