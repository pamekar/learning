<?php

if ( ! function_exists( 'academist_elated_social_options_map' ) ) {
	function academist_elated_social_options_map() {

	    $page = '_social_page';
		
		academist_elated_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social Networks', 'academist' ),
				'icon'  => 'fa fa-share-alt'
			)
		);
		
		/**
		 * Enable Social Share
		 */
		$panel_social_share = academist_elated_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_social_share',
				'title' => esc_html__( 'Enable Social Share', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Social Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'academist' ),
				'parent'        => $panel_social_share
			)
		);
		
		$panel_show_social_share_on = academist_elated_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_show_social_share_on',
				'title'           => esc_html__( 'Show Social Share On', 'academist' ),
				'dependency' => array(
					'show' => array(
						'enable_social_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_post',
				'default_value' => 'no',
				'label'         => esc_html__( 'Posts', 'academist' ),
				'description'   => esc_html__( 'Show Social Share on Blog Posts', 'academist' ),
				'parent'        => $panel_show_social_share_on
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_page',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pages', 'academist' ),
				'description'   => esc_html__( 'Show Social Share on Pages', 'academist' ),
				'parent'        => $panel_show_social_share_on
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
		do_action('academist_elated_action_post_types_social_share', $panel_show_social_share_on);
		
		/**
		 * Social Share Networks
		 */
		$panel_social_networks = academist_elated_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_social_networks',
				'title'           => esc_html__( 'Social Networks', 'academist' ),
				'dependency' => array(
					'hide' => array(
						'enable_social_share'  => 'no'
					)
				)
			)
		);
		
		/**
		 * Facebook
		 */
		academist_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'facebook_title',
				'title'  => esc_html__( 'Share on Facebook', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Facebook', 'academist' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_facebook_share_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_facebook_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_facebook_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'facebook_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'academist' ),
				'parent'        => $enable_facebook_share_container
			)
		);
		
		/**
		 * Twitter
		 */
		academist_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'twitter_title',
				'title'  => esc_html__( 'Share on Twitter', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_twitter_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Twitter', 'academist' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_twitter_share_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_twitter_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_twitter_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'twitter_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'academist' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'twitter_via',
				'default_value' => '',
				'label'         => esc_html__( 'Via', 'academist' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		/**
		 * Google Plus
		 */
		academist_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'google_plus_title',
				'title'  => esc_html__( 'Share on Google Plus', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_google_plus_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Google Plus', 'academist' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_google_plus_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_google_plus_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_google_plus_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'google_plus_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'academist' ),
				'parent'        => $enable_google_plus_container
			)
		);
		
		/**
		 * Linked In
		 */
		academist_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'linkedin_title',
				'title'  => esc_html__( 'Share on LinkedIn', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_linkedin_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'academist' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_linkedin_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_linkedin_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_linkedin_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'linkedin_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'academist' ),
				'parent'        => $enable_linkedin_container
			)
		);
		
		/**
		 * Tumblr
		 */
		academist_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'tumblr_title',
				'title'  => esc_html__( 'Share on Tumblr', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_tumblr_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'academist' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_tumblr_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_tumblr_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_tumblr_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'tumblr_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'academist' ),
				'parent'        => $enable_tumblr_container
			)
		);
		
		/**
		 * Pinterest
		 */
		academist_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'pinterest_title',
				'title'  => esc_html__( 'Share on Pinterest', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_pinterest_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'academist' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_pinterest_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_pinterest_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_pinterest_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'pinterest_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'academist' ),
				'parent'        => $enable_pinterest_container
			)
		);
		
		/**
		 * VK
		 */
		academist_elated_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'vk_title',
				'title'  => esc_html__( 'Share on VK', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_vk_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via VK', 'academist' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_vk_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_vk_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_vk_share'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'vk_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'academist' ),
				'parent'        => $enable_vk_container
			)
		);
		
		if ( defined( 'ACADEMIST_TWITTER_FEED_VERSION' ) ) {
			$twitter_panel = academist_elated_add_admin_panel(
				array(
					'title' => esc_html__( 'Twitter', 'academist' ),
					'name'  => 'panel_twitter',
					'page'  => '_social_page'
				)
			);
			
			academist_elated_add_admin_twitter_button(
				array(
					'name'   => 'twitter_button',
					'parent' => $twitter_panel
				)
			);
		}
		
		if ( defined( 'ACADEMIST_INSTAGRAM_FEED_VERSION' ) ) {
			$instagram_panel = academist_elated_add_admin_panel(
				array(
					'title' => esc_html__( 'Instagram', 'academist' ),
					'name'  => 'panel_instagram',
					'page'  => '_social_page'
				)
			);
			
			academist_elated_add_admin_instagram_button(
				array(
					'name'   => 'instagram_button',
					'parent' => $instagram_panel
				)
			);
		}
		
		/**
		 * Open Graph
		 */
		$panel_open_graph = academist_elated_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_open_graph',
				'title' => esc_html__( 'Open Graph', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_open_graph',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Open Graph', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will allow usage of Open Graph protocol on your site', 'academist' ),
				'parent'        => $panel_open_graph
			)
		);
		
		$enable_open_graph_container = academist_elated_add_admin_container(
			array(
				'name'            => 'enable_open_graph_container',
				'parent'          => $panel_open_graph,
				'dependency' => array(
					'show' => array(
						'enable_open_graph'  => 'yes'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'open_graph_image',
				'default_value' => ELATED_ASSETS_ROOT . '/img/open_graph.jpg',
				'label'         => esc_html__( 'Default Share Image', 'academist' ),
				'parent'        => $enable_open_graph_container,
				'description'   => esc_html__( 'Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'academist' ),
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
        do_action('academist_elated_action_social_options', $page);
	}
	
	add_action( 'academist_elated_action_options_map', 'academist_elated_social_options_map', academist_elated_set_options_map_position( 'social' ) );
}