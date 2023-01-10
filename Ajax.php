<?php

class Ajax {
	public function register() : void {
		add_action( 'wp_ajax_knomic_add_image_to_slide', [ $this, 'add_image']);
		add_action( 'wp_ajax_knomic_remove_image_from_slide', [ $this, 'remove_image']);
		add_action( 'wp_ajax_knomic_update_slide_arrangement', [ $this, 'sort_slide']);
	}

	public function add_image() : void {
		$error_msg = 'Image not found';
		if ( !isset( $_POST['id'] ) ) {
			wp_send_json_error( ['message'=> $error_msg]);
		}
		$id = $_POST['id'];
		$attachment = get_post($id);
		if ( ! $attachment ||  'attachment' !==  $attachment->post_type) {
			wp_send_json_error( ['message'=> $error_msg]);
		}
		$image_array = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT ) ? get_option( KNOMIC_SLIDESHOW__ARRANGEMENT ) : [];
		if ( in_array( $id, $image_array ) ) {
			wp_send_json_error( ['message'=> 'Image already in slideshow']);
		}
		$image_array[] = $id;
		update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );


		wp_send_json_success( ['message' => 'Image successfully added'] );
	}

	public function remove_image() : void {
		wp_send_json_success( 'It works' );
	}

	public function sort_slide() : void {
		$image_array = $_POST['map'];
		update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );
		wp_send_json_success( ['message' => 'Image has been sorted']);
	}

}