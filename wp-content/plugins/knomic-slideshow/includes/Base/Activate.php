<?php

namespace includes\Base;

class Activate {
	public static function activate() : void
	{
		var_dump('team');
		flush_rewrite_rules();
	}
}