<?php

if ( ! function_exists( 'academist_lms_map_course_meta' ) ) {
	function academist_lms_map_course_meta() {
		
		//Get list of courses;
		$academist_courses = array();
		$courses      = get_posts(
			array(
				'numberposts' => - 1,
				'post_type'   => 'course',
				'post_status' => 'publish'
			)
		);
		foreach ( $courses as $course ) {
			$academist_courses[ $course->ID ] = $course->post_title;
		}
		
		//Get list of instructors;
		$academist_instructors = array();
		$instructors      = get_posts(
			array(
				'numberposts' => - 1,
				'post_type'   => 'instructor',
				'post_status' => 'publish'
			)
		);
		foreach ( $instructors as $instructor ) {
			$academist_instructors[ $instructor->ID ] = $instructor->post_title;
		}
		
		if ( academist_lms_bbpress_plugin_installed() ) {
			//Get list of forums;
			$academist_forums = array();
			$forums      = get_posts(
				array(
					'numberposts'         => - 1,
					'post_type'           => 'forum',
					'post_status'         => 'publish',
					'posts_per_page'      => get_option( '_bbp_forums_per_page', 50 ),
					'ignore_sticky_posts' => true,
					'orderby'             => 'menu_order title',
					'order'               => 'ASC'
				)
			);
			foreach ( $forums as $forum ) {
				$academist_forums[ $forum->ID ] = $forum->post_title;
			}
		}
		
		$meta_box = academist_elated_create_meta_box(
			array(
				'scope' => 'course',
				'title' => esc_html__( 'Course Settings', 'academist-lms' ),
				'name'  => 'course_settings_meta_box'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_course_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'academist-lms' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single course page', 'academist-lms' ),
				'parent'        => $meta_box,
				'options'       => academist_elated_get_yes_no_select_array()
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_instructor_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Course Instructor', 'academist-lms' ),
				'description' => esc_html__( 'Select instructor for this course', 'academist-lms' ),
				'parent'      => $meta_box,
				'options'     => $academist_instructors,
				'args'        => array(
					'select2' => true
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_duration_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Course Duration', 'academist-lms' ),
				'description' => esc_html__( 'Set duration for course', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_curriculum_desc_meta',
				'type'        => 'textarea',
				'label'       => esc_html__( 'General Curriculum Description', 'academist-lms' ),
				'description' => esc_html__( 'Set general description of course curriculum', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_course_duration_parameter_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Course Duration Parameter', 'academist-lms' ),
				'description'   => esc_html__( 'Choose parameter for course duration', 'academist-lms' ),
				'default_value' => 'minutes',
				'parent'        => $meta_box,
				'options'       => array(
					''        => esc_html__( 'Default', 'academist-lms' ),
					'minutes' => esc_html__( 'Minutes', 'academist-lms' ),
					'hours'   => esc_html__( 'Hours', 'academist-lms' ),
					'days'    => esc_html__( 'Days', 'academist-lms' ),
					'weeks'   => esc_html__( 'Weeks', 'academist-lms' ),
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_maximum_students_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Maximum Students', 'academist-lms' ),
				'description' => esc_html__( 'Set maximal number of students', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_retake_number_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Re-Takes', 'academist-lms' ),
				'description' => esc_html__( 'Set maximal number of retakes', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_course_featured_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Featured Course', 'academist-lms' ),
				'description'   => esc_html__( 'Enable this option to set course featured', 'academist-lms' ),
				'parent'        => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_prerequired_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Pre-Required Course', 'academist-lms' ),
				'description' => esc_html__( 'Select course that needs to be completed before attending', 'academist-lms' ),
				'parent'      => $meta_box,
				'options'     => $academist_courses,
				'args'        => array(
					'select2' => true
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_passing_percentage_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Passing Percentage', 'academist-lms' ),
				'description' => esc_html__( 'Set value required to pass the course', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_course_free_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Free Course', 'academist-lms' ),
				'description'   => esc_html__( 'Enabling this option will set course to be free', 'academist-lms' ),
				'parent'        => $meta_box
			)
		);
		
		$course_price_container = academist_elated_add_admin_container(
			array(
				'type'       => 'container',
				'name'       => 'course_price_container',
				'parent'     => $meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_course_free_meta' => 'yes'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_price_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Price', 'academist-lms' ),
				'description' => esc_html__( 'Set price for course', 'academist-lms' ),
				'parent'      => $course_price_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_course_price_discount_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Discount', 'academist-lms' ),
				'description' => esc_html__( 'Enter discount value for course', 'academist-lms' ),
				'parent'      => $course_price_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_course_members_meta',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Course Members', 'academist-lms' ),
				'description'   => esc_html__( 'Enabling this option will show all members that buy/start this course', 'academist-lms' ),
				'parent'        => $meta_box
			)
		);
		
		if ( academist_lms_bbpress_plugin_installed() ) {
			academist_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_course_forum_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Course Forum', 'academist-lms' ),
					'description' => esc_html__( 'Select forum for this course', 'academist-lms' ),
					'parent'      => $meta_box,
					'options'     => $academist_forums,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		$meta_box_curriculum = academist_elated_create_meta_box(
			array(
				'scope' => 'course',
				'title' => esc_html__( 'Course Curriculum', 'academist-lms' ),
				'name'  => 'course_curriculum_meta_box'
			)
		);
		
		academist_lms_add_meta_box_course_items_field(
			array(
				'name'        => 'eltdf_course_curriculum',
				'label'       => esc_html__( 'Curriculum', 'academist-lms' ),
				'description' => esc_html__( 'Organize lessons and quizzes into sections.', 'academist-lms' ),
				'parent'      => $meta_box_curriculum
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_lms_map_course_meta', 5 );
}