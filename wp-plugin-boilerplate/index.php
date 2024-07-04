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

class Test_beta{
    public function __construct(){
        add_action('init',array($this, 'custom_post_type' ));
    }
    public function active(){
        update_option( 'plugin_activated', time() );
    }
    public function inactive(){
        update_option( 'plugin_deactivated', time() );
    }
    public function custom_post_type(){
        register_post_type('test',['public'=>true, 'label'=>'Test']);
    }
}
$t = new Test_beta();

register_activation_hook(__FILE__, array($t, 'active'));
register_deactivation_hook( __FILE__, array($t, 'inactive'));
register_uninstall_hook( __FILE__,   'uninstall_func' );

function uninstall_func(){
    delete_option('plugin_activated');
    delete_option('plugin_deactivated');
    die('test gone wrong!');
}