<?php

require '../class.enqueue.php';

class EnqueueTest extends WP_UnitTestCase {

	/**
	 * @var Enqueue
	 */
	private $enqueue;

	public function setUp() {
		parent::setUp();
		$this->enqueue = new Enqueue();
	}

	public function test_register() {
		$enqueue = $this->enqueue;

		// Use the add_action() function to get the list of actions and filters
		global $wp_filter;

		// Check if the 'wp_print_scripts' action is registered
		$this->assertArrayHasKey( 'wp_print_scripts', $wp_filter );
		$this->assertEquals( [ [ $enqueue, 'print_scripts' ] ], $wp_filter['wp_print_scripts']->callbacks );

		// Check if the 'wp_print_styles' action is registered
		$this->assertArrayHasKey( 'wp_print_styles', $wp_filter );
		$this->assertEquals( [ [ $enqueue, 'print_styles' ] ], $wp_filter['wp_print_styles']->callbacks );

		// Check if the 'admin_enqueue_scripts' action is registered
		$this->assertArrayHasKey( 'admin_enqueue_scripts', $wp_filter );
		$this->assertEquals( [ [ $enqueue, 'enqueue_admin_scripts' ] ], $wp_filter['admin_enqueue_scripts']->callbacks );
	}

	public function test_print_styles() {
		// Create an instance of the Enqueue class
		$enqueue = $this->enqueue;

		// Run the print_styles method
		$enqueue->print_styles();

		// Check if the 'slideshow' style is registered and enqueued
		$this->assertTrue( wp_style_is( 'slideshow', 'enqueued' ) );
	}

	public function test_print_scripts() {
		// Create an instance of the Enqueue class
		$enqueue = $this->enqueue;

		// Run the print_scripts method
		$enqueue->print_scripts();

		// Check if the 'jquery' script is registered and enqueued
		$this->assertTrue( wp_script_is( 'jquery', 'enqueued' ) );

		// Check if the 'slideshow' script is registered and enqueued when not in admin area
		$this->assertTrue( wp_script_is( 'slideshow', 'enqueued' ) );

		// Check if the 'admin-slideshow' script is registered and enqueued
		$this->assertTrue( wp_script_is( 'admin-slideshow', 'enqueued' ) );

		// Check if the 'jquery-ui-sortable' script is registered and enqueued
		$this->assertTrue( wp_script_is( 'jquery-ui-sortable', 'enqueued' ) );
	}

	public function test_enqueue_admin_scripts() {
		// Create an instance of the Enqueue class
		$enqueue = $this->enqueue;

		// Run the enqueue_admin_scripts method
		$enqueue->enqueue_admin_scripts();

		// Check if the 'jquery-ui-sortable' style is registered and enqueued
		$this->assertTrue( wp_style_is( 'jquery-ui-sortable', 'enqueued' ) );

		// Check if the 'toastr' style is registered and enqueued
		$this->assertTrue( wp_style_is( 'toastr', 'enqueued' ) );

		// Check if the 'admin' style is registered and enqueued
		$this->assertTrue( wp_style_is( 'admin', 'enqueued' ) );

		// Check if the 'font-awesome' style is registered and enqueued
		$this->assertTrue( wp_style_is( 'font-awesome', 'enqueued' ) );

		// Check if the 'toastr' script is registered and enqueued
		$this->assertTrue( wp_script_is( 'toastr', 'enqueued' ) );

		// Check if the 'clipboard' script is registered and enqueued
		$this->assertTrue( wp_script_is( 'clipboard', 'enqueued' ) );

		// Check if the 'admin-slideshow' script is registered and enqueued
		$this->assertTrue( wp_script_is( 'admin-slideshow', 'enqueued' ) );
	}

}