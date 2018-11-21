<?php if ( $enable_title === 'yes' ) {
	$title_tag    = ! empty( $title_tag ) ? $title_tag : 'h4';
	$title_styles = $this_object->getTitleStyles( $params );
	?>
	<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="eltdf-cli-title entry-title" <?php academist_elated_inline_style( $title_styles ); ?>>
	<a itemprop="url" href="<?php echo get_permalink(); ?>" target="<?php echo esc_attr( "_self" ); ?>">
		<?php echo esc_attr( get_the_title() ); ?>
	</a>
	</<?php echo esc_attr( $title_tag ); ?>>
<?php } ?>