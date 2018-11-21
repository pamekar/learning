<?php

if ( ! function_exists( 'academist_lms_map_instructor_single_meta' ) ) {
	function academist_lms_map_instructor_single_meta() {
		
		$meta_box = academist_elated_create_meta_box(
			array(
				'scope' => 'instructor',
				'title' => esc_html__( 'Instructor Info', 'academist-lms' ),
				'name'  => 'instructor_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_instructor_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'academist-lms' ),
				'description' => esc_html__( 'The members\'s title', 'academist-lms' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_instructor_vita',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Brief Vita', 'academist-lms' ),
				'description' => esc_html__( 'The members\'s brief vita', 'academist-lms' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_instructor_email',
				'type'        => 'text',
				'label'       => esc_html__( 'Email', 'academist-lms' ),
				'description' => esc_html__( 'The members\'s email', 'academist-lms' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_instructor_resume',
				'type'        => 'file',
				'label'       => esc_html__( 'Resume', 'academist-lms' ),
				'description' => esc_html__( 'Upload members\'s resume', 'academist-lms' ),
				'parent'      => $meta_box
			)
		);
		
		for ( $x = 1; $x < 6; $x ++ ) {
			$social_icon_group = academist_elated_add_admin_group(
				array(
					'name'   => 'eltdf_instructor_social_icon_group' . $x,
					'title'  => esc_html__( 'Social Link ', 'academist-lms' ) . $x,
					'parent' => $meta_box
				)
			);
			
			$social_row1 = academist_elated_add_admin_row(
				array(
					'name'   => 'eltdf_instructor_social_icon_row1' . $x,
					'parent' => $social_icon_group
				)
			);
			
			academist_elated_icon_collections()->getIconsMetaBoxOrOption(
				array(
					'label'            => esc_html__( 'Icon ', 'academist-lms' ) . $x,
					'parent'           => $social_row1,
					'name'             => 'eltdf_instructor_social_icon_pack_' . $x,
					'defaul_icon_pack' => '',
					'type'             => 'meta-box',
					'field_type'       => 'simple'
				)
			);
			
			$social_row2 = academist_elated_add_admin_row(
				array(
					'name'   => 'eltdf_instructor_social_icon_row2' . $x,
					'parent' => $social_icon_group
				)
			);
			
			academist_elated_create_meta_box_field(
				array(
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Link', 'academist-lms' ),
					'name'   => 'eltdf_instructor_social_icon_' . $x . '_link',
					'parent' => $social_row2
				)
			);
			
			academist_elated_create_meta_box_field(
				array(
					'type'    => 'selectsimple',
					'label'   => esc_html__( 'Target', 'academist-lms' ),
					'name'    => 'eltdf_instructor_social_icon_' . $x . '_target',
					'options' => academist_elated_get_link_target_array(),
					'parent'  => $social_row2
				)
			);
		}
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_lms_map_instructor_single_meta', 46 );
}