<?php do_action('academist_elated_action_before_sticky_header'); ?>

<div class="eltdf-sticky-header">
    <?php do_action( 'academist_elated_action_after_sticky_menu_html_open' ); ?>
    <div class="eltdf-sticky-holder <?php echo esc_attr($menu_area_class); ?>">
        <?php if($sticky_header_in_grid) : ?>
        <div class="eltdf-grid">
            <?php endif; ?>
            <div class="eltdf-vertical-align-containers">
                <div class="eltdf-position-left"><!--
                 --><div class="eltdf-position-left-inner">
                        <?php if(!$hide_logo) {
                            academist_elated_get_logo('sticky');
                        } ?>
                        <?php if($menu_area_position === 'left') : ?>
                            <?php academist_elated_get_sticky_menu('eltdf-sticky-nav'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($menu_area_position === 'center') : ?>
                    <div class="eltdf-position-center"><!--
                     --><div class="eltdf-position-center-inner">
                            <?php academist_elated_get_sticky_menu('eltdf-sticky-nav'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="eltdf-position-right"><!--
                 --><div class="eltdf-position-right-inner">
                        <?php if($menu_area_position === 'right') : ?>
                            <?php academist_elated_get_sticky_menu('eltdf-sticky-nav'); ?>
                        <?php endif; ?>
                        <?php academist_elated_get_sticky_header_widget_menu_area(); ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
	<?php do_action( 'academist_elated_action_before_sticky_menu_html_close' ); ?>
</div>

<?php do_action('academist_elated_action_after_sticky_header'); ?>