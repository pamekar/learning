<?php

if($display_title === 'yes') { ?>
    <<?php echo esc_attr($title_tag); ?> itemprop="name" class="entry-title eltdf-<?php echo esc_attr($class_name); ?>-title" <?php echo academist_elated_get_inline_style($title_styles); ?>>
		<a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</<?php echo esc_attr($title_tag); ?>>
<?php } ?>