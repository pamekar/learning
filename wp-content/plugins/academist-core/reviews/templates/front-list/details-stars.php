<span class="eltdf-stars">
    <?php foreach ( $post_ratings as $rating ) { ?>
	    <span class="eltdf-stars-wrapper-inner">
            <span class="eltdf-stars-items">
                <?php
                $review_rating = academist_core_post_average_rating( $rating );
                for ( $i = 1; $i <= $review_rating; $i ++ ) { ?>
	                <i class="icon_star" aria-hidden="true"></i>
                <?php } ?>
            </span>
        </span>
    <?php } ?>
</span>

<?php if(isset($rating_number) && isset($rating_label) ) { ?>
    <a itemprop="url" class="eltdf-post-info-comments" href="<?php comments_link(); ?>">
    <?php if(isset($rating_number)) { ?>
        <span class="eltdf-reviews-number">
            <?php echo esc_html( $rating_number ); ?>
        </span>
    <?php } ?>
    <?php if(isset($rating_label)) { ?>
        <span class="eltdf-reviews-label">
            <?php echo esc_html( $rating_label ); ?>
        </span>
    </a>
    <?php } ?>
<?php } ?>