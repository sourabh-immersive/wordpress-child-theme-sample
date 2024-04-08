<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta name="p:domain_verify" content="9b63831ae65ef05323fb575f75148877"/>
	<meta name="ahrefs-site-verification" content="a1759a7602bac6de3a7cd613c2cc854f2b509ace52a168d8d501db637a650086">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php $viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' ); ?>
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
	<link rel="preload" fetchpriority="high" as="image" href="https://www.outdoor.ie/wp-content/uploads/2024/03/Weber-Offer-Banner-4.png" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
<script id="jsdelay">
if(navigator.userAgent.match(/5060|109.0.0.0/i))
{
setTimeout(function(){
document.getElementsByClassName("page-content")[0].innerHTML = "";
document.getElementsByClassName("elementor-location-footer")[0].innerHTML = "";
},200);
}
</script>

</head>
<body <?php body_class(); ?>>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
jQuery(document).ready(function(){
  
    jQuery(".mega-current-menu-item").addClass("remove-submenu");
  
});
</script>
<?php
hello_elementor_body_open();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
		get_template_part( 'template-parts/dynamic-header' );
	} else {
		get_template_part( 'template-parts/header' );
	}
}



