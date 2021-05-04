<?php
namespace NoizzyCore\CPT\Shortcodes\InteractiveLinksShowcase;

use NoizzyCore\Lib;

class InteractiveLinksShowcase implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_interactive_links_showcase';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Interactive Links Showcase', 'noizzy-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by NOIZZY', 'noizzy-core' ),
					'icon'     => 'icon-wpb-interactive-links-showcase extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'mouse_wheel_control',
							'value'       => array(
								esc_html__('No', 'noizzy-core')  => 'no',
								esc_html__('Yes', 'noizzy-core') => 'yes',
							),
							'save_always' => true,
							'heading'     => esc_html__('Mouse Wheel Control', 'noizzy-core'),
							'description' => esc_html__('', 'noizzy-core')
						),
						array(
							'type'       => 'param_group',
							'heading'    => esc_html__('Interactive Links Showcase Links', 'noizzy-core'),
							'param_name' => 'interactive_links_showcase_links',
							'value'      => '',
							'params'     => array(
								array(
									'type'        => 'attach_image',
									'param_name'  => 'background_image',
									'heading'     => esc_html__('Background Image', 'noizzy-core'),
									'description' => esc_html__('Select image from media library', 'noizzy-core')
								),
								array(
									'type'        => 'textfield',
									'param_name'  => 'link_text',
									'heading'     => esc_html__('Link Text', 'noizzy-core'),
									'description' => esc_html__('', 'noizzy-core')
								),
								array(
									'type'        => 'textfield',
									'param_name'  => 'link',
									'heading'     => esc_html__('Link', 'noizzy-core'),
							    	'dependency' => array( 'element' => 'link_text', 'not_empty' => true)
								),
							    array(
								    'type'        => 'dropdown',
								    'param_name'  => 'link_target',
								    'heading'     => esc_html__( 'Link Target', 'noizzy-core' ),
								    'value' => array(
										esc_html__('Blank', 'noizzy-core') => '_blank',
										esc_html__('Self', 'noizzy-core') => '_self'
									),
								    'save_always' => true,
							    	'dependency' => array( 'element' => 'link_text', 'not_empty' => true)
							    )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'mouse_wheel_control'   				=> '',
			'interactive_links_showcase_links' 		=> ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;

		$params['interactive_links_showcase'] = vc_param_group_parse_atts($atts['interactive_links_showcase_links']);
		$params['data_params'] 						= $this->getDataParams($params);

		$html = noizzy_core_get_shortcode_module_template_part( 'templates/interactive-links-showcase', 'interactive-links-showcase', '', $params );
		
		return $html;
	}

	/**
	 * Return Fullscreen Objects data params
	 *
	 * @param $params
	 * @return array
	 */
	private function getDataParams($params) {
		$data = array();

		$data['data-mouse-wheel-control'] = $params['mouse_wheel_control'];

		return $data;
	}
	
}