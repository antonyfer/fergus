<?php

if ( ! function_exists( 'noizzy_core_add_social_share_shortcodes' ) ) {
	function noizzy_core_add_social_share_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'NoizzyCore\CPT\Shortcodes\SocialShare\SocialShare'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcode', 'noizzy_core_add_social_share_shortcodes' );
}

if ( ! function_exists( 'noizzy_core_set_social_share_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for social share shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function noizzy_core_set_social_share_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-social-share';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'noizzy_core_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_core_set_social_share_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'noizzy_edge_get_social_share_html' ) ) {
	/**
	 * Calls button shortcode with given parameters and returns it's output
	 *
	 * @param $params
	 * @return mixed|string
	 */
	function noizzy_edge_get_social_share_html( $params = array() ) {
        return noizzy_edge_execute_shortcode( 'edge_social_share', $params );
	}
}

if ( ! function_exists( 'noizzy_edge_the_excerpt_max_charlength' ) ) {
	/**
	 * Function that sets character length for social share shortcode
	 *
	 * @param $charlength string original text
	 * @return string shortened text
	 */
	function noizzy_edge_the_excerpt_max_charlength( $charlength ) {
		$twitter_via_meta = noizzy_edge_options()->getOptionValue( 'twitter_via' );
		$via              = ! empty( $twitter_via_meta ) ? ' via ' . esc_attr( $twitter_via_meta ) : '';
		
		$excerpt_text = get_the_excerpt();
		$excerpt      = esc_html( strip_shortcodes( $excerpt_text ) );
		$charlength   = 139 - ( mb_strlen( $via ) + $charlength );
		
		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex   = mb_substr( $excerpt, 0, $charlength );
			$exwords = explode( ' ', $subex );
			$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
}