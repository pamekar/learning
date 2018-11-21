<?php

namespace AcademistLMS\Lib;

/**
 * interface PostTypeInterface
 * @package AcademistLMS\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}