<?php
$current_user    = wp_get_current_user();
$name            = $current_user->display_name;
$current_user_id = $current_user->ID;
?>
<div class="eltdf-logged-in-user">
    <div class="eltdf-logged-in-user-inner">
        <span>
            <?php if ( academist_membership_theme_installed() ) {
                $profile_image = get_user_meta( $current_user_id, 'social_profile_image', true );
                if ( $profile_image == '' ) {
                    $profile_image = get_avatar( $current_user_id, 28 );
                } else {
                    $profile_image = '<img src="' . esc_url( $profile_image ) . '" />';
                }
                echo academist_membership_kses_img( $profile_image );
            } ?>
            <span class="eltdf-logged-in-user-name"><?php echo esc_html( $name ); ?></span>
        </span>
    </div>
</div>
<ul class="eltdf-login-dropdown">
	<?php
	$nav_items = academist_membership_get_dashboard_navigation_items();
	foreach ( $nav_items as $nav_item ) { ?>
		<li>
			<a href="<?php echo esc_url($nav_item['url']); ?>">
                <span class="eltdf-login-dropdown-item-inner">
				    <?php echo esc_attr($nav_item['text']); ?>
                </span>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>">
            <span class="eltdf-login-dropdown-item-inner">
			    <?php esc_html_e( 'Log Out', 'academist-membership' ); ?>
            </span>
		</a>
	</li>
</ul>