<?php

if ( ! function_exists( 'noizzy_edge_portfolio_category_additional_fields' ) ) {
	function noizzy_edge_portfolio_category_additional_fields() {
		
		$fields = noizzy_edge_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		noizzy_edge_add_taxonomy_field(
			array(
				'name'   => 'edge_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'noizzy-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'noizzy_edge_custom_taxonomy_fields', 'noizzy_edge_portfolio_category_additional_fields' );
}