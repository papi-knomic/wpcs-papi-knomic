<?php
require '../class.admin.php';


class AdminTest extends WP_UnitTestCase {
	/**
	 * @var Admin
	 */
	private $admin;

	public function setUp() {
		parent::setUp();
		$this->admin = new Admin();
	}

	public function test_register() {
		global $wp_filter;
		$this->admin->register();
		$this->assertEquals( 1, did_action( 'admin_menu' ) );
		$this->assertArrayHasKey( 'admin_menu', $wp_filter );
		$this->assertArrayHasKey( [$this->admin, 'add_admin_pages'], $wp_filter['admin_menu'] );
	}

	public function test_add_admin_pages() {
		global $admin_page_hooks;
		$this->admin->add_admin_pages();
		$this->assertArrayHasKey( 'knomic_slideshow', $admin_page_hooks );
	}

	public function test_admin_index_page(){
		global $wpdb;
		$attachment_id = $this->factory->attachment->create_upload_object( __DIR__ . '/test-image.jpg' );
		update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, [$attachment_id] );
		$this->admin->admin_index_page();
		$this->expectOutputRegex('/test-image.jpg/');
	}
}