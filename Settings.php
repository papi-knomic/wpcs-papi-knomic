<?php


class Settings {
	public function register() : void {
		add_action('init', [$this, 'create_post_type']);
		add_image_size(KNOMIC_SLIDESHOW__LARGE, KNOMIC_SLIDESHOW__LARGE_IMAGE_WIDTH, KNOMIC_SLIDESHOW__LARGE_IMAGE_WIDTH, true);
		add_image_size(KNOMIC_SLIDESHOW__THUMB, KNOMIC_SLIDESHOW__THUMB_IMAGE_WIDTH, KNOMIC_SLIDESHOW__THUMB_IMAGE_WIDTH, true);
	}

	public function create_post_type() : void {
		$args = [
			'public' => true,
			'label' => 'Slideshow Images',
			'supports' => [
				'title',
				'thumbnail'
			]
		];

		register_post_type('slideshow_images', $args);
	}
}