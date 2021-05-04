<?php

if ( ! function_exists( 'noizzy_music_add_albums_player_slider_shortcode' ) ) {
	function noizzy_music_add_albums_player_slider_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'NoizzyMusic\CPT\Shortcodes\Albums\AlbumsPlayerSlider'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'noizzy_music_filter_add_vc_shortcode', 'noizzy_music_add_albums_player_slider_shortcode' );
}

if ( ! function_exists( 'noizzy_music_set_albums_player_slider_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for albums slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function noizzy_music_set_albums_player_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-albums-player-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'noizzy_music_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_music_set_albums_player_slider_icon_class_name_for_vc_shortcodes' );
}