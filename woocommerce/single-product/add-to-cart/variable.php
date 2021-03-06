<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.1
 NM: Modified */

defined( 'ABSPATH' ) || exit;

global $product, $nm_theme_options;

// Labels class
$nm_form_class = ( $nm_theme_options['product_select_hide_labels'] ) ? ' nm-select-hide-labels' : '';

// Custom select class
$nm_form_class .= ( $nm_theme_options['product_custom_select'] ) ? ' nm-custom-select' : ' nm-default-select';

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form id="nm-variations-form" class="variations_form cart<?php echo esc_attr( $nm_form_class ); ?>" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ); // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<?php if ( get_field('product-color') ) : ?>
			<table class="variations cone-variations" cellspacing="0"tabindex="0">
				<tbody>
					<tr class="cone-tr">
						<td class="nm-variation-row">
							<div class="label"><label>Color</label></div>
							<div class="value">
								<span class="sod_select" tabindex="0" data-cycle="false" data-links="false" data-links-external="false" data-placeholder-option="false" data-filter="">
									<span class="sod_label"><?php the_field('product-color'); ?></span>
									<span class="sod_list_wrapper">
										<span class="sod_list">
											<?php if( have_rows('attribute-links') ): ?>
												<?php while( have_rows('attribute-links') ) : the_row();?>
													<a class="sod_option cd-sod-option" href="<?php the_sub_field('attribute-link'); ?>"><?php the_sub_field('attribute-color-name'); ?></a>
												<?php endwhile; ?>
											<?php endif; ?>
										</span>
									</span>
								</span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		<?php endif; ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="nm-variation-row">
                            <div class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></div>
                            <div class="value">
                                <?php
                                    wc_dropdown_variation_attribute_options( array(
                                        'options'   => $options,
                                        'attribute' => $attribute_name,
                                        'product'   => $product,
                                    ) );
                                    echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
                                ?>
                            </div>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
                 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
