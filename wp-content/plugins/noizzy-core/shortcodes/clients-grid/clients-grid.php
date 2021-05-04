<?php
namespace NoizzyCore\CPT\Shortcodes\ClientsGrid;

use NoizzyCore\Lib;

class ClientsGrid implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edge_clients_grid';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Clients Grid', 'noizzy-core' ),
					'base'            => $this->getBase(),
					'category'        => esc_html__( 'by NOIZZY', 'noizzy-core' ),
					'icon'            => 'icon-wpb-clients-grid extended-custom-icon',
					'as_parent'       => array( 'only' => 'edge_clients_grid_item' ),
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'grid_cols',
							'heading'     => esc_html__( 'Number Of Columns', 'noizzy-core' ),
							'value'       => array(
								esc_html__( 'One', 'noizzy-core' )   => '1',
								esc_html__( 'Two', 'noizzy-core' )   => '2',
								esc_html__( 'Three', 'noizzy-core' ) => '3',
								esc_html__( 'Four', 'noizzy-core' )  => '4',
								esc_html__( 'Five', 'noizzy-core' )  => '5',
								esc_html__( 'Six', 'noizzy-core' )   => '6'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'items_hover_animation',
							'heading'     => esc_html__( 'Items Hover Animation', 'noizzy-core' ),
							'value'       => array(
								esc_html__( 'Switch Images', 'noizzy-core' ) => 'switch-images',
								esc_html__( 'Roll Over', 'noizzy-core' )     => 'roll-over'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'grid_cols' => '4',
			'items_hover_animation'   => 'switch-images'
		);
		
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['content']        = $content;
		
		$html = noizzy_core_get_shortcode_module_template_part( 'templates/clients-grid', 'clients-grid', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['items_hover_animation'] ) ? 'edge-cc-hover-' . $params['items_hover_animation'] : 'edge-cc-hover-switch-images';
		$holderClasses[] = 'edge-clients-col-' . $params['grid_cols'];
		
		return implode( ' ', $holderClasses );
	}
}