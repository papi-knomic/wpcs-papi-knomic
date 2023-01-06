<?php

namespace includes\Base;

class Frontend extends BaseController {
	public function register() : void
	{
		add_shortcode( 'knomic_slideshow', [ $this, 'showSlideshow'] );
	}

	public function showSlideshow() {
		require_once $this->plugin_path . 'views/slideshow-frontend.php';
	}
}