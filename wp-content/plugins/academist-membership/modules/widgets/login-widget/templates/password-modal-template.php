<div class="eltdf-password-holder eltdf-modal-holder" data-modal="password">
    <div class="eltdf-password-content eltdf-modal-content">
        <div class="eltdf-reset-pass-content-inner eltdf-modal-content-inner" id="eltdf-reset-pass-content">
            <h3><?php esc_html_e("Reset Password", "eltdf-membership") ?></h3>
            <div class="eltdf-wp-reset-pass-holder">
                <?php echo academist_membership_execute_shortcode( 'eltdf_user_reset_password', array() ) ?>
            </div>
        </div>
    </div>
</div>