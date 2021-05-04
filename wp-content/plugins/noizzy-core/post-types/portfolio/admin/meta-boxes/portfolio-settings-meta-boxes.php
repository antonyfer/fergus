<?php

if ( ! function_exists( 'noizzy_core_map_portfolio_settings_meta' ) ) {
	function noizzy_core_map_portfolio_settings_meta() {
		$meta_box = noizzy_edge_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'noizzy-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		noizzy_edge_create_meta_box_field( array(
			'name'        => 'edge_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'noizzy-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'noizzy-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'noizzy-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'noizzy-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'noizzy-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'noizzy-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'noizzy-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'noizzy-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'noizzy-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'noizzy-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'noizzy-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'noizzy-core' )
			)
		) );

        noizzy_edge_create_meta_box_field(
            array(
                'name'          => 'edge_portfolio_masonry_fixed_dimensions_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'noizzy-core' ),
                'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'noizzy-core' ),
                'default_value' => '',
                'parent'        => $meta_box,
                'options'       => array(
                    ''                   => esc_html__( 'Default', 'noizzy-core' ),
                    'small'              => esc_html__( 'Small', 'noizzy-core' ),
                    'large-width'        => esc_html__( 'Large Width', 'noizzy-core' ),
                    'large-height'       => esc_html__( 'Large Height', 'noizzy-core' ),
                    'large-width-height' => esc_html__( 'Large Width/Height', 'noizzy-core' )
                )
            )
        );

        $all_pages = array();
        $pages     = get_pages();
        foreach ( $pages as $page ) {
            $all_pages[ $page->ID ] = $page->post_title;
        }

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'portfolio_single_back_to_link',
                'type'        => 'select',
                'label'       => esc_html__( '"Back To" Link', 'noizzy-core' ),
                'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'plie-core' ),
                'parent'      => $meta_box,
                'options'     => $all_pages,
                'args'        => array(
                    'select2' => true
                )
            )
        );


	}
	
	add_action( 'noizzy_edge_meta_boxes_map', 'noizzy_core_map_portfolio_settings_meta', 41 );
}