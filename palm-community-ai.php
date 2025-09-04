<?php

/**
 * Plugin Name: Palm AI Community
 * Plugin URI: https://palmoutsourcing.com
 * Description: this plugin Task for creating a custom post type for community discussions With AI.
 * Version: 1.0.0
 * Author: Mohamed Sakr
 * Author URI: https://palmoutsourcing.com
 * Text Domain: palm-ai-community
 */

if ( ! defined( 'ABSPATH' ) ) exit;

include_once plugin_dir_path(__FILE__) . 'inc/post-types/ai-community.php';
include_once plugin_dir_path(__FILE__) . 'inc/post-types.php';
include_once plugin_dir_path(__FILE__) . 'inc/settings.php';
include_once plugin_dir_path(__FILE__) . 'inc/content-display.php';



add_action('admin_enqueue_scripts', function () {
        wp_enqueue_script('community-summary-ajax', plugin_dir_url(__FILE__) . 'assets/js/script.js', ['jquery'], null, true);
        wp_localize_script('community-summary-ajax', 'communitySummaryAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('community_summary_ajax_nonce'),
            'use_ajax' => get_option('use_ajax_summary', false),
        ]);
});