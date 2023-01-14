<?php


class Deactivate {
	public static function deactivate_plugin() : void {
		flush_rewrite_rules();
	}
}