<?php

require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'class.settings.php';
require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'class.admin.php';
require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'class.enqueue.php';
require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'class.frontend.php';
require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'class.ajax.php';


class Init {
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services(): array {
		return [
			Settings::class,
			Admin::class,
			Enqueue::class,
			Frontend::class,
			Ajax::class
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() : void {
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
	private static function instantiate( $class ) {
		$service = new $class();

		return $service;
	}
}