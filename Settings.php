<?php


class Settings {
	public function register() : void {
		add_action('init', [$this, 'create_post_type']);
		add_image_size('slideshow_size', 814, 610, true);
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