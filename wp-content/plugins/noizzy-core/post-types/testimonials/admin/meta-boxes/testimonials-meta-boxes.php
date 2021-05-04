<?php

if ( ! function_exists( 'noizzy_core_map_testimonials_meta' ) ) {
	function noizzy_core_map_testimonials_meta() {
		$testimonial_meta_box = noizzy_edge_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'noizzy-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'noizzy-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'noizzy-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'noizzy-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'noizzy-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'noizzy-core' ),
				'description' => esc_html__( 'Enter author name', 'noizzy-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'noizzy-core' ),
				'description' => esc_html__( 'Enter author job position', 'noizzy-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'noizzy_edge_meta_boxes_map', 'noizzy_core_map_testimonials_meta', 95 );
}