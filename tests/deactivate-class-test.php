<?php

require '../class.deactivate.php';


class DeactivateTest extends WP_UnitTestCase {

	public function test_activate_plugin() {
		global $wp_rewrite;
		$original_rules = $wp_rewrite->wp_rewrite_rules();
		Deactivate::deactivate_plugin();
		$this->assertNotEquals( $original_rules, $wp_rewrite->wp_rewrite_rules() );
	}

}