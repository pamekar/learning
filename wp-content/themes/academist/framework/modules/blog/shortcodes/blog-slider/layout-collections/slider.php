<?php
$image_meta          = get_post_meta( get_the_ID(), 'eltdf_blog_list_featured_image_meta', true );
$blog_list_image_id  = ! empty( $image_meta ) && academist_elated_blog_item_has_link() ? academist_elated_get_attachment_id_from_url( $image_meta ) : '';
?>

<li class="eltdf-blog-slider-item">
    <div class="eltdf-blog-slider-item-inner">
        <div class="eltdf-item-image">
			<a itemprop="url" href="<?php echo get_permalink(); ?>">
				<?php if ( ! empty( $blog_list_image_id ) ) {
					echo wp_get_attachment_image( $blog_list_image_id, $image_size );
				} else {
					the_post_thumbnail( $image_size );
				} ?>
			</a>
        </div>
        <div class="eltdf-item-text-wrapper">
            <div class="eltdf-item-text-holder">
                <div class="eltdf-item-text-holder-inner">

	                <?php academist_elated_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>

                    <?php academist_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params); ?>
                </div>
            </div>
        </div>
    </div>
</li>