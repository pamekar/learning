<li class="eltdf-blog-slider-item">
	<div class="eltdf-blog-slider-item-inner">
		<div class="eltdf-item-image">
			<a itemprop="url" href="<?php echo get_permalink(); ?>">
				<?php echo get_the_post_thumbnail(get_the_ID(), $image_size); ?>
			</a>
		</div>
		<div class="eltdf-bli-content">
			<?php academist_elated_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
			
			<div class="eltdf-bli-excerpt">
				<?php academist_elated_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
				<?php academist_elated_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
			</div>
		</div>
	</div>
</li>