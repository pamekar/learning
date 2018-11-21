<?php
get_header();
academist_elated_get_title();
do_action( 'academist_elated_action_before_main_content' ); ?>
<div class="eltdf-container eltdf-default-page-template">
	<?php do_action( 'academist_elated_action_after_container_open' ); ?>
	<div class="eltdf-container-inner clearfix">
		<?php
			$academist_taxonomy_id   = get_queried_object_id();
			$academist_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$academist_taxonomy      = ! empty( $academist_taxonomy_id ) ? get_term_by( 'id', $academist_taxonomy_id, $academist_taxonomy_type ) : '';
			$academist_taxonomy_slug = ! empty( $academist_taxonomy ) ? $academist_taxonomy->slug : '';
			$academist_taxonomy_name = ! empty( $academist_taxonomy ) ? $academist_taxonomy->taxonomy : '';
			
			academist_core_get_archive_portfolio_list( $academist_taxonomy_slug, $academist_taxonomy_name );
		?>
	</div>
	<?php do_action( 'academist_elated_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
