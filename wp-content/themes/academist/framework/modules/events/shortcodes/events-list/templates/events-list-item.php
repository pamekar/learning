<?php
$price_class = '';
if(tribe_get_cost(null, true)== 'Free') {
	$price_class = 'eltdf-free';
}
?>

<div <?php post_class($item_class); ?>>
	<div class="eltdf-events-list-item-holder">
		<?php if(has_post_thumbnail()) : ?>
			<div class="eltdf-events-list-item-image-holder">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail($image_size); ?>

					<div class="eltdf-events-list-item-date-holder">
						<div class="eltdf-events-list-item-date-inner">
							<span class="eltdf-events-list-item-date-day">
								<?php echo tribe_get_start_date(null, true, 'd'); ?>
							</span>

							<span class="eltdf-events-list-item-date-month">
								<?php echo tribe_get_start_date(null, true, 'M'); ?>
							</span>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<div class="eltdf-events-list-item-content">
			<div class="eltdf-events-list-item-title-holder">
				<h4 class="eltdf-events-list-item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>
				<span class="eltdf-events-list-item-price <?php echo esc_html($price_class);?>">
					<?php echo esc_html(tribe_get_cost(null, true)); ?>
				</span>
			</div>
			<div class="eltdf-events-list-item-info">
				<div class="eltdf-events-list-item-date">
					<span class="eltdf-events-item-info-icon">
						<?php echo academist_elated_icon_collections()->renderIcon('icon-clock', 'simple_line_icons'); ?>
					</span>
					<?php echo tribe_events_event_schedule_details(); ?>
				</div>
				<div class="eltdf-events-list-item-location-holdere">
					<span class="eltdf-events-item-info-icon">
						<?php echo academist_elated_icon_collections()->renderIcon('icon-location-pin', 'simple_line_icons'); ?>
					</span>
					<span class="qpdef-events-list-item-location"><?php echo esc_html(tribe_get_address()); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>