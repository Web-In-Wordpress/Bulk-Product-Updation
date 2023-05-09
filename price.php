<?php
// Replace with your own credentials
$consumer_key = 'your_consumer_key';
$consumer_secret = 'your_consumer_secret';
$store_url = 'https://yourstore.com';

// Include the WooCommerce API client library
require_once( 'woocommerce/woocommerce.php' );

// Instantiate the client with your credentials
$client = new WC_API_Client( $store_url, $consumer_key, $consumer_secret );

// Get all products
$products = $client->products->get();

// Loop through each product
foreach ( $products as $product ) {
    // Calculate the new price
    $price = floatval( $product->price ) * 1.1;

    // Update the product with the new price
    $client->products->update( $product->id, array( 'regular_price' => $price ) );
}
