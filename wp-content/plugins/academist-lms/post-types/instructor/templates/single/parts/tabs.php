<?php
$tabs = apply_filters( 'academist_elated_filter_single_instructor_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	
	<div class="eltdf-tabs eltdf-tabs-standard">
		<ul class="eltdf-tabs-nav clearfix">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>">
						<span class="eltdf-tab-title">
                            <?php echo apply_filters( 'academist_elated_filter_instructor_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                        </span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="eltdf-tab-container" id="tab-<?php echo sanitize_title( $key ); ?>">
				<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/' . $tab['template'], 'instructor', '', $params ); ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>