<?php
/**
 * Functions for Google login
 */

if (!function_exists('academist_membership_get_google_social_login')) {
    /**
     * Render form for google login
     */
    function academist_membership_get_google_social_login() {

        $social_login_enabled = academist_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
        $google_login_enabled = academist_elated_options()->getOptionValue('enable_google_social_login') == 'yes' ? true : false;
        $enabled = ($social_login_enabled && $google_login_enabled) ? true : false;

        if (!is_user_logged_in() && $enabled) {
            $html = '<form class="eltdf-google-login-holder">'
                . wp_nonce_field('eltdf_validate_googleplus_login', 'eltdf_nonce_google_login_' . rand(), true, false) .
                academist_elated_get_button_html(array(
                    'html_type'        => 'button',
                    'button_arrow'        => 'no',
                    'custom_class'     => 'eltdf-google-login',
                    'icon_pack'        => 'font_elegant',
                    'fe_icon'          => 'social_googleplus',
                    'size'             => 'small',
                    'text'             => 'GOOOGLE +',
                    'color'            => '#d62d20',
                    'background_color' => '#fff',
                    'hover_background_color' => '#d62d20',
                    'hover_border_color'     => '#d62d20',
                    'hover_color'            => '#fff'
                )) .
                '</form>';
            print $html;
        }
    }

    add_action('academist_membership_social_network_login', 'academist_membership_get_google_social_login');
}

if (!function_exists('academist_membership_check_google_user')) {
    /**
     * Function for getting google user data.
     * Checks for user mail and register or log in user
     */
    function academist_membership_check_google_user() {

        if (isset($_POST['response'])) {
            $response = $_POST['response'];
            $user_email = $response['email'];
            $network = 'googleplus';
            $response['network'] = $network;
            $nonce = $response['nonce'];

            if (email_exists($user_email)) {
                //User already exist, log in user
                academist_membership_login_user_from_social_network($user_email, $nonce, $network);
            } else {
                //Register new user
                academist_membership_register_user_from_social_network($response);
            }
            $url = academist_membership_get_dashboard_page_url();
            if ($url == '') {
                $url = esc_url(home_url('/'));
            }
            academist_membership_ajax_response('success', esc_html__('Login successful, redirecting...', 'academist-membership'), $url);
        }

        wp_die();
    }

    add_action('wp_ajax_academist_membership_check_google_user', 'academist_membership_check_google_user');
    add_action('wp_ajax_nopriv_academist_membership_check_google_user', 'academist_membership_check_google_user');
}