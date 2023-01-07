<?php

class Ajax {
	public function register() : void {
		add_action( 'wp_ajax_knomic_add_image_to_slide', [ $this, 'add_image']);
		add_action( 'wp_ajax_knomic_remove_image_from_slide', [ $this, 'remove_image']);
		add_action( 'wp_ajax_knomic_update_slide_arrangement', [ $this, 'sort_slide']);
	}

	public function add_image() : void {

	}

	public function remove_image() : void {

	}

	public function sort_slide() : void {

	}

}