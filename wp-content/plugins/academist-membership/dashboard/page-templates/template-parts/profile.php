<div class="eltdf-membership-dashboard-page">
	<div class="eltdf-membership-dashboard-page-content">
		<div class="eltdf-profile-image">
            <?php echo academist_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First name', 'academist-membership' ); ?>:</span>
			<?php echo esc_attr($first_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last name', 'academist-membership' ); ?>:</span>
			<?php echo esc_attr($last_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'academist-membership' ); ?>:</span>
			<?php echo esc_attr($email); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'academist-membership' ); ?>:</span>
			<?php echo esc_attr($description); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'academist-membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_url($website); ?></a>
		</p>
	</div>
</div>
