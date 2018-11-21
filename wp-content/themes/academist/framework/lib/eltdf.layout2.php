<?php

class AcademistElatedClassFieldPortfolioFollow extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "portfolio_single_follow" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "portfolio_single_no_follow" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_portfoliofollow" value="portfolio_single_follow"<?php if ( academist_elated_option_get_value( $name ) == "portfolio_single_follow" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_portfoliofollow" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldZeroOne extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "1" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "0" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_zeroone" value="1"<?php if ( academist_elated_option_get_value( $name ) == "1" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_zeroone" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldImageVideo extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch switch-type">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "image" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Image', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "video" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Video', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_imagevideo" value="image"<?php if ( academist_elated_option_get_value( $name ) == "image" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_imagevideo" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldYesEmpty extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "yes" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_yesempty" value="yes"<?php if ( academist_elated_option_get_value( $name ) == "yes" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_yesempty" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldFlagPage extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "page" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_flagpage" value="page"<?php if ( academist_elated_option_get_value( $name ) == "page" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpage" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldFlagPost extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "post" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_flagpost" value="post"<?php if ( academist_elated_option_get_value( $name ) == "post" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpost" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldFlagMedia extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "attachment" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_flagmedia" value="attachment"<?php if ( academist_elated_option_get_value( $name ) == "attachment" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagmedia" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldFlagPortfolio extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "portfolio_page" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_flagportfolio" value="portfolio_page"<?php if ( academist_elated_option_get_value( $name ) == "portfolio_page" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagportfolio" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldFlagProduct extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label class="cb-enable<?php if ( academist_elated_option_get_value( $name ) == "product" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'Yes', 'academist' ) ?></span></label>
								<label class="cb-disable<?php if ( academist_elated_option_get_value( $name ) == "" ) { echo " selected"; } ?>"><span><?php esc_html_e( 'No', 'academist' ) ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_flagproduct" value="product"<?php if ( academist_elated_option_get_value( $name ) == "product" ) { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagproduct" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldRange extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		$range_min      = 0;
		$range_max      = 1;
		$range_step     = 0.01;
		$range_decimals = 2;
		if ( isset( $args["range_min"] ) ) {
			$range_min = $args["range_min"];
		}
		
		if ( isset( $args["range_max"] ) ) {
			$range_max = $args["range_max"];
		}
		
		if ( isset( $args["range_step"] ) ) {
			$range_step = $args["range_step"];
		}
		
		if ( isset( $args["range_decimals"] ) ) {
			$range_decimals = $args["range_decimals"];
		}
		?>
		<div class="eltdf-page-form-section">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="eltdf-slider-range-wrapper">
								<div class="form-inline">
									<input type="text" class="form-control eltdf-form-element eltdf-form-element-xsmall pull-left eltdf-slider-range-value" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
									<div class="eltdf-slider-range small" data-step="<?php echo esc_attr( $range_step ); ?>" data-min="<?php echo esc_attr( $range_min ); ?>" data-max="<?php echo esc_attr( $range_max ); ?>" data-decimals="<?php echo esc_attr( $range_decimals ); ?>" data-start="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldRangeSimple extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) { ?>
		<div class="col-lg-3" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-slider-range-wrapper">
				<div class="form-inline">
					<em class="eltdf-field-description"><?php echo esc_html( $label ); ?></em>
					<input type="text" class="form-control eltdf-form-element eltdf-form-element-xxsmall pull-left eltdf-slider-range-value" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"/>
					<div class="eltdf-slider-range xsmall" data-step="0.01" data-max="1" data-start="<?php echo esc_attr( academist_elated_option_get_value( $name ) ); ?>"></div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldRadio extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		$checked     = $value = "";
		$value_saved = academist_elated_option_has_value( $name );
		
		if ( $value_saved ) {
			$value   = academist_elated_option_get_value( $name );
			$checked = $value == 'yes' ? "checked" : "";
		}
		
		$html = '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $checked . ' /> ' . $label . '<br />';
		echo wp_kses( $html, array(
			'input' => array(
				'type'    => true,
				'name'    => true,
				'value'   => true,
				'checked' => true
			),
			'br'    => true
		) );
	}
}

class AcademistElatedClassFieldRadioGroup extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		$use_images    = isset( $args["use_images"] ) && $args["use_images"] ? true : false;
		$hide_labels   = isset( $args["hide_labels"] ) && $args["hide_labels"] ? true : false;
		$hide_radios   = $use_images ? 'display: none' : '';
		$checked_value = academist_elated_option_get_value( $name );
		?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $name ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<?php if ( is_array( $options ) && count( $options ) ) { ?>
								<div class="eltdf-field eltdf-radio-group-holder <?php if ( $use_images ) { echo "with-images"; } ?>" data-option-name="<?php echo esc_attr( $name ); ?>" data-option-type="radiogroup">
									<?php foreach ( $options as $key => $atts ) {
										$selected = false;
										if ( $checked_value == $key ) {
											$selected = true;
										}
										?>
										<label class="radio-inline">
											<input <?php if ( $selected ) { echo "checked"; } ?> <?php academist_elated_inline_style( $hide_radios ); ?> type="radio" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $key ); ?>">
											<?php if ( ! empty( $atts["label"] ) && ! $hide_labels ) {
												echo esc_attr( $atts["label"] );
											} ?>
											
											<?php if ( $use_images ) { ?>
												<img title="<?php if ( ! empty( $atts["label"] ) ) { echo esc_attr( $atts["label"] ); } ?>" src="<?php echo esc_url( $atts['image'] ); ?>" alt="<?php echo esc_attr( "$key image" ) ?>"/>
											<?php } ?>
										</label>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldCheckBoxGroup extends AcademistElatedClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {
		if ( ! ( is_array( $options ) && count( $options ) ) ) {
			return;
		}
		
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id          = $name . '-' . $repeat['index'];
			$name        = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$saved_value = $repeat['value'];
		} else {
			$id          = $name;
			$saved_value = academist_elated_option_get_value( $name );
		}
		
		$show = ! empty( $args["show"] ) ? $args["show"] : array();
		?>
		
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $id ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="eltdf-checkbox-group-holder">
								<!-- Needed for font weight and fonts group of option in order to save empty value -->
								<div class="checkbox-inline" style="display: none">
									<label>
										<input checked type="checkbox" value="" name="<?php echo esc_attr( $name . '[]' ); ?>">
									</label>
								</div>
								<?php foreach ( $options as $option_key => $option_label ) : ?>
									<?php
									if ( $option_label !== '' ) {
										$i            = 1;
										$checked      = is_array( $saved_value ) && in_array( $option_key, $saved_value );
										$checked_attr = $checked ? 'checked' : '';
										?>
										<div class="checkbox-inline">
											<label>
												<input <?php echo esc_attr( $checked_attr ); ?> type="checkbox" id="<?php echo esc_attr( $name . $option_key ) . '-' . $i; ?>" value="<?php echo esc_attr( $option_key ); ?>" name="<?php echo esc_attr( $name . '[]' ); ?>"
												<label for="<?php echo esc_attr( $name . $option_key ) . '-' . $i; ?>"><?php echo esc_html( $option_label ); ?></label>
											</label>
										</div>
										<?php
										$i ++;
									}
								endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldCheckBox extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		$checked = "";
		
		if ( '1' === academist_elated_option_get_value( $name ) ) {
			$checked = "checked";
		}
		
		$html = '<div class ="eltdf-page-form-section">';
		$html .= '<div class="eltdf-section-content">';
		$html .= '<div class="container-fluid">';
		$html .= '<div class="row">';
		$html .= '<div class="col-lg-3">';
		$html .= '<input id="' . $name . '" class="eltdf-single-checkbox-field" type="checkbox" name="' . $name . '" value="1" ' . $checked . ' />';
		$html .= '<label for="' . $name . '"> ' . $label . '</label><br />';
		$html .= '<input class="eltdf-checkbox-single-hidden" type="hidden" name="' . $name . '" value="0"/>';
		$html .= '</div>'; //close col-lg-3
		$html .= '</div>'; //close row
		$html .= '</div>'; //close container-fluid
		$html .= '</div>'; //close eltdf-section-content
		$html .= '</div>'; //close eltdf-page-form-section
		
		echo wp_kses( $html, array(
			'input' => array(
				'type'     => true,
				'id'       => true,
				'name'     => true,
				'value'    => true,
				'checked'  => true,
				'class'    => true,
				'disabled' => true
			),
			'div'   => array(
				'class' => true
			),
			'br'    => true,
			'label' => array(
				'for' => true
			)
		) );
	}
}

class AcademistElatedClassFieldDate extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $repeat = array() ) {
		$col_width = 2;
		
		if ( isset( $args["col_width"] ) ) {
			$col_width = $args["col_width"];
		}
		
		$suffix = ! empty( $args['suffix'] ) ? $args['suffix'] : false;
		
		$class       = '';
		$data_string = '';
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id    = $name . '-' . $repeat['index'];
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
		} else {
			$id    = $name;
			$value = academist_elated_option_get_value( $name );
		}
		
		if ( $label === '' && $description === '' ) {
			$class .= ' eltdf-no-description';
		}
		
		if ( isset( $args['custom_class'] ) && $args['custom_class'] != '' ) {
			$class .= ' ' . $args['custom_class'];
		}
		
		if ( isset( $args['input-data'] ) && $args['input-data'] != '' ) {
			foreach ( $args['input-data'] as $data_key => $data_value ) {
				$data_string .= $data_key . '=' . $data_value;
				$data_string .= ' ';
			}
		}
		?>
		<div class="eltdf-page-form-section <?php echo esc_attr( $class ); ?>" id="eltdf_<?php echo esc_attr( $id ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
							<?php if ( $suffix ) : ?>
								<div class="input-group">
							<?php endif; ?>
								<input type="text" id="eltdf_<?php echo esc_attr( $id ); ?>dp" class="datepicker form-control eltdf-input eltdf-form-element" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>"/>
								<?php if ( $suffix ) : ?>
									<div class="input-group-addon"><?php echo esc_html( $args['suffix'] ); ?></div>
								<?php endif; ?>
							<?php if ( $suffix ) : ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldFile extends AcademistElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $repeat = array() ) {
		$value     = academist_elated_option_get_value( $name );
		$has_value = academist_elated_option_has_value( $name );
		
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id    = $name . '-' . $repeat['index'];
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
			
			if ( $value !== '' ) {
				$has_value = true;
			} else {
				$has_value = false;
			}
		} else {
			$id    = $name;
			$value = academist_elated_option_get_value( $name );
		}
		?>
		<div class="eltdf-page-form-section" id="eltdf_<?php echo esc_attr( $id ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="eltdf-media-uploader">
								<div<?php if ( ! $has_value ) { ?> style="display: none"<?php } ?> class="eltdf-media-image-holder">
									<img src="<?php if ( $has_value ) { echo esc_url( academist_elated_option_get_uploaded_file_icon( $value ) ); } ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'academist' ); ?>" class="eltdf-media-image img-thumbnail"/>
									<?php if ( $has_value ) { ?> <h4 class="eltdf-media-title"><?php echo academist_elated_option_get_uploaded_file_title( $value ) ?></h4> <?php } ?>
								</div>
								<div style="display: none" class="eltdf-media-meta-fields">
									<input type="hidden" class="eltdf-media-upload-url" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>"/>
								</div>
								<a class="eltdf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select File', 'academist' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select File', 'academist' ); ?>"><?php esc_html_e( 'Upload', 'academist' ); ?></a>
								<a style="display: none;" href="javascript: void(0)" class="eltdf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'academist' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class AcademistElatedClassFieldFactory {
	public function render( $field_type, $name, $label = "", $description = "", $options = array(), $args = array(), $repeat = array() ) {
		
		switch ( strtolower( $field_type ) ) {
			case 'text':
				$field = new AcademistElatedClassFieldText();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'textsimple':
				$field = new AcademistElatedClassFieldTextSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'textarea':
				$field = new AcademistElatedClassFieldTextArea();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'textareasimple':
				$field = new AcademistElatedClassFieldTextAreaSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'textareahtml':
				$field = new AcademistElatedClassFieldTextAreaHtml();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'color':
				$field = new AcademistElatedClassFieldColor();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'colorsimple':
				$field = new AcademistElatedClassFieldColorSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'image':
				$field = new AcademistElatedClassFieldImage();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'imagesimple':
				$field = new AcademistElatedClassFieldImageSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'font':
				$field = new AcademistElatedClassFieldFont();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'fontsimple':
				$field = new AcademistElatedClassFieldFontSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'select':
				$field = new AcademistElatedClassFieldSelect();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'selectblank':
				$field = new AcademistElatedClassFieldSelectBlank();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'selectsimple':
				$field = new AcademistElatedClassFieldSelectSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'selectblanksimple':
				$field = new AcademistElatedClassFieldSelectBlankSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'yesno':
				$field = new AcademistElatedClassFieldYesNo();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'yesnosimple':
				$field = new AcademistElatedClassFieldYesNoSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'portfoliofollow':
				$field = new AcademistElatedClassFieldPortfolioFollow();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'zeroone':
				$field = new AcademistElatedClassFieldZeroOne();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'imagevideo':
				$field = new AcademistElatedClassFieldImageVideo();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'yesempty':
				$field = new AcademistElatedClassFieldYesEmpty();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'file':
				$field = new AcademistElatedClassFieldFile();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'flagpost':
				$field = new AcademistElatedClassFieldFlagPost();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'flagpage':
				$field = new AcademistElatedClassFieldFlagPage();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'flagmedia':
				$field = new AcademistElatedClassFieldFlagMedia();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'flagportfolio':
				$field = new AcademistElatedClassFieldFlagPortfolio();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'flagproduct':
				$field = new AcademistElatedClassFieldFlagProduct();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'range':
				$field = new AcademistElatedClassFieldRange();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'rangesimple':
				$field = new AcademistElatedClassFieldRangeSimple();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'radio':
				$field = new AcademistElatedClassFieldRadio();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'checkbox':
				$field = new AcademistElatedClassFieldCheckBox();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'date':
				$field = new AcademistElatedClassFieldDate();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'radiogroup':
				$field = new AcademistElatedClassFieldRadioGroup();
				$field->render( $name, $label, $description, $options, $args );
				break;
			case 'checkboxgroup':
				$field = new AcademistElatedClassFieldCheckBoxGroup();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'address':
				$field = new AcademistElatedClassFieldAddress();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			case 'icon':
				$field = new AcademistElatedClassFieldIcon();
				$field->render( $name, $label, $description, $options, $args, $repeat );
				break;
			default:
				break;
		}
	}
}