<?php
	
	/* Styles
	=============================================================== */
	
	function nm_child_theme_styles() {
		 // Enqueue child theme styles
		wp_enqueue_script( 'swiper-scripts', get_stylesheet_directory_uri() . '/assets/js/lib/swiper.min.js', array('jquery'), 1.0, true );
		wp_enqueue_style( 'swiper-style', get_stylesheet_directory_uri() . '/assets/css/lib/swiper.min.css' );

		wp_enqueue_style( 'nm-child-theme', get_stylesheet_directory_uri() . '/assets/css/src/main.min.css' );
		wp_enqueue_script( 'main-min-scripts', get_stylesheet_directory_uri() . '/assets/js/src/main.min.js', array('jquery'), 1.0, true );
	}
	add_action( 'wp_enqueue_scripts', 'nm_child_theme_styles', 1000 ); // Note: Use priority "1000" to include the stylesheet after the parent theme stylesheets