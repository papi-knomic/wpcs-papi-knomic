<?php


class Frontend {
	public function register() : void {
		add_shortcode( 'knomic_slideshow', [ $this, 'show_slideshow'] );
	}

	public function show_slideshow() : void {
		$image_ids = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT );
		$images = [];

		if ( ! empty( $image_ids ) ){
			foreach ( $image_ids as $image_id ) {
				$images[] = wp_get_attachment_image_src( $image_id, KNOMIC_SLIDESHOW__LARGE)[0];
			}
		}
		require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'views/slideshow-frontend.php';
	}
}