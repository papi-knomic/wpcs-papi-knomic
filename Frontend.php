<?php


class Frontend  {
	public function register() : void {
		add_shortcode( 'knomic_slideshow', [ $this, 'showSlideshow'] );
	}

	public function showSlideshow() : void {
		require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'views/slideshow-frontend.php';
	}
}