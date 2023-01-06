<?php

namespace includes\Base;

class Settings extends BaseController
{
	public function register() {
		add_action('init', [$this, 'createPostType']);
//		add_image_size('np_widget', 180, 100, true);
//		add_image_size('np_function', 600, 280, true);
	}

	public function createPostType() : void
	{
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