<?php


class Settings {
	public function register() : void {
		add_action( 'after_setup_theme', [ $this, 'set_image_sizes' ] );
	}

	public function set_image_sizes() : void {
		add_theme_support( 'post-thumbnails' );
		add_image_size(KNOMIC_SLIDESHOW__LARGE, KNOMIC_SLIDESHOW__LARGE_IMAGE_WIDTH, KNOMIC_SLIDESHOW__LARGE_IMAGE_HEIGHT, true);
		add_image_size(KNOMIC_SLIDESHOW__THUMB, KNOMIC_SLIDESHOW__THUMB_IMAGE_WIDTH, KNOMIC_SLIDESHOW__THUMB_IMAGE_HEIGHT, true);
	}
}