<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edge_Clients_Grid extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'noizzy_core_add_clients_grid_shortcodes' ) ) {
	function noizzy_core_add_clients_grid_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'NoizzyCore\CPT\Shortcodes\Clientsgrid\Clientsgrid',
			'NoizzyCore\CPT\Shortcodes\ClientsgridItem\ClientsgridItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcode', 'noizzy_core_add_clients_grid_shortcodes' );
}

if ( ! function_exists( 'noizzy_core_set_clients_grid_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for clients grid shortcode
	 */
	function noizzy_core_set_clients_grid_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.wpb_content_element.wpb_edge_clients_grid_item > .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcodes_custom_style', 'noizzy_core_set_clients_grid_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'noizzy_core_set_clients_grid_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for clients grid shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function noizzy_core_set_clients_grid_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-grid';
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-grid-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_core_set_clients_grid_icon_class_name_for_vc_shortcodes' );
}