<?php if(academist_elated_core_plugin_installed()) { ?>
    <div class="eltdf-blog-like">
        <?php if( function_exists('academist_elated_get_like') ) academist_elated_get_like(); ?>
    </div>
<?php } ?>