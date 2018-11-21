<?php

if ( ! function_exists( 'academist_core_map_team_single_meta' ) ) {
	function academist_core_map_team_single_meta() {
		
		$meta_box = academist_elated_create_meta_box(
			array(
				'scope' => 'team-member',
				'title' => esc_html__( 'Team Member Info', 'academist-core' ),
				'name'  => 'team_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_team_member_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Position', 'academist-core' ),
				'description' => esc_html__( 'The members\'s role within the team', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_team_member_birth_date',
				'type'        => 'date',
				'label'       => esc_html__( 'Birth date', 'academist-core' ),
				'description' => esc_html__( 'The members\'s birth date', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_team_member_email',
				'type'        => 'text',
				'label'       => esc_html__( 'Email', 'academist-core' ),
				'description' => esc_html__( 'The members\'s email', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_team_member_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Phone', 'academist-core' ),
				'description' => esc_html__( 'The members\'s phone', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_team_member_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Address', 'academist-core' ),
				'description' => esc_html__( 'The members\'s addres', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_team_member_education',
				'type'        => 'text',
				'label'       => esc_html__( 'Education', 'academist-core' ),
				'description' => esc_html__( 'The members\'s education', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_team_member_resume',
				'type'        => 'file',
				'label'       => esc_html__( 'Resume', 'academist-core' ),
				'description' => esc_html__( 'Upload members\'s resume', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		for ( $x = 1; $x < 6; $x ++ ) {
			
			$social_icon_group = academist_elated_add_admin_group(
				array(
					'name'   => 'eltdf_team_member_social_icon_group' . $x,
					'title'  => esc_html__( 'Social Link ', 'academist-core' ) . $x,
					'parent' => $meta_box
				)
			);
			
			$social_row1 = academist_elated_add_admin_row(
				array(
					'name'   => 'eltdf_team_member_social_icon_row1' . $x,
					'parent' => $social_icon_group
				)
			);
			
			academist_elated_icon_collections()->getIconsMetaBoxOrOption(
				array(
					'label'            => esc_html__( 'Icon ', 'academist-core' ) . $x,
					'parent'           => $social_row1,
					'name'             => 'eltdf_team_member_social_icon_pack_' . $x,
					'defaul_icon_pack' => '',
					'type'             => 'meta-box',
					'field_type'       => 'simple'
				)
			);
			
			$social_row2 = academist_elated_add_admin_row(
				array(
					'name'   => 'eltdf_team_member_social_icon_row2' . $x,
					'parent' => $social_icon_group
				)
			);
			
			academist_elated_create_meta_box_field(
				array(
					'type'            => 'textsimple',
					'label'           => esc_html__( 'Link', 'academist-core' ),
					'name'            => 'eltdf_team_member_social_icon_' . $x . '_link',
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'eltdf_team_member_social_icon_pack_'. $x  => ''
						)
					)
				)
			);
			
			academist_elated_create_meta_box_field(
				array(
					'type'            => 'selectsimple',
					'label'           => esc_html__( 'Target', 'academist-core' ),
					'name'            => 'eltdf_team_member_social_icon_' . $x . '_target',
					'options'         => academist_elated_get_link_target_array(),
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'eltdf_team_member_social_icon_' . $x . '_link'  => ''
						)
					)
				)
			);
		}
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_core_map_team_single_meta', 46 );
}