<?php

namespace NoizzyMusic\Lib;

/**
 * interface PostTypeInterface
 * @package NoizzyMusic\Lib;
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