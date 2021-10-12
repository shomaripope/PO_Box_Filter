<?php
/*
   Plugin Name: Shomari's Awesome Dynamic Shipping-Option-Hider Plugin!
   Plugin URI: http://linkedin.com/in/shomari-pope/
   description: Hides Your Choice of Shipping Option(s)...
                    **  $shipping_method_to_hide = 'flat_rate:1'  ** 
                ...If "P.O Box" Is Entered In Shipping Street Address Input.
   */

/////////Custom Hook to Hide Shipping Options, If "P.O Box" is Entered In Address Input////////////// 

add_filter('woocommerce_package_rates', 'shomaris_hide_fedex_for_po_box_shipment', 10, 2);    
function shomaris_hide_fedex_for_po_box_shipment($available_shipping_methods, $package){
    $shipping_method_to_hide = 'flat_rate:1';
    global $woocommerce;
////////////////////////////////////////Get Form Values/////////////////////////////////////////////////////
    $address  = ( !empty( $woocommerce->customer->get_shipping_address_1() ) ) ? $woocommerce->customer->get_shipping_address_1() : $woocommerce->customer->get_billing_address_1();
	$replace  = array(" ", ".", ",");
 $address2  = strtolower( str_replace( $replace, '', $address ) );
///////////////////////Condition Hides Shipping Options, if P.O Box Entered//////////////////////////
    if ( strstr( $address2, 'pobox' ) ) {
        foreach ($available_shipping_methods as $shipping_method => $value) {
            if( strpos( $shipping_method, $shipping_method_to_hide, $shipping_method_to_hides ) !== false ) {
                unset($available_shipping_methods[$shipping_method]);
            }
        }
    }
    return $available_shipping_methods;
}
?>