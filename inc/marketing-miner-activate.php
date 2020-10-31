<?php
/**
 * @package MarketingMiner
 */

class MarketingMinerActivate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}