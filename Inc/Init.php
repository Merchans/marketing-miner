<?php
/**
 * @package NBSPAutomat
 */
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
	 *
	 * Initialize the class
	 * @param $class class from the services array
	 *
	 * @return mixed instance  new instance of the class
	 */
	private static function instantiate( $class )
    {
        $service = new $class();

        return $service;
    }
}

