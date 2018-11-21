<?php
$eltdf_sidebar_layout  = academist_elated_sidebar_layout();
$eltdf_grid_space_meta = academist_elated_get_meta_field_intersect( 'page_grid_space' );
$eltdf_holder_classes  = ! empty( $eltdf_grid_space_meta ) ? 'eltdf-grid-' . $eltdf_grid_space_meta . '-gutter' : 'eltdf-grid-medium-gutter';

get_header();
academist_elated_get_title();
get_template_part( 'slider' );
do_action('academist_elated_action_before_main_content');
?>

<div class="eltdf-container eltdf-default-page-template">
	<?php do_action( 'academist_elated_action_after_container_open' ); ?>
	
	<div class="eltdf-container-inner clearfix">
        <?php do_action( 'academist_elated_action_after_container_inner_open' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="eltdf-grid-row <?php echo esc_attr( $eltdf_holder_classes ); ?>">
				<div <?php echo academist_elated_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action( 'academist_elated_action_page_after_content' );
					?>
				</div>
				<?php if ( $eltdf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo academist_elated_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
        <?php do_action( 'academist_elated_action_before_container_inner_close' ); ?>
	</div>
	
	<?php do_action( 'academist_elated_action_before_container_close' ); ?>
</div>

<?php get_footer(); ?>