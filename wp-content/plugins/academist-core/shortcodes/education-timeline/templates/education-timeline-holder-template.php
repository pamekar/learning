<div class="eltdf-tml-holder">
    <?php if(!empty($title)) { ?>
        <h3 class="eltdf-tml-title"><?php echo esc_html($title);?></h3>
    <?php } ?>
    <div class="eltdf-timeline">
        <?php echo do_shortcode($content); ?>
    </div>
</div>