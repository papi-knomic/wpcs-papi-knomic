<?php


class Activate {
	public static function activatePlugin() : void {
		flush_rewrite_rules();
	}
}