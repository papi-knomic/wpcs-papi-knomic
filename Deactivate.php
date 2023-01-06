<?php


class Deactivate {
	public static function deactivatePlugin() : void {
		flush_rewrite_rules();
	}
}