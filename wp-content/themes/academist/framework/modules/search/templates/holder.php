<div class="eltdf-grid-row">
	<div <?php echo academist_elated_get_content_sidebar_class(); ?>>
		<div class="eltdf-search-page-holder">
			<?php academist_elated_get_search_page_layout(); ?>
		</div>
		<?php do_action( 'academist_elated_page_after_content' ); ?>
	</div>
	<?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
		<div <?php echo academist_elated_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
</div>