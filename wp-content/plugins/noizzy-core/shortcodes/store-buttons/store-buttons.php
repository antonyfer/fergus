<?php
namespace NoizzyCore\CPT\Shortcodes\StoreButtons;

use NoizzyCore\Lib;

class StoreButtons implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_store_buttons';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Store Buttons', 'noizzy-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by NOIZZY', 'noizzy-core' ),
					'icon'                    => 'icon-wpb-store-buttons extended-custom-icon',
					'show_settings_on_create' => true,
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'noizzy-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'noizzy-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'google_store',
							'heading'    => esc_html__( 'Google Play Store Link', 'noizzy-core' ),
                            'admin_label' 	=> true,
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'app_store',
                            'heading'    => esc_html__( 'App Store Link', 'noizzy-core' ),
							'admin_label' 	=> true,
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'  => '',
			'google_store'  => '',
			'app_store'     => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		
		$html = noizzy_core_get_shortcode_module_template_part( 'templates/store-buttons-template', 'store-buttons', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
}
