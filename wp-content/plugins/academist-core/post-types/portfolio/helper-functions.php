<?php

if ( ! function_exists( 'academist_core_portfolio_meta_box_functions' ) ) {
	function academist_core_portfolio_meta_box_functions( $post_types ) {
		$post_types[] = 'portfolio-item';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_meta_box_post_types_save', 'academist_core_portfolio_meta_box_functions' );
	add_filter( 'academist_elated_filter_meta_box_post_types_remove', 'academist_core_portfolio_meta_box_functions' );
}

if ( ! function_exists( 'academist_core_portfolio_scope_meta_box_functions' ) ) {
	function academist_core_portfolio_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'portfolio-item';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_set_scope_for_meta_boxes', 'academist_core_portfolio_scope_meta_box_functions' );
}

if ( ! function_exists( 'academist_core_portfolio_add_social_share_option' ) ) {
	function academist_core_portfolio_add_social_share_option( $container ) {
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_portfolio_item',
				'default_value' => 'no',
				'label'         => esc_html__( 'Portfolio Item', 'academist-core' ),
				'description'   => esc_html__( 'Show Social Share for Portfolio Items', 'academist-core' ),
				'parent'        => $container
			)
		);
	}
	
	add_action( 'academist_elated_action_post_types_social_share', 'academist_core_portfolio_add_social_share_option', 10, 1 );
}

if ( ! function_exists( 'academist_core_register_portfolio_cpt' ) ) {
	function academist_core_register_portfolio_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'AcademistCore\CPT\Portfolio\PortfolioRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'academist_core_filter_register_custom_post_types', 'academist_core_register_portfolio_cpt' );
}

if ( ! function_exists( 'academist_core_get_archive_portfolio_list' ) ) {
	function academist_core_get_archive_portfolio_list( $academist_taxonomy_slug = '', $academist_taxonomy_name = '' ) {
		
		$number_of_items        = 12;
		$number_of_items_option = academist_elated_options()->getOptionValue( 'portfolio_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}
		
		$number_of_columns        = 'four';
		$number_of_columns_option = academist_elated_options()->getOptionValue( 'portfolio_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}
		
		$space_between_items        = 'normal';
		$space_between_items_option = academist_elated_options()->getOptionValue( 'portfolio_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}
		
		$image_size        = 'landscape';
		$image_size_option = academist_elated_options()->getOptionValue( 'portfolio_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}
		
		$item_style        = 'standard-shader';
		$item_layout_option = academist_elated_options()->getOptionValue( 'portfolio_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_style = $item_layout_option;
		}
		
		$category = $academist_taxonomy_name === 'portfolio-category' && ! empty( $academist_taxonomy_slug ) ? $academist_taxonomy_slug : '';
		$tag      = $academist_taxonomy_name === 'portfolio-tag' && ! empty( $academist_taxonomy_slug ) ? $academist_taxonomy_slug : '';
		
		$params = array(
			'type'                => 'gallery',
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items,
			'image_proportions'   => $image_size,
			'category'            => $category,
			'tag'                 => $tag,
			'item_style'         => $item_style,
			'pagination_type'     => 'load-more'
		);
		
		$html = academist_elated_execute_shortcode( 'eltdf_portfolio_list', $params );
		
		print $html;
	}
}

// Load portfolio shortcodes
if ( ! function_exists( 'academist_core_include_portfolio_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function academist_core_include_portfolio_shortcodes_files() {
		foreach ( glob( ACADEMIST_CORE_CPT_PATH . '/portfolio/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'academist_core_action_include_shortcodes_file', 'academist_core_include_portfolio_shortcodes_files' );
}

if ( ! function_exists( 'academist_core_set_portfolio_single_info_follow_body_class' ) ) {
	/**
	 * Function that adds follow portfolio info class to body if sticky sidebar is enabled on portfolio single layouts
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with follow portfolio info class body class added
	 */
	function academist_core_set_portfolio_single_info_follow_body_class( $classes ) {
		if ( is_singular( 'portfolio-item' ) && academist_elated_options()->getOptionValue( 'portfolio_single_sticky_sidebar' ) == 'yes' ) {
			$classes[] = 'eltdf-follow-portfolio-info';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_core_set_portfolio_single_info_follow_body_class' );
}

if ( ! function_exists( 'academist_core_single_portfolio_title_display' ) ) {
	/**
	 * Function that checks option for single portfolio title and overrides it with filter
	 */
	function academist_core_single_portfolio_title_display( $show_title_area ) {
		if ( is_singular( 'portfolio-item' ) ) {
			//Override displaying title based on portfolio option
			$show_title_area_meta = academist_elated_get_meta_field_intersect( 'show_title_area_portfolio_single' );
			
			if ( ! empty( $show_title_area_meta ) ) {
				$show_title_area = $show_title_area_meta == 'yes' ? true : false;
			}
		}
		
		return $show_title_area;
	}
	
	add_filter( 'academist_elated_filter_show_title_area', 'academist_core_single_portfolio_title_display' );
}

if ( ! function_exists( 'academist_core_set_breadcrumbs_output_for_portfolio' ) ) {
	function academist_core_set_breadcrumbs_output_for_portfolio( $childContent, $delimiter, $before, $after ) {
		
		if ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tag' ) ) {
			$childContent = '';
			
			$academist_taxonomy_id        = get_queried_object_id();
			$academist_taxonomy_type      = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$academist_taxonomy           = ! empty( $academist_taxonomy_id ) ? get_term_by( 'id', $academist_taxonomy_id, $academist_taxonomy_type ) : '';
			$academist_taxonomy_parent_id = isset( $academist_taxonomy->parent ) && $academist_taxonomy->parent !== 0 ? $academist_taxonomy->parent : '';
			$academist_taxonomy_parent    = $academist_taxonomy_parent_id !== '' ? get_term_by( 'id', $academist_taxonomy_parent_id, $academist_taxonomy_type ) : '';
		
			if ( ! empty( $academist_taxonomy_parent ) ) {
				$childContent .= '<a itemprop="url" href="' . get_term_link( $academist_taxonomy_parent->term_id ) . '">' . $academist_taxonomy_parent->name . '</a>' . $delimiter;
			}
			
			if ( ! empty( $academist_taxonomy ) ) {
				$childContent .= $before . esc_attr( $academist_taxonomy->name ) . $after;
			}
			
		} elseif ( is_singular( 'portfolio-item' ) ) {
			$portfolio_categories = wp_get_post_terms( academist_elated_get_page_id(), 'portfolio-category' );
			$childContent         = '';
			
			if ( ! empty( $portfolio_categories ) && count( $portfolio_categories ) ) {
				foreach ( $portfolio_categories as $cat ) {
					$childContent .= '<a itemprop="url" href="' . get_term_link( $cat->term_id ) . '">' . $cat->name . '</a>' . $delimiter;
				}
			}
			
			$childContent .= $before . get_the_title() . $after;
		}
		
		return $childContent;
	}
	
	add_filter( 'academist_elated_filter_breadcrumbs_title_child_output', 'academist_core_set_breadcrumbs_output_for_portfolio', 10, 4 );
}

if ( ! function_exists( 'academist_core_set_single_portfolio_comments_enabled' ) ) {
	function academist_core_set_single_portfolio_comments_enabled( $comments ) {
		if ( is_singular( 'portfolio-item' ) && academist_elated_options()->getOptionValue( 'portfolio_single_comments' ) == 'yes' ) {
			$comments = true;
		}
		
		return $comments;
	}
	
	add_filter( 'academist_elated_filter_post_type_comments', 'academist_core_set_single_portfolio_comments_enabled', 10, 1 );
}

if ( ! function_exists( 'academist_core_get_single_portfolio' ) ) {
	function academist_core_get_single_portfolio() {
		$portfolio_template = academist_elated_get_meta_field_intersect( 'portfolio_single_template' );
		
		$params = array(
			'holder_classes' => 'eltdf-ps-' . $portfolio_template . '-layout',
			'item_layout'    => $portfolio_template
		);
		
		academist_core_get_cpt_single_module_template_part( 'templates/single/holder', 'portfolio', $portfolio_template, $params );
	}
}

if ( ! function_exists( 'academist_core_set_single_portfolio_style' ) ) {
	/**
	 * Function that return padding for content
	 */
	function academist_core_set_single_portfolio_style( $style ) {
		$page_id      = academist_elated_get_page_id();
		$class_prefix = academist_elated_get_unique_page_class( $page_id );
		
		$current_styles = '';
		$current_style  = array();
		
		$current_selector = array(
			$class_prefix . ' .eltdf-portfolio-single-holder .eltdf-ps-info-holder'
		);
		
		$info_padding_top = get_post_meta( $page_id, 'portfolio_info_top_padding', true );
		
		if ( ! empty( $info_padding_top ) ) {
			$current_style['margin-top'] = academist_elated_filter_px( $info_padding_top ) . 'px';
			
			$current_styles .= academist_elated_dynamic_css( $current_selector, $current_style );
		}
		
		$current_style = $current_styles . $style;
		
		return $current_style;
	}
	
	add_filter( 'academist_elated_filter_add_page_custom_style', 'academist_core_set_single_portfolio_style' );
}

if ( ! function_exists( 'academist_core_add_portfolio_attachment_custom_field' ) ) {
	function academist_core_add_portfolio_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'portfolio_single_masonry_image_size', true );
			
			$form_fields['portfolio_single_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'academist-core' ),
				'helps' => esc_html__( 'Choose image size for portfolio single item - Masonry layout', 'academist-core' )
			);
			
			$form_fields['portfolio_single_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][portfolio_single_masonry_image_size]'>";
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, '', false ) . ' value="">' . esc_html__( 'Default', 'academist-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'small', false ) . ' value="small">' . esc_html__( 'Small', 'academist-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-width', false ) . ' value="large-width">' . esc_html__( 'Large Width', 'academist-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-height', false ) . ' value="large-height">' . esc_html__( 'Large Height', 'academist-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-width-height', false ) . ' value="large-width-height">' . esc_html__( 'Large Width Height', 'academist-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '</select>';
		}
		
		return $form_fields;
	}
	
	add_filter( 'attachment_fields_to_edit', 'academist_core_add_portfolio_attachment_custom_field', 10, 2 );
}

if ( ! function_exists( 'academist_core_save_image_portfolio_attachment_fields' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function academist_core_save_image_portfolio_attachment_fields( $post, $attachment ) {
		
		if ( isset( $attachment['portfolio_single_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'portfolio_single_masonry_image_size', $attachment['portfolio_single_masonry_image_size'] );
		}
		
		return $post;
	}
	
	add_filter( 'attachment_fields_to_save', 'academist_core_save_image_portfolio_attachment_fields', 10, 2 );
}

if ( ! function_exists( 'academist_core_get_portfolio_single_media' ) ) {
	/*
     * @param boolean $masonry - set it manually when calling function from port single masonry templates,
     *                           used to crop images only for port single masonry layouts
     */
	function academist_core_get_portfolio_single_media($masonry = false) {
		$image_ids       = get_post_meta( get_the_ID(), 'eltdf-portfolio-image-gallery', true );
		$single_upload   = get_post_meta( get_the_ID(), 'eltdf_portfolio_single_upload', true );
		$portfolio_media = array();
		
		if ( $image_ids !== '' ) {
			$image_ids = explode( ',', $image_ids );
			
			foreach ( $image_ids as $image_id ) {
				$media                   = array();
				$media['title']          = get_the_title( $image_id );
				$media['type']           = 'image';
				$media['description']    = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$media['image_src']      = wp_get_attachment_image_src( $image_id, 'full' );
				$media['holder_classes'] = '';
				
				$image_size = get_post_meta( $image_id, 'portfolio_single_masonry_image_size', true );

				// if image size for port single masonry layout is set and function is called from masonry layout template
				if ( ! empty ( $image_size ) && $masonry === true ) {
					switch ( $image_size ) {
						case 'small':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'academist_elated_image_square' );
							break;
						case 'large-width':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'academist_elated_image_landscape' );
							break;
						case 'large-height':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'academist_elated_image_portrait' );
							break;
						case 'large-width-height':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'academist_elated_image_huge' );
							break;
					}
					
					$media['holder_classes'] = 'eltdf-masonry-size-' . esc_attr( $image_size );
				}
				
				$portfolio_media[] = $media;
			}
		}
		
		if ( is_array( $single_upload ) && count( $single_upload ) ) {
			foreach ( $single_upload as $item ) {
				$media = array();
				
				if ( $item['file_type'] == 'video' ) {
					$media['type']        = $item['video_type'];
					$media['description'] = 'video';
					$media['video_url']   = academist_core_get_portfolio_video_url( $item );
					
					if ( $item['video_type'] == 'self' ) {
						$media['video_cover'] = ! empty( $item['video_cover_image'] ) ? $item['video_cover_image'] : '';
					}
					
					if ( $item['video_type'] !== 'self' ) {
						$media['video_id'] = $item['video_id'];
					}
				} elseif ( $item['file_type'] == 'image' ) {
					$media['type']      = 'image';
					$media['image_src'] = $item['single_image'];
				}

				//fallback if description is not set for media
				$media['title'] = get_the_title();
				
				$portfolio_media[] = $media;
			}
		}
		
		return $portfolio_media;
	}
}

if ( ! function_exists( 'academist_core_get_portfolio_video_url' ) ) {
	function academist_core_get_portfolio_video_url( $video ) {
		switch ( $video['video_type'] ) {
			case 'youtube':
				return 'https://youtube.com/watch?v=' . $video['video_id'];
				break;
			case 'vimeo';
				return 'https://vimeo.com/' . $video['video_id'];
				break;
			case 'self':
				$return_array = array();
				
				if ( ! empty( $video['video_mp4'] ) ) {
					$return_array['mp4'] = $video['video_mp4'];
				}
				
				return $return_array;
				
				break;
		}
	}
}

if ( ! function_exists( 'academist_core_get_portfolio_single_media_html' ) ) {
	function academist_core_get_portfolio_single_media_html( $media ) {
		$params = array();
		
		if ( $media['type'] == 'image' ) {
			$params['lightbox'] = academist_elated_options()->getOptionValue( 'portfolio_single_lightbox_images' ) == 'yes';
			
			$media['image_url'] = is_array( $media['image_src'] ) ? $media['image_src'][0] : $media['image_src'];
			if ( empty( $media['description'] ) ) {
				$media['description'] = $media['title'];
			}
		}
		
		if ( in_array( $media['type'], array( 'youtube', 'vimeo' ) ) ) {
			$params['lightbox'] = academist_elated_options()->getOptionValue( 'portfolio_single_lightbox_videos' ) == 'yes';
			
			if ( $params['lightbox'] ) {
				switch ( $media['type'] ) {
					case 'vimeo':
						$url      = 'https://vimeo.com/api/v2/video/' . $media['video_id'] . '.php';
						$request  = wp_remote_get($url);
						$response = unserialize( wp_remote_retrieve_body( $request ) );
						
						$params['video_title']    = $response[0]['title'];
						$params['lightbox_thumb'] = $response[0]['thumbnail_large'];
						break;
					case 'youtube':
						$params['video_title'] = $media['title'];
						
						$params['lightbox_thumb'] = 'http://img.youtube.com/vi/' . trim( $media['video_id'] ) . '/sddefault.jpg';
						break;
				}
			}
		}
		
		$params['media'] = $media;
		
		academist_core_get_cpt_single_module_template_part( 'templates/single/media/' . $media['type'], 'portfolio', '', $params );
	}
}

if ( ! function_exists( 'academist_core_get_portfolio_single_related_posts' ) ) {
	/**
	 * Function for returning portfolio single related posts
	 *
	 * @param $post_id
	 *
	 * @return WP_Query
	 */
	function academist_core_get_portfolio_single_related_posts( $post_id ) {
		//Get tags
		$tags = wp_get_object_terms( $post_id, 'portfolio-tag' );
		
		//Get categories
		$categories = wp_get_object_terms( $post_id, 'portfolio-category' );
		
		$tag_ids = array();
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}
		}
		
		$category_ids = array();
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$category_ids[] = $category->term_id;
			}
		}
		
		$hasRelatedByTag = false;
		
		if ( $tag_ids ) {
			$related_by_tag = academist_core_get_portfolio_single_related_posts_by_param( $post_id, $tag_ids, 'portfolio-tag' );
			
			if ( ! empty( $related_by_tag->posts ) ) {
				$hasRelatedByTag = true;
				
				return $related_by_tag;
			}
		}
		
		if ( $categories && ! $hasRelatedByTag ) {
			$related_by_category = academist_core_get_portfolio_single_related_posts_by_param( $post_id, $category_ids, 'portfolio-category' );
			
			if ( ! empty( $related_by_category->posts ) ) {
				return $related_by_category;
			}
		}
	}
}

if ( ! function_exists( 'academist_core_get_portfolio_single_related_posts_by_param' ) ) {
	/**
	 * @param $post_id - Post ID
	 * @param $term_ids - Category or Tag IDs
	 * @param $taxonomy
	 *
	 * @return WP_Query
	 */
	function academist_core_get_portfolio_single_related_posts_by_param( $post_id, $term_ids, $taxonomy ) {
		$args = array(
			'post_status'    => 'publish',
			'post__not_in'   => array( $post_id ),
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => '4',
			'tax_query'      => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $term_ids,
				),
			)
		);
		
		$related_by_taxonomy = new WP_Query( $args );
		
		return $related_by_taxonomy;
	}
}

if ( ! function_exists( 'academist_core_add_portfolio_to_search_types' ) ) {
	function academist_core_add_portfolio_to_search_types( $post_types ) {
		
		$post_types['portfolio-item'] = esc_html__( 'Portfolio', 'academist-core' );
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_search_post_type_widget_params_post_type', 'academist_core_add_portfolio_to_search_types' );
}

/**
 * Loads more function for portfolio.
 */
if ( ! function_exists( 'academist_core_portfolio_ajax_load_more' ) ) {
	function academist_core_portfolio_ajax_load_more() {
		$shortcode_params = array();
		
		if ( ! empty( $_POST ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key !== '' ) {
					$addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
					$setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );
					
					$shortcode_params[ $setAllLettersToLowercase ] = $value;
				}
			}
		}
		
		$port_list = new \AcademistCore\CPT\Shortcodes\Portfolio\PortfolioList();
		
		$query_array                     = $port_list->getQueryArray( $shortcode_params );
		$query_results                   = new \WP_Query( $query_array );
		$shortcode_params['this_object'] = $port_list;
		
		$html = '';
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$html .= academist_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'portfolio-item', $shortcode_params['item_type'], $shortcode_params );
			endwhile;
		else:
			$html .= academist_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/posts-not-found', '', $shortcode_params );
		endif;
		
		wp_reset_postdata();
		
		$return_obj = array(
			'html' => $html,
		);
		
		echo json_encode( $return_obj );
		exit;
	}
}

add_action( 'wp_ajax_nopriv_academist_core_portfolio_ajax_load_more', 'academist_core_portfolio_ajax_load_more' );
add_action( 'wp_ajax_academist_core_portfolio_ajax_load_more', 'academist_core_portfolio_ajax_load_more' );

if (!function_exists('academist_core_admin_filter_taxonomies')) {
    /*
     * add taxonomy filters in admin portfolio list
     */
    function academist_core_admin_filter_taxonomies() {
        global $typenow;

        // an array of all the taxonomies to display
        $taxonomies = array('portfolio-category', 'portfolio-tag');

        // use the custom post type here
        if ($typenow === 'portfolio-item') {
            foreach ($taxonomies as $taxonomy) {
                $taxonomy_obj = get_taxonomy($taxonomy);
                wp_dropdown_categories(array(
                    'show_option_all' => sprintf(__('All %s', 'academist-core'), $taxonomy_obj->label),
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => true,
                    'hide_if_empty' => true,
                    'selected' => filter_input(INPUT_GET, $taxonomy_obj->query_var, FILTER_SANITIZE_STRING),
                    'hierarchical' => true,
                    'name' => $taxonomy_obj->query_var,
                    'taxonomy' => $taxonomy_obj->name,
                    'value_field' => 'slug',
                ));
            }
        }
    }

    add_action('restrict_manage_posts', 'academist_core_admin_filter_taxonomies');
}