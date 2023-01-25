<?php

require '../class.activate.php';


class ActivateTest extends WP_UnitTestCase {

	public function test_activate_plugin() {
		global $wp_rewrite;
		$original_rules = $wp_rewrite->wp_rewrite_rules();
		Activate::activate_plugin();
		$this->assertNotEquals($original_rules, $wp_rewrite->wp_rewrite_rules());
	}

}