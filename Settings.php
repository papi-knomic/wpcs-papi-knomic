<?php


class Settings {
	public function register() : void {
		add_action( 'after_setup_theme', [ $this, 'set_image_sizes' ] );
		add_filter( 'wp_handle_upload_prefilter', [ $this, 'check_image_size_before_upload' ] );
	}

	public function set_image_sizes() : void {
		add_theme_support( 'post-thumbnails' );
		add_image_size(KNOMIC_SLIDESHOW__LARGE, KNOMIC_SLIDESHOW__LARGE_IMAGE_WIDTH, KNOMIC_SLIDESHOW__LARGE_IMAGE_HEIGHT, true);
		add_image_size(KNOMIC_SLIDESHOW__THUMB, KNOMIC_SLIDESHOW__THUMB_IMAGE_WIDTH, KNOMIC_SLIDESHOW__THUMB_IMAGE_HEIGHT, true);
	}

	public function check_image_size_before_upload( $file ) {
		$min_width = KNOMIC_SLIDESHOW__LARGE_IMAGE_WIDTH;
		$min_height = KNOMIC_SLIDESHOW__LARGE_IMAGE_HEIGHT;
		$img = getimagesize( $file['tmp_name'] );
		$width = $img[0];
		$height = $img[1];

		if ( $width < $min_width || $height < $min_height ) {
			$file['error'] = "Image must be at least {$min_width}px wide and {$min_height}px tall";
		}
		return $file;
	}
}