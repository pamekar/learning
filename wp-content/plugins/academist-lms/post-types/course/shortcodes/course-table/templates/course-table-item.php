<tr class="eltdf-ct-item">
	<td>
		<?php echo esc_attr( get_the_title() ); ?>
		<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/price', '', $params ); ?>
	</td>
	<?php if ( $enable_category == 'yes' ) { ?>
		<td>
			<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/category', '', $params ); ?>
		</td>
	<?php } ?>
	<?php if ( $enable_instructor == 'yes' ) { ?>
		<td>
			<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/instructor', '', $params ); ?>
		</td>
	<?php } ?>
	<?php if ( $enable_students == 'yes' ) { ?>
		<td>
			<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/students', '', $params ); ?>
		</td>
	<?php } ?>
	<?php if ( $enable_price == 'yes' ) { ?>
		<td>
			<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/price', '', $params ); ?>
		</td>
	<?php } ?>
	<td>
		<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/button', '', $params ); ?>
	</td>
</tr>