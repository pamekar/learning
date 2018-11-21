<?php

namespace AcademistLMS\CPT\Lesson;

use AcademistLMS\Lib\PostTypeInterface;

/**
 * Class LessonRegister
 * @package AcademistLMS\CPT\Lesson
 */
class LessonRegister implements PostTypeInterface {
	/**
	 * @var string
	 */
	private $base;
	private $taxBase;
	
	public function __construct() {
		$this->base    = 'lesson';
		$this->taxBase = 'lesson-category';
		
		add_filter( 'single_template', array( $this, 'registerSingleTemplate' ) );
	}
	
	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
	}
	
	/**
	 * Registers lesson single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-lesson-item.php' ) ) {
				return ACADEMIST_LMS_CPT_PATH . '/lesson/templates/single-' . $this->base . '.php';
			}
		}
		
		return $single;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$slug = $this->base;
		
		register_post_type( $this->base,
			array(
				'labels'       => array(
					'name'          => esc_html__( 'Academist Lessons', 'academist-lms' ),
					'singular_name' => esc_html__( 'Academist Lesson', 'academist-lms' ),
					'add_item'      => esc_html__( 'New Lesson', 'academist-lms' ),
					'add_new_item'  => esc_html__( 'Add New Lesson', 'academist-lms' ),
					'edit_item'     => esc_html__( 'Edit Lesson', 'academist-lms' )
				),
				'public'       => false,
				'has_archive'  => false,
				'rewrite'      => array( 'slug' => $slug ),
				'show_in_menu' => 'academist_lms_menu',
				'show_ui'      => true,
				'supports'     => array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes',
					'comments'
				),
			)
		);
	}
}