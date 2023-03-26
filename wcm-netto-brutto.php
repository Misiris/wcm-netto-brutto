<?php
/*
Plugin Name: WooCommerce Netto Brutto Display
Description: A plugin that Netto Brutto Display
Author: Patryk Grzesik
*/
if (!defined( 'ABSPATH' )) {
    exit;
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_price', 10);
add_action('woocommerce_after_shop_loop_item_title', 'wcm_netto_brutto_display',10);
function wcm_netto_brutto_display() {
    global $product;

    $netto = wc_get_price_excluding_tax( $product );
    $brutto = wc_get_price_including_tax( $product );

    if ( $product->is_taxable() ) {
        $tax = ' (' . wc_get_formatted_tax_rate( $product->get_tax_rate() ) . ' VAT)';
    } else {
        $tax = '';
    }

    echo '<div class="net-gross-price">';
    echo '<span class="net-price">Cena Netto: ' . wc_price( $netto ) . '</span><br>';
    echo '<span class="gross-price">Cena Brutto: ' . wc_price( $brutto ) . $tax .'</span>';
    echo '</div>';
}