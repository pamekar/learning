<div class="form-top-section">
    <div class="form-top-section-holder" id="anchornav">
        <div class="form-top-section-inner clearfix">
            <?php if(is_object($page) && property_exists($page, 'layout')) { ?>
            <div class="eltdf-anchor-holder">
                <?php if(is_array($page->layout) && count($page->layout)) { ?>
                    <span><?php esc_html_e('Scroll To:', 'academist') ?></span>
                    <select class="nav-select eltdf-selectpicker" data-width="315px" data-hide-disabled="true" data-live-search="true" id="eltdf-select-anchor">
                        <option value="" disabled selected></option>
                        <?php foreach ($page->layout as $panel) { ?>
                            <option data-anchor="#eltdf_<?php echo esc_attr($panel->name); ?>"><?php echo esc_attr($panel->title); ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>