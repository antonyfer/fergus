<?php

namespace NoizzyMusic\CPT\Shortcodes\Albums;

use NoizzyMusic\Lib;

class AlbumsSlider implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edge_albums_slider';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Albums Slider', 'noizzy-music' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by NOIZZY MUSIC', 'noizzy-music' ),
					'icon'     => 'icon-wpb-portfolio-slider extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Albums', 'noizzy-music' ),
							'admin_label' => true,
							'description' => esc_html__( 'Set number of items for your albums slider. Enter -1 to show all', 'noizzy-music' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'noizzy-music' ),
                            'value'      => array(
                                esc_html__( 'One', 'noizzy-music' )   => '1',
                                esc_html__( 'Two', 'noizzy-music' )   => '2',
                                esc_html__( 'Three', 'noizzy-music' ) => '3',
                                esc_html__( 'Four', 'noizzy-music' )  => '4',
                                esc_html__( 'Five', 'noizzy-music' )  => '5'
                            ),
							'description' => esc_html__( 'Number of portfolios that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'noizzy-music' ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'genre',
							'heading'     => esc_html__( 'One-Genre Albums List', 'noizzy-music' ),
							'description' => esc_html__( 'Enter one genre slug (leave empty for showing all genres)', 'noizzy-music' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'artist',
							'heading'     => esc_html__( 'One-Artist Albums List', 'noizzy-music' ),
							'description' => esc_html__( 'Enter one artist slug (leave empty for showing all artists)', 'noizzy-music' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'noizzy-music' ),
							'value'       => array_flip( noizzy_edge_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'noizzy-music' ),
							'value'       => array_flip( noizzy_edge_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'noizzy-music' ),
							'value'      => array_flip( noizzy_edge_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'noizzy-music' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'noizzy-music' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'noizzy-music' ),
							'dependency'  => array( 'element' => 'item_type', 'value' => array( '' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'noizzy-music' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'noizzy-music' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'noizzy-music' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'noizzy-music' ),
							'group'       => esc_html__( 'Slider Settings', 'noizzy-music' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'noizzy-music' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'noizzy-music' ),
							'group'       => esc_html__( 'Slider Settings', 'noizzy-music' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'noizzy-music' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'noizzy-music' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'navigation_skin',
							'heading'    => esc_html__( 'Navigation Skin', 'noizzy-music' ),
							'value'      => array(
								esc_html__( 'Default', 'noizzy-music' ) => '',
								esc_html__( 'Light', 'noizzy-music' )   => 'light',
								esc_html__( 'Dark', 'noizzy-music' )    => 'dark'
							),
							'dependency' => array( 'element' => 'enable_navigation', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'noizzy-music' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'noizzy-music' ),
							'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'noizzy-music' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'pagination_skin',
							'heading'    => esc_html__( 'Pagination Skin', 'noizzy-music' ),
							'value'      => array(
								esc_html__( 'Default', 'noizzy-music' ) => '',
								esc_html__( 'Light', 'noizzy-music' )   => 'light',
								esc_html__( 'Dark', 'noizzy-music' )    => 'dark'
							),
							'dependency' => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'noizzy-music' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'pagination_position',
							'heading'     => esc_html__( 'Pagination Position', 'noizzy-music' ),
							'value'       => array(
								esc_html__( 'Below Slider', 'noizzy-music' ) => 'below-slider',
								esc_html__( 'On Slider', 'noizzy-music' )    => 'on-slider'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Slider Settings', 'noizzy-music' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_items'        => '4',
			'columns'                => 'four',
			'space_between_items'    => 'normal',
			'image_proportions'      => 'full',
			'genre'                  => '',
			'selected_albums'        => '',
			'artist'                 => '',
			'orderby'                => 'date',
			'order'                  => 'ASC',
			'title_tag'              => 'h5',
			'slider_type'            => '',
			'type'                   => 'gallery-no-space',
			'enable_loop'            => 'no',
			'enable_autoplay'        => 'yes',
			'slider_speed'           => '5000',
			'slider_speed_animation' => '600',
			'enable_navigation'      => 'yes',
			'navigation_skin'        => '',
			'enable_pagination'      => 'yes',
			'pagination_skin'        => '',
			'pagination_position'    => 'below-slider'
		);
		$params = shortcode_atts( $args, $atts );

		$params['type']              = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
        $params['enable_navigation'] = ! empty( $params['enable_navigation'] ) ? $params['enable_navigation'] : $args['enable_navigation'];

		$params['albums_slider_on']  = 'yes'; // enables slider and center slide - data center
		
		$html = '<div class="edge-albums-slider-holder">';
			$html .= noizzy_edge_execute_shortcode( 'edge_albums_list', $params );
		$html .= '</div>';

		return $html;
	}
}