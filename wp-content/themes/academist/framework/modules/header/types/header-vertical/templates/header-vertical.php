<?php do_action('academist_elated_action_before_page_header'); ?>

<aside class="eltdf-vertical-menu-area <?php echo esc_html($holder_class); ?>">
	<div class="eltdf-vertical-menu-area-inner">
		<div class="eltdf-vertical-area-background"></div>
		<?php if(!$hide_logo) {
			academist_elated_get_logo();
		} ?>
		<?php academist_elated_get_header_vertical_main_menu(); ?>
		<div class="eltdf-vertical-area-widget-holder">
			<?php academist_elated_get_header_widget_area_one(); ?>
			<?php academist_elated_get_header_widget_area_two(); ?>
		</div>
	</div>
</aside>

<?php do_action('academist_elated_action_after_page_header'); ?>