<li>
    <div class="<?php echo esc_attr( $comment_class ); ?>">
        <?php if ( ! $is_pingback_comment ) { ?>
            <div class="eltdf-comment-image"> <?php echo academist_elated_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
        <?php } ?>
        <div class="eltdf-comment-text">
            <div class="eltdf-comment-info">
                <h6 class="eltdf-comment-name vcard">
                    <?php echo wp_kses_post( get_comment_author_link() ); ?>
                </h6>
                <div class="eltdf-review-rating">
                    <?php foreach($rating_criteria as $rating) { ?>
                        <?php if(!isset($rating['show']) || (isset($rating['show']) && $rating['show'])) { ?>
                            <span class="eltdf-rating-inner">
                                <span class="eltdf-rating-value">
                                    <?php
                                        $review_rating = get_comment_meta( $comment->comment_ID, $rating['key'], true );
                                        for ( $i = 1; $i <= $review_rating; $i ++ ) { ?>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    <?php } ?>
                                </span>
                            </span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php if ( ! $is_pingback_comment ) { ?>
                <div class="eltdf-text-holder" id="comment-<?php comment_ID(); ?>">
                    <div class="eltdf-review-title">
                        <span><?php echo esc_html( $review_title ); ?></span>
                    </div>
                    <?php comment_text(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<!-- li is closed by wordpress after comment rendering -->