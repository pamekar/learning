<?php

if ( ! function_exists( 'academist_elated_woocommerce_body_class' ) ) {
	function academist_elated_woocommerce_body_class( $classes ) {
		if ( academist_elated_is_woocommerce_page() ) {
			$classes[] = 'eltdf-woocommerce-page';
			
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$classes[] = 'eltdf-woo-main-page';
			}
			
			if ( is_singular( 'product' ) ) {
				$classes[] = 'eltdf-woo-single-page';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_woocommerce_body_class' );
}

if ( ! function_exists( 'academist_elated_woocommerce_columns_class' ) ) {
	function academist_elated_woocommerce_columns_class( $classes ) {
		
		if ( is_singular( 'product' ) ) {
			$classes[] = academist_elated_options()->getOptionValue( 'eltdf_woo_related_products_columns' );
		} else {
			$classes[] = academist_elated_options()->getOptionValue( 'eltdf_woo_product_list_columns' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_woocommerce_columns_class' );
}

if ( ! function_exists( 'academist_elated_woocommerce_columns_space_class' ) ) {
	function academist_elated_woocommerce_columns_space_class( $classes ) {
		$woo_space_between_items = academist_elated_options()->getOptionValue( 'eltdf_woo_product_list_columns_space' );
		
		if ( ! empty( $woo_space_between_items ) ) {
			$classes[] = 'eltdf-woo-' . $woo_space_between_items . '-space';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_woocommerce_columns_space_class' );
}

if ( ! function_exists( 'academist_elated_woocommerce_pl_info_position_class' ) ) {
	function academist_elated_woocommerce_pl_info_position_class( $classes ) {
		$info_position       = academist_elated_options()->getOptionValue( 'eltdf_woo_product_list_info_position' );
		$info_position_class = '';
		
		if ( $info_position === 'info_below_image' ) {
			$info_position_class = 'eltdf-woo-pl-info-below-image';
		} else if ( $info_position === 'info_on_image_hover' ) {
			$info_position_class = 'eltdf-woo-pl-info-on-image-hover';
		}
		
		$classes[] = $info_position_class;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_woocommerce_pl_info_position_class' );
}

if ( ! function_exists( 'academist_elated_add_woocommerce_shortcode_class' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function academist_elated_add_woocommerce_shortcode_class( $classes ) {
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking'
		);
		
		foreach ( $woocommerce_shortcodes as $woocommerce_shortcode ) {
			$has_shortcode = academist_elated_has_shortcode( $woocommerce_shortcode );
			
			if ( $has_shortcode ) {
				$classes[] = 'eltdf-woocommerce-page woocommerce-account eltdf-' . str_replace( '_', '-', $woocommerce_shortcode );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_add_woocommerce_shortcode_class' );
}

if ( ! function_exists( 'academist_elated_woo_single_product_thumb_position_class' ) ) {
	function academist_elated_woo_single_product_thumb_position_class( $classes ) {
		$product_thumbnail_position = academist_elated_get_meta_field_intersect( 'woo_set_thumb_images_position' );
		
		if ( ! empty( $product_thumbnail_position ) ) {
			$classes[] = 'eltdf-woo-single-thumb-' . $product_thumbnail_position;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_woo_single_product_thumb_position_class' );
}

if ( ! function_exists( 'academist_elated_woo_single_product_has_zoom_class' ) ) {
	function academist_elated_woo_single_product_has_zoom_class( $classes ) {
		$zoom_maginifier = academist_elated_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );
		
		if ( $zoom_maginifier === 'yes' ) {
			$classes[] = 'eltdf-woo-single-has-zoom';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_woo_single_product_has_zoom_class' );
}

if ( ! function_exists( 'academist_elated_woo_single_product_has_zoom_support' ) ) {
	function academist_elated_woo_single_product_has_zoom_support() {
		$zoom_maginifier = academist_elated_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );
		
		if ( $zoom_maginifier === 'yes' ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
	}
	
	add_action( 'init', 'academist_elated_woo_single_product_has_zoom_support' );
}

if ( ! function_exists( 'academist_elated_woo_single_product_image_behavior_class' ) ) {
	function academist_elated_woo_single_product_image_behavior_class( $classes ) {
		$image_behavior = academist_elated_get_meta_field_intersect( 'woo_set_single_images_behavior' );
		
		if ( ! empty( $image_behavior ) ) {
			$classes[] = 'eltdf-woo-single-has-' . $image_behavior;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_woo_single_product_image_behavior_class' );
}

if ( ! function_exists( 'academist_elated_woo_single_product_photo_swipe_support' ) ) {
	function academist_elated_woo_single_product_photo_swipe_support() {
		$image_behavior = academist_elated_get_meta_field_intersect( 'woo_set_single_images_behavior' );
		
		if ( $image_behavior === 'photo-swipe' ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}
	
	add_action( 'init', 'academist_elated_woo_single_product_photo_swipe_support' );
}

if ( ! function_exists( 'academist_elated_woocommerce_products_per_page' ) ) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function academist_elated_woocommerce_products_per_page() {
		$products_per_page_meta = academist_elated_options()->getOptionValue( 'eltdf_woo_products_per_page' );
		$products_per_page      = ! empty( $products_per_page_meta ) ? intval( $products_per_page_meta ) : 12;
		
		return $products_per_page;
	}
	
	add_filter('loop_shop_per_page', 'academist_elated_woocommerce_products_per_page', 20);
}

if ( ! function_exists( 'academist_elated_woocommerce_related_products_args' ) ) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 *
	 * @param $args array array of args for the query
	 *
	 * @return mixed array of changed args
	 */
	function academist_elated_woocommerce_related_products_args( $args ) {
		$related = academist_elated_options()->getOptionValue( 'eltdf_woo_related_products_columns' );
		
		if ( ! empty( $related ) ) {
			switch ( $related ) {
				case 'eltdf-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'eltdf-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}
		} else {
			$args['posts_per_page'] = 4;
		}
		
		return $args;
	}
	
	add_filter('woocommerce_output_related_products_args', 'academist_elated_woocommerce_related_products_args');
}

if ( ! function_exists( 'academist_elated_woocommerce_product_thumbnail_column_size' ) ) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function academist_elated_woocommerce_product_thumbnail_column_size() {
		$thumbs_number_meta = academist_elated_options()->getOptionValue( 'woo_number_of_thumb_images' );
		$thumbs_number      = ! empty ( $thumbs_number_meta ) ? intval( $thumbs_number_meta ) : 4;
		
		return apply_filters( 'academist_elated_filter_number_of_thumbnails_per_row_single_product', $thumbs_number );
	}
	
	add_filter( 'woocommerce_product_thumbnails_columns', 'academist_elated_woocommerce_product_thumbnail_column_size', 10 );
}

if ( ! function_exists( 'academist_elated_set_single_product_thumbnails_size' ) ) {
	function academist_elated_set_single_product_thumbnails_size( $size ) {
		return apply_filters( 'academist_elated_filter_woocommerce_gallery_thumbnail_size', 'woocommerce_thumbnail' );
	}
	
	add_filter( 'woocommerce_gallery_thumbnail_size', 'academist_elated_set_single_product_thumbnails_size' );
}

if ( ! function_exists( 'academist_elated_woocommerce_template_loop_product_title' ) ) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function academist_elated_woocommerce_template_loop_product_title() {
		$tag = academist_elated_options()->getOptionValue( 'eltdf_products_list_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h5';
		}
		
		the_title( '<' . $tag . ' class="eltdf-product-list-title"><a href="' . get_the_permalink() . '">', '</a></' . $tag . '>' );
	}
}

if ( ! function_exists( 'academist_elated_woocommerce_template_single_title' ) ) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function academist_elated_woocommerce_template_single_title() {
		$tag = academist_elated_options()->getOptionValue( 'eltdf_single_product_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h1';
		}
		
		the_title( '<' . $tag . '  itemprop="name" class="eltdf-single-product-title">', '</' . $tag . '>' );
	}
}

if ( ! function_exists( 'academist_elated_woocommerce_sale_flash' ) ) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function academist_elated_woocommerce_sale_flash() {
		global $product;
		
		if ( ! empty( $product ) ) {
			return '<span class="eltdf-onsale">' . academist_elated_get_woocommerce_sale( $product ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_sale_flash', 'academist_elated_woocommerce_sale_flash' );
}

if ( ! function_exists( 'academist_elated_woocommerce_product_out_of_stock' ) ) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function academist_elated_woocommerce_product_out_of_stock() {
		global $product;
		
		if ( ! $product->is_in_stock() ) {
			print '<span class="eltdf-out-of-stock">' . esc_html__( 'Sold', 'academist' ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_product_thumbnails', 'academist_elated_woocommerce_product_out_of_stock', 20 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'academist_elated_woocommerce_product_out_of_stock', 10 );
}

if ( ! function_exists( 'academist_elated_woocommerce_new_flash' ) ) {
	/**
	 * Function for adding new flash template
	 *
	 * @return string
	 */
	function academist_elated_woocommerce_new_flash() {
		$new = get_post_meta( get_the_ID(), 'eltdf_show_new_sign_woo_meta', true );
		
		if ( $new === 'yes' ) {
			print '<span class="eltdf-new-product">' . esc_html__( 'New', 'academist' ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_product_thumbnails', 'academist_elated_woocommerce_new_flash', 21 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'academist_elated_woocommerce_new_flash', 11 );
}

if ( ! function_exists( 'academist_elated_single_product_content_additional_tag_before' ) ) {
	function academist_elated_single_product_content_additional_tag_before() {
		
		print '<div class="eltdf-single-product-content">';
	}
}

if ( ! function_exists( 'academist_elated_single_product_content_additional_tag_after' ) ) {
	function academist_elated_single_product_content_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'academist_elated_single_product_summary_additional_tag_before' ) ) {
	function academist_elated_single_product_summary_additional_tag_before() {
		
		print '<div class="eltdf-single-product-summary">';
	}
}

if ( ! function_exists( 'academist_elated_single_product_summary_additional_tag_after' ) ) {
	function academist_elated_single_product_summary_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'academist_elated_pl_holder_additional_tag_before' ) ) {
	function academist_elated_pl_holder_additional_tag_before() {
		
		print '<div class="eltdf-pl-main-holder">';
	}
}

if ( ! function_exists( 'academist_elated_pl_holder_additional_tag_after' ) ) {
	function academist_elated_pl_holder_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'academist_elated_pl_inner_additional_tag_before' ) ) {
	function academist_elated_pl_inner_additional_tag_before() {
		
		print '<div class="eltdf-pl-inner">';
	}
}

if ( ! function_exists( 'academist_elated_pl_inner_additional_tag_after' ) ) {
	function academist_elated_pl_inner_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'academist_elated_pl_image_additional_tag_before' ) ) {
	function academist_elated_pl_image_additional_tag_before() {
		
		print '<div class="eltdf-pl-image">';
	}
}

if ( ! function_exists( 'academist_elated_pl_image_additional_tag_after' ) ) {
	function academist_elated_pl_image_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'academist_elated_pl_inner_text_additional_tag_before' ) ) {
	function academist_elated_pl_inner_text_additional_tag_before() {
		
		print '<div class="eltdf-pl-text"><div class="eltdf-pl-text-outer"><div class="eltdf-pl-text-inner">';
	}
}

if ( ! function_exists( 'academist_elated_pl_inner_text_additional_tag_after' ) ) {
	function academist_elated_pl_inner_text_additional_tag_after() {
		
		print '</div></div></div>';
	}
}

if ( ! function_exists( 'academist_elated_pl_text_wrapper_additional_tag_before' ) ) {
	function academist_elated_pl_text_wrapper_additional_tag_before() {
		
		print '<div class="eltdf-pl-text-wrapper">';
	}
}

if ( ! function_exists( 'academist_elated_pl_text_wrapper_additional_tag_after' ) ) {
	function academist_elated_pl_text_wrapper_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'academist_elated_pl_rating_additional_tag_before' ) ) {
	function academist_elated_pl_rating_additional_tag_before() {
		global $product;
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );
			
			if ( $rating_html !== '' ) {
				print '<div class="eltdf-pl-rating-holder">';
			}
		}
	}
}

if ( ! function_exists( 'academist_elated_pl_rating_additional_tag_after' ) ) {
	function academist_elated_pl_rating_additional_tag_after() {
		global $product;
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );
			
			if ( $rating_html !== '' ) {
				print '</div>';
			}
		}
	}
}

if ( ! function_exists( 'academist_elated_woocommerce_share' ) ) {
	/**
	 * Function that social share for product page
	 *
	 * @see academist_elated_get_social_share_html - available params type, icon_type and title
	 *
	 * Return social share html
	 */
	function academist_elated_woocommerce_share() {
		if ( academist_elated_options()->getOptionValue( 'enable_social_share' ) == 'yes' && academist_elated_options()->getOptionValue( 'enable_social_share_on_product' ) == 'yes' ) :
			echo '<div class="eltdf-woo-social-share-holder">';
			echo academist_elated_get_social_share_html( array( 'type' => 'list', 'title' => esc_attr__('Share:', 'academist') ) );
			echo '</div>';
		endif;
	}
}

if ( ! function_exists( 'academist_elated_woocommerce_single_product_title' ) ) {
	/**
	 * Function that checks option for single product title and overrides it with filter
	 */
	function academist_elated_woocommerce_single_product_title( $show_title_area ) {
		if ( is_singular( 'product' ) ) {
			$woo_title_meta = get_post_meta( get_the_ID(), 'eltdf_show_title_area_woo_meta', true );
			
			if ( empty( $woo_title_meta ) ) {
				$woo_title_main = academist_elated_options()->getOptionValue( 'show_title_area_woo' );
				
				if ( ! empty( $woo_title_main ) ) {
					$show_title_area = $woo_title_main == 'yes' ? true : false;
				}
			} else {
				$show_title_area = $woo_title_meta == 'yes' ? true : false;
			}
		}
		
		return $show_title_area;
	}
	
	add_filter( 'academist_elated_filter_show_title_area', 'academist_elated_woocommerce_single_product_title' );
}

if ( ! function_exists( 'academist_elated_set_title_text_output_for_woocommerce' ) ) {
	function academist_elated_set_title_text_output_for_woocommerce( $title ) {
		
		if ( is_product_category() || is_product_tag() ) {
			global $wp_query;
			
			$tax            = $wp_query->get_queried_object();
			$category_title = $tax->name;
			$title          = $category_title;
		} elseif ( academist_elated_is_woocommerce_shop() || is_singular( 'product' ) ) {
			$shop_id = academist_elated_get_woo_shop_page_id();
			$title   = $shop_id !== -1 ? get_the_title( $shop_id ) : esc_html__( 'Shop', 'academist' );
		}
		
		return $title;
	}
	
	add_filter( 'academist_elated_filter_title_text', 'academist_elated_set_title_text_output_for_woocommerce' );
}

if ( ! function_exists( 'academist_elated_set_breadcrumbs_output_for_woocommerce' ) ) {
	function academist_elated_set_breadcrumbs_output_for_woocommerce( $childContent, $delimiter, $before, $after ) {
		$shop_id = academist_elated_get_woo_shop_page_id();
		
		if ( academist_elated_is_product_category() || academist_elated_is_product_tag() ) {
			$childContent = '';
			
			if ( ! empty( $shop_id ) && $shop_id !== -1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}
			
			$eltdf_taxonomy_id        = get_queried_object_id();
			$eltdf_taxonomy_type      = is_tax( 'product_tag' ) ? 'product_tag' : 'product_cat';
			$eltdf_taxonomy           = ! empty( $eltdf_taxonomy_id ) ? get_term_by( 'id', $eltdf_taxonomy_id, $eltdf_taxonomy_type ) : '';
			$eltdf_taxonomy_parent_id = isset( $eltdf_taxonomy->parent ) && $eltdf_taxonomy->parent !== 0 ? $eltdf_taxonomy->parent : '';
			$eltdf_taxonomy_parent    = $eltdf_taxonomy_parent_id !== '' ? get_term_by( 'id', $eltdf_taxonomy_parent_id, $eltdf_taxonomy_type ) : '';
			
			if ( ! empty( $eltdf_taxonomy_parent ) ) {
				$childContent .= '<a itemprop="url" href="' . get_term_link( $eltdf_taxonomy_parent->term_id ) . '">' . $eltdf_taxonomy_parent->name . '</a>' . $delimiter;
			}
			
			if ( ! empty( $eltdf_taxonomy ) ) {
				$childContent .= $before . esc_attr( $eltdf_taxonomy->name ) . $after;
			}
			
		} elseif ( is_singular( 'product' ) ) {
			$childContent = '';
			$product      = wc_get_product( get_the_ID() );
			$categories   = ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), ', ' ) : '';
			
			if ( ! empty( $shop_id ) && $shop_id !== -1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}
			
			if ( ! empty( $categories ) ) {
				$childContent .= $categories . $delimiter;
			}
			
			$childContent .= $before . get_the_title() . $after;
			
		} elseif ( academist_elated_is_woocommerce_shop() ) {
			$childContent = $before . get_the_title( $shop_id ) . $after;
		}
		
		return $childContent;
	}
	
	add_filter( 'academist_elated_filter_breadcrumbs_title_child_output', 'academist_elated_set_breadcrumbs_output_for_woocommerce', 10, 4 );
}

if ( ! function_exists( 'academist_elated_set_sidebar_layout_for_woocommerce' ) ) {
	function academist_elated_set_sidebar_layout_for_woocommerce( $sidebar_layout ) {
		
		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_layout = academist_elated_get_meta_field_intersect( 'sidebar_layout', academist_elated_get_woo_shop_page_id() );
		}
		
		return $sidebar_layout;
	}
	
	add_filter( 'academist_elated_filter_sidebar_layout', 'academist_elated_set_sidebar_layout_for_woocommerce' );
}

if ( ! function_exists( 'academist_elated_set_sidebar_name_for_woocommerce' ) ) {
	function academist_elated_set_sidebar_name_for_woocommerce( $sidebar_name ) {
		
		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_name = academist_elated_get_meta_field_intersect( 'custom_sidebar_area', academist_elated_get_woo_shop_page_id() );
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'academist_elated_filter_sidebar_name', 'academist_elated_set_sidebar_name_for_woocommerce' );
}