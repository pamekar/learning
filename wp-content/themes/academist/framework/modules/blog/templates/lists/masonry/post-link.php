<?php
$post_classes[] = 'eltdf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-text-main">
                    <?php academist_elated_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
					<div class="eltdf-post-mark">
					</div>
                </div>
            </div>
        </div>
    </div>
</article>