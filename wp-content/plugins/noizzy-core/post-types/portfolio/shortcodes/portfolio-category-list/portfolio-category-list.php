<?php

namespace NoizzyCore\CPT\Shortcodes\PortfolioCategoryList;

use NoizzyCore\Lib;

class PortfolioCategoryList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edge_portfolio_category_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Portfolio Category List', 'noizzy-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by NOIZZY', 'noizzy-core' ),
					'icon'     => 'icon-wpb-portfolio-category-list extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'noizzy-core' ),
							'value'       => array(
								esc_html__( 'Default', 'noizzy-core' ) => '',
								esc_html__( 'One', 'noizzy-core' )     => '1',
								esc_html__( 'Two', 'noizzy-core' )     => '2',
								esc_html__( 'Three', 'noizzy-core' )   => '3',
								esc_html__( 'Four', 'noizzy-core' )    => '4',
								esc_html__( 'Five', 'noizzy-core' )    => '5'
							),
							'description' => esc_html__( 'Default value is Three', 'noizzy-core' ),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'noizzy-core' ),
							'value'       => array_flip( noizzy_edge_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Items Per Page', 'noizzy-core' ),
							'description' => esc_html__( 'Set number of items for your portfolio category list. Default value is 6', 'noizzy-core' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'noizzy-core' ),
							'value'       => array_flip( noizzy_edge_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'noizzy-core' ),
							'value'       => array_flip( noizzy_edge_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_proportions',
							'heading'     => esc_html__( 'Image Proportions', 'noizzy-core' ),
							'value'       => array(
								esc_html__( 'Original', 'noizzy-core' )  => 'full',
								esc_html__( 'Square', 'noizzy-core' )    => 'square',
								esc_html__( 'Landscape', 'noizzy-core' ) => 'landscape',
								esc_html__( 'Portrait', 'noizzy-core' )  => 'portrait',
								esc_html__( 'Medium', 'noizzy-core' )    => 'medium',
								esc_html__( 'Large', 'noizzy-core' )     => 'large'
							),
							'description' => esc_html__( 'Set image proportions for your portfolio category list', 'noizzy-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'noizzy-core' ),
							'value'      => array_flip( noizzy_edge_get_title_tag( true ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_columns'   => '3',
			'space_between_items' => 'normal',
			'number_of_items'     => '6',
			'orderby'             => 'date',
			'order'               => 'ASC',
			'image_proportions'   => 'full',
			'title_tag'           => 'h3'
		);
		$params = shortcode_atts( $args, $atts );
		
		$query_array              = $this->getQueryArray( $params );
		$params['query_results']  = get_terms( $query_array );
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['image_size']     = $this->getImageSize( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		$html = noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'portfolio-category-holder', '', $params );
		
		return $html;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'taxonomy'   => 'portfolio-category',
			'number'     => $params['number_of_items'],
			'orderby'    => $params['orderby'],
			'order'      => $params['order'],
			'hide_empty' => true
		);
		
		return $query_array;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['space_between_items'] ) ? 'edge-' . $params['space_between_items'] . '-space' : 'edge-' . $args['space_between_items'] . '-space';
		
		$number_of_columns = $params['number_of_columns'];
		switch ( $number_of_columns ):
			case '1':
				$classes[] = 'edge-pcl-one-column';
				break;
			case '2':
				$classes[] = 'edge-pcl-two-columns';
				break;
			case '3':
				$classes[] = 'edge-pcl-three-columns';
				break;
			case '4':
				$classes[] = 'edge-pcl-four-columns';
				break;
			case '5':
				$classes[] = 'edge-pcl-five-columns';
				break;
			default:
				$classes[] = 'edge-pcl-three-columns';
				break;
		endswitch;
		
		return implode( ' ', $classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'noizzy_edge_landscape';
					break;
				case 'portrait':
					$thumb_size = 'noizzy_edge_portrait';
					break;
				case 'square':
					$thumb_size = 'noizzy_edge_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}
}