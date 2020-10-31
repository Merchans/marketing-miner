<?php
/**
 * @package MarketingMiner
 */

class MarketingMinerDeactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}