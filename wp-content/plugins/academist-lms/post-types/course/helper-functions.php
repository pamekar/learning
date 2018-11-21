<?php

//Register meta boxes
if ( ! function_exists( 'academist_lms_course_meta_box_functions' ) ) {
	function academist_lms_course_meta_box_functions( $post_types ) {
		$post_types[] = 'course';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_meta_box_post_types_save', 'academist_lms_course_meta_box_functions' );
	add_filter( 'academist_elated_filter_meta_box_post_types_remove', 'academist_lms_course_meta_box_functions' );
}

//Register meta boxes scope
if ( ! function_exists( 'academist_lms_course_scope_meta_box_functions' ) ) {
	function academist_lms_course_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'course';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_set_scope_for_meta_boxes', 'academist_lms_course_scope_meta_box_functions' );
}

//Register course post type
if ( ! function_exists( 'academist_lms_register_course_cpt' ) ) {
	function academist_lms_register_course_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'AcademistLMS\CPT\Course\CourseRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'academist_lms_filter_register_custom_post_types', 'academist_lms_register_course_cpt' );
}

// Load course shortcodes
if ( ! function_exists( 'academist_lms_include_course_shortcodes_file' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function academist_lms_include_course_shortcodes_file() {
		foreach ( glob( ACADEMIST_LMS_CPT_PATH . '/course/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'academist_lms_action_include_shortcodes_file', 'academist_lms_include_course_shortcodes_file' );
}

//Add course to list of post types with review
if ( ! function_exists( 'academist_lms_extend_rating_posts_types' ) ) {
    function academist_lms_extend_rating_posts_types($post_types) {
        $post_types[] = 'course';

        return $post_types;
    }

    add_filter( 'academist_core_filter_rating_post_types', 'academist_lms_extend_rating_posts_types' );
}

if ( ! function_exists( 'academist_lms_get_archive_course_list' ) ) {
	function academist_lms_get_archive_course_list( $academist_taxonomy_slug = '', $academist_taxonomy_name = '' ) {
		
		$number_of_items        = 12;
		$number_of_items_option = academist_elated_options()->getOptionValue( 'course_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}
		
		$number_of_columns        = 'four';
		$number_of_columns_option = academist_elated_options()->getOptionValue( 'course_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}
		
		$space_between_items        = 'normal';
		$space_between_items_option = academist_elated_options()->getOptionValue( 'course_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}
		
		$image_size        = 'full';
		$image_size_option = academist_elated_options()->getOptionValue( 'course_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}
		
		$item_layout = 'standard';
		
		$category = $academist_taxonomy_name === 'course-category' && ! empty( $academist_taxonomy_slug ) ? $academist_taxonomy_slug : '';
		$tag      = $academist_taxonomy_name === 'course-tag' && ! empty( $academist_taxonomy_slug ) ? $academist_taxonomy_slug : '';
		
		$params = array(
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items,
			'image_proportions'   => $image_size,
			'category'            => $category,
			'tag'                 => $tag,
			'item_layout'         => $item_layout,
			'pagination_type'     => 'load-more'
		);
		
		$html = academist_elated_execute_shortcode( 'eltdf_course_list', $params );
		
		print $html;
	}
}

//Course single functions
function academist_lms_add_meta_box_course_items_field( $attributes ) {
	$name        = '';
	$label       = '';
	$description = '';
	
	extract( $attributes );
	
	if ( ! empty( $parent ) && ! empty( $name ) ) {
		$field = new AcademistLMSCourseSectionsMetaBox( $name, $label, $description );
		
		if ( is_object( $parent ) ) {
			$parent->addChild( $name, $field );
			
			return $field;
		}
	}
	
	return false;
}

if ( ! function_exists( 'academist_lms_single_course_title_display' ) ) {
	/**
	 * Function that checks option for single portfolio title and overrides it with filter
	 */
	function academist_lms_single_course_title_display( $show_title_area ) {
		if ( is_singular( 'course' ) ) {
			//Override displaying title based on portfolio option
			$show_title_area_meta = academist_elated_get_meta_field_intersect( 'show_title_area_course_single' );
			
			if ( ! empty( $show_title_area_meta ) ) {
				$show_title_area = $show_title_area_meta == 'yes' ? true : false;
			}
		}
		
		return $show_title_area;
	}
	
	add_filter( 'academist_elated_filter_show_title_area', 'academist_lms_single_course_title_display' );
}

if ( ! function_exists( 'academist_lms_set_single_course_comments_enabled' ) ) {
	function academist_lms_set_single_course_comments_enabled( $comments ) {
		if ( is_singular( 'course' ) && academist_elated_options()->getOptionValue( 'course_single_comments' ) == 'yes' ) {
			$comments = true;
		}
		
		return $comments;
	}
	
	add_filter( 'academist_elated_filter_post_type_comments', 'academist_lms_set_single_course_comments_enabled', 10, 1 );
}

if ( ! function_exists( 'academist_lms_get_single_course' ) ) {
	function academist_lms_get_single_course() {
		$instructor = get_post_meta( get_the_ID(), 'eltdf_course_instructor_meta', true );
		
		$params = array(
			'sidebar_layout' => academist_elated_sidebar_layout(),
			'instructor'     => $instructor
		);
		
		academist_lms_get_cpt_single_module_template_part( 'single/holder', 'course', '', $params );
	}
}

if ( ! function_exists( 'academist_lms_single_course_tabs' ) ) {
	/**
	 * Add course tabs to single course pages.
	 *
	 * @param array $tabs
	 *
	 * @return array
	 */
	function academist_lms_single_course_tabs( $tabs = array() ) {
		global $post;
		
		$course_sections = get_post_meta( get_the_ID(), 'eltdf_course_curriculum', true );
		$member_list     = get_post_meta( get_the_ID(), 'eltdf_course_members_meta', true );
		$forum_id        = get_post_meta( get_the_ID(), 'eltdf_course_forum_meta', true );
		
		$show_content    = $post->post_content ? true : false;
		$show_curriculum = ! empty( $course_sections );
		$show_reviews    = academist_lms_show_reviews();
		$show_members    = ! empty( $member_list );
		$show_forum      = ! empty( $forum_id );
		
		if ( ! empty( $forum_id ) ) {
			$forum_link = get_permalink( $forum_id );
		}
		
		// Description tab - shows course content
		if ( $show_content ) {
			$tabs['description'] = array(
				'title'    => __( 'Description', 'academist-lms' ),
				'icon'     => '<i class="lnr lnr-pencil" aria-hidden="true"></i>',
				'priority' => 10,
				'template' => 'content'
			);
		}
		
		// Curriculum tab - shows course curriculum
		if ( $show_curriculum ) {
			$tabs['curriculum'] = array(
				'title'    => __( 'Curriculum', 'academist-lms' ),
				'icon'     => '<i class="lnr lnr-bookmark" aria-hidden="true"></i>',
				'priority' => 20,
				'template' => 'curriculum'
			);
		}
		
		// Reviews tab - shows reviews
		if ( $show_reviews ) {
			$tabs['reviews'] = array(
				'title'    => __( 'Reviews', 'academist-lms' ),
				'icon'     => '<i class="lnr lnr-star" aria-hidden="true"></i>',
				'priority' => 30,
				'template' => 'reviews-list'
			);
		}
		
		// Member tab - shows members
		if ( $show_members ) {
			$tabs['members'] = array(
				'title'    => __( 'Members', 'academist-lms' ),
				'icon'     => '<i class="lnr lnr-users" aria-hidden="true"></i>',
				'priority' => 40,
				'template' => 'members'
			);
		}
		
		// Forum tab - shows forum
		if ( $show_forum ) {
			$tabs['forum'] = array(
				'title'    => __( 'Forum', 'academist-lms' ),
				'icon'     => '<i class="lnr lnr-bubble" aria-hidden="true"></i>',
				'priority' => 40,
				'template' => 'forum',
				'link'     => $forum_link
			);
		}
		
		return $tabs;
	}
	
	add_filter( 'academist_elated_filter_single_course_tabs', 'academist_lms_single_course_tabs' );
}

if ( ! function_exists( 'academist_lms_get_course_curriculum_list' ) ) {
	function academist_lms_get_course_curriculum_list( $section_elements ) {
		$video_lessons   = $audio_lessons = $reading_lessons = 0;
		$lessons_summary = array();
		$elements        = array();
		
		foreach ( $section_elements as $section_element ) {
			$element          = array();
			$element['title'] = get_the_title( $section_element['value'] );
			$element['url']   = get_the_permalink( $section_element['value'] );
			$element['id']    = $section_element['value'];
			if ( $section_element['type'] == 'lesson' ) {
				$element['type']             = 'lesson';
				$element['class']            = 'eltdf-section-lesson';
				$element['extra_info_value'] = get_post_meta( $section_element['value'], 'eltdf_lesson_duration_meta', true );
				$element['extra_info_unit']  = get_post_meta( $section_element['value'], 'eltdf_lesson_duration_parameter_meta', true );
				$lesson_type                 = get_post_meta( $section_element['value'], 'eltdf_lesson_type_meta', true );
				switch ( $lesson_type ) {
					case 'video':
						$element['label'] = esc_html__( 'Video:', 'academist-lms' );
						$element['icon']  = '<i class="lnr lnr-camera-video" aria-hidden="true"></i>';
						$video_lessons ++;
						break;
					case 'audio':
						$element['label'] = esc_html__( 'Audio:', 'academist-lms' );
						$element['icon']  = '<i class="lnr lnr-volume-medium" aria-hidden="true"></i>';
						$audio_lessons ++;
						break;
					case 'reading':
						$element['label'] = esc_html__( 'Reading:', 'academist-lms' );
						$element['icon']  = '<i class="lnr lnr-file-empty" aria-hidden="true"></i>';
						$reading_lessons ++;
						break;
					default:
						$element['label'] = esc_html__( 'Reading:', 'academist-lms' );
						$element['icon']  = '<i class="lnr lnr-file-empty" aria-hidden="true"></i>';
						$reading_lessons ++;
						break;
				}
			} else if ( $section_element['type'] == 'quiz' ) {
				$element['type']             = 'lesson';
				$element['class']            = 'eltdf-section-quiz';
				$element['icon']             = '<i class="lnr lnr-license" aria-hidden="true"></i>';
				$element['label']            = esc_html__( 'Graded:', 'academist-lms' );
				$questions_number              = get_post_meta( $section_element['value'], 'eltdf_quiz_question_list_meta', true );
				$element['extra_info_value'] = count( $questions_number );
				$element['extra_info_unit']  = count( $questions_number ) == 1 ? esc_html__( 'Question', 'academist-lms' ) : esc_html__( 'Questions', 'academist-lms' );
			}
			array_push( $elements, $element );
		}
		if ( $video_lessons !== 0 ) {
			$lessons_summary[] = $video_lessons . ' ' . ( $video_lessons == 1 ? esc_html__( 'video', 'academist-lms' ) : esc_html__( 'videos', 'academist-lms' ) );
		}
		if ( $audio_lessons !== 0 ) {
			$lessons_summary[] = $audio_lessons . ' ' . ( $audio_lessons == 1 ? esc_html__( 'audio', 'academist-lms' ) : esc_html__( 'audios', 'academist-lms' ) );
		}
		if ( $reading_lessons !== 0 ) {
			$lessons_summary[] = $reading_lessons . ' ' . ( $reading_lessons == 1 ? esc_html__( 'reading', 'academist-lms' ) : esc_html__( 'readings', 'academist-lms' ) );
		}
		
		$params = array(
			'lessons_summary' => $lessons_summary,
			'elements'        => $elements
		);
		
		return $params;
	}
}

//Course payment functions
if ( ! function_exists( 'academist_lms_include_course_payment_class' ) ) {
	/**
	 * Function that includes product course
	 */
	function academist_lms_include_course_payment_class() {
		if ( academist_lms_eltdf_woocommerce_integration_installed() && academist_lms_is_woocommerce_installed() ) {
			require_once 'payment/class-wc-product-course.php';
			require_once 'payment/class-wc-order-item-course.php';
			require_once 'payment/class-wc-order-item-course-store.php';
			require_once 'payment/class-wc-course-data-store-cpt.php';
		}
	}
	
	add_action( 'wp_loaded', 'academist_lms_include_course_payment_class' );
}

if ( ! function_exists( 'academist_lms_add_course_to_post_types_payment' ) ) {
	/**
	 * Function that add custom post type to list
	 */
	function academist_lms_add_course_to_post_types_payment( $post_types ) {
		if ( academist_lms_eltdf_woocommerce_integration_installed() ) {
			$post_types[] = 'course';
		}
		
		return $post_types;
	}
	
	add_filter( 'academist_checkout_integration_post_types', 'academist_lms_add_course_to_post_types_payment', 100 );
}

if ( ! function_exists( 'academist_lms_course_add_to_cart_action' ) ) {
	function academist_lms_course_add_to_cart_action( $add_to_cart_url ) {
		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );
		$product           = new WC_Product_Course( $product_id );
		$url               = $product->add_to_cart_url();
		$quantity          = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
		$passed_validation = true;
		
		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) !== false ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			// If has custom URL redirect there
			if ( $url ) {
				wp_safe_redirect( $url );
				exit;
			} elseif ( get_option( 'woocommerce_cart_redirect_after_add' ) === 'yes' ) {
				wp_safe_redirect( wc_get_cart_url() );
				exit;
			}
		}
	}
	
	add_action( 'woocommerce_add_to_cart_handler_course', 'academist_lms_course_add_to_cart_action', 10, 1 );
}

if ( ! function_exists( 'academist_lms_course_add_users_to_course' ) ) {
	function academist_lms_course_add_users_to_course( $id ) {
		$order      = new WC_Order( $id );
		$items      = $order->get_items();
		
		foreach ( $items as $item ) {
			$data       = $item->get_data();
			$product_id = $data['product_id'];
			
			if ( $item['product_id'] == 0 && get_post_type( $product_id ) == 'course' ) {
				if ( $users = get_post_meta( $product_id, 'eltdf_course_users_attended', true ) !== '' ) {
					$users[] = get_current_user_id();
				} else {
					$users = array( get_current_user_id() );
				}
				
				update_post_meta( $product_id, 'eltdf_course_users_attended', $users );
				
				$user_status_values = academist_lms_get_user_courses_status();
				
				if ( ! empty( $user_status_values ) ) {
					if ( ! array_key_exists( $product_id, $user_status_values ) ) {
						$user_status_values[ $product_id ] = array(
							'status'          => 'enrolled',
							'items_completed' => array(),
							'retakes'         => 0
						);
						
						academist_lms_set_user_courses_status( $user_status_values );
					}
				} else {
					$user_status_new_values = array(
						$product_id => array(
							'status'          => 'enrolled',
							'items_completed' => array(),
							'retakes'         => 0
						)
					);
					
					academist_lms_set_user_courses_status( $user_status_new_values );
				}
			}
		}
	}
	
	add_action( 'woocommerce_order_status_completed', 'academist_lms_course_add_users_to_course', 10, 1 );
}

if ( ! function_exists( 'academist_lms_calculate_course_price' ) ) {
	function academist_lms_calculate_course_price( $id ) {
		$final_price    = 0;
		$free_course    = get_post_meta( $id, 'eltdf_course_free_meta', true );
		$price          = get_post_meta( $id, 'eltdf_course_price_meta', true );
		$discount_price = get_post_meta( $id, 'eltdf_course_price_discount_meta', true );
		
		if ( $free_course != 'yes' ) {
			if ( $discount_price != '' ) {
				$final_price = $discount_price;
			} elseif ( $price != '' ) {
				$final_price = $price;
			}
		}
		
		return $final_price;
	}
}

//Course rating functions
if ( ! function_exists( 'academist_lms_add_course_to_rating' ) ) {
	function academist_lms_add_course_to_rating( $post_types ) {
		$post_types[] = 'course';
		
		return $post_types;
	}
	
	add_filter( 'academist_lms_rating_post_types', 'academist_lms_add_course_to_rating' );
}

//Course rating functions
if ( ! function_exists( 'academist_lms_show_reviews' ) ) {
	function academist_lms_show_reviews() {
		
		if ( academist_elated_show_comments() ) {
			return true;
		}
	}
}

if ( ! function_exists( 'academist_lms_show_reviews_form' ) ) {
	function academist_lms_show_reviews_form( $show_form ) {
		
		if ( is_singular( 'course' ) && ! academist_lms_user_has_course() ) {
			$show_form = false;
		}
		
		return $show_form;
	}
	
	add_filter( 'academist_elated_filter_show_comment_form_filter', 'academist_lms_show_reviews_form' );
}

if ( ! function_exists( 'academist_lms_get_buy_form' ) ) {
	function academist_lms_get_buy_form() {
		
		if ( academist_lms_is_woocommerce_installed() ) {
			$user_has_course = academist_lms_user_has_course();
			$params          = array();
			
			$user_current_course_status = academist_lms_user_current_course_status();
			$user_completed_prerequired = academist_lms_user_completed_prerequired_course();
			
			if ( $user_current_course_status == 'completed' ) {
				$params['percent'] = 100;
			} else if ( $user_current_course_status == 'in-progress' ) {
				$params['percent'] = academist_lms_user_current_course_completed_percent();
			} else {
				$params['percent'] = 0;
			}
			if ( $user_has_course ) {
				if ( ! $user_completed_prerequired ) {
					$params['prerequired'] = get_post_meta( get_the_ID(), 'eltdf_course_prerequired_meta', true );
					academist_lms_get_cpt_single_module_template_part( 'single/parts/prerequired-info', 'course', '', $params );
				} else {
					if ( $user_current_course_status == 'completed' && ( academist_lms_check_retakes_option() > academist_lms_user_current_course_retakes() ) ) {
						academist_lms_get_cpt_single_module_template_part( 'single/parts/retake-form', 'course', '', $params );
					}
					academist_lms_get_cpt_single_module_template_part( 'single/parts/progress-bar', 'course', '', $params );
				}
			} elseif ( academist_lms_check_is_course_in_cart() ) {
				academist_lms_get_cpt_single_module_template_part( 'single/parts/cart-button', 'course', '', $params );
			} elseif ( academist_lms_eltdf_woocommerce_integration_installed() ) {
				academist_checkout_get_buy_form( array(), array( 'input_text' => esc_html__( 'Apply now', 'academist-lms' ) ) );
			}
			//this should move from this function when sidebar created
		}
	}
}

if ( ! function_exists( 'academist_lms_get_items_load' ) ) {
	function academist_lms_get_items_load() {
		$params = array();
		
		if ( is_singular( 'course' ) ) {
			academist_lms_get_cpt_single_module_template_part( 'single/popup-holder', 'course', '', $params );
		}
	}
	
	add_action( 'academist_elated_action_before_page_header', 'academist_lms_get_items_load' );
}

if ( ! function_exists( 'academist_lms_load_element_item' ) ) {
	function academist_lms_load_element_item() {
		
		if ( isset( $_POST ) && isset( $_POST['item_id'] ) ) {
			$id        = $_POST['item_id'];
			$course_id = $_POST['course_id'];
			$json_data = array();
			
			$params = array(
				'item_id'   => $id,
				'course_id' => $course_id
			);
			
			$post_type = get_post_type( $id );
			if ( $post_type == 'lesson' ) {
				$params['lesson_type'] = get_post_meta( $id, 'eltdf_lesson_type_meta', true );
			}
			
			$html = academist_lms_cpt_single_module_template_part( 'single/holder', $post_type, '', $params );
			if ( academist_lms_user_has_course( $course_id ) && academist_lms_user_completed_prerequired_course( $course_id ) ) {
				$html .= academist_lms_popup_navigation( $params );
			}
			
			$json_data['html'] = $html;
			
			academist_lms_ajax_status( 'success', '', $json_data );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_academist_lms_load_element_item', 'academist_lms_load_element_item' );
	add_action( 'wp_ajax_academist_lms_load_element_item', 'academist_lms_load_element_item' );
}

if ( ! function_exists( 'academist_lms_popup_navigation' ) ) {
	function academist_lms_popup_navigation( $params = array() ) {
		
		$html = academist_lms_cpt_single_module_template_part( 'single/parts/popup-navigation', 'course', '', $params );
		
		return $html;
	}
}

if ( ! function_exists( 'academist_lms_complete_item' ) ) {
	function academist_lms_complete_item() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$data        = $_POST;
			$data_string = $data['post'];
			parse_str( $data_string, $data_array );
			$course_id          = $data_array['academist_lms_course_id'];
			$item_id            = $data_array['academist_lms_item_id'];
			$user_status_values = academist_lms_get_user_courses_status();
			
			$items = academist_lms_get_items_in_course( $course_id );
			
			if ( ! empty( $user_status_values ) && array_key_exists( $course_id, $user_status_values ) ) {
				
				$items_completed = array_unique( array_merge( $user_status_values[ $course_id ]['items_completed'], array( $item_id ) ) );
				if ( academist_lms_array_equal( $items, $items_completed ) ) {
					$status = 'completed';
				} else {
					$status = 'in-progress';
				}
				
				$user_status_new_values = array(
					'status'          => $status,
					'items_completed' => array_unique( array_merge( $user_status_values[ $course_id ]['items_completed'], array( $item_id ) ) ),
					'retakes'         => $user_status_values[ $course_id ]['retakes']
				);
				
				$user_status_values[ $course_id ] = $user_status_new_values;
				academist_lms_set_user_courses_status( $user_status_values );
				
				$message_html = '<p class="eltdf-lms-message">';
				$message_html .= '<span class="lnr lnr-checkmark-circle"></span>';
				$message_html .= '<span class="eltdf-lms-message-text">';
				
				$message = get_post_meta( $item_id, 'eltdf_lesson_post_message_meta', true );
				
				if ( $message == '' ) {
					$message_html .= esc_html__( 'Completed', 'academist-lms' );
				} else {
					$message_html .= $message;
				}
				
				$message_html .= '</span>';
				
				$data = array(
					'content_message' => $message_html
				);
				academist_lms_ajax_status( 'success', esc_html__( 'Item finished successfully', 'academist-lms' ), $data );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_complete_item', 'academist_lms_complete_item' );
}

if ( ! function_exists( 'academist_lms_check_retakes_option' ) ) {
	function academist_lms_check_retakes_option() {
		$number_of_retakes = get_post_meta( get_the_ID(), 'eltdf_course_retake_number_meta', true );
		
		return $number_of_retakes;
	}
}

if ( ! function_exists( 'academist_lms_get_items_in_course' ) ) {
	function academist_lms_get_items_in_course( $id = '' ) {
		$course_id       = ( $id != '' ? $id : get_the_ID() );
		$course_sections = get_post_meta( $course_id, 'eltdf_course_curriculum', true );
		
		$items = array();
		if ( isset( $course_sections ) && $course_sections != '' ) {
			for ( $i = 0; $i < count( $course_sections ); $i ++ ) {
				if ( isset( $course_sections[ $i ]['section_elements'] ) ) {
					$elements = $course_sections[ $i ]['section_elements'];
					if ( ! empty( $elements ) ) {
						foreach ( $elements as $element ) {
							if ( isset( $element['value'] ) ) {
								$items[] = $element['value'];
							}
						}
					}
				}
			}
		}
		
		return $items;
	}
}

if ( ! function_exists( 'academist_lms_get_number_of_items_in_course' ) ) {
	function academist_lms_get_number_of_items_in_course( $id = '' ) {
		$course_id = ( $id != '' ? $id : get_the_ID() );
		$items     = academist_lms_get_items_in_course( $course_id );
		
		if ( is_array( $items ) && count( $items ) > 0 ) {
			$number_ot_items = count( $items );
		} else {
			$number_ot_items = 0;
		}
		
		return $number_ot_items;
	}
}

if ( ! function_exists( 'academist_lms_get_course_item_completed_class' ) ) {
	function academist_lms_get_course_item_completed_class( $id = '' ) {
		$class           = '';
		$course_id       = ( $id != '' ? $id : get_the_ID() );
		$completed_items = academist_lms_user_current_course_items_completed();
		
		if ( in_array( $course_id, $completed_items ) ) {
			$class = 'eltdf-item-completed';
		}
		
		return $class;
	}
}

if ( ! function_exists( 'academist_lms_set_user_courses_status' ) ) {
	function academist_lms_set_user_courses_status( $user_status_values ) {
		update_user_meta( get_current_user_id(), 'eltdf_user_course_status', $user_status_values );
	}
}

if ( ! function_exists( 'academist_lms_get_user_courses_status' ) ) {
	function academist_lms_get_user_courses_status() {
		$user_status_values = get_user_meta( get_current_user_id(), 'eltdf_user_course_status', true );
		
		return $user_status_values;
	}
}
if ( ! function_exists( 'academist_lms_user_current_course_info' ) ) {
	function academist_lms_user_current_course_info( $id = '' ) {
		$course_id          = ( $id != '' ? $id : get_the_ID() );
		$user_status_values = academist_lms_get_user_courses_status();
		
		if ( is_array( $user_status_values ) && count( $user_status_values ) > 0 && array_key_exists( $course_id, $user_status_values ) ) {
			return $user_status_values[ $course_id ];
		}
		
		return false;
	}
}

if ( ! function_exists( 'academist_lms_user_current_course_status' ) ) {
	function academist_lms_user_current_course_status( $id = '' ) {
		$user_course_status = '';
		$course_id          = ( $id != '' ? $id : get_the_ID() );
		$user_status_values = academist_lms_user_current_course_info( $course_id );
		
		if ( is_array( $user_status_values ) && count( $user_status_values ) > 0 ) {
			$user_course_status = $user_status_values['status'];
		}
		
		return $user_course_status;
	}
}

if ( ! function_exists( 'academist_lms_user_current_course_items_completed' ) ) {
	function academist_lms_user_current_course_items_completed( $id = '' ) {
		$user_course_items_completed = array();
		$course_id                   = ( $id != '' ? $id : get_the_ID() );
		$user_status_values          = academist_lms_user_current_course_info( $course_id );
		
		if ( is_array( $user_status_values ) && count( $user_status_values ) > 0 ) {
			$user_course_items_completed = $user_status_values['items_completed'];
		}
		
		return $user_course_items_completed;
	}
}

if ( ! function_exists( 'academist_lms_user_current_course_retakes' ) ) {
	function academist_lms_user_current_course_retakes( $id = '' ) {
		$user_course_retakes = 0;
		$course_id           = ( $id != '' ? $id : get_the_ID() );
		$user_status_values  = academist_lms_user_current_course_info( $course_id );
		
		if ( is_array( $user_status_values ) && count( $user_status_values ) > 0 ) {
			$user_course_retakes = $user_status_values['retakes'];
		}
		
		return $user_course_retakes;
	}
}

if ( ! function_exists( 'academist_lms_user_current_course_completed_percent' ) ) {
	function academist_lms_user_current_course_completed_percent( $id = '' ) {
		$course_id       = ( $id != '' ? $id : get_the_ID() );
		$items           = academist_lms_get_number_of_items_in_course( $course_id );
		$completed_items = count( academist_lms_user_current_course_items_completed() );
		$percent         = $items == 0 ? 0 : round( ( $completed_items / $items ) * 100 );
		
		return $percent;
	}
}

if ( ! function_exists( 'academist_lms_course_items_list_array' ) ) {
	function academist_lms_course_items_list_array( $id = '' ) {
		$course_id       = ( $id != '' ? $id : get_the_ID() );
		$course_sections = get_post_meta( $course_id, 'eltdf_course_curriculum', true );
		$elements_keys   = array();
		
		if ( ! empty( $course_sections ) ) {
			foreach ( $course_sections as $course_section ) {
				$section_elements = $course_section['section_elements'];
				if ( ! empty( $section_elements ) ) {
					
					$list     = academist_lms_get_course_curriculum_list( $section_elements );
					$elements = $list['elements'];
					
					foreach ( $elements as $element ) {
						$elements_keys[] = $element['id'];
					}
				}
			}
		}
		
		return $elements_keys;
	}
}

if ( ! function_exists( 'academist_lms_course_is_preview_available' ) ) {
	function academist_lms_course_is_preview_available( $id ) {
		$free_lesson      = get_post_meta( $id, 'eltdf_lesson_free_meta', true );
		$available        = false;
		$user_have_course = academist_lms_user_has_course() && academist_lms_user_completed_prerequired_course();
		
		if ( $user_have_course ) {
			$available = true;
		} else if ( $free_lesson == 'yes' ) {
			$available = true;
		}
		
		return $available;
	}
}

if ( ! function_exists( 'academist_lms_retake_course' ) ) {
	function academist_lms_retake_course() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$data        = $_POST;
			$data_string = $data['post'];
			parse_str( $data_string, $data_array );
			$course_id = $data_array['academist_lms_course_id'];
			
			$user_courses_status_values = academist_lms_get_user_courses_status();
			$user_course_status_values  = academist_lms_user_current_course_info( $course_id );
			
			$user_status_new_values = array(
				'status'          => 'enrolled',
				'items_completed' => array(),
				'retakes'         => $user_course_status_values['retakes'] + 1
			);
			
			$user_courses_status_values[ $course_id ] = $user_status_new_values;
			academist_lms_set_user_courses_status( $user_courses_status_values );
			
			//Updated results field
			$params_results = academist_lms_get_quiz_results_meta_params();
			academist_lms_set_user_quiz_values( $course_id, 0, $params_results, 'eltdf_user_quiz_results' );
			
			//Update temporary field
			$params_results = academist_lms_get_quiz_temp_meta_params();
			academist_lms_set_user_quiz_values( $course_id, 0, $params_results, 'eltdf_user_quiz_temp' );
			
			//Update status field
			$params_results = academist_lms_get_quiz_status_meta_params();
			academist_lms_set_user_quiz_values( $course_id, 0, $params_results, 'eltdf_user_quiz_status' );
			
			academist_lms_ajax_status( 'success', esc_html__( 'Course Retaken', 'academist-lms' ) );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_retake_course', 'academist_lms_retake_course' );
}

if ( ! function_exists( 'academist_lms_check_is_course_in_cart' ) ) {
	function academist_lms_check_is_course_in_cart() {
		
		foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['data'];
			
			if ( get_the_ID() == $_product->get_id() ) {
				return true;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'academist_lms_remove_message_from_cart' ) ) {
	function academist_lms_remove_message_from_cart( $message, $product_id ) {
		if ( get_post_type( $product_id ) == 'course' ) {
			return '';
		}
		
		return $message;
	}
	
	add_filter( 'wc_add_to_cart_message_html', 'academist_lms_remove_message_from_cart', 10, 2 );
}

if ( ! function_exists( 'academist_lms_add_course_to_search_types' ) ) {
	function academist_lms_add_course_to_search_types( $post_types ) {
		$post_types['course'] = esc_html__( 'Course', 'academist-lms' );
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_search_post_type_widget_params_post_type', 'academist_lms_add_course_to_search_types' );
}

if ( ! function_exists( 'academist_lms_course_override_search_template_path' ) ) {
	function academist_lms_course_override_search_template_path( $template_path ) {
		
		if ( isset( $_GET['eltdf-course-search'] ) ) {
			$template_path = ACADEMIST_LMS_CPT_PATH . '/';
		}
		
		return $template_path;
	}
	
	add_filter( 'academist_elated_filter_edit_module_template_path', 'academist_lms_course_override_search_template_path', 10, 1 );
}

if ( ! function_exists( 'academist_lms_course_override_search_path' ) ) {
	function academist_lms_course_override_search_path( $path ) {
		
		if ( isset( $_GET['eltdf-course-search'] ) ) {
			$path = 'search';
		}
		
		return $path;
	}
	
	add_filter( 'academist_elated_filter_search_page_path', 'academist_lms_course_override_search_path', 10, 1 );
}

if ( ! function_exists( 'academist_lms_course_override_search_module' ) ) {
	function academist_lms_course_override_search_module( $module ) {
		
		if ( isset( $_GET['eltdf-course-search'] ) ) {
			$module = 'course';
		}
		
		return $module;
	}
	
	add_filter( 'academist_elated_filter_search_page_module', 'academist_lms_course_override_search_module', 10, 1 );
}

if ( ! function_exists( 'academist_lms_course_override_search_plugin' ) ) {
	function academist_lms_course_override_search_plugin( $plugin ) {
		
		if ( isset( $_GET['eltdf-course-search'] ) ) {
			$plugin = true;
		}
		
		return $plugin;
	}
	
	add_filter( 'academist_elated_filter_search_page_plugin_override', 'academist_lms_course_override_search_plugin', 10, 1 );
}

if ( ! function_exists( 'academist_lms_course_override_search_params' ) ) {
	function academist_lms_course_override_search_params( $params ) {
		
		if ( isset( $_GET['eltdf-course-search'] ) ) {
			$list_params   = array();
			$search_params = array();
			
			$query_array = array(
				'post_status'    => 'publish',
				'post_type'      => 'course',
				'posts_per_page' => '-1'
			);
			
			$tax_query = array();
			if ( isset( $_GET['eltdf-course-category'] ) && $_GET['eltdf-course-category'] != 'all' ) {
				$tax_query[]                        = array(
					'taxonomy' => 'course-category',
					'field'    => 'slug',
					'terms'    => array(
						$_GET['eltdf-course-category']
					)
				);
				$search_params['selected_category'] = $_GET['eltdf-course-category'];
			}
			
			if ( ! empty( $tax_query ) ) {
				$query_array['tax_query'] = $tax_query;
			}
			
			$meta_query = array();
			if ( isset( $_GET['eltdf-course-instructor'] ) && $_GET['eltdf-course-instructor'] != 'all' ) {
				$meta_query[]                         = array(
					'key'     => 'eltdf_course_instructor_meta',
					'value'   => $_GET['eltdf-course-instructor'],
					'compare' => '='
				);
				$search_params['selected_instructor'] = $_GET['eltdf-course-instructor'];
			}
			
			if ( isset( $_GET['eltdf-course-price'] ) && $_GET['eltdf-course-price'] != 'all' ) {
				$free_meta_value                 = $_GET['eltdf-course-price'] == 'free' ? 'yes' : 'no';
				$meta_query[]                    = array(
					'key'     => 'eltdf_course_free_meta',
					'value'   => $free_meta_value,
					'compare' => '='
				);
				$search_params['selected_price'] = $_GET['eltdf-course-price'];
			}
			
			if ( ! empty( $meta_query ) ) {
				$query_array['meta_query'] = $meta_query;
			}
			
			$new_query               = new WP_Query( $query_array );
			$params['query']         = $new_query;
			$params['max_num_pages'] = 1;
			
			$params['search_params'] = $search_params;
			$params['list_params']   = $list_params;
		}
		
		return $params;
	}
	
	add_filter( 'academist_elated_filter_search_page_params', 'academist_lms_course_override_search_params', 10, 1 );
}

if ( ! function_exists( 'academist_lms_course_override_search_title' ) ) {
	function academist_lms_course_override_search_title( $title ) {
		
		if ( isset( $_GET['eltdf-course-search'] ) ) {
			$title = esc_html__( 'List of filtered courses', 'academist-lms' );
		}
		
		return $title;
	}
	
	add_filter( 'academist_elated_filter_title_text', 'academist_lms_course_override_search_title', 10, 1 );
}

if ( ! function_exists( 'academist_lms_search_courses' ) ) {
	function academist_lms_search_courses() {
		$user_id = get_current_user_id();
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$args = array(
				'post_type'      => 'course',
				'post_status'    => 'publish',
				'order'          => 'DESC',
				'orderby'        => 'date',
				's'              => $_POST['term'],
				'posts_per_page' => 5
			);
			
			$html  = '';
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				$html .= '<ul>';
				while ( $query->have_posts() ) {
					$query->the_post();
					$html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$html              .= '</ul>';
				$json_data['html'] = $html;
				academist_lms_ajax_status( 'success', '', $json_data );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_academist_lms_search_courses', 'academist_lms_search_courses' );
	add_action( 'wp_ajax_academist_lms_search_courses', 'academist_lms_search_courses' );
}

if ( ! function_exists( 'academist_lms_complete_button' ) ) {
	function academist_lms_complete_button( $params = array() ) {
		$html = '';
		
		if ( academist_lms_user_has_course( $params['course_id'] ) ) {
			$html               = academist_lms_cpt_single_module_template_part( 'single/parts/complete-form', 'course', '', $params );
			$user_status_values = academist_lms_get_user_courses_status();
			
			if ( ! empty( $user_status_values ) && array_key_exists( $params['course_id'], $user_status_values ) ) {
				if ( in_array( $params['item_id'], $user_status_values[ $params['course_id'] ]['items_completed'] ) ) {
					$message_html = '<p class="eltdf-lms-message">';
					$message_html .= '<span class="lnr lnr-checkmark-circle"></span>';
					$message_html .= '<span class="eltdf-lms-message-text">';
					
					$message = get_post_meta( $params['item_id'], 'eltdf_lesson_post_message_meta', true );
					
					if ( $message == '' ) {
						$message_html .= esc_html__( 'Completed', 'academist-lms' );
					} else {
						$message_html .= $message;
					}
					
					$message_html .= '</span>';
					
					$html = $message_html;
				}
			}
		}
		
		return $html;
	}
}

if ( ! function_exists( 'academist_lms_override_breadcrumbs' ) ) {
	function academist_lms_override_breadcrumbs( $childContent, $delimiter, $before, $after ) {
		
		if ( is_tax( 'course-category', '' ) ) {
			$childContent = '';
			$terms        = get_terms( 'course-category' );
			$curent_term  = get_queried_object()->term_id;
			// @TODO Optimize function by using get_term_parents_list()  that is included in wp 4.8 version
			foreach ( $terms as $term ) {
				if ( $term->term_id == $curent_term ) {
					$cat  = $term;
					$args = array(
						'format'    => 'name',
						'separator' => $delimiter,
						'link'      => true,
						'inclusive' => false
					);
					
					$parents = get_ancestors( $curent_term, 'course-category', 'taxonomy' );
					
					if ( $args['inclusive'] ) {
						array_unshift( $parents, $curent_term );
					}
					
					foreach ( array_reverse( $parents ) as $term_id ) {
						$parent = get_term( $term_id, 'course-category' );
						$name   = ( 'slug' === $args['format'] ) ? $parent->slug : $parent->name;
						
						if ( $args['link'] ) {
							$childContent .= '<a href="' . esc_url( get_term_link( $parent->term_id, 'course-category' ) ) . '">' . $name . '</a>' . $args['separator'];
						} else {
							$childContent .= $name . $args['separator'];
						}
					}
					
					$childContent .= $before . $cat->name . $after;
					break;
				}
			}
		} else if ( is_singular( 'course' ) ) {
			global $post;
			$childContent = '';
			$cats         = get_the_terms( $post->ID, 'course-category' );
			if ( $cats ) {
				$cat          = $cats[0];
				$args         = array(
					'separator' => $delimiter,
					'link'      => true
				);
				$parents      = get_term_parents_list( $cat, 'course-category', $args );
				$childContent .= $parents;
			}
			$childContent .= $before . get_the_title() . $after;
		}
		
		return $childContent;
	}
	
	add_filter( 'academist_elated_filter_breadcrumbs_title_child_output', 'academist_lms_override_breadcrumbs', 10, 4 );
}

if ( ! function_exists( 'academist_lms_single_course_add_social_share_option' ) ) {
    function academist_lms_single_course_add_social_share_option( $container ) {
        academist_elated_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_social_share_on_course',
                'default_value' => 'no',
                'label'         => esc_html__( 'Course Item', 'academist-lms' ),
                'description'   => esc_html__( 'Show Social Share for Course Items', 'academist-lms' ),
                'parent'        => $container
            )
        );
    }

    add_action( 'academist_elated_action_post_types_social_share', 'academist_lms_single_course_add_social_share_option', 10, 1 );
}