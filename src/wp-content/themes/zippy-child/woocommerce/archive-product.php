<?php
defined('ABSPATH') || exit;

get_header('shop'); // header WooCommerce
?>

<main id="main" class="shop-page">
    <?php echo do_shortcode('[block id="shop-layout-custom"]'); ?>
</main>

<?php
get_footer('shop');
