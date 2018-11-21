<?php 
get_header();
academist_elated_get_title();
get_template_part('slider');
do_action('academist_elated_action_before_main_content');
?>
<div class="eltdf-container">
	<?php do_action('academist_elated_action_after_container_open'); ?>
	<div class="eltdf-container-inner clearfix">
		<div id="tribe-events-pg-template">
			<?php tribe_events_before_html(); ?>
			<?php tribe_get_view(); ?>
			<?php tribe_events_after_html(); ?>
		</div> <!-- #tribe-events-pg-template -->
		<?php do_action('academist_elated_action_page_after_content'); ?>
	</div>
	<?php do_action('academist_elated_action_before_container_close'); ?>
</div>
<?php get_footer(); ?>
