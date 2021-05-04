<?php

if ( ! function_exists( 'noizzy_music_add_audio_playlist_shortcodes' ) ) {
    function noizzy_music_add_audio_playlist_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'NoizzyMusic\CPT\Shortcodes\AudioPlaylist\AudioPlaylist'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'noizzy_music_filter_add_vc_shortcode', 'noizzy_music_add_audio_playlist_shortcodes' );
}

if ( ! function_exists( 'noizzy_music_set_audio_playlist_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for audio playlist shortcode to set our icon for Visual Composer shortcodes panel
     */
    function noizzy_music_set_audio_playlist_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-audio-playlist';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'noizzy_music_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_music_set_audio_playlist_icon_class_name_for_vc_shortcodes' );
}

if(!function_exists('noizzy_music_get_audio_playlist_html')) {
    /**
     * Calls audio playlist shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function noizzy_music_get_audio_playlist_html($params) {
        $audio_playlist_html = noizzy_edge_execute_shortcode('edge_audio_playlist', $params);
        $audio_playlist_html = str_replace("\n", '', $audio_playlist_html);
        return $audio_playlist_html;
    }
}