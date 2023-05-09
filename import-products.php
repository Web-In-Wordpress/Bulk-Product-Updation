<?php
/*
Save the above code in a file with a .php extension, for example, import-products.php.

Upload the CSV file with your product data to your server.

Modify the $csv_file variable in the script to point to the path of your CSV file.

Upload the import-products.php file to your WordPress root directory.

Run the script by visiting http://yourdomain.com/import-products.php in your web browser.
*/
// Load WordPress
require_once('wp-load.php');

// Set the path to the CSV file
$csv_file = 'path/to/products.csv';

// Open the CSV file
if (($handle = fopen($csv_file, "r")) !== FALSE) {
    // Loop through the rows
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Extract the data from the row
        $name = $data[0];
        $description = $data[1];
        $price = $data[2];

        // Create the product
        $post = array(
            'post_title' => $name,
            'post_content' => $description,
            'post_status' => 'publish',
            'post_type' => 'product'
        );
        $post_id = wp_insert_post($post);

        // Add the price
        update_post_meta($post_id, '_price', $price);
    }

    // Close the CSV file
    fclose($handle);
}
?>
