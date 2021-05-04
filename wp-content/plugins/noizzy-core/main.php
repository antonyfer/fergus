<?php
/*
Plugin Name: Noizzy Core
Description: Plugin that adds all post types needed by our theme
Author: Edge Themes
Version: 1.0.2
*/

require_once 'load.php';

add_action('after_setup_theme', array(NoizzyCore\CPT\PostTypesRegister::getInstance(), 'register'));

if (!function_exists('noizzy_core_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines noizzy_edge_core_on_activate action
     */
    function noizzy_core_activation() {
        do_action('noizzy_edge_core_on_activate');

        NoizzyCore\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'noizzy_core_activation');
}

if (!function_exists('noizzy_core_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function noizzy_core_text_domain() {
        load_plugin_textdomain('noizzy-core', false, NOIZZY_CORE_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'noizzy_core_text_domain');
}

if (!function_exists('noizzy_core_version_class')) {
    /**
     * Adds plugins version class to body
     *
     * @param $classes
     *
     * @return array
     */
    function noizzy_core_version_class($classes) {
        $classes[] = 'noizzy-core-' . NOIZZY_CORE_VERSION;

        return $classes;
    }

    add_filter('body_class', 'noizzy_core_version_class');
}

if (!function_exists('noizzy_core_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function noizzy_core_theme_installed() {
        return defined('EDGE_ROOT');
    }
}

if (!function_exists('noizzy_core_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function noizzy_core_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('noizzy_core_is_woocommerce_integration_installed')) {
    //is Edge Woocommerce Integration installed?
    function noizzy_core_is_woocommerce_integration_installed() {
        return defined('NOIZZY_CHECKOUT_INTEGRATION');
    }
}

if (!function_exists('noizzy_core_is_revolution_slider_installed')) {
    function noizzy_core_is_revolution_slider_installed() {
        return class_exists('RevSliderFront');
    }
}

if (!function_exists('noizzy_core_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function noizzy_core_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if (!function_exists('noizzy_core_theme_menu')) {
    /**
     * Function that generates admin menu for options page.
     * It generates one admin page per options page.
     */
    function noizzy_core_theme_menu() {
        if (noizzy_core_theme_installed()) {

            global $noizzy_edge_Framework;
            noizzy_edge_init_theme_options();

            $page_hook_suffix = add_menu_page(
                esc_html__('Noizzy Options', 'noizzy-core'), // The value used to populate the browser's title bar when the menu page is active
                esc_html__('Noizzy Options', 'noizzy-core'), // The text of the menu in the administrator's sidebar
                'administrator',                            // What roles are able to access the menu
                EDGE_OPTIONS_SLUG,            // The ID used to bind submenu items to this menu
                array($noizzy_edge_Framework->getSkin(), 'renderOptions'), // The callback function used to render this menu
                $noizzy_edge_Framework->getSkin()->getSkinURI() . '/assets/img/admin-logo-icon.png', // Icon For menu Item
                100                                                                                            // Position
            );

            foreach ($noizzy_edge_Framework->edgeOptions->adminPages as $key => $value) {
                $slug = "";

                if (!empty($value->slug)) {
                    $slug = "_tab" . $value->slug;
                }

                $subpage_hook_suffix = add_submenu_page(
                    EDGE_OPTIONS_SLUG,
                    esc_html__('Noizzy Options - ', 'noizzy-core') . $value->title, // The value used to populate the browser's title bar when the menu page is active
                    $value->title,                                                 // The text of the menu in the administrator's sidebar
                    'administrator',                                               // What roles are able to access the menu
                    EDGE_OPTIONS_SLUG . $slug,                       // The ID used to bind submenu items to this menu
                    array($noizzy_edge_Framework->getSkin(), 'renderOptions')
                );

                add_action('admin_print_scripts-' . $subpage_hook_suffix, 'noizzy_edge_enqueue_admin_scripts');
                add_action('admin_print_styles-' . $subpage_hook_suffix, 'noizzy_edge_enqueue_admin_styles');
            };

            add_action('admin_print_scripts-' . $page_hook_suffix, 'noizzy_edge_enqueue_admin_scripts');
            add_action('admin_print_styles-' . $page_hook_suffix, 'noizzy_edge_enqueue_admin_styles');
        }
    }

    add_action('admin_menu', 'noizzy_core_theme_menu');
}

if (!function_exists('noizzy_core_theme_menu_backup_options')) {
    /**
     * Function that generates admin menu for options page.
     * It generates one admin page per options page.
     */
    function noizzy_core_theme_menu_backup_options() {
        if (noizzy_core_theme_installed()) {
            global $noizzy_edge_Framework;

            $slug = "_backup_options";
            $page_hook_suffix = add_submenu_page(
                EDGE_OPTIONS_SLUG,
                esc_html__('Noizzy Options - Backup Options', 'noizzy-core'), // The value used to populate the browser's title bar when the menu page is active
                esc_html__('Backup Options', 'noizzy-core'),                // The text of the menu in the administrator's sidebar
                'administrator',                                             // What roles are able to access the menu
                EDGE_OPTIONS_SLUG . $slug,                     // The ID used to bind submenu items to this menu
                array($noizzy_edge_Framework->getSkin(), 'renderBackupOptions')
            );

            add_action('admin_print_scripts-' . $page_hook_suffix, 'noizzy_edge_enqueue_admin_scripts');
            add_action('admin_print_styles-' . $page_hook_suffix, 'noizzy_edge_enqueue_admin_styles');
        }
    }

    add_action('admin_menu', 'noizzy_core_theme_menu_backup_options');
}

if (!function_exists('noizzy_core_theme_admin_bar_menu_options')) {
    /**
     * Add a link to the WP Toolbar
     */
    function noizzy_core_theme_admin_bar_menu_options($wp_admin_bar) {
        if ( noizzy_core_theme_installed() && current_user_can( 'administrator' ) ) {
            global $noizzy_edge_Framework;

            $args = array(
                'id'    => 'noizzy-admin-bar-options',
                'title' => sprintf('<span class="ab-icon dashicons-before dashicons-admin-generic"></span> %s', esc_html__('Noizzy Options', 'noizzy-core')),
                'href'  => esc_url(admin_url('admin.php?page=' . EDGE_OPTIONS_SLUG))
            );

            $wp_admin_bar->add_node($args);

            foreach ($noizzy_edge_Framework->edgeOptions->adminPages as $key => $value) {
                $suffix = !empty($value->slug) ? '_tab' . $value->slug : '';

                $args = array(
                    'id'     => 'noizzy-admin-bar-options-' . $suffix,
                    'title'  => $value->title,
                    'parent' => 'noizzy-admin-bar-options',
                    'href'   => esc_url(admin_url('admin.php?page=' . EDGE_OPTIONS_SLUG . $suffix))
                );

                $wp_admin_bar->add_node($args);
            };
        }
    }

    add_action('admin_bar_menu', 'noizzy_core_theme_admin_bar_menu_options', 999);
}