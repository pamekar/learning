<?php
$month = get_the_time('m');
$year = get_the_time('Y');
$title = get_the_title();
?>
<div itemprop="dateCreated" class="eltdf-post-info-date entry-date published updated">
    <?php if(empty($title) && academist_elated_blog_item_has_link()) { ?>
        <a itemprop="url" href="<?php the_permalink() ?>">
    <?php } else { ?>
        <a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
    <?php } ?>

        <?php the_time(get_option('date_format')); ?>
        </a>
    <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(academist_elated_get_page_id()); ?>"/>
</div>