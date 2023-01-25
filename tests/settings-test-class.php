<?php

require '../class.settings.php';

class SettingsTest extends WP_UnitTestCase {

	/**
	 * @var Settings
	 */
	private $settings;

	public function setUp() {
		parent::setUp();
		$this->settings = new Settings();
	}

	public function test_register() {
		$settings = $this->settings;
		$settings->register();
		$this->assertEquals( has_action( 'after_setup_theme', [ $settings, 'set_image_sizes' ] ), 10 );
	}

	public function test_set_image_sizes() {
		$settings = $this->settings;
		$settings->set_image_sizes();
		$this->assertTrue( current_theme_supports( 'post-thumbnails' ) );
		$this->assertTrue( has_image_size( KNOMIC_SLIDESHOW__LARGE ) );
		$this->assertTrue( has_image_size( KNOMIC_SLIDESHOW__THUMB ) );
	}
}
