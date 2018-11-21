<?php
$course_free  = get_post_meta( get_the_ID(), 'eltdf_course_free_meta', true );
$course_class = $course_free === 'yes' ? 'eltdf-free-course' : '';
?>
<span class="eltdf-course-single-type <?php echo esc_attr( $course_class ); ?>">
  <?php if ( $course_free === 'yes' ) {
	  esc_html_e( 'Free', 'academist-lms' );
  } else {
	  echo get_woocommerce_currency_symbol() . academist_lms_calculate_course_price( get_the_ID() );
  }
  ?>
</span>