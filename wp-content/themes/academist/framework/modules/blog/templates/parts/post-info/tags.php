<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="eltdf-tags-holder">
    <div class="eltdf-tags">
		<span class="eltdf-post-info-bottom-text"><?php esc_html_e( 'Tag: ', 'academist' ); ?></span><?php the_tags('', '&nbsp&nbsp&nbsp', ''); ?>
    </div>
</div>
<?php } ?>