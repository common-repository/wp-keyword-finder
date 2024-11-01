<?php
/*
Plugin Name: WP Keyword Finder
Plugin URI: https://github.com/EvilBozkurt
Description: You can use this plugin to find keywords in Google and also Yahoo and Bing. It helps you produce higher quality content in terms of SEO. In this way, search engines will love your articles more.
Author: Mehmet Bozkurt
Version: 1.1.2
*/

if ( !function_exists( 'add_action' ) ) {
    echo 'You are not allowed to enter.';
    exit;
}

//Plugin DIR URL
define( 'WPKF_URL', plugin_dir_url( __FILE__ ) );
//Plugin DIR Path
define( 'WPKF_DIR', plugin_dir_path( __FILE__ ) );

// Load Admin Settings
include WPKF_DIR ."admin/index.php";

// Load Functions
include WPKF_DIR ."WPKF-functions.php";

// Load Settings
require_once WPKF_DIR . 'includes/settings.php';

function WPKF_register_activation_settings() {
    //register our settings
    
    $args = array(
        'type' => 'tinyint(1)',
        'description' => 'Pro Version',
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest' => '',
        'default' => 0,
    );
    
    // evil aktivasyon sirasinda calisir
    
    if(get_option("WPKF_default_country") ==  '' || get_option("WPKF_default_country") == false){
        add_option("WPKF_default_country", "TR");
    }
    
    if(get_option("WPKF_default_language") ==  '' || get_option("WPKF_default_language") == false){
        add_option("WPKF_default_language", "TR");
    }

    if(get_option("WPKF_default_source") ==  '' || get_option("WPKF_default_source") == false){
        add_option("WPKF_default_source", "google");
    }
}

//Register Options
register_activation_hook( __FILE__, 'WPKF_register_activation_settings' );

// Plugin WP-Admin Settings Text
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'WPKF_plugin_page');

function WPKF_plugin_page( $links ) {
    $links[] = '<a href="' . admin_url( 'options-general.php?page=wpkf_keyword_finder_dashboard' ) . '">' . __('Settings') . '</a>';
    return $links;
}
