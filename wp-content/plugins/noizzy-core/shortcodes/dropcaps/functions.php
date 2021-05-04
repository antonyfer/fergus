<?php

if ( ! function_exists( 'noizzy_core_add_dropcaps_shortcodes' ) ) {
	function noizzy_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'NoizzyCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcode', 'noizzy_core_add_dropcaps_shortcodes' );
}