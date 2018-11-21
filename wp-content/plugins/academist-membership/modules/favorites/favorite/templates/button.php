<?php echo academist_elated_get_button_html(array(
    'text'			=> $favorites_text,
    'custom_class'	=> 'eltdf-membership-item-favorites',
    'type'	        => 'outline',
    'icon_pack'	    => 'font_awesome',
    'fa_icon'	    => $icon,
    'custom_attrs'	=> array('data-item-id' => $item_id)
));