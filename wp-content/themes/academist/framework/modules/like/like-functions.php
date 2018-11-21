<?php

if ( ! function_exists( 'academist_elated_like' ) ) {
	/**
	 * Returns AcademistElatedClassLike instance
	 *
	 * @return AcademistElatedClassLike
	 */
	function academist_elated_like() {
		return AcademistElatedClassLike::get_instance();
	}
}

function academist_elated_get_like() {
	
	echo wp_kses( academist_elated_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}