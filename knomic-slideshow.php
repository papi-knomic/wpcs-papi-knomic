<?php
/**
 * Plugin Name: Knomic Slideshow
 * Plugin URI: https://github.com/papi-knomic/wpcs-papi-knomic
 * Description: Plugin for creating slideshows
 * Author: Samson Moses
 * Author URI: https://twitter.com/knomicprograms
 * Version: 1.0
 * Text Domain: knomic-slideshow
 */



//Stops file from being called directly
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'KNOMIC_SLIDESHOW_VERSION', '1.0.0' );
define( 'KNOMIC_SLIDESHOW__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'Activate.php';
require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'Deactivate.php';
require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'Init.php';


/*
 * Plugin activation
 */
register_activation_hook( __FILE__, ['Activate', 'activate_plugin']);

/*
 * Plugin deactivation
 */
register_deactivation_hook( __FILE__, ['Deactivate', 'deactivate_plugin']);

if ( class_exists( 'init' ) ) {
	Init::register_services();
}

