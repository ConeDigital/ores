<?php
	
	/* Styles
	=============================================================== */
	
	function nm_child_theme_styles() {
		 // Enqueue child theme styles
		wp_enqueue_script( 'swiper-scripts', get_stylesheet_directory_uri() . '/assets/js/lib/swiper.min.js', array('jquery'), 1.0, true );
		wp_enqueue_style( 'swiper-style', get_stylesheet_directory_uri() . '/assets/css/lib/swiper.min.css' );

		wp_enqueue_style( 'nm-child-theme', get_stylesheet_directory_uri() . '/assets/css/src/main.min.css', array(), 5.3);
		wp_enqueue_script( 'main-min-scripts', get_stylesheet_directory_uri() . '/assets/js/src/main.min.js', array('jquery'), 1.0, true );
	}
	add_action( 'wp_enqueue_scripts', 'nm_child_theme_styles', 1000 ); // Note: Use priority "1000" to include the stylesheet after the parent theme stylesheets


	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 45);

	//Add pdf to processing email
	add_filter('woocommerce_email_attachments', 'attach_terms_conditions_pdf_to_email', 10,  3);
	function attach_terms_conditions_pdf_to_email ( $attachments, $status ,  $order ) {
		$allowed_statuses = array('customer_processing_order');
		if( isset( $status ) && in_array ( $status, $allowed_statuses ) ) {
			$attachments[] = get_stylesheet_directory() . '/assets/images/withdrawal.pdf';
		}
		return $attachments;
	}
