<ul class="eltdf-membership-dashboard-nav clearfix">
	<?php
	$nav_items = academist_membership_get_dashboard_navigation_items();
	$user_action = isset($_GET['user-action']) ? $_GET['user-action'] : 'profile';
	foreach ( $nav_items as $nav_item ) { ?>
		<li <?php if($user_action == $nav_item['user_action']){ echo 'class="eltdf-active-dash"'; } ?>>
			<a href="<?php echo esc_url($nav_item['url']); ?>">
                <?php if(isset($nav_item['icon'])){ ?>
<!--                    <span class="eltdf-dash-icon">-->
<!--						--><?php //print $nav_item['icon']; ?>
<!--					</span>-->
                <?php } ?>
                <span class="eltdf-dash-label">
				    <?php echo esc_attr($nav_item['text']); ?>
                </span>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>">
<!--             <span class="eltdf-dash-icon">-->
<!--                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>-->
<!--            </span>-->
			<?php esc_html_e( 'Log out', 'academist-membership' ); ?>
		</a>
	</li>
</ul>