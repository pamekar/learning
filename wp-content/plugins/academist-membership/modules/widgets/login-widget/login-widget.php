<?php

class AcademistMembershipLoginRegister extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'eltdf_login_register_widget',
			esc_html__( 'Academist Login Widget', 'academist-membership' ),
			array( 'description' => esc_html__( 'Login and register membership widget', 'academist-membership' ) )
		);
	}

//    public function widget( $args, $instance ) {
//        $additional_class = is_user_logged_in() ? 'eltdf-user-logged-in' : 'eltdf-user-not-logged-in';
//
//        echo '<div class="widget eltdf-login-register-widget ' . esc_attr( $additional_class ) . '">';
//        if ( ! is_user_logged_in() ) {
//            echo academist_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template', 'logged-out' );
//        } else {
//            echo academist_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template', 'logged-in' );
//        }
//        echo '</div>';
//    }

    public function widget( $args, $instance ) {
        $additional_class = '';
        if ( is_user_logged_in() ) {
            $additional_class .= 'eltdf-user-logged-in';
        } else {
            $additional_class .= 'eltdf-user-not-logged-in';
        }

        echo '<div class="widget eltdf-login-register-widget ' . esc_attr( $additional_class ) . '">';
        if ( ! is_user_logged_in() ) {
            echo '<a href="#" class="eltdf-modal-opener eltdf-login-opener" data-modal="login">' . esc_html__( 'Login', 'academist-membership' ) . '</a>';
            echo '<a href="#" class="eltdf-modal-opener eltdf-register-opener" data-modal="register">' . esc_html__( 'Register', 'academist-membership' ) . '</a>';

            add_action( 'wp_footer', array( $this, 'eltdf_membership_render_login_form' ) );
            add_action( 'wp_footer', array( $this, 'eltdf_membership_render_register_form' ) );
            add_action( 'wp_footer', array( $this, 'eltdf_membership_render_password_form' ) );
        } else {
            echo academist_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template' );
        }
        echo '</div>';
    }

    public function eltdf_membership_render_login_form() {

        //Render modal with login and register forms
        echo academist_membership_get_module_template_part( 'widgets', 'login-widget', 'login-modal-template' );
    }

    public function eltdf_membership_render_register_form() {

        //Render modal with login and register forms
        echo academist_membership_get_module_template_part( 'widgets', 'login-widget', 'register-modal-template' );
    }

    public function eltdf_membership_render_password_form() {

        //Render modal with login and register forms
        echo academist_membership_get_module_template_part( 'widgets', 'login-widget', 'password-modal-template' );
    }
}

if ( ! function_exists( 'academist_membership_login_widget_load' ) ) {
	function academist_membership_login_widget_load() {
		register_widget( 'AcademistMembershipLoginRegister' );
	}
	
	add_action( 'widgets_init', 'academist_membership_login_widget_load' );
}

