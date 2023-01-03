<?php

namespace includes;

class Init {
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function getServices(): array
	{
		return [];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 * @return
	 */
	public static function registerServices() : void
	{
		foreach ( self::getServices() as $class ) {
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