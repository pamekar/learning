<?php get_header(); ?>
				<div class="eltdf-page-not-found">
					<?php
					$eltdf_title_image_404 = academist_elated_options()->getOptionValue( '404_page_title_image' );
					$eltdf_title_404       = academist_elated_options()->getOptionValue( '404_title' );
					$eltdf_subtitle_404    = academist_elated_options()->getOptionValue( '404_subtitle' );
					$eltdf_text_404        = academist_elated_options()->getOptionValue( '404_text' );
					$eltdf_button_label    = academist_elated_options()->getOptionValue( '404_back_to_home' );
					$eltdf_button_style    = academist_elated_options()->getOptionValue( '404_button_style' );
					?>

					<div class="eltdf-404-wrapper">

						<?php if ( ! empty( $eltdf_title_image_404 ) ) { ?>
							<div class="eltdf-404-title-image">
								<img src="<?php echo esc_url( $eltdf_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'academist' ); ?>" />
							</div>
						<?php } ?>

						<h1 class="eltdf-404-title">
							<?php if ( ! empty( $eltdf_title_404 ) ) {
								echo esc_html( $eltdf_title_404 );
							} else {
								esc_html_e( '404', 'academist' );
							} ?>
						</h1>

						<div class="eltdf-separator-holder clearfix  eltdf-separator-center ">
							<div class="eltdf-separator"></div>
						</div>

						<h3 class="eltdf-404-subtitle">
							<?php if ( ! empty( $eltdf_subtitle_404 ) ) {
								echo esc_html( $eltdf_subtitle_404 );
							} else {
								esc_html_e( 'Oops!', 'academist' );
							} ?>
						</h3>

						<p class="eltdf-404-text">
							<?php if ( ! empty( $eltdf_text_404 ) ) {
								echo esc_html( $eltdf_text_404 );
							} else {
								esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'academist' );
							} ?>
						</p>

						<?php
							$button_params = array(
								'link' => esc_url( home_url( '/' ) ),
								'text' => ! empty( $eltdf_button_label ) ? $eltdf_button_label : esc_html__( 'Back home', 'academist' )
							);

							if ( $eltdf_button_style == 'light-style' ) {
								$button_params['custom_class'] = 'eltdf-btn-light-style';
							}

							echo academist_elated_return_button_html( $button_params );
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>