<?php


class Activate {
	public static function activate_plugin() : void {
		flush_rewrite_rules();
	}
}