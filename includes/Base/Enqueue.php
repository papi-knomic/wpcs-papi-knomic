<?php

namespace includes\Base;

class Enqueue extends BaseController {
	public function register()
	{
		add_action( 'wp_print_scripts', [ $this, 'printScripts' ]);
		add_action( 'wp_print_styles',  [ $this, 'printStyles']);
	}

	public function printScripts() : void
	{

		if ( ! is_admin() ){
			//register
			wp_register_script('slideshow', $this->plugin_url . 'assets/js/slideshow.js');

			// enqueue frontend scripts
			wp_enqueue_script('slideshow');
		}

		//register general scripts
		wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.js');

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-datepicker' );
		wp_enqueue_script('jquery-ui-sortable' );
	}

	public function printStyles() : void
	{
		wp_enqueue_style( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'jquery-ui-sortable' );
		wp_enqueue_style( 'slideshow', $this->plugin_url . 'assets/css/slideshow.css');
	}

}