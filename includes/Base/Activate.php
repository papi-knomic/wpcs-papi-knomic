<?php

namespace includes\Base;

class Activate {
	public static function activate() : void
	{
		flush_rewrite_rules();
	}
}