<?php

if ( ! function_exists( 'noizzy_core_map_portfolio_meta' ) ) {
	function noizzy_core_map_portfolio_meta() {
		global $noizzy_edge_Framework;

		$noizzy_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$noizzy_pages[ $page->ID ] = $page->post_title;
		}

		//Portfolio Images

		$noizzy_portfolio_images = new NoizzyEdgeMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'noizzy-core' ), '', '', 'portfolio_images' );
		$noizzy_edge_Framework->edgeMetaBoxes->addMetaBox( 'portfolio_images', $noizzy_portfolio_images );

		$noizzy_portfolio_image_gallery = new NoizzyEdgeMultipleImages( 'edge-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'noizzy-core' ), esc_html__( 'Choose your portfolio images', 'noizzy-core' ) );
		$noizzy_portfolio_images->addChild( 'edge-portfolio-image-gallery', $noizzy_portfolio_image_gallery );

		//Portfolio Single Upload Images/Videos

		$noizzy_portfolio_images_videos = noizzy_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'noizzy-core' ),
				'name'  => 'edge_portfolio_images_videos'
			)
		);
		noizzy_edge_add_repeater_field(
			array(
				'name'        => 'edge_portfolio_single_upload',
				'parent'      => $noizzy_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'noizzy-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'noizzy-core' ),
						'options' => array(
							'image' => esc_html__('Image','noizzy-core'),
							'video' => esc_html__('Video','noizzy-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'noizzy-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'noizzy-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'noizzy-core'),
							'vimeo' => esc_html__('Vimeo', 'noizzy-core'),
							'self' => esc_html__('Self Hosted', 'noizzy-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'noizzy-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'noizzy-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'noizzy-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);

		//Portfolio Additional Sidebar Items

		$noizzy_additional_sidebar_items = noizzy_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'noizzy-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		noizzy_edge_add_repeater_field(
			array(
				'name'        => 'edge_portfolio_properties',
				'parent'      => $noizzy_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'noizzy-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'noizzy-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'noizzy-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'noizzy-core' )
					)
				)
			)
		);
	}

	add_action( 'noizzy_edge_meta_boxes_map', 'noizzy_core_map_portfolio_meta', 40 );
}