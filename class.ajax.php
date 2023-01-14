<?php

class Ajax {
	public function register() : void {
		add_action( 'wp_ajax_knomic_add_image_to_slide', [ $this, 'add_image']);
		add_action( 'wp_ajax_knomic_remove_image_from_slide', [ $this, 'remove_image']);
		add_action( 'wp_ajax_knomic_update_slide_arrangement', [ $this, 'sort_slide']);
	}

	public function add_image() : void {
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'knomic_slideshow_image_select') ) {
			// Set the error message
			$error_msg = 'Image not found';

			// Check if the attachment ID is set
			if ( ! isset( $_POST['id'] ) ) {
				wp_send_json_error( [ 'message' => $error_msg ] );
			}

			$id = $_POST['id'];
			$attachment = get_post( $id );

			// Check if the attachment exists and is of the post_type 'attachment'
			if ( ! $attachment || 'attachment' !== $attachment->post_type ) {
				wp_send_json_error( [ 'message' => $error_msg ] );
			}

			// Check if the attachment meets the minimum size requirements
			if ( ! $this->check_image_size( $id ) ) {
				wp_send_json_error( [ 'message' => 'Image not up to minimum width and height' ] );
			}

			// Get the current images in the slideshow
			$image_array = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT ) ? get_option( KNOMIC_SLIDESHOW__ARRANGEMENT ) : [];

			// Check if the image is already in the slideshow
			if ( in_array( (int) $id, $image_array, true ) ) {
				wp_send_json_error( [ 'message' => 'Image already in slideshow' ] );
			}

			// Add the image to the slideshow and update the option
			$image_array[] = $id;
			update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );
			wp_send_json_success( [ 'message' => 'Image successfully added' ] );
		}
		wp_send_json_error(['message' => 'Unauthorized request']);
	}

	public function remove_image() : void {
		if ( isset($_POST['nonce'] )  && wp_verify_nonce( $_POST['nonce'], 'knomic_slideshow_image_remove') ) {
			$id = $_POST['id'];
			$image_array = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT );
			$index = array_search( $id, $image_array, true );
			// Check if the image is in the slideshow
			if ( false === $index ) {
				wp_send_json_error(['message' => 'Image not found in slideshow']);
			}
			// Remove the image from the slideshow
			unset( $image_array[$index] );
			$image_array = array_values($image_array);
			// delete the attachment
			wp_delete_attachment( $id );
			// Update the option
			update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );
			wp_send_json_success( ['message' => 'Image has been removed']);
		}
		wp_send_json_error(['message' => 'Unauthorised request']);
	}

	public function sort_slide() : void {
		if ( isset($_POST['nonce'] )  && wp_verify_nonce( $_POST['nonce'], 'knomic_slideshow_image_sort') ) {
			if (!isset($_POST['map'])) {
				wp_send_json_error( [ 'message' => 'Sorting map not found' ] );
			}
			$image_array = $_POST['map'];
			update_option( KNOMIC_SLIDESHOW__ARRANGEMENT, $image_array );
			wp_send_json_success( [ 'message' => 'Images have been sorted' ] );
		}
		wp_send_json_error(['message' => 'Unauthorised request']);
	}

	public function check_image_size( int $id ) : bool {
		$metadata = wp_get_attachment_metadata( $id );

		// Set the minimum required width and height
		$min_width = KNOMIC_SLIDESHOW__LARGE_IMAGE_WIDTH;
		$min_height = KNOMIC_SLIDESHOW__LARGE_IMAGE_HEIGHT;

		if ( empty( $metadata ) || ! isset( $metadata['sizes'] ) ) {
			return false;
		}

		$sizes = $metadata['sizes'];

		// check if the size exists and its width and height are greater than or equal to the minimum required
		if ( isset( $sizes[KNOMIC_SLIDESHOW__LARGE] ) && $sizes[KNOMIC_SLIDESHOW__LARGE]['width'] >= $min_width && $sizes[KNOMIC_SLIDESHOW__LARGE]['height'] >= $min_height) {
			return true;
		}

		return false;
	}

}