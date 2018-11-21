<?php
$title_tag = isset($link_tag) ? $link_tag : 'h5';
$post_link_meta = get_post_meta(get_the_ID(), "eltdf_post_link_link_meta", true );

if(academist_elated_get_blog_module() == 'list') {
    $post_link = get_the_permalink();
} else {
    if(!empty($post_link_meta)) {
        $post_link = esc_html($post_link_meta);
    }
}
?>

<div class="eltdf-post-link-holder">
    <div class="eltdf-post-link-holder-inner">
        <<?php echo esc_attr($title_tag);?> itemprop="name" class="eltdf-link-title eltdf-post-title">
        <?php if(isset($post_link) && $post_link != '') { ?>
        <a itemprop="url" href="<?php echo esc_url($post_link); ?>" title="<?php the_title_attribute(); ?>" target="_self">
            <?php } ?>
            <?php echo get_the_title(); ?>
            <?php if(isset($post_link) && $post_link != '') { ?>
        </a>
        <?php } ?>
        </<?php echo esc_attr($title_tag);?>>
		<span class="eltdf-external-link">
			<a itemprop="url" href="<?php echo esc_url($post_link_meta); ?>" title="<?php the_title_attribute(); ?>" target="_blank">
				<?php echo esc_html($post_link_meta) ?>
			</a>
		</span>
    </div>
</div>