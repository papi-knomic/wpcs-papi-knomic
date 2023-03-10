<?php

class Admin {
	public function register() : void {
		add_action( 'admin_menu', [$this, 'add_admin_pages']);
	}

	public function add_admin_pages() : void {
		add_menu_page('Knomic Slideshow', 'Knomic Slideshow', 'manage_options', 'knomic_slideshow', [$this, 'admin_index_page'],'dashicons-format-gallery', 110 );
	}


	public function admin_index_page(): void {
		$image_ids = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT );
		$images = [];

		if ( ! empty( $image_ids ) ) {
			foreach ( $image_ids as $image_id ) {
				$images[] = wp_get_attachment_image_src( $image_id, KNOMIC_SLIDESHOW__THUMB)[0];
			}
		}
		require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'views/admin-page.php';
	}
}