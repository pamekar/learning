<div class="eltdf-login-holder eltdf-modal-holder" data-modal="login">
    <div class="eltdf-login-content eltdf-modal-content">
        <div class="eltdf-login-content-inner eltdf-modal-content-inner">
            <h3><?php esc_html_e("User login", "academist-membership") ?></h3>
            <div class="eltdf-wp-login-holder">
                <div class="eltdf-wp-login-holder"><?php echo academist_membership_execute_shortcode( 'eltdf_user_login', array() ); ?></div>
            </div>
        </div>
    </div>
</div>