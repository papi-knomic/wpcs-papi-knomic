<?php

namespace includes\Base;

class Deactivate {
	public static function deactivate() : void
	{
		flush_rewrite_rules();
	}

}