<?php
/*
 * Plugin name: I like
 * Plugin URI: https://mrtangle.com/plugins/i-like/
 * Author: MR
 * Author URI: https://mrtangle.com/
 * Version: 1.1
 * Description: A Simple way to display beautiful Like and Dislike buttons under each post, also add total likes and dislikes counters.
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt/
 * Text Domain: i-like
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 */
define('I_LIKE_VERSION', '1.1');

/**
 *  define constant
 */
if (!defined('I_LIKE_URL')) {
    define('I_LIKE_URL', plugin_dir_url(__FILE__));
}

/* enqueue style and scripts */
if (!function_exists('i_like_plugin_scripts')) {
    function i_like_plugin_scripts()
    {
        /* font awesome css */
        wp_enqueue_style('i-like-fa-style', I_LIKE_URL . 'assets/css/all.min.css');
        /* plugin main style */
        wp_enqueue_style('i-like-main-style', I_LIKE_URL . 'assets/css/main.css');

        /* ajax js */
        wp_enqueue_script('i-like-ajax-js', I_LIKE_URL . 'assets/js/i-like-ajax.js', 'jQuery', '1.0.0', true);
        /* plugin main js */
        wp_enqueue_script('i-like-main-js', I_LIKE_URL . 'assets/js/main.js', 'jQuery', '1.0.0', true);

        wp_localize_script('i-like-ajax-js', 'i_like_ajax_url', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
    add_action('wp_enqueue_scripts', 'i_like_plugin_scripts');
}

/* setting table */
require plugin_dir_path(__FILE__) . 'inc/i_like_db.php';
register_activation_hook(__FILE__, 'i_like_table');

/* ajax data */
require plugin_dir_path(__FILE__) . 'inc/i_like_ajax.php';

/* setting menu and page */
require plugin_dir_path(__FILE__) . 'inc/i_like_plugin_settings.php';

/* add buttons to post */
require plugin_dir_path(__FILE__) . 'inc/i_like_add_buttons.php';

/* add setting link to plugin page */
require plugin_dir_path(__FILE__) . 'inc/i_like_add_setting_link.php';
