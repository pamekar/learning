<thead>
<tr>
	<td>
		<?php esc_html_e( "Course program", 'academist-lms' ); ?>
	</td>
	<?php if ( $enable_category == 'yes' ) { ?>
		<td>
			<?php esc_html_e( "Category", 'academist-lms' ); ?>
		</td>
	<?php } ?>
	<?php if ( $enable_instructor == 'yes' ) { ?>
		<td>
			<?php esc_html_e( "Instructor", 'academist-lms' ); ?>
		</td>
	<?php } ?>
	<?php if ( $enable_students == 'yes' ) { ?>
		<td>
			<?php esc_html_e( "Students", 'academist-lms' ); ?>
		</td>
	<?php } ?>
	<?php if ( $enable_price == 'yes' ) { ?>
		<td>
			<?php esc_html_e( "Price", 'academist-lms' ); ?>
		</td>
	<?php } ?>
	<td>
		&nbsp;
	</td>
</tr>
</thead>