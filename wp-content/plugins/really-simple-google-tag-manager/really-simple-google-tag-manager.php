<?php
/**
 * Plugin Name: Really Simple Google Tag Manager
 * Description: Add Google Tag Manager onto every page of your website without editing code.
 * Author: 		HasThemes
 * Author URI: 	https://hasthemes.com/
 * Version: 	1.0.6
 * Text Domain: simple-googletag
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly
define( 'SIMPLE_GOOGLE_TAG_ROOT', __FILE__ );
define( 'SIMPLE_GOOGLE_TAG_URL', plugins_url( '/', SIMPLE_GOOGLE_TAG_ROOT ) );
define( 'SIMPLE_GOOGLE_TAG_PATH', plugin_dir_path( SIMPLE_GOOGLE_TAG_ROOT ) );
define( 'SIMPLE_GOOGLE_TAG_PLUGIN_BASE', plugin_basename( SIMPLE_GOOGLE_TAG_ROOT ) );

function simple_googletag_get_id(){
	$simple_googletag_id = get_option('google_tag_manager_id')?get_option('google_tag_manager_id'):'';
	return $simple_googletag_id;
}

// Required File
require_once ( SIMPLE_GOOGLE_TAG_PATH .'includes/class.simple-googletag.php' );