<?php

if ( ! function_exists( 'noizzy_edge_portfolio_options_map' ) ) {
	function noizzy_edge_portfolio_options_map() {
		
		noizzy_edge_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'noizzy-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = noizzy_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'noizzy-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'noizzy-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'noizzy-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'noizzy-core' ),
				'default_value' => '4',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'noizzy-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'2' => esc_html__( '2 Columns', 'noizzy-core' ),
					'3' => esc_html__( '3 Columns', 'noizzy-core' ),
					'4' => esc_html__( '4 Columns', 'noizzy-core' ),
					'5' => esc_html__( '5 Columns', 'noizzy-core' )
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'noizzy-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'noizzy-core' ),
				'default_value' => 'normal',
				'options'       => noizzy_edge_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'noizzy-core' ),
				'default_value' => 'square',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'noizzy-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'noizzy-core' ),
					'landscape' => esc_html__( 'Landscape', 'noizzy-core' ),
					'portrait'  => esc_html__( 'Portrait', 'noizzy-core' ),
					'square'    => esc_html__( 'Square', 'noizzy-core' )
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'noizzy-core' ),
				'default_value' => 'gallery-overlay',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'noizzy-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'noizzy-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'noizzy-core' )
				)
			)
		);
		
		$panel = noizzy_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'noizzy-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'noizzy-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'noizzy-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = noizzy_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'noizzy-core' ),
				'default_value' => 'two',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'noizzy-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'noizzy-core' ),
					'three' => esc_html__( '3 Columns', 'noizzy-core' ),
					'four'  => esc_html__( '4 Columns', 'noizzy-core' )
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'noizzy-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'noizzy-core' ),
				'default_value' => 'normal',
				'options'       => noizzy_edge_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = noizzy_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'noizzy-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'noizzy-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'noizzy-core' ),
					'three' => esc_html__( '3 Columns', 'noizzy-core' ),
					'four'  => esc_html__( '4 Columns', 'noizzy-core' )
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'noizzy-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'noizzy-core' ),
				'default_value' => 'normal',
				'options'       => noizzy_edge_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		noizzy_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'noizzy-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'noizzy-core' ),
					'yes' => esc_html__( 'Yes', 'noizzy-core' ),
					'no'  => esc_html__( 'No', 'noizzy-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'noizzy-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'noizzy-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'noizzy-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'noizzy-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'noizzy-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'noizzy-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'noizzy-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = noizzy_edge_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'noizzy-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'noizzy-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);

        noizzy_edge_add_admin_field(
            array(
                'name'          => 'portfolio_single_related_posts',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Show Realted Posts', 'noizzy-core' ),
                'description'   => esc_html__( 'Enabling this option will show portfolio related posts (related by tags or category)', 'noizzy-core' ),
                'parent'        => $panel,
                'default_value' => 'no'
            )
        );
		
		noizzy_edge_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'noizzy-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'noizzy-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'noizzy_edge_options_map', 'noizzy_edge_portfolio_options_map', 10 );
}