<?php
$eltdf_search_holder_params = academist_elated_get_holder_params_search();
?>
<?php get_header(); ?>
<?php academist_elated_get_title(); ?>
<?php do_action('academist_elated_action_before_main_content'); ?>
	<div class="<?php echo esc_attr( $eltdf_search_holder_params['holder'] ); ?>">
		<?php do_action( 'academist_elated_action_after_container_open' ); ?>
		<div class="<?php echo esc_attr( $eltdf_search_holder_params['inner'] ); ?>">
			<?php academist_elated_get_search_page(); ?>
		</div>
		<?php do_action( 'academist_elated_action_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>