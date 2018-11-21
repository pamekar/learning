<?php if ( ! $first_attempt ) { ?>
	<div class="eltdf-quiz-results">
		<?php if ( isset( $post_message ) && ! empty( $post_message ) ) { ?>
			<div class="eltdf-results-message">
				<?php echo esc_html( $post_message ); ?>
			</div>
		<?php } ?>
		<div class="eltdf-results-caption">
			<?php echo esc_html__( 'You have reached ', 'academist-lms' ) . $points . esc_html__( ' of ', 'academist-lms' ) . $points_t . esc_html__( ' points ', 'academist-lms' ) . '(' . $points_p . '%)'; ?>
		</div>
		<div class="eltdf-results-values">
			<div class="eltdf-results-correct"><?php echo esc_html__( 'Correct', 'academist-lms' ) . ' ' . $correct ?></div>
			<div class="eltdf-results-wrong"><?php echo esc_html__( 'Wrong', 'academist-lms' ) . ' ' . $wrong ?></div>
			<div class="eltdf-results-empty"><?php echo esc_html__( 'Empty', 'academist-lms' ) . ' ' . $empty ?></div>
			<div class="eltdf-results-points"><?php echo esc_html__( 'Points', 'academist-lms' ) . ' ' . $points . '/' . $points_t ?></div>
			<div class="eltdf-results-time"><?php echo esc_html__( 'Time', 'academist-lms' ) . ' ' . $time ?></div>
		</div>
	</div>
	<div class="eltdf-quiz-message">
		<?php if ( $points_p < $required_p ) { ?>
			<div class="eltdf-message-error">
				<?php echo esc_html__( 'Your quiz grade - failed. Quiz requirement', 'academist-lms' ) . ' ' . esc_attr( $required_p ) . '%'; ?>
			</div>
		<?php } else { ?>
			<div class="eltdf-message-error">
				<?php echo esc_html__( 'Your quiz grade - success.', 'academist-lms' ); ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>
