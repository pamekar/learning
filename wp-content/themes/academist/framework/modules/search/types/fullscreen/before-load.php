<?php

if ( ! function_exists( 'academist_elated_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function academist_elated_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'academist' );

        return $search_type_options;
    }

    add_filter( 'academist_elated_filter_search_type_global_option', 'academist_elated_set_search_fullscreen_global_option' );
}