<?php
/*
Plugin Name: NBSP Automat
Plugin URI: https://github.com/Merchans/nbsp-automat
Description: Automatically adds a non-breaking space (&nbsp) in the content.
Version: 1.0
Author: Richard Markovič
Author URI:
License: GPLv2 or later
Text Domain: nbsp-automat
*/


if	( ! defined('ABSPATH') ) {
	die();
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Nemespace for auto loading
use Inc\Base\Activate;
use Inc\Base\Deactivate;

/**
 *  The code that runs during plugin activation
 */
function nbsp_automat_activate() {
    Activate::activate();
}

/**
 *  The code that runs during plugin deactivation
 */
function  nbsp_automat_deactivate() {
    Deactivate::deactivate();
}
register_activation_hook( __FILE__, 'nbsp_automat_activate' );
register_deactivation_hook( __FILE__, 'nbsp_automat_deactivate');

if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}
