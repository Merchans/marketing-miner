<?php
/**
 * @package MarketingMiner
 */
namespace Inc\Base;


class Enqueuq
{
    public function register() {
        // for administracion script
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    public function enqueue() {
        // enqueue all our scrits
        //$MarketingMinerStyle = plugins_url('/assets/marketing-miner.css', __FILE__ .'/../' );
        wp_enqueue_style("mypluginstyle", PLUGIN_URL . 'assets/marketing-miner.css' );
        //$MarketingMinerScript = plugins_url('/assets/marketing-miner.js', __FILE__ .'/../' );
        wp_enqueue_script("mypluginscript", PLUGIN_URL . 'assets/marketing-miner.js');
    }
}