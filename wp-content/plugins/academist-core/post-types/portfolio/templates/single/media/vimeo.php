<?php if ( $lightbox ) : ?>
	<a itemprop="image" title="<?php echo esc_attr( $video_title ); ?>" href="<?php echo esc_url( $media['video_url'] ); ?>" data-rel="prettyPhoto[single_pretty_photo]" class="eltdf-portfolio-video-lightbox">
		<img itemprop="image" width="100%" src="<?php echo esc_url( $lightbox_thumb ); ?>" alt="<?php echo esc_attr( $video_title ); ?>"/>
	</a>
<?php else: ?>
	<div class="eltdf-iframe-video-holder">
		<?php echo wp_oembed_get( esc_url( $media['video_url'] ) ); ?>
	</div>
<?php endif; ?>
