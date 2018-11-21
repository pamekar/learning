<div class="eltdf-social-register-holder">
	<form method="post" class="eltdf-register-form">
		<fieldset>
			<div>
                <label><?php esc_html_e( 'Username*', 'academist-membership' ); ?></label>
				<input type="text" name="user_register_name" id="user_register_name" value="" required
				       pattern=".{3,}" title="<?php esc_attr_e( 'Three or more characters', 'academist-membership' ); ?>"/>
			</div>
			<div>
                <label><?php esc_html_e( 'Email*', 'academist-membership' ); ?></label>
				<input type="email" name="user_register_email" id="user_register_email" value="" required />
			</div>
            <div>
                <label><?php esc_html_e( 'Password*', 'academist-membership' ); ?></label>
                <input type="password" name="user_register_password" id="user_register_password" value="" required />
            </div>
            <div>
                <label><?php esc_html_e( 'Repeat Password*', 'academist-membership' ); ?></label>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password"  value="" required />
            </div>
            <?php do_action('academist_membership_additional_registration_field'); ?>
			<div class="eltdf-register-button-holder">
				<?php
				if ( academist_membership_theme_installed() ) {
					echo academist_elated_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'Register', 'academist-membership' ),
						'type'      => 'solid',
						'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'Register', 'academist-membership' ) . '</button>';
				}
				wp_nonce_field( 'eltdf-ajax-register-nonce', 'eltdf-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'academist_membership_action_login_ajax_response' ); ?>
</div>