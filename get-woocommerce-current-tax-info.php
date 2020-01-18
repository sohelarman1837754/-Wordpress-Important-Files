<?php

add_action('woocommerce_archive_description', 'woocommerce_category_description', 2);

function woocommerce_category_description() {
    if (is_product_category()) {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        echo "CAT IS:".print_r($cat->description,true); // the category needed.
    }
}

?>
