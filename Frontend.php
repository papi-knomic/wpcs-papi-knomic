<?php


class Frontend {
	public function register() : void {
		add_shortcode( 'knomic_slideshow', [ $this, 'show_slideshow'] );
	}

	public function show_slideshow() : void {
		require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'views/slideshow-frontend.php';
	}
}