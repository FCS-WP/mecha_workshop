<?php

function add_custom_font_css()
{
    wp_enqueue_style(
        'custom-font',
        get_stylesheet_directory_uri() . '/assets/sass/custom-font.css',
        [],
        filemtime(
            get_stylesheet_directory() . '/assets/sass/custom-font.css'
        )
    );
}
add_action('wp_enqueue_scripts', 'add_custom_font_css');

add_filter('loop_shop_per_page', function () {
    return 6;
}, 999);
