<?php
/**
 * @package MarketingMiner
 */

/*
Plugin Name: Marketing Miner
Plugin URI: https://github.com/Merchans/marketing-miner
Description: Data mining plugin for online marketers! Save your time with various tools that drives you valuable data.
Version: 1.0
Author: Richard Markovič & Jakub Inger
Author URI: https://lebedova.inger.cz/
License: GPLv2 or later
Text Domain: marketing-miner
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
function marketing_miner_activate() {
    Activate::activate();
}

/**
 *  The code that runs during plugin deactivation
 */
function  marketing_miner_deactivate() {
    Deactivate::deactivate();
}
register_activation_hook( __FILE__, 'marketing_miner_activate' );
register_deactivation_hook( __FILE__, 'marketing_miner_deactivate');

if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}