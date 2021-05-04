<?php

if ( ! function_exists( 'noizzy_core_add_interactive_links_showcase_shortcode' ) ) {
	function noizzy_core_add_interactive_links_showcase_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'NoizzyCore\CPT\Shortcodes\InteractiveLinksShowcase\InteractiveLinksShowcase',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcode', 'noizzy_core_add_interactive_links_showcase_shortcode' );
}

if ( ! function_exists( 'noizzy_core_set_interactive_links_showcase_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for interactive links showcase shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function noizzy_core_set_interactive_links_showcase_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-interactive-links-showcase';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_core_set_interactive_links_showcase_icon_class_name_for_vc_shortcodes' );
}