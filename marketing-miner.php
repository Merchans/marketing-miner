<?php
/**
 * @package MarketingMiner
 */

/*
Plugin Name: Marketing Miner
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
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

if ( !class_exists( 'MarketingMiner' ) ) {

    class MarketingMiner
    {
        // atributs
        protected $apiKey;
        public $plugin;

        // method
        function __construct( $apiKey = null ) {

            $this->apiKey = $apiKey;
            $this->plugin = plugin_basename( __FILE__ );

        }

        function register() {

            add_action( 'admin_menu', array( $this, 'addAdminKeywords' ) );
        }



        function activate() {
            flush_rewrite_rules();
        }

        function deactivation() {
            flush_rewrite_rules();
        }


        function addAdminKeywords()
        {
            add_menu_page(
                __('Keywords', 'marketing-miner'),
                'Keywords',
                'read',
                'keywords',
                array( $this,'adminKeywordsContent' ),
                'dashicons-chart-line',
                5
            );
        }

        function adminKeywordsContent()
        {
        	$key =  $this->apiKey;
            ?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php _e('Klíčová slova'); ?></h1>
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

    }
}

if ( class_exists('MarketingMiner') ) {

    $marketingMiner = new MarketingMiner("ebd35110-cf35-4c86-900a-83056e5f7cf5");
    $marketingMiner->register();
}


// activation
register_activation_hook( __FILE__, array($marketingMiner, 'activate') );

// deactivation
register_deactivation_hook( __FILE__, array($marketingMiner, 'deactivate') );

// uninstal
