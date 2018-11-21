<div class="eltdf-footer-top-holder">
    <div class="eltdf-footer-top-inner <?php echo esc_attr($footer_top_grid_class); ?>">
        <div class="eltdf-grid-row <?php echo esc_attr($footer_top_classes); ?>">
            <?php for ($i = 0; $i < sizeof($footer_top_columns); $i++) { ?>
                <div class="eltdf-column-content eltdf-grid-col-<?php echo esc_attr($footer_top_columns[$i]); ?>">
                    <?php
                    if (is_active_sidebar('footer_top_column_' . ($i+1))) {
                        dynamic_sidebar('footer_top_column_' . ($i+1));
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>