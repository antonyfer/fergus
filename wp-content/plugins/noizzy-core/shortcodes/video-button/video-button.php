<?php

namespace NoizzyCore\CPT\Shortcodes\VideoButton;

use NoizzyCore\Lib;

class VideoButton implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edge_video_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Video Button', 'noizzy-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by NOIZZY', 'noizzy-core' ),
					'icon'                      => 'icon-wpb-video-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'noizzy-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'noizzy-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'video_link',
							'heading'    => esc_html__( 'Video Link', 'noizzy-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'video_image',
							'heading'     => esc_html__( 'Video Image', 'noizzy-core' ),
							'description' => esc_html__( 'Select image from media library', 'noizzy-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'play_button_color',
							'heading'    => esc_html__( 'Play Button Color', 'noizzy-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'play_button_size',
							'heading'    => esc_html__( 'Play Button Size (px)', 'noizzy-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_image',
							'heading'     => esc_html__( 'Play Button Custom Image', 'noizzy-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'noizzy-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_hover_image',
							'heading'     => esc_html__( 'Play Button Custom Hover Image', 'noizzy-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'noizzy-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_video_shadow',
							'value'       => array(
								esc_html__('No', 'noizzy-core')  => 'no',
								esc_html__('Yes', 'noizzy-core') => 'yes',
							),
							'save_always' => true,
							'heading'     => esc_html__('Enable Video Shadow', 'noizzy-core'),
							'description' => esc_html__('', 'noizzy-core')
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'video_link'              => '#',
			'video_image'             => '',
			'play_button_color'       => '',
			'play_button_size'        => '',
			'play_button_image'       => '',
			'play_button_hover_image' => '',
			'enable_video_shadow'	  => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     	= $this->getHolderClasses( $params );
		$params['play_button_styles'] 	= $this->getPlayButtonStyles( $params );
		$params['video_holder_styles'] 	= $this->getVideoHolderStyles( $params );

		$html = noizzy_core_get_shortcode_module_template_part( 'templates/video-button', 'video-button', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['video_image'] ) ? 'edge-vb-has-img' : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getVideoHolderStyles( $params ) {
		$styles = array();

		if ( ! empty ( $params['enable_video_shadow'] ) && ( $params['enable_video_shadow'] == 'yes' ) ) {
			$styles[] = 'box-shadow: 6px 10px 23.68px -7.68px rgba(0, 0, 0, 0.54)';
		}

		return implode( ';', $styles );
	}
	
	private function getPlayButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['play_button_color'] ) ) {
			$styles[] = 'color: ' . $params['play_button_color'];
		}
		
		if ( ! empty( $params['play_button_size'] ) ) {
			$styles[] = 'font-size: ' . noizzy_edge_filter_px( $params['play_button_size'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}