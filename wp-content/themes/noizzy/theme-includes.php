<?php

//define constants
define( 'EDGE_ROOT', get_template_directory_uri() );
define( 'EDGE_ROOT_DIR', get_template_directory() );
define( 'EDGE_ASSETS_ROOT', get_template_directory_uri() . '/assets' );
define( 'EDGE_ASSETS_ROOT_DIR', get_template_directory() . '/assets' );
define( 'EDGE_FRAMEWORK_ROOT', get_template_directory_uri() . '/framework' );
define( 'EDGE_FRAMEWORK_ROOT_DIR', get_template_directory() . '/framework' );
define( 'EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT', get_template_directory_uri() . '/framework/admin/assets' );
define( 'EDGE_FRAMEWORK_MODULES_ROOT', get_template_directory_uri() . '/framework/modules' );
define( 'EDGE_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory() . '/framework/modules' );
define( 'EDGE_FRAMEWORK_HEADER_ROOT', get_template_directory_uri() . '/framework/modules/header' );
define( 'EDGE_FRAMEWORK_HEADER_ROOT_DIR', get_template_directory() . '/framework/modules/header' );
define( 'EDGE_FRAMEWORK_SEARCH_ROOT', get_template_directory_uri() . '/framework/modules/search' );
define( 'EDGE_FRAMEWORK_SEARCH_ROOT_DIR', get_template_directory() . '/framework/modules/search' );
define( 'EDGE_FRAMEWORK_HEADER_TYPES_ROOT', get_template_directory_uri() . '/framework/modules/header/types' );
define( 'EDGE_FRAMEWORK_HEADER_TYPES_ROOT_DIR', get_template_directory() . '/framework/modules/header/types' );
define( 'EDGE_THEME_ENV', 'false' );
define( 'EDGE_PROFILE_SLUG', 'edge' );
define( 'EDGE_OPTIONS_SLUG', 'noizzy_edge_theme_menu');

//include necessary files
include_once EDGE_ROOT_DIR . '/framework/edge-framework.php';
include_once EDGE_ROOT_DIR . '/includes/nav-menu/edge-menu.php';
require_once EDGE_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once EDGE_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once EDGE_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once EDGE_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( EDGE_ROOT_DIR . '/export' ) ) {
	include_once EDGE_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once EDGE_ROOT_DIR . '/includes/edge-body-class-functions.php';
	include_once EDGE_ROOT_DIR . '/includes/edge-loading-spinners.php';
}