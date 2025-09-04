<?php
/*
Plugin Name: Palm AI Summary Settings
Description: A plugin to manage content summary settings for Palm AI.
Version: 1.0
Author: Your Name
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Include the settings file
require_once plugin_dir_path( __FILE__ ) . 'inc/settings.php';

// Activation hook
function palm_ai_summary_settings_activate() {
    // Set default options
    add_option('content_length', '30');
    add_option('use_ajax_summary', '0');
}
register_activation_hook( __FILE__, 'palm_ai_summary_settings_activate' );

// Deactivation hook
function palm_ai_summary_settings_deactivate() {
    // Clean up options
    delete_option('content_length');
    delete_option('use_ajax_summary');
}
register_deactivation_hook( __FILE__, 'palm_ai_summary_settings_deactivate');
?>