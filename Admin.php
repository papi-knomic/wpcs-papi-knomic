<?php

class Admin {
	public function register() : void {
		add_action( 'admin_menu', [$this, 'addAdminPages']);
	}

	public function addAdminPages() : void {
		add_menu_page('Knomic Slideshow', 'Knomic Slideshow', 'manage_options', 'knomic_slideshow', [$this, 'adminIndex'],'dashicons-format-gallery', 110 );
	}


	public function adminIndex(): void {
		require_once KNOMIC_SLIDESHOW__PLUGIN_DIR . 'views/admin-page.php';
	}
}