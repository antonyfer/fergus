<?php

if ( ! function_exists( 'noizzy_music_set_bands_in_town_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for bands in town shortcode to set our icon for Visual Composer shortcodes panel
     */
    function noizzy_music_set_bands_in_town_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-bands-in-town-events';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'noizzy_music_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_music_set_bands_in_town_icon_class_name_for_vc_shortcodes' );
}

if (!function_exists('noizzy_music_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function noizzy_music_theme_installed() {
        return defined('EDGE_ROOT');
    }
}