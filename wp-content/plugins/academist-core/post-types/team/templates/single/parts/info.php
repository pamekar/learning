<div class="eltdf-team-single-info-holder">
	<div class="eltdf-grid-row">
		<div class="eltdf-ts-image-holder eltdf-grid-col-6">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="eltdf-ts-details-holder eltdf-grid-col-6">
			<h3 itemprop="name" class="eltdf-name entry-title"><?php the_title(); ?></h3>
			<p class="eltdf-position"><?php echo esc_html($position); ?>
				<?php foreach ($social_icons as $social_icon) {
					echo wp_kses_post($social_icon);
				} ?>
			</p>
			<div class="eltdf-ts-bio-holder">
				<?php if(!empty($birth_date)) { ?>
					<div class="eltdf-ts-info-row">
						<span aria-hidden="true" class="icon_calendar eltdf-ts-bio-icon"></span>
						<span class="eltdf-ts-bio-info"><?php echo esc_html__('born on: ', 'academist-core').esc_html($birth_date); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($email)) { ?>
					<div class="eltdf-ts-info-row">
						<span aria-hidden="true" class="icon_mail_alt eltdf-ts-bio-icon"></span>
						<span itemprop="email" class="eltdf-ts-bio-info"><?php echo esc_html__('email: ', 'academist-core').sanitize_email(esc_html($email)); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($phone)) { ?>
					<div class="eltdf-ts-info-row">
						<span aria-hidden="true" class="icon_phone eltdf-ts-bio-icon"></span>
						<span class="eltdf-ts-bio-info"><?php echo esc_html__('phone: ', 'academist-core').esc_html($phone); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($address)) { ?>
					<div class="eltdf-ts-info-row">
						<span aria-hidden="true" class="icon_building_alt eltdf-ts-bio-icon"></span>
						<span class="eltdf-ts-bio-info"><?php echo esc_html__('lives in: ', 'academist-core').esc_html($address); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($education)) { ?>
					<div class="eltdf-ts-info-row">
						<span aria-hidden="true" class="icon_ribbon_alt eltdf-ts-bio-icon"></span>
						<span class="eltdf-ts-bio-info"><?php echo esc_html__('education: ', 'academist-core').esc_html($education); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($resume)) { ?>
					<div class="eltdf-ts-info-row">
						<span aria-hidden="true" class="icon_document_alt eltdf-ts-bio-icon"></span>
						<a href="<?php echo esc_url($resume); ?>" download target="_blank"><span class="eltdf-ts-bio-info"><?php echo esc_html__('Download Resume', 'academist-core'); ?></span></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>