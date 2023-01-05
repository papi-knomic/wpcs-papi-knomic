<?php

namespace includes\Pages;

use includes\Base\BaseController;

class Admin extends BaseController
{
	public function register() : void
	{
		add_action( 'admin_menu', [$this, 'addAdminPages']);
	}

	public function addAdminPages() : void
	{
		add_menu_page('Knomic Slideshow', 'Knomic Slideshow', 'manage_options', 'knomic_slideshow', [$this, 'adminIndex'],'dashicons-format-gallery', 110 );
	}


	public function adminIndex(): void
	{
		require_once $this->plugin_path . 'views/admin-page.php';
	}
}