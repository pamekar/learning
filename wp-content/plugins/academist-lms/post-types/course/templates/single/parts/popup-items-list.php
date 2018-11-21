<?php
$course_sections = get_post_meta( get_the_ID(), 'eltdf_course_curriculum', true );
if ( ! empty( $course_sections ) ) { ?>
	<div class="eltdf-course-popup-items">
		<div class="eltdf-course-popup-items-list">
			<?php foreach ( $course_sections as $course_section ) { ?>
				<div class="eltdf-popup-items-section">
					<h3 class="eltdf-section-name">
						<?php echo esc_html( $course_section['section_name'] ) ?>
					</h3>
					<h4 class="eltdf-section-title">
						<?php echo esc_html( $course_section['section_title'] ) ?>
					</h4>
                    <p class="eltdf-section-description">
                        <?php echo esc_html($course_section['section_description']) ?>
                    </p>
					<div class="eltdf-section-content">
						<?php
						if ( isset( $course_section['section_elements'] ) && $course_section['section_elements'] !== '' ) {
							$section_elements = $course_section['section_elements'];
							if ( ! empty( $section_elements ) ) {
								$list            = academist_lms_get_course_curriculum_list( $section_elements );
								$elements        = $list['elements'];
								$lessons_summary = $list['lessons_summary'];
								?>
								<div class="eltdf-section-elements">
									<?php if ( ! empty( $lessons_summary ) ) {
										$lesson_info = implode( ', ', $lessons_summary );
										?>
										<div class="eltdf-section-elements-summary">
											<span class="eltdf-summary-value"><?php echo esc_html( $lesson_info ); ?></span>
										</div>
									<?php } ?>
									<?php foreach ( $elements as $key => $element ) { ?>
										<div class="eltdf-section-element <?php echo esc_attr( $element['class'] ); ?> clearfix <?php echo academist_lms_get_course_item_completed_class( $element['id'] ); ?>" data-section-element-id="<?php echo esc_attr( $element['id'] ); ?>">
											<div class="eltdf-element-title">
												<span class="eltdf-element-label">
                                                    <?php echo esc_attr( $element['label'] ); ?>
                                                </span>
												<?php if ( academist_lms_course_is_preview_available( $element['id'] ) ) { ?>
													<a class="eltdf-element-name eltdf-element-link-open" itemprop="url" href="<?php echo esc_attr( $element['url'] ); ?>" title="<?php echo esc_attr( $element['title'] ); ?>" data-item-id="<?php echo esc_attr( $element['id'] ); ?>" data-course-id="<?php echo get_the_ID(); ?>">
														<?php echo esc_html( $element['title'] ); ?>
														<?php if ( ! academist_lms_user_has_course() || ! academist_lms_user_completed_prerequired_course() ) { ?>
															<span class="eltdf-element-preview-holder"><?php esc_html_e( 'preview', 'academist-lms' ); ?></span>
														<?php } ?>
													</a>
												<?php } else { ?>
													<?php echo esc_html( $element['title'] ); ?>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
