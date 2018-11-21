<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if(!defined('ABSPATH')) {
	die('-1');
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

global $post;

$event_id = get_the_ID();

$price_class = '';
if(tribe_get_cost(null, true) === 'Free') {
	$price_class = 'eltdf-free';
}
?>

<div id="tribe-events-content" class="tribe-events-single eltdf-tribe-events-single">
	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<div class="eltdf-events-single-main-content">
		<div class="eltdf-grid-row eltdf-events-single-media">
			<div class="eltdf-events-single-featured-image eltdf-grid-col-6">
				<?php echo tribe_event_featured_image($event_id, 'full', false); ?>
			</div>
			<div class="eltdf-events-single-map eltdf-grid-col-6">
				<?php tribe_get_template_part('modules/meta/map'); ?>
			</div>
		</div>
		<div class="eltdf-events-single-content-holder">
			<div class="eltdf-events-single-title-wrapper">
			<h2 class="eltdf-events-single-title"><?php the_title(); ?></h2>
			</div>

			<div class="eltdf-events-single-share-wrapper">
			<?php if ( academist_elated_options()->getOptionValue( 'enable_social_share' ) == 'yes' && academist_elated_options()->getOptionValue( 'enable_social_share_on_tribe_events' ) == 'yes' ) : ?>
				<div class="eltdf-event-social-share">
					<?php
					/**
					 * Available params type, icon_type and title
					 *
					 * Return social share html
					 */

					echo academist_elated_get_social_share_html( array( 'type'  => 'list', 'title' => esc_attr__( 'Share:', 'academist' ) ) ); ?>
				</div>
			<?php endif; ?>
			</div>

			<?php echo do_shortcode('[eltdf_separator position="left" width="38px" thickness="3px" color="#ff1949" top_margin="0" bottom_margin="16"]'); ?>
			<?php do_action('tribe_events_single_event_before_the_content') ?>

			<?php the_content(); ?>

			<?php do_action('tribe_events_single_event_after_the_content') ?>
		</div>
	</div>

	<div class="eltdf-events-single-meta">
		<?php do_action('tribe_events_single_event_before_the_meta') ?>
		<h4><?php esc_html_e('Event Details', 'academist'); ?></h4>

		<div class="eltdf-events-single-meta-holder eltdf-grid-row">
			<div class="eltdf-grid-col-4">
				<div class="eltdf-events-single-meta-item">
					<span class="eltdf-events-single-meta-icon">
						<?php echo academist_elated_icon_collections()->renderIcon('dripicons-calendar', 'dripicons'); ?>
					</span>
					<span class="eltdf-events-single-meta-label"><?php esc_html_e('Date:', 'academist'); ?></span>
					<span class="eltdf-events-single-meta-value">
						<?php echo tribe_events_event_schedule_details(); ?>
					</span>
				</div>

				<div class="eltdf-events-single-meta-item">
					<span class="eltdf-events-single-meta-icon">
						<?php echo academist_elated_icon_collections()->renderIcon('dripicons-clock', 'dripicons'); ?>
					</span>
					<span class="eltdf-events-single-meta-label"><?php esc_html_e('Time:', 'academist'); ?></span>
					<span class="eltdf-events-single-meta-value">
						<?php echo tribe_get_start_time(); ?> - <?php echo tribe_get_end_time(); ?>
					</span>
				</div>

				<?php if(tribe_has_venue()) : ?>
					<div class="eltdf-events-single-meta-item">
						<span class="eltdf-events-single-meta-icon">
							<?php echo academist_elated_icon_collections()->renderIcon('dripicons-home', 'dripicons'); ?>
						</span>
						<span class="eltdf-events-single-meta-label"><?php esc_html_e('Venue:', 'academist'); ?></span>
						<span class="eltdf-events-single-meta-value">
							<?php echo esc_html(tribe_get_venue()); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>

			<div class="eltdf-grid-col-4">
				<?php if(tribe_has_organizer()) : ?>
                    <?php 
                        $organizer_ids = tribe_get_organizer_ids(); 
                        foreach ( $organizer_ids as $organizer ) {
                    ?>
					<div class="eltdf-events-single-meta-item">
						<span class="eltdf-events-single-meta-icon">
							<?php echo academist_elated_icon_collections()->renderIcon('dripicons-user', 'dripicons'); ?>
						</span>
                        
						<span class="eltdf-events-single-meta-label"><?php esc_html_e('Organizer Name:', 'academist'); ?></span>
						<span class="eltdf-events-single-meta-value">
                            
                        <?php 
                                echo tribe_get_organizer_link( $organizer );
                        ?>
                            
						</span>
					</div>
                    <?php
                        }
                    ?>
				<?php endif; ?>

				<?php if(tribe_get_organizer_phone()) : ?>
					<div class="eltdf-events-single-meta-item">
						<span class="eltdf-events-single-meta-icon">
							<?php echo academist_elated_icon_collections()->renderIcon('dripicons-clock', 'dripicons'); ?>
						</span>
						<span class="eltdf-events-single-meta-label"><?php esc_html_e('Phone:', 'academist'); ?></span>
						<span class="eltdf-events-single-meta-value">
							<?php echo esc_html(tribe_get_organizer_phone()); ?>
						</span>
					</div>
				<?php endif; ?>

				<?php if(tribe_has_venue()) : ?>
					<?php if(tribe_address_exists()) : ?>
						<div class="eltdf-events-single-meta-item">
								<span class="eltdf-events-single-meta-icon">
									<?php echo academist_elated_icon_collections()->renderIcon('dripicons-location', 'dripicons'); ?>
								</span>
							<span class="eltdf-events-single-meta-label"><?php esc_html_e('Address:', 'academist'); ?></span>
							<span class="eltdf-events-single-meta-value">
									<?php echo tribe_get_address(); ?>
								</span>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<div class="eltdf-grid-col-4">
								<?php if(tribe_get_organizer_email()) : ?>
					<div class="eltdf-events-single-meta-item">
						<span class="eltdf-events-single-meta-icon">
							<?php echo academist_elated_icon_collections()->renderIcon('dripicons-mail', 'dripicons'); ?>
						</span>
						<span class="eltdf-events-single-meta-label"><?php esc_html_e('Email:', 'academist'); ?></span>
						<span class="eltdf-events-single-meta-value">
							<a href="mailto: <?php echo tribe_get_organizer_email(); ?>">
								<?php echo esc_html(tribe_get_organizer_email()); ?>
							</a>
						</span>
					</div>
				<?php endif; ?>

				<?php if(tribe_get_organizer_website_link()) : ?>
					<div class="eltdf-events-single-meta-item">
						<span class="eltdf-events-single-meta-icon">
							<?php echo academist_elated_icon_collections()->renderIcon('dripicons-browser', 'dripicons'); ?>
						</span>
						<span class="eltdf-events-single-meta-label"><?php esc_html_e('Website:', 'academist'); ?></span>
						<span class="eltdf-events-single-meta-value">
							<a target="_blank" href="<?php echo tribe_get_organizer_website_url(); ?>">
								<?php echo tribe_get_organizer_website_url(); ?>
							</a>
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="eltdf-events-single-navigation-holder clearfix">
			<div class="eltdf-events-single-prev-event">
				<?php
				$prev_event = Tribe__Events__Main::instance()->get_closest_event($post, 'previous');
				if($prev_event !== null) {
				?>
				<span class="eltdf-events-nav-text">
					<a href="<?php echo esc_attr(tribe_get_event_link($prev_event)); ?>" target="_self" itemprop="url">
						<span class="eltdf-events-nav-label"><?php esc_html_e('Previous' , 'academist')?></span>
					</a>
				</span>
				<?php } ?>

			</div>

			<div class="eltdf-events-single-next-event">
				<?php
				$next_event = Tribe__Events__Main::instance()->get_closest_event($post, 'next');
				if($next_event !== null) {
				?>

				<span class="eltdf-events-nav-text">
					<a href="<?php echo esc_attr(tribe_get_event_link($next_event)); ?>" target="_self" itemprop="url">
						<span class="eltdf-events-nav-label"><?php esc_html_e('Next' , 'academist')?></span>
					</a>
				</span>
				<?php } ?>

			</div>
		</div>

		<?php do_action('tribe_events_single_event_after_the_meta'); ?>
	</div>
</div>
