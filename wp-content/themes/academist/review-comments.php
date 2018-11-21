<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="eltdf-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="eltdf-comment-holder-inner">
				<h4 class="eltdf-comments-title"><?php esc_html_e( 'See what learners said', 'academist' ); ?></h4>
				<div class="eltdf-comments">
					<ul class="eltdf-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'academist_elated_comment' ), apply_filters( 'academist_elated_filter_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'academist' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$eltdf_commenter = wp_get_current_commenter();
		$eltdf_req       = get_option( 'require_name_email' );
		$eltdf_aria_req  = ( $eltdf_req ? " aria-required='true'" : '' );
        $eltdf_consent  = empty( $eltdf_commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$eltdf_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Post a Comment', 'academist' ),
			'title_reply_before'   => '<h5 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h5>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'academist' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'academist' ),
			'label_submit'         => esc_html__( 'Submit', 'academist' ),
			'comment_field'        => apply_filters( 'academist_elated_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_html__( 'Comment', 'academist' ) . '" name="comment" cols="45" rows="6" aria-required="true"></textarea>' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => apply_filters( 'academist_elated_filter_comment_form_default_fields', array(
				'author' => '<input id="author" name="author" placeholder="' . esc_html__( 'Your Name', 'academist' ) . '" type="text" value="' . esc_attr( $eltdf_commenter['comment_author'] ) . '"' . $eltdf_aria_req . ' />',
				'email'  => '<input id="email" name="email" placeholder="' . esc_html__( 'Your Email', 'academist' ) . '" type="text" value="' . esc_attr( $eltdf_commenter['comment_author_email'] ) . '"' . $eltdf_aria_req . ' />',
				'url'    => '<input id="url" name="url" placeholder="' . esc_html__( 'Website', 'academist' ) . '" type="text" value="' . esc_attr( $eltdf_commenter['comment_author_url'] ) . '" size="30" maxlength="200" />',
                'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $eltdf_consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'academist' ) . '</label></p>',
			) )
		);
		
	if ( get_comment_pages_count() > 1 ) { ?>
		<div class="eltdf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $eltdf_show_comment_form = apply_filters('academist_elated_filter_show_comment_form_filter', true);
    if($eltdf_show_comment_form) {
    ?>
        <div class="eltdf-comment-form">
            <div class="eltdf-comment-form-inner">
                <?php comment_form( $eltdf_args ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>	