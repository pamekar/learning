<?php
/**
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */
?>
<form action="<?php bbp_search_url(); ?>" class="eltdf-bbp-search-form" method="get">
    <div class="eltdf-form-holder">
        <input type="hidden" name="action" value="bbp-search-request" />
        <input type="text" placeholder="<?php esc_attr_e('Search', 'academist') ?>" class="eltdf-search-field" autocomplete="off" name="bbp_search" tabindex="<?php bbp_tab_index(); ?>"  value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" />
	    <button tabindex="<?php bbp_tab_index(); ?>" class="button" type="submit" value=""><span class="icon_search"></span></button>
    </div>
</form>