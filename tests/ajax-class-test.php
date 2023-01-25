<?php
require '../class.ajax.php';


class AjaxTest extends WP_UnitTestCase {

	/**
	 * @var Ajax
	 */
	private $ajax;

	public function setUp() : void {
		parent::setUp();
		$this->ajax = new \Ajax();
	}

	/**
	 * This is to test the register method
	 * @return void
	 */
	public function test_register() {
		// Set up some mock methods
		$this->ajax->add_image = function() {};
		$this->ajax->remove_image = function() {};
		$this->ajax->sort_slide = function() {};

		// Register the actions
		$this->ajax->register();

		// Check that the actions are registered correctly
		$this->assertEquals([$this->ajax, 'add_image'], has_action('wp_ajax_knomic_add_image_to_slide'));
		$this->assertEquals([$this->ajax, 'remove_image'], has_action('wp_ajax_knomic_remove_image_from_slide'));
		$this->assertEquals([$this->ajax, 'sort_slide'], has_action('wp_ajax_knomic_update_slide_arrangement'));
	}

	/**
	 * This is to test the add image method
	 * @return void
	 */
	public function test_add_image() {
		// Test adding an image
		$_POST = [
			'nonce' => wp_create_nonce('knomic_slideshow_image_select'),
			'id' => 1
		];
		$this->ajax->add_image();
		$image_array = get_option(KNOMIC_SLIDESHOW__ARRANGEMENT);
		$this->assertContains(1, $image_array);

		// Test adding an image that already exists in the slideshow
		$this->ajax->add_image();
		$image_array = get_option(KNOMIC_SLIDESHOW__ARRANGEMENT);
		$this->assertEquals(1, count($image_array));

		// Test adding an image without a nonce
		$_POST = [
			'id' => 2
		];
		$this->ajax->add_image();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Unauthorized request', $response['message']);

		// Test adding an image with an invalid nonce
		$_POST = [
			'nonce' => 'invalid_nonce',
			'id' => 3
		];
		$this->ajax->add_image();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Unauthorized request', $response['message']);

		// Test adding an image that doesn't meet the minimum size requirements
		$this->ajax->check_image_size = function() {
			return false;
		};
		$_POST = [
			'nonce' => wp_create_nonce('knomic_slideshow_image_select'),
			'id' => 4
		];
		$this->ajax->add_image();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Image not up to minimum width and height', $response['message']);
	}

	/**
	 * This is to test the remove_image method
	 * @return void
	 */
	public function test_remove_image() {
		// Test removing an image
		update_option(KNOMIC_SLIDESHOW__ARRANGEMENT, [1, 2, 3]);
		$_POST = [
			'nonce' => wp_create_nonce('knomic_slideshow_image_remove'),
			'id' => 2
		];
		$this->ajax->remove_image();
		$image_array = get_option(KNOMIC_SLIDESHOW__ARRANGEMENT);
		$this->assertNotContains(2, $image_array);

		// Test removing an image that doesn't exist in the slideshow
		$_POST = [
			'nonce' => wp_create_nonce('knomic_slideshow_image_remove'),
			'id' => 4
		];
		$this->ajax->remove_image();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Image not found in slideshow', $response['message']);

		// Test removing an image without a nonce
		$_POST = [
			'id' => 2
		];
		$this->ajax->remove_image();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Unauthorized request', $response['message']);

		// Test removing an image with an invalid nonce
		$_POST = [
			'nonce' => 'invalid_nonce',
			'id' => 2
		];
		$this->ajax->remove_image();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Unauthorized request', $response['message']);
	}

	/**
	 * This is to test the sort_slide method
	 * @return void
	 */
	public function test_sort_slide() {
		// Test sorting the slides
		update_option(KNOMIC_SLIDESHOW__ARRANGEMENT, [3, 1, 2]);
		$_POST = [
			'nonce' => wp_create_nonce('knomic_slideshow_image_sort'),
			'slides' => [1, 3, 2]
		];
		$this->ajax->sort_slide();
		$sorted_slides = get_option(KNOMIC_SLIDESHOW__ARRANGEMENT);
		$this->assertEquals([1, 3, 2], $sorted_slides);

		// Test sorting the slides without a nonce
		$_POST = [        'slides' => [1, 3, 2]
		];
		$this->ajax->sort_slide();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Unauthorized request', $response['message']);

		// Test sorting the slides with an invalid nonce
		$_POST = [
			'nonce' => 'invalid_nonce',
			'slides' => [1, 3, 2]
		];
		$this->ajax->sort_slide();
		$response = json_decode(wp_get_server_protocol(), true);
		$this->assertEquals('Unauthorized request', $response['message']);
	}

	/**
	 * This is to test the check_image_size method
	 * @return void
	 */
	public function test_check_image_size() {
		// Test an image that meets the minimum size requirements
		$image_id = 1;
		add_image_size('knomic_slideshow', 500, 300);
		$image = wp_get_attachment_metadata($image_id);
		$image['width'] = 600;
		$image['height'] = 400;
		wp_update_attachment_metadata($image_id, $image);
		$this->assertTrue($this->ajax->check_image_size($image_id));

		// Test an image that doesn't meet the minimum width requirement
		$image_id = 2;
		$image = wp_get_attachment_metadata($image_id);
		$image['width'] = 400;
		$image['height'] = 400;
		wp_update_attachment_metadata($image_id, $image);
		$this->assertFalse($this->ajax->check_image_size($image_id));

		// Test an image that doesn't meet the minimum height requirement
		$image_id = 3;
		$image = wp_get_attachment_metadata($image_id);
		$image['width'] = 600;
		$image['height'] = 200;
		wp_update_attachment_metadata($image_id, $image);
		$this->assertFalse($this->ajax->check_image_size($image_id));
	}

}
