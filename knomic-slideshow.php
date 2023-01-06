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

// Require once for the composer autoload
if (file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


/*
 * Plugin activation
 */
function activateKnomicSlideshow() : void
{
	Activate::activate();
}
register_activation_hook( __FILE__, 'activateKnomicSlideshow');

/*
 * Plugin deactivation
 */
function deactivateKnomicSlideshow() : void
{
	Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivateKnomicSlideshow');

if ( class_exists( 'includes\\init' ) ) {
	Init::registerServices();
}

