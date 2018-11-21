<div class="eltdf-register-holder eltdf-modal-holder" data-modal="register">
    <div class="eltdf-register-content eltdf-modal-content">
        <div class="eltdf-register-content-inner eltdf-modal-content-inner" id="eltdf-register-content">
            <h3><?php esc_html_e("User registration", "eltdf-membership") ?></h3>
            <div class="eltdf-wp-register-holder">
                <?php echo academist_membership_execute_shortcode( 'eltdf_user_register', array() ) ?>
            </div>
        </div>
    </div>
</div>