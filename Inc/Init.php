<?php


namespace Inc;


final class Init
{
    public function __construct() {
    }

    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueuq::class,
            Base\SettingsLinks::class
        ];
    }

    /**
     * Loop through the clasess initialize them, and call the register() method if exist
     * @return [type] [description]
     */
    public static function register_services()  {

        foreach ( self::get_services() as $class ) {
            $service = self::instantiate( $class );
            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
    }
    }
    /**
     * Initialize the class
     * @param  class $class    class from the services array
     * @return class instance  new instance of the class
     */
    private static function instantiate( $class )
    {
        $service = new $class();

        return $service;
    }
}
/*
use Inc\Activate;
use Inc\Deactivate;

if ( !class_exists( 'MarketingMiner' ) ) {

    class MarketingMiner
    {
        // atributs
        protected $apiKey;
        public $plugin;

        // methods
        public function __construct( $apiKey = null ) {

            $this->apiKey = $apiKey;
            $this->plugin = plugin_basename( __FILE__ );
        }

        public function register() {

            add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

            // for administracion script
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

            // for thems scripts

            add_filter("plugin_action_links_$this->plugin", array($this, "settings_link"));
        }


        public function settings_link( $link ) {

            // add custom settings link
            $settings_link = '<a href="admin.php?page=marketing-miner">Settings</a>';
            array_push($link, $settings_link);

            return $link;

        }

        public function add_admin_page()
        {
            add_menu_page(
                __('Keywords', 'marketing-miner'),
                'Keywords',
                'read',
                'marketing-miner',
                array( $this,'admin_keywords_content' ),
                'dashicons-chart-line',
                5
            );
        }

        public function admin_keywords_content()
        {
            $key =  $this->apiKey;
            ?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php _e('Klíčová slova', 'marketing-miner' ); ?></h1>
                <?php

                include 'templates/keywords-decreasing-header.html';

                $cURLConnection = curl_init();

                curl_setopt($cURLConnection, CURLOPT_URL, "https://www.marketingminer.com/api/v1/project/$key/detail/dashboard");
                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

                $keywordsList = curl_exec($cURLConnection);
                curl_close($cURLConnection);

                $keywordsIncreasing = json_decode($keywordsList, true)['increasing'];

                foreach($keywordsIncreasing as $keyword):
                    ?>
                    <tr>
                        <td class="text-capitalize "><?= $keyword['engine']; ?></td>
                        <td><?= $keyword['keyword']; ?></td>
                        <td>
                            <?php if($keyword['position'] <= 10): ?>
                                <button class="btn btn-info btn-position text-center">
                                    <?php if($keyword['position']==1) ?>
                                        🏆
                                    <?= $keyword['position']; ?>
                                </button>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-position text-center">
                                    <?= $keyword['position']; ?>
                                </button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-success btn-position text-center">
                                +<?= $keyword['position_change']; ?>
                            </button>
                        </td>
                    </tr>
                <?php
                endforeach;
                include 'templates/keywords-increasing-footer.html';
                include 'templates/keywords-decreasing-header.html';
                echo '<br><br>';
                $keywordsDecreasing = json_decode($keywordsList, true)['decreasing'];
                foreach($keywordsDecreasing as $keyword): ?>
                    <tr>
                        <td class="text-capitalize"><?= $keyword['engine']; ?></td>
                        <td><?= $keyword['keyword']; ?></td>
                        <td>
                            <?php if($keyword['position'] <= 10): ?>
                                <button class="btn btn-info btn-position text-center">
                                    <?= $keyword['position']; ?>
                                </button>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-position text-center">
                                    <?php if($keyword['position']>50): ?>
                                        😥
                                    <?php endif; ?>
                                    <?= $keyword['position']; ?>
                                </button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-position text-center">
                                <?= $keyword['position_change']; ?>
                            </button>
                        </td>
                    </tr>
                <?php
                endforeach;
                include 'templates/keywords-decreasing-footer.html'; ?>
            </div>
            <?php
        }

        public function enqueue() {
            // enqueue all our scrits
            wp_enqueue_style("mypluginstyle", plugins_url('/assets/marketing-miner.css', __FILE__));
            wp_enqueue_script("mypluginstyle", plugins_url('/assets/marketing-miner.js', __FILE__));
        }

        public function activate() {
            Activate::activate();
        }

    }
}

if ( class_exists('MarketingMiner') ) {

    $marketingMiner = new MarketingMiner("ebd35110-cf35-4c86-900a-83056e5f7cf5");
    $marketingMiner->register();

    // activation
    //require_once plugin_dir_path(__FILE__) . 'Inc/Activate.php';
    register_activation_hook( __FILE__, array( $marketingMiner, 'activate' ) );

    // deactivation
    //require_once plugin_dir_path(__FILE__) . 'Inc/Deactivate.php';
    register_deactivation_hook( __FILE__, array('Deactivate', 'deactivate') );

}
*/

