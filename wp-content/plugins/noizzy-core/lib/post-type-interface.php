<?php

namespace NoizzyCore\Lib;

/**
 * interface PostTypeInterface
 * @package NoizzyCore\Lib;
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