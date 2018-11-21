<div class="eltdf-events-list eltdf-grid-row <?php echo esc_attr($holder_classes); ?>">
	<?php
		if ( $query->have_posts() ):
			while ( $query->have_posts() ) : $query->the_post();
				academist_elated_get_module_template_part( 'templates/events-list-item', 'events/shortcodes/events-list', $type, $params );
			endwhile;
		else: ?>
			<p><?php esc_html_e('Sorry, no posts matched your criteria.', 'academist'); ?></p>
		<?php endif;
	
		wp_reset_postdata();
	?>
</div>