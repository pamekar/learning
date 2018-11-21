<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$eltdf_sidebar_layout  = academist_elated_sidebar_layout();
$eltdf_grid_space_meta = academist_elated_options()->getOptionValue( 'woo_list_grid_space' );
$eltdf_holder_classes  = ! empty( $eltdf_grid_space_meta ) ? 'eltdf-grid-' . $eltdf_grid_space_meta . '-gutter' : 'eltdf-grid-medium-gutter';

get_header();
academist_elated_get_title();
get_template_part( 'slider' );
do_action('academist_elated_action_before_main_content');

//Woocommerce content
if ( ! is_singular( 'product' ) ) { ?>
	<div class="eltdf-container">
		<div class="eltdf-container-inner clearfix">
			<div class="eltdf-grid-row <?php echo esc_attr( $eltdf_holder_classes ); ?>">
				<div <?php echo academist_elated_get_content_sidebar_class(); ?>>
					<?php academist_elated_woocommerce_content(); ?>
				</div>
				<?php if ( $eltdf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo academist_elated_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="eltdf-container">
		<div class="eltdf-container-inner clearfix">
			<?php academist_elated_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>