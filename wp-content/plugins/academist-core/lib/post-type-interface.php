<?php

namespace AcademistCore\Lib;

/**
 * interface PostTypeInterface
 * @package AcademistCore\Lib;
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