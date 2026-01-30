<?php

/*
 * Define Variables
 */
if (!defined('THEME_DIR'))
    define('THEME_DIR', get_template_directory());

if (!defined('THEME_DIR_CHILD'))
    define('THEME_DIR_CHILD', THEME_DIR . '-child');

if (!defined('THEME_URL'))
    define('THEME_URL', get_template_directory_uri());


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


/**
 *
 * Include Autoload file
 */

require_once THEME_DIR_CHILD . '/autoload.php';

/**
 * Localize script for AJAX
 */
function theme_enqueue_ajax_scripts()
{
    wp_localize_script('main-js', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_ajax_scripts');