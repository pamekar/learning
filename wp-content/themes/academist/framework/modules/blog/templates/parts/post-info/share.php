<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if(academist_elated_options()->getOptionValue('enable_social_share') === 'yes' && academist_elated_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="eltdf-blog-share">
		<span class="eltdf-post-info-bottom-text"><?php esc_html_e( 'Share: ', 'academist' ); ?></span><?php echo academist_elated_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>