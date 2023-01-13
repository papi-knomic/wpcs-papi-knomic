<?php

class Ajax {
	public function register() : void {
		add_action( 'wp_ajax_knomic_add_image_to_slide', [ $this, 'add_image']);
		add_action( 'wp_ajax_knomic_remove_image_from_slide', [ $this, 'remove_image']);
		add_action( 'wp_ajax_knomic_update_slide_arrangement', [ $this, 'sort_slide']);
	}

	public function add_image() : void {
		if ( isset($_POST['nonce'] )  && wp_verify_nonce( $_POST['nonce'], 'knomic_slideshow_image_select') ) {
			$error_msg = 'Image not found';
			if ( ! isset( $_POST['id'] ) ) {
				wp_send_json_error( [ 'message' => $error_msg ] );
			}
			$id         = $_POST['id'];
			$attachment = get_post( $id );
			if ( ! $attachment || 'attachment' !== $attachment->post_type ) {
				wp_send_json_error( [ 'message' => $error_msg ] );
			}
			$image_array = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT ) ? get_option( KNOMIC_SLIDESHOW__ARRANGEMENT ) : [];
			if ( in_array( (int) $id, $image_array, true ) ) {
				wp_send_json_error( [ 'message' => 'Image already in slideshow' ] );
			}
			$image_array[] = $id;
			update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );
			wp_send_json_success( [ 'message' => 'Image successfully added' ] );
		}
		wp_send_json_error(['message' => 'Unauthorised request']);
	}

	public function remove_image() : void {
		if ( isset($_POST['nonce'] )  && wp_verify_nonce( $_POST['nonce'], 'knomic_slideshow_image_remove') ) {
			$id = $_POST['id'];
			$image_array = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT );
			$index = array_search( $id, $image_array );
			if ( $index === false ) {
				wp_send_json_error(['message' => 'Image not in slideshow']);
			}
			unset( $image_array[$index] );
			$image_array = array_values($image_array);
			wp_delete_attachment( $id );
			update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );
			wp_send_json_success( ['message' => 'Image has been removed']);
		}
		wp_send_json_error(['message' => 'Unauthorised request']);
	}

	public function sort_slide() : void {
		if ( isset($_POST['nonce'] )  && wp_verify_nonce( $_POST['nonce'], 'knomic_slideshow_image_sort') ) {
			$image_array = $_POST['map'];
			update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );
			wp_send_json_success( [ 'message' => 'Image has been sorted' ] );
		}
		wp_send_json_error(['message' => 'Unauthorised request']);
	}

}