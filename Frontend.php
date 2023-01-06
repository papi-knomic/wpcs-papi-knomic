<?php


class Frontend extends BaseController {
	public function register() : void {
		add_shortcode( 'knomic_slideshow', [ $this, 'showSlideshow'] );
	}

	public function showSlideshow() : void {
		require_once $this->plugin_path . 'views/slideshow-frontend.php';
	}
}