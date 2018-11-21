<?php if ( $enable_image == 'yes' ) { ?>
	<a itemprop="url" href="<?php echo get_permalink(); ?>" target="<?php echo esc_attr( "_self" ); ?>">
	<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/image', '', $params ); ?>
	</a>
<?php } ?>

<div class="eltdf-cli-text-holder">
	<div class="eltdf-cli-text-wrapper">
		<div class="eltdf-cli-text">
			<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/title', '', $params ); ?>
			<?php if ( $enable_instructor == 'yes' ) { ?>
				<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/instructor', '', $params ); ?>
			<?php } ?>
			<?php if ( $enable_price == 'yes' ) { ?>
				<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/price', '', $params ); ?>
			<?php } ?>
		</div>
	</div>
</div>