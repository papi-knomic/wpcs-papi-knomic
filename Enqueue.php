<?php


class Enqueue {
	public function register() : void {
		add_action( 'wp_print_scripts', [ $this, 'print_scripts' ]);
		add_action( 'wp_print_styles',  [ $this, 'print_styles']);
	}

	public function print_scripts() : void {
		if ( ! is_admin() ) {
			//register
			wp_register_script('slideshow', KNOMIC_SLIDESHOW__PLUGIN_URL . 'assets/js/slideshow.js',  [], '1.0', false);

			// enqueue frontend scripts
			wp_enqueue_script('slideshow');
		}

		//register general scripts
		wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.js', [], '1.0', false);
		wp_register_script('admin-slideshow', KNOMIC_SLIDESHOW__PLUGIN_URL . 'assets/js/admin.js', ['jquery'], '1.0', true);

		wp_enqueue_script('jquery');
		wp_enqueue_media();
		wp_enqueue_script('admin-slideshow');
		wp_enqueue_script('jquery-ui-sortable' );
	}

	public function print_styles() : void {
		wp_enqueue_style( 'jquery-ui-sortable' );
		wp_enqueue_style( 'slideshow', KNOMIC_SLIDESHOW__PLUGIN_URL . 'assets/css/slideshow.css', [], '1.0' );
	}

}