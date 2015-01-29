<?php
/*
Plugin Name: mathtex latex equation editor
Plugin URI: http://latex.kobmat.com/mathtex-latex-equation-editor
Description: Adds MathTex latex equation popup editor to wordrpess TinyMCE editor.
Author: kobmat
Version: 1.1.5
Author URI: http://www.kobmat.com/math
*/
add_option( 'mathtex_editor_server_url', 'http://chart.apis.google.com/chart?cht=tx&chl=');
add_option( 'mathtex_codecogs_url', 'http://latex.codecogs.com/gif.latex?');
add_option( 'mathtex_enable_codecogs_conversions', 'yes');
add_option( 'mathtex_editor_code_completion', 'yes');
add_option( 'mathtex_use_php_to_request', 'no'); 
add_option( 'mathtex_enable_cache', 'no');
add_option( 'mathtex_cache_limit', '360');

function latex_mathtex_init() {
	add_filter('mce_external_plugins', "mathtex_register");
	add_filter('mce_buttons', 'mathtex_add_button', 0);
}

function mathtex_add_button($buttons)
{
    array_push($buttons, "separator", "mathTex");
	array_push($buttons, "separator", "mathTexConverter");
 	return $buttons;
}

function mathtex_register($plugin_array)
{
    $url = plugins_url( 'editor_plugin.js.php', __FILE__ );

    $plugin_array['mathTex'] = $url;
    return $plugin_array;
} 



add_action('init', 'latex_mathtex_init');

if ( is_admin() ){ // admin actions
  add_action( 'admin_menu', 'mathtex_create_menu' );
} else {
  // non-admin enqueues, actions, and filters
  
}

function mathtex_cache_get()
{
	echo "This is a test";
}

function mathtex_create_menu() 
{
	add_options_page('MathTex Equation Editor', 'MathTex Equation Editor', 'administrator', __FILE__, 'mathtex_settings_page'); 
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() { // whitelist options
  register_setting( 'mathTex', 'mathtex_editor_server_url' );
  register_setting( 'mathTex', 'mathtex_enable_codecogs_conversions' );
  register_setting( 'mathTex', 'mathtex_codecogs_url' );
  register_setting( 'mathTex',  'mathtex_editor_code_completion');
  register_setting( 'mathTex', 'mathtex_use_php_to_request');
  register_setting( 'mathTex', 'mathtex_enable_cache');
  register_setting( 'mathTex', 'mathtex_cache_limit');
}

function mathtex_settings_page() {
	include(dirname(__FILE__).'/options.php');
}

