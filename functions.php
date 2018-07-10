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

/**
 * Register term fields
 */
add_action( 'init', 'register_attributes_url_meta' );
function register_attributes_url_meta() {
	$attributes = wc_get_attribute_taxonomies();

	foreach ( $attributes as $tax ) {
		$name = wc_attribute_taxonomy_name( $tax->attribute_name );

		add_action( $name . '_add_form_fields', 'add_attribute_url_meta_field' );
		add_action( $name . '_edit_form_fields', 'edit_attribute_url_meta_field', 10 );
		add_action( 'edit_' . $name, 'save_attribute_url' );
		add_action( 'create_' . $name, 'save_attribute_url' );
	}
}

/**
 * Add term fields form
 */
function add_attribute_url_meta_field() {

	wp_nonce_field( basename( __FILE__ ), 'attrbute_url_meta_nonce' );
	?>

	<div class="form-field">
		<label for="attribute_url"><?php _e( 'URL', 'domain' ); ?></label>
		<input type="url" name="attribute_url" id="attribute_url" value="" />
	</div>
	<?php
}
/**
 * Edit term fields form
 */
function edit_attribute_url_meta_field( $term ) {
	$url = get_term_meta( $term->term_id, 'attribute_url', true );
	wp_nonce_field( basename( __FILE__ ), 'attrbute_url_meta_nonce' );
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="attribute_url"><?php _e( 'URL', 'domain' ); ?></label></th>
		<td>
			<input type="url" name="attribute_url" id="attribute_url" value="<?php echo esc_url( $url ); ?>" />
		</td>
	</tr>
	<?php
}
/**
 * Save term fields
 */
function save_attribute_url( $term_id ) {
	if ( ! isset( $_POST['attribute_url'] ) || ! wp_verify_nonce( $_POST['attrbute_url_meta_nonce'], basename( __FILE__ ) ) ) {
		return;
	}
	$old_url = get_term_meta( $term_id, 'attribute_url', true );
	$new_url = esc_url( $_POST['attribute_url'] );
	if ( ! empty( $old_url ) && $new_url === '' ) {
		delete_term_meta( $term_id, 'attribute_url' );
	} else if ( $old_url !== $new_url ) {
		update_term_meta( $term_id, 'attribute_url', $new_url, $old_url );
	}
}
/**
 * Show term URL
 */
add_filter( 'woocommerce_attribute', 'make_product_atts_linkable', 10, 3 );
function make_product_atts_linkable( $text, $attribute, $values ) {
	$new_values = array();
	foreach ( $values as $value ) {
		if ( $attribute['is_taxonomy'] ) {
			$term = get_term_by( 'name', $value, $attribute['name'] );
			$url = get_term_meta( $term->term_id, 'attribute_url', true );
			if ( ! empty( $url ) ) {
				$val = '<a href="' . esc_url( $url ) . '" title="' . esc_attr( $value ) . '">' . $value . '</a>';
				array_push( $new_values, $val );
			} else {
				array_push( $new_values, $value );
			}
		} else {
			$matched = preg_match_all( "/\[([^\]]+)\]\(([^)]+)\)/", $value, $matches );
			if ( $matched && count( $matches ) == 3 ) {
				$val = '<a href="' . esc_url( $matches[2][0] ) . '" title="' . esc_attr( $matches[1][0] ) . '">' . sanitize_text_field( $matches[1][0] ) . '</a>';
				array_push( $new_values, $val );
			} else {
				array_push( $new_values, $value );
			}
		}
	}
	$text = implode( ', ', $new_values );
	return $text;
}