<?php if ( academist_elated_options()->getOptionValue( 'enable_social_share' ) == 'yes' && academist_elated_options()->getOptionValue( 'enable_social_share_on_course' ) == 'yes' ) : ?>
	<div class="eltdf-course-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */

		echo academist_elated_get_social_share_html( array( 'type'  => 'list', 'title' => esc_attr__( 'Share:', 'academist-lms' ) ) ); ?>
	</div>
<?php endif; ?>