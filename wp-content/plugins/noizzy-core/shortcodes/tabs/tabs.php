<?php
namespace NoizzyCore\CPT\Shortcodes\Tabs;

use NoizzyCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_tabs';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Tabs', 'noizzy-core' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'edge_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by NOIZZY', 'noizzy-core' ),
					'icon'            => 'icon-wpb-tabs extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'noizzy-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'noizzy-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'noizzy-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'noizzy-core' ) => 'standard',
								esc_html__( 'Boxed', 'noizzy-core' )    => 'boxed',
								esc_html__( 'Simple', 'noizzy-core' )   => 'simple',
								esc_html__( 'Vertical', 'noizzy-core' ) => 'vertical'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Skin', 'noizzy-core' ),
							'value'       => array(
								esc_html__( 'Dark', 'noizzy-core' ) 	=> 'dark',
								esc_html__( 'Light', 'noizzy-core' ) => 'light',
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
			'type'         => 'standard',
			'skin'         => 'dark'
		);
		$params = shortcode_atts( $args, $atts );
		
		// Extract tab titles
		preg_match_all( '/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		
		/**
		 * get tab titles array
		 */
		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach ( $tab_titles as $tab ) {
			preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = noizzy_core_get_shortcode_module_template_part( 'templates/tab-template', 'tabs', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'edge-tabs-' . esc_attr( $params['type'] ) : 'edge-tabs-standard';
		$holderClasses[] = ! empty( $params['skin'] ) ? 'edge-tabs-' . esc_attr( $params['skin'] ) : 'edge-tabs-dark';
		
		return implode( ' ', $holderClasses );
	}
}