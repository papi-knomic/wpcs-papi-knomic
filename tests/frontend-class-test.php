<?php
require '../class.frontend.php';


class FrontendTest extends WP_UnitTestCase {

	/**
	 * @var Frontend
	 */
	private $frontend;

	public function setUp() {
		parent::setUp();
		$this->frontend = new Frontend();
	}

	public function test_register() {
		// Create an instance of the Frontend class
		$frontend = $this->frontend;

		// Use the add_shortcode() function to get the list of shortcodes
		global $shortcode_tags;

		// Check if the KNOMIC_SLIDESHOW_SHORTCODE shortcode is registered
		$this->assertArrayHasKey( KNOMIC_SLIDESHOW_SHORTCODE, $shortcode_tags );
		$this->assertEquals( [ $frontend, 'show_slideshow' ], $shortcode_tags[KNOMIC_SLIDESHOW_SHORTCODE] );
	}

	public function test_show_slideshow(){
		// Create an instance of the Frontend class
		$frontend = $this->frontend;

		// Add some attachments to the media library
		$attachment_id1 = self::factory()->attachment->create_upload_object( dirname(__FILE__).'/data/test-image-1.jpg' );
		$attachment_id2 = self::factory()->attachment->create_upload_object( dirname(__FILE__).'/data/test-image-2.jpg' );
		$attachment_ids = array($attachment_id1, $attachment_id2);

		// Add the attachments ids to the options table
		update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $attachment_ids);

		// Run the show_slideshow method
		ob_start();
		$frontend->show_slideshow();
		$output = ob_get_clean();

		// Check if the images are displayed in the slideshow
		$this->assertContains( wp_get_attachment_image_src( $attachment_id1, KNOMIC_SLIDESHOW__LARGE)[0], $output);
		$this->assertContains( wp_get_attachment_image_src( $attachment_id2, KNOMIC_SLIDESHOW__LARGE)[0], $output);
	}
}
