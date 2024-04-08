<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<?php /* translators: %s: Order number */ ?>

<p><?php printf( esc_html__( "We would like to thank for placing your order with the Outdoor Scene. We wanted to let you know that your order has been received and is now being processed.", 'woocommerce' ) ); ?></p>

<p><?php printf( esc_html__( "At the Outdoor Scene we always strive to provide the very best products at the very best prices. We are sure that you will enjoy your purchase and would like to thank you again for choosing the Outdoor Scene. ", 'woocommerce' ) ); ?></p>

<p><?php printf( esc_html__( "Please note that we use a third party professional delivery company to manage all of our deliveries. If you need to make an enquiry about the status of your order, please contact Eazimoves (Brian) on 086 6058316 or email warehouse@outdoor.ie ", 'woocommerce' ) ); ?></p>

<p><?php printf( esc_html__( "Also should you need to return your purchase please click the link below to download our Orders Return Form:", 'woocommerce' ) ); ?></p>

<p><a href="https://www.outdoor.ie/wp-content/uploads/returns/Order-Returns-Form-The-Outdoor-Scene.pdf">https://www.outdoor.ie/wp-content/uploads/returns/Order-Returns-Form-The-Outdoor-Scene.pdf</a></p>

<p><?php printf( esc_html__( "Finally, your order details are shown below for your reference:", 'woocommerce' ), esc_html( $order->get_order_number() ) ); ?></p>




<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );


/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
