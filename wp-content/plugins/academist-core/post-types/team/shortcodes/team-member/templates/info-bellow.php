<div class="eltdf-team eltdf-item-space <?php echo esc_attr($team_member_layout) ?>">
	<div class="eltdf-team-inner">
		<?php if (get_the_post_thumbnail($member_id) !== '') { ?>
			<div class="eltdf-team-image">
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>">
                    <?php echo get_the_post_thumbnail($member_id, 'full'); ?>
                </a>
			</div>
		<?php } ?>
		<div class="eltdf-team-info">
            <div class="eltdf-team-title-holder">
                <h4 itemprop="name" class="eltdf-team-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                </h4>

                <?php if (!empty($position)) { ?>
                    <h6 class="eltdf-team-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt)) { ?>
				<div class="eltdf-team-text">
					<div class="eltdf-team-text-inner">
						<div class="eltdf-team-description">
							<p itemprop="description" class="eltdf-team-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="eltdf-team-social-holder-between">
				<div class="eltdf-team-social">
					<div class="eltdf-team-social-inner">
						<div class="eltdf-team-social-wrapp">
							<?php foreach ($team_social_icons as $team_social_icon) {
								echo wp_kses_post($team_social_icon);
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>