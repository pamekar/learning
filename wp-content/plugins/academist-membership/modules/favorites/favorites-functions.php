<?php
if ( ! function_exists( 'academist_membership_add_item_to_favorites' ) ) {
    function academist_membership_add_item_to_favorites() {
        $user_id = get_current_user_id();

        if ( empty( $_POST ) || ! isset( $_POST ) ) {
            academist_core_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-membership' ) );
        } else {
            $item_id                = $_POST['item_id'];
            $current_items_array    = get_user_meta( $user_id, 'eltdf_item_favorites', true );
            $current_users_array    = get_post_meta( $item_id, 'eltdf_users_favorites', true );

            if ( ! empty( $current_items_array ) && in_array( $item_id, $current_items_array ) ) {
                $temp_array[]           = $item_id;
                $current_items_array    = array_diff( $current_items_array, $temp_array );
                $data['message']        = esc_html__( 'Favorite', 'academist-membership' );
                $data['icon']           = 'eltdf-favorite-active';
            } else {
                $current_items_array[] = $item_id;
                $current_items_array   = array_unique( $current_items_array );
                $data['message']       = esc_html__( 'Remove', 'academist-membership' );
                $data['icon']          = 'eltdf-favorite-inactive';
            }

            update_user_meta( $user_id, 'eltdf_item_favorites', $current_items_array );

            if ( ! empty( $current_users_array ) && in_array( $user_id, $current_users_array ) ) {
                $temp_array[]        = $user_id;
                $current_users_array = array_diff( $current_users_array, $temp_array );
            } else {
                $current_users_array[] = $user_id;
                $current_users_array   = array_unique( $current_users_array );
            }
            update_post_meta( $item_id, 'eltdf_users_favorites', $current_users_array );

            academist_core_ajax_status( 'success', '', $data );
        }

        wp_die();
    }

    add_action( 'wp_ajax_academist_membership_add_item_to_favorites', 'academist_membership_add_item_to_favorites' );
}

if ( ! function_exists( 'academist_membership_is_item_in_favorites' ) ) {
    function academist_membership_is_item_in_favorites( $item_id = '', $user_id = '' ) {
        $item_id    = $item_id != '' ? $item_id : get_the_ID();
        $user_id    = $user_id != '' ? $user_id : get_current_user_id();
        $items      = get_user_meta( $user_id, 'eltdf_item_favorites', true );

        if ( ! empty( $items ) && in_array( $item_id, $items ) ) {
            return true;
        }

        return false;
    }
}

if ( ! function_exists( 'academist_membership_get_number_of_item_favorites' ) ) {
    function academist_membership_get_number_of_item_favorites( $item_id = '' ) {
        $item_id    = $item_id != '' ? $item_id : get_the_ID();

        $number_of_fav = get_post_meta( $item_id, 'eltdf_users_favorites', true );

        if ( $number_of_fav != '' && is_array( $number_of_fav ) ) {
            return count( $number_of_fav );
        }

        return 0;
    }
}

if ( ! function_exists( 'academist_membership_get_user_favorites' ) ) {
    function academist_membership_get_user_favorites( $user_id = '', $post_types = array() ) {
        $user_id                = $user_id != '' ? $user_id : get_current_user_id();
        $user_favorites         = array();
        $user_favorites_meta    = get_user_meta($user_id, 'eltdf_item_favorites', true);

        if( !empty($user_favorites_meta) ) {
            if (empty($post_types)) {
                $user_favorites = $user_favorites_meta;
            } else {
                foreach ($user_favorites_meta as $favorite) {
                    $item_post_type = get_post_type($favorite);
                    if (in_array($item_post_type, $post_types)) {
                        $user_favorites[] = $favorite;
                    }
                }
            }
        }

        return $user_favorites;
    }
}

if ( ! function_exists( 'academist_membership_get_favorite_template' ) ) {
    function academist_membership_get_favorite_template($item_id = '', $template = 'icon', $args = array()) {
        if ( is_user_logged_in() ) {
            $item_id    = $item_id != '' ? $item_id : get_the_ID();
            if ( ! academist_membership_is_item_in_favorites($item_id) ) {
                $text = esc_html__( 'Favorite', 'academist-membership' );
                $icon = 'eltdf-favorite-inactive fas fa-heart';
            } else {
                $text = esc_html__( 'Remove', 'academist-membership' );
                $icon = 'eltdf-favorite-active fas fa-heart';
            }

            $favorites_params = array(
                'item_id'           => $item_id,
                'icon'              => $icon,
                'favorites_text'              => $text,
            );

            print academist_membership_get_module_template_part( 'favorites', 'favorite', $template, '', $favorites_params );
        }
    }
}