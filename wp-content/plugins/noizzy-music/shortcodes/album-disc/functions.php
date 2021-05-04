<?php

if ( ! function_exists( 'noizzy_music_add_album_disc_shortcodes' ) ) {
    function noizzy_music_add_album_disc_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'NoizzyMusic\CPT\Shortcodes\AlbumDisc\AlbumDisc'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'noizzy_music_filter_add_vc_shortcode', 'noizzy_music_add_album_disc_shortcodes' );
}

if ( ! function_exists( 'noizzy_music_set_album_disc_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for album disc shortcode to set our icon for Visual Composer shortcodes panel
     */
    function noizzy_music_set_album_disc_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-album-disc';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'noizzy_music_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_music_set_album_disc_icon_class_name_for_vc_shortcodes' );
}