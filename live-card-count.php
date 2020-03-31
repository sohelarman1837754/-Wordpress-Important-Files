//This code for the functions.php
function woocommerce_cart_link() {
    global $woocommerce;
    ?>
     <a class="cart_result" href="<?php echo wc_get_cart_url(); ?>"><i class="fas fa-shopping-cart"></i><p><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?></p></a>
    <?php
}

//This is for the display
<?php
  if ( class_exists( 'WooCommerce' ) ) {
      woocommerce_cart_link();
    }
   ?> 
