<?php

// Adds theme support for WooCommerce
add_theme_support( 'woocommerce' );

// Disable the default WooCommerce stylesheet
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

if ( ! function_exists( 'academist_elated_disable_woocommerce_pretty_photo' ) ) {
	/**
	 * Function that disable WooCommerce pretty photo script and style
	 */
	function academist_elated_disable_woocommerce_pretty_photo() {
		if ( academist_elated_load_woo_assets() ) {
			
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'academist_elated_disable_woocommerce_pretty_photo' );
}

if ( ! function_exists( 'academist_elated_woocommerce_content' ) ) {
	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function academist_elated_woocommerce_content() {
		
		if ( is_singular( 'product' ) ) {
			
			while ( have_posts() ) : the_post();
				
				wc_get_template_part( 'content', 'single-product' );
			
			endwhile;
			
		} else {
			
			if ( have_posts() ) {
				
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				
				woocommerce_product_loop_start();
				
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();
						
						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
						
						wc_get_template_part( 'content', 'product' );
					}
				}
				
				woocommerce_product_loop_end();
				
				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
		}
	}
}

/*************** PRODUCT LISTS FILTERS - begin ***************/

	//Add additional html tags around product lists
	add_action( 'woocommerce_before_shop_loop', 'academist_elated_pl_holder_additional_tag_before', 35 );
	add_action( 'woocommerce_after_shop_loop', 'academist_elated_pl_holder_additional_tag_after', 5 );
	
	//Add additional html tag around product elements
	add_action( 'woocommerce_before_shop_loop_item', 'academist_elated_pl_inner_additional_tag_before', 5 );
	
	//Remove open and close link position
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	
	//Add additional html tags around image and marks
	add_action( 'woocommerce_before_shop_loop_item_title', 'academist_elated_pl_image_additional_tag_before', 5 );
	add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_image_additional_tag_after', 6 );
	add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'academist_elated_pl_image_additional_tag_after', 1 );


	/*************** Product Info Position Is On Image Hover ***************/
	
		//Add additional html tag around product elements
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'academist_elated_pl_inner_additional_tag_after', 22 );
		
		//Add open and close link position
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'woocommerce_template_loop_product_link_open', 21 );
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'woocommerce_template_loop_product_link_close', 21 );
		
		//Add additional html around product info elements
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'academist_elated_pl_inner_text_additional_tag_before', 5 );
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'academist_elated_pl_inner_text_additional_tag_after', 15 );
		
		//Override product title with our own html
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'academist_elated_woocommerce_template_loop_product_title', 12 );
		
		//Add additional html tags around rating star element
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'academist_elated_pl_rating_additional_tag_before', 9 );
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'academist_elated_pl_rating_additional_tag_after', 11 );
		
		//Change rating star position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'woocommerce_template_loop_rating', 10 );
		
		//Change price position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'woocommerce_template_loop_price', 13 );
		
		//Change add to cart position
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'academist_elated_action_woo_pl_info_on_image_hover', 'woocommerce_template_loop_add_to_cart', 14 );


	/*************** Product Info Position Is Below Image ***************/

		//Add additional html tag around product elements
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_inner_additional_tag_after', 21 );
		
		//Add open and close link position
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'woocommerce_template_loop_product_link_open', 20 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'woocommerce_template_loop_product_link_close', 20 );
		
		//Add additional html at the end of product info elements
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_text_wrapper_additional_tag_before', 22 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_text_wrapper_additional_tag_after', 30 );
		
		//Override product title with our own html
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_woocommerce_template_loop_product_title', 27 );
		
		//Change rating star position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'woocommerce_template_loop_rating', 25 );
		
		//Add additional html tags around rating star element
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_rating_additional_tag_before', 24 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_rating_additional_tag_after', 26 );
		
		//Change price position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'woocommerce_template_loop_price', 28 );

		//Add additional html around add to cart element
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_inner_text_additional_tag_before', 27 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'academist_elated_pl_inner_text_additional_tag_after', 29 );

		//Change add to cart position
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'academist_elated_action_woo_pl_info_below_image', 'woocommerce_template_loop_add_to_cart', 28 );


/*************** PRODUCT LISTS FILTERS - end ***************/

/*************** PRODUCT SINGLE FILTERS - begin ***************/

	//Add additional html around single product summary and images
	add_action( 'woocommerce_before_single_product_summary', 'academist_elated_single_product_content_additional_tag_before', 5 );
	add_action( 'woocommerce_after_single_product_summary', 'academist_elated_single_product_content_additional_tag_after', 1 );
	
	//Add additional html around single product summary
	add_action( 'woocommerce_before_single_product_summary', 'academist_elated_single_product_summary_additional_tag_before', 30 );
	add_action( 'woocommerce_after_single_product_summary', 'academist_elated_single_product_summary_additional_tag_after', 5 );

	//Change sale mark position
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 20 );
	
	//Change title position
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary', 'academist_elated_woocommerce_template_single_title', 5 );

	//Change price position
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
	
	//Change product meta position
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 30 );

	//Add social share (default woocommerce_share)
	add_action( 'woocommerce_single_product_summary', 'academist_elated_woocommerce_share', 6 );

	//Change product tabs position
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );


/*************** PRODUCT SINGLE FILTERS - end ***************/