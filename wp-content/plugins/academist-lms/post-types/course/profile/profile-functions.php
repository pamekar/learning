<?php

if ( ! function_exists( 'academist_lms_add_profile_navigation_item' ) ) {
	function academist_lms_add_profile_navigation_item( $navigation, $dashboard_url ) {
		
		$navigation['courses'] = array(
			'url'         => esc_url( add_query_arg( array( 'user-action' => 'courses' ), $dashboard_url ) ),
			'text'        => esc_html__( 'Courses', 'academist-lms' ),
			'user_action' => 'courses',
			'icon'        => '<i class="fa fa-file" aria-hidden="true"></i>'
		);
		
		$navigation['course-favorites'] = array(
			'url'         => esc_url( add_query_arg( array( 'user-action' => 'course-favorites' ), $dashboard_url ) ),
			'text'        => esc_html__( 'Courses Wishlist', 'academist-lms' ),
			'user_action' => 'course-favorites',
			'icon'        => '<i class="fa fa-heart" aria-hidden="true"></i>'
		);
		
		return $navigation;
	}
	
	add_filter( 'academist_membership_dashboard_navigation_pages', 'academist_lms_add_profile_navigation_item', 10, 2 );
}

if ( ! function_exists( 'academist_lms_add_profile_navigation_pages' ) ) {
	function academist_lms_add_profile_navigation_pages( $page, $action ) {

        if( $action == 'courses' ) {
            $course_params = array();
            $customer_orders = academist_lms_get_user_profile_course_items();
            $course_params['customer_orders'] = $customer_orders;
            $page = academist_lms_get_cpt_module_template_part( 'course', 'profile', 'templates/courses-list', '', $course_params );
        }
        else if( $action == 'course-favorites' ) {
            $favorites_params = array();
            $user_favorites = academist_membership_get_user_favorites(get_current_user_id(), array('course'));
            $favorites_params['user_favorites'] = $user_favorites;
            $page = academist_lms_get_cpt_module_template_part( 'course', 'profile', 'templates/favorites-list', '', $favorites_params);
        }
		
		return $page;
	}
	
	add_filter( 'academist_membership_dashboard_pages', 'academist_lms_add_profile_navigation_pages', 10, 2 );
}

if ( ! function_exists( 'academist_lms_user_has_course' ) ) {
	function academist_lms_user_has_course( $id = '' ) {
		$id = $id === '' ? get_the_ID() : $id;
		
		if ( academist_lms_eltdf_woocommerce_integration_installed() && function_exists( 'academist_checkout_get_user_order_item_completed' ) ) {
			return academist_checkout_get_user_order_item_completed( 'WC_Order_Item_Course', $id );
		}

        return '';
	}
}

if ( ! function_exists( 'academist_lms_user_completed_prerequired_course' ) ) {
	function academist_lms_user_completed_prerequired_course( $id = '' ) {
		$id                 = $id === '' ? get_the_ID() : $id;
		$user_courses       = get_user_meta( get_current_user_id(), 'eltdf_user_course_status', true );
		$prerequired_course = get_post_meta( $id, 'eltdf_course_prerequired_meta', true );
		
		if ( isset( $prerequired_course ) && ! empty( $prerequired_course ) ) {
			if ( isset( $user_courses ) && ! empty( $user_courses ) ) {
				if ( ! array_key_exists( $prerequired_course, $user_courses ) ) {
					return false;
				} else if ( $user_courses[ $prerequired_course ] == 'completed' ) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		
		return true;
	}
}

if ( ! function_exists( 'academist_lms_get_user_orders' ) ) {
    function academist_lms_get_user_orders() {
        $customer_orders = array();

        if ( get_current_user_id() > 0 ) {
            $customer_orders = wc_get_orders(
                array(
                    'customer' => get_current_user_id()
                )
            );
        }

        return $customer_orders;
    }
}

if ( ! function_exists( 'academist_lms_get_user_profile_course_items' ) ) {
	function academist_lms_get_user_profile_course_items() {
        $customer_orders = academist_lms_get_user_orders();

        $formatted_orders = array();
        if ( ! empty( $customer_orders ) ) {
            foreach ( $customer_orders as $customer_order ) {
                $items = $customer_order->get_items();

                foreach ( $items as $item_id => $item ) {
                    if ( is_a( $item, 'WC_Order_Item_Course' ) ) {
                        $item['order_status'] = $customer_order->get_status();
                        array_push( $formatted_orders, $item );
                    }
                }
            }
        }

        return $formatted_orders;
	}
}