<?php


namespace Inc\Base;


class SettingsLinks
{
    protected $plugin_name;
    public function __construct()
    {
        $this->plugin_name = PLUGIN;
    }

    public function register() {
        // for thems scripts
        add_filter("plugin_action_links_$this->plugin_name", array($this, "settings_link"));
    }
    public function settings_link( $link ) {

        // add custom settings link
        $settings_link = '<a href="admin.php?page=marketing-miner">Settings</a>';
        array_push($link, $settings_link);

        return $link;

    }
}