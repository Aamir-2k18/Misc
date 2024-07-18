<?php 
/*
Plugin Name: Boilerplate
Plugin URI: http://example.com/
Description: This is just a test
Author: who!?
Version: 0.1
Author URI: http://127.0.0.1/
*/
if(!defined('ABSPATH')){ die(); }


// Register custom post type
function register_custom_post_type() {
    register_post_type('test', array(
        'public' => true,
        'label'  => 'Test'
    ));
}
add_action('init', 'register_custom_post_type');

// Activation hook
function activate_plugin() {
    update_option('plugin_activated', time());
}
register_activation_hook(__FILE__, 'activate_plugin');

// Deactivation hook
function deactivate_plugin() {
    update_option('plugin_deactivated', time());
}
register_deactivation_hook(__FILE__, 'deactivate_plugin');

// Uninstall hook
function uninstall_plugin() {
    delete_option('plugin_activated');
    delete_option('plugin_deactivated');
    // It's generally better to not call die() in uninstall hooks.
    // Instead, you might use error_log() or similar if needed.
}
register_uninstall_hook(__FILE__, 'uninstall_plugin');
