<?php
get_header();
if ( academist_membership_theme_installed() ) {
    academist_elated_get_title();
} else { ?>
    <div class="eltdf-membership-title">
        <?php the_title( '<h1>', '</h1>' ); ?>
    </div>
<?php }
do_action('academist_elated_action_before_main_content');
?>
    <div class="eltdf-container">
        <?php do_action( 'academist_elated_after_container_open' ); ?>
        <div class="eltdf-container-inner clearfix">
            <div class="eltdf-membership-main-wrapper clearfix">
                <?php if ( is_user_logged_in() ) { ?>
                    <div class="eltdf-membership-dashboard-nav-holder clearfix">
                        <?php
                        //Include dashboard navigation
                        echo academist_membership_get_dashboard_template_part( 'navigation' );
                        ?>
                    </div>
                    <div class="eltdf-membership-dashboard-content-holder">
                        <?php echo academist_membership_get_dashboard_pages(); ?>
                    </div>
                <?php } else { ?>
                    <div class="eltdf-login-register-content eltdf-user-not-logged-in">
                        <h3><span><?php esc_html_e('User login', 'academist-membership') ?></span></h3>
                        <div class="eltdf-login-content-inner">
                            <div class="eltdf-wp-login-holder">
                                <?php echo academist_membership_execute_shortcode( 'eltdf_user_login', array() ); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php do_action( 'academist_elated_before_container_close' ); ?>
    </div>
<?php get_footer(); ?>