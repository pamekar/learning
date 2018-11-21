<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php academist_elated_inline_style($button_styles); ?> <?php academist_elated_class_attribute($button_classes); ?> <?php echo academist_elated_get_inline_attrs($button_data); ?> <?php echo academist_elated_get_inline_attrs($button_custom_attrs); ?>>
    <span class="eltdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo academist_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
</a>