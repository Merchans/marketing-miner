<?php
/**
 * @package MarketingMiner
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;

class Admin extends BaseController
{
    public $plugin;

    // methods
    public function register() {

        add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

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
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e('Klíčová slova', 'marketing-miner' ); ?></h1>
            <?php

            include dirname(__FILE__, 3) .'/templates/keywords-decreasing-header.html';

            $cURLConnection = curl_init();

            curl_setopt($cURLConnection, CURLOPT_URL, "https://www.marketingminer.com/api/v1/project/ebd35110-cf35-4c86-900a-83056e5f7cf5/detail/dashboard");
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

            include dirname(__FILE__, 3) .'/templates/keywords-increasing-footer.html';
            include dirname(__FILE__, 3) .'/templates/keywords-decreasing-header.html';
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

            include dirname(__FILE__, 3) .'/templates/keywords-decreasing-footer.html'; ?>
        </div>
        <?php
    }

}