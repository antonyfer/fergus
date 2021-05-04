<?php

if ( ! function_exists( 'noizzy_core_enqueue_scripts_for_full_screen_sections_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function noizzy_core_enqueue_scripts_for_full_screen_sections_shortcodes() {
		wp_enqueue_script( 'fullPage', NOIZZY_CORE_SHORTCODES_URL_PATH . '/full-screen-sections/assets/js/plugins/jquery.fullPage.min.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'noizzy_edge_enqueue_third_party_scripts', 'noizzy_core_enqueue_scripts_for_full_screen_sections_shortcodes' );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edge_Full_Screen_Sections extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Edge_Full_Screen_Sections_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'noizzy_core_add_full_screen_sections_shortcodes' ) ) {
	function noizzy_core_add_full_screen_sections_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'NoizzyCore\CPT\Shortcodes\FullScreenSections\FullScreenSections',
			'NoizzyCore\CPT\Shortcodes\FullScreenSections\FullScreenSectionsItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcode', 'noizzy_core_add_full_screen_sections_shortcodes' );
}

if ( ! function_exists( 'noizzy_core_set_full_screen_sections_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for full screen sections holder shortcode
	 */
	function noizzy_core_set_full_screen_sections_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.vc_shortcodes_container.wpb_edge_full_screen_sections_item { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcodes_custom_style', 'noizzy_core_set_full_screen_sections_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'noizzy_core_set_full_screen_sections_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for full screen sections holder shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function noizzy_core_set_full_screen_sections_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-full-screen-sections';
		$shortcodes_icon_class_array[] = '.icon-wpb-full-screen-sections-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_core_set_full_screen_sections_icon_class_name_for_vc_shortcodes' );
}