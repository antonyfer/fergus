<?php
namespace NoizzyCore\CPT\Shortcodes\ClientsCarousel;

use NoizzyCore\Lib;

class ClientsCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edge_clients_carousel';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Clients Carousel', 'noizzy-core' ),
					'base'            => $this->getBase(),
					'category'        => esc_html__( 'by NOIZZY', 'noizzy-core' ),
					'icon'            => 'icon-wpb-clients-carousel extended-custom-icon',
					'as_parent'       => array( 'only' => 'edge_clients_carousel_item' ),
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'noizzy-core' ),
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
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'noizzy-core' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'noizzy-core' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'noizzy-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'noizzy-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'noizzy-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'noizzy-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'noizzy-core' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'noizzy-core' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false ) ),
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
			'number_of_visible_items' => '4',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_navigation'       => 'no',
			'slider_pagination'       => 'no',
			'items_hover_animation'   => 'switch-images'
		);
		
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['carousel_data']  = $this->getSliderData( $params );
		$params['content']        = $content;
		
		$html = noizzy_core_get_shortcode_module_template_part( 'templates/clients-carousel', 'clients-carousel', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['items_hover_animation'] ) ? 'edge-cc-hover-' . $params['items_hover_animation'] : 'edge-cc-hover-switch-images';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = ! empty( $params['number_of_visible_items'] ) ? $params['number_of_visible_items'] : '4';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		
		return $slider_data;
	}
}