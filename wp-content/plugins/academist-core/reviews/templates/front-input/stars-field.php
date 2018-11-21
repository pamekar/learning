<div class="eltdf-comment-form-rating">
    <label><?php echo esc_html($label); ?><span class="required">*</span></label>
    <span class="eltdf-comment-rating-box">
        <?php for ( $i = 1; $i <= ACADEMIST_CORE_REVIEWS_MAX_RATING; $i ++ ) { ?>
            <span class="eltdf-star-rating" data-value="<?php echo esc_attr( $i ); ?>"></span>
        <?php } ?>
        <input type="hidden" name="<?php echo esc_attr($key); ?>" class="eltdf-rating" value="3">
    </span>
</div>