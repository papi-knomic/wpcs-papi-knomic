<?php

class InitTest extends WP_UnitTestCase {

	public function test_get_services() {
		$services = Init::get_services();
		$this->assertEquals( $services, [
			Settings::class,
			Admin::class,
			Enqueue::class,
			Frontend::class,
			Ajax::class
		]);
	}

	public function test_register_services() {
		$mock = $this->getMockBuilder( Settings::class )
		             ->setMethods( [ 'register' ] )
		             ->getMock();
		$mock->expects( $this->once() )
		     ->method( 'register' );
		$services = [
			$mock
		];
		$this->setProtectedProperty( Init::class, 'services', $services );
		Init::register_services();
	}

	public function test_instantiate() {
		$this->setProtectedMethod( 'instantiate' );
		$instance = $this->instantiate( Settings::class );
		$this->assertInstanceOf( Settings::class, $instance );
	}
}

