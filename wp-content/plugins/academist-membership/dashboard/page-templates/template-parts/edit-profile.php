<?php 

if ( !function_exists('academist_membership_dashboard_edit_profile_fields') ) {
	function academist_membership_dashboard_edit_profile_fields($params){

		extract($params);

		$edit_profile = academist_elated_add_dashboard_fields(array(
			'name' => 'edit_profile',
		));

		$edit_profile_form = academist_elated_add_dashboard_form(array(
			'name' => 'edit_profile_form',
			'form_id'   => 'eltdf-membership-update-profile-form',
			'form_action' => 'academist_membership_update_user_profile',
			'parent' => $edit_profile,
			'button_label' => esc_html__('Update Profile','academist-membership'),
			'button_args' => array(
				'data-updating-text' => esc_html__('Updating Profile', 'academist-membership'),
				'data-updated-text' => esc_html__('Profile Updated', 'academist-membership'),
			)
		));

		$edit_profile_name_group = academist_elated_add_dashboard_group(array(
			'name' => 'edit_profile_name_group',
			'parent' => $edit_profile_form,
		));

		academist_elated_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'first_name',
			'label' => esc_html__('First Name','academist-membership'),
			'parent' => $edit_profile_name_group,
			'value' => $first_name
		));
		
		academist_elated_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'last_name',
			'label' => esc_html__('Last Name','academist-membership'),
			'parent' => $edit_profile_name_group,
			'value' => $last_name
		));

		academist_elated_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'email',
			'label' => esc_html__('Email','academist-membership'),
			'parent' => $edit_profile_form,
			'value' => $email,
			'args' => array(
				'input_type' => 'email'
			)
		));

		academist_elated_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'url',
			'label' => esc_html__('Website','academist-membership'),
			'parent' => $edit_profile_form,
			'value' => $website
		));

		academist_elated_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'description',
			'label' => esc_html__('Description','academist-membership'),
			'parent' => $edit_profile_form,
			'value' => $description
		));

		academist_elated_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'password',
			'label' => esc_html__('Password','academist-membership'),
			'parent' => $edit_profile_form,
			'args' => array(
				'input_type' => 'password'
			)
		));

		academist_elated_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'password2',
			'label' => esc_html__('Repeat Password','academist-membership'),
			'parent' => $edit_profile_form,
			'args' => array(
				'input_type' => 'password'
			)
		));

		$edit_profile->render();
	}
}
?>

<div class="eltdf-membership-dashboard-page">
	<div>
		<?php academist_membership_dashboard_edit_profile_fields($params); ?>
		<?php do_action( 'academist_membership_action_login_ajax_response' ); ?>
	</div>
</div>