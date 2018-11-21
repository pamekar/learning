<div class="eltdf-social-login-holder">
    <div class="eltdf-social-login-holder-inner">
        <form method="post" class="eltdf-login-form">
            <?php
            $redirect = '';
            if ( isset( $_GET['redirect_uri'] ) ) {
                $redirect = $_GET['redirect_uri'];
            } ?>
            <fieldset>
                <div>
                    <label><?php esc_html_e( 'Username*', 'academist-membership' ); ?></label>
                    <input type="text" name="user_login_name" id="user_login_name" value="" required pattern=".{3,}" title="<?php esc_attr_e( 'Three or more characters', 'academist-membership' ); ?>"/>
                </div>
                <div>
                    <label><?php esc_html_e( 'Password*', 'academist-membership' ); ?></label>
                    <input type="password" name="user_login_password" id="user_login_password" value="" required/>
                </div>
                <div class="eltdf-lost-pass-remember-holder clearfix">
                    <div class="eltdf-remember-holder">
                            <span class="eltdf-login-remember">
                                <input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
                                <label for="rememberme" class="eltdf-checbox-label"><?php esc_html_e( 'Remember me', 'academist-membership' ) ?></label>
                            </span>
                    </div>
                    <div class="eltdf-lost-pass-holder">
                        <a href="#" class="eltdf-modal-opener" data-modal="password"><?php esc_html_e( 'Forgot your password?', 'academist-membership' ); ?></a>
                    </div>
                </div>
                <input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( $redirect ); ?>">
                <div class="eltdf-login-button-holder">
                    <?php
                    if ( academist_membership_theme_installed() ) {
                        echo academist_elated_get_button_html( array(
                            'html_type' => 'button',
                            'text'      => esc_html__( 'Login', 'academist-membership' ),
                            'type'      => 'solid',
                            'size'      => 'small'
                        ) );
                    } else {
                        echo '<button type="submit">' . esc_html__( 'Login', 'academist-membership' ) . '</button>';
                    }
                    ?>
                    <?php wp_nonce_field( 'eltdf-ajax-login-nonce', 'eltdf-login-security' ); ?>
                </div>
                <div class="eltdf-register-link-holder">
                        <span class="eltdf-register-label">
                            <?php esc_html_e( 'Not a member yet?', 'academist-membership' ); ?>
                        </span>
                    <a href="#" class="eltdf-modal-opener" data-modal="register"><?php esc_html_e( 'Register Now', 'academist-membership' ); ?></a>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
    if(academist_membership_theme_installed()) {
        //if social login enabled add social networks login
        $social_login_enabled = academist_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
        if($social_login_enabled) { ?>
            <div class="eltdf-login-form-social-login">
                <div class="eltdf-login-social-title">
                    <?php esc_html_e('Recommended: Connect with Social Networks!', 'academist-membership'); ?>
                </div>
                <div class="eltdf-login-social-networks">
                    <?php do_action('academist_membership_social_network_login'); ?>
                </div>
            </div>
        <?php }
    }
    do_action( 'academist_membership_action_login_ajax_response' );
    ?>
</div>