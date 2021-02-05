<?php
/**
 * @package NBSPAutomat
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueuq extends BaseController
{
    public function register() {
        // for administracion script
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    public function enqueue() {
        // enqueue all our scrits
        //$NBSPAutomatStyle = plugins_url('/assets/nbsp-automat.css', __FILE__ .'/../' );
        wp_enqueue_style("mypluginstyle", $this->plugin_url . 'assets/nbsp-automat.css' );
        //$NBSPAutomatScript = plugins_url('/assets/nbsp-automat.js', __FILE__ .'/../' );
        wp_enqueue_script("mypluginscript", $this->plugin_url . 'assets/nbsp-automat.js');
    }
}
