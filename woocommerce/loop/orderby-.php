<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="woocommerce-cshowing" method="get">
    <select onchange="this.form.submit()" name="nppg" class="nppg" aria-label="<?php esc_attr_e( 'Showing', 'woocommerce' ); ?>">
        <option value="" >Showing</option>
        <option value="1" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '1' ){ echo 'selected'; } ?>>1</option>
        <option value="2" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '2' ){ echo 'selected'; } ?>>2</option>
        <option value="3" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '3' ){ echo 'selected'; } ?>>3</option>
        <option value="4" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '4' ){ echo 'selected'; } ?>>4</option>
        <option value="5" <?php if(isset($_GET['nppg']) && $_GET['nppg'] == '5' ){ echo 'selected'; } ?>>5</option>
    </select>
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields( null, array( 'nppg', 'submit', 'paged', 'product-page' ) ); ?>
</form>


<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
<div id="changeviewcs"><div class="switchToGrid"><i class="fas fa-th-large"></i></div><div class="switchToList"><i class="fas fa-th-list"></i></div></span></div>