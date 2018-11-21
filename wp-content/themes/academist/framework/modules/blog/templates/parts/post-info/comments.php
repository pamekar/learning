<?php if(comments_open()) { ?>
	<div class="eltdf-post-info-comments-holder">
		<a itemprop="url" class="eltdf-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0 ' . esc_html__('Comments','academist'), '1 '.esc_html__('Comment','academist'), '% '.esc_html__('Comments','academist') ); ?>
		</a>
	</div>
<?php } ?>