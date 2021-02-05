<?php
/**
 * @package NBSPAutomat
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use Inc\Api\Callbacks\AdminCallbacks;
class Admin extends BaseController
{

    public $settings;

    public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setPages();

        $this->setSubpages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
    }


	/**
	 *
	 */
	public function setPages()
	{
        $this->pages = [
            [
                'page_title'	=>  'Keywords',
                'menu_title'	=>	'Keywords',
                'capability'	=>	'read',
                'menu_slug'		=>	'nbsp-automat',
                'callback'		=> 	array( $this->callbacks, 'adminDashboard' ),
                'icon_url'		=>  'dashicons-chart-line',
                'position'		=>  110
            ],
        ];
	}

	/**
	 *
	 */
	public function setSubpages()
    {
        $this->subpages = [
            [
                'parent_slug'	=>	'nbsp-automat',
                'page_title'	=>	'NBSP Automat Settings',
                'menu_title'	=>	'Settings',
                'capability'	=>	'manage_options',
                'menu_slug'		=>	'nbsp-automat-settings',
                'callback'		=>  array( $this->callbacks, 'adminSettings' ),
            ],
        ];
    }

	/**
	 *
	 */
	public function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'alecaddd_options_group',
                'option_name' => 'mm_api_key',
                'callback' => array( $this->callbacks, 'alecadddOptionsGroup' )
            ),
            array(
                'option_group' => 'alecaddd_options_group',
                'option_name' => 'first_name'
            )
        );

        $this->settings->setSettings( $args );
    }

	/**
	 *
	 */
	public function setSections()
    {
        $args = array(
            array(
                'id' => 'alecaddd_admin_index',
                'title' => 'Settings',
                'callback' => array( $this->callbacks, 'alecadddAdminSection' ),
                'page' => 'alecaddd_plugin'
            )
        );

        $this->settings->setSections( $args );
    }

	/**
	 *
	 */
	public function setFields()
    {
        $args = array(
            array(
                'id' => 'mm_api_key',
                'title' => 'API KEY',
                'callback' => array( $this->callbacks, 'mmApiKey' ),
                'page' => 'alecaddd_plugin',
                'section' => 'alecaddd_admin_index',
                'args' => array(
                    'label_for' => 'mm_api_key',
                    'class' => 'example-class'
                )
            )
        );

        $this->settings->setFields( $args );
    }
}
