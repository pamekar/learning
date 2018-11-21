<?php
$product = academist_elated_return_woocommerce_global_variable();

if ($display_price === 'yes' && $price_html = $product->get_price_html()) { ?>
	<div class="eltdf-<?php echo esc_attr($class_name); ?>-price"><?php echo wp_kses_post($price_html); ?></div>
<?php } ?>