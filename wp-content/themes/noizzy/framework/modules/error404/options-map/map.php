<?php

if ( ! function_exists( 'noizzy_edge_error_404_options_map' ) ) {
	function noizzy_edge_error_404_options_map() {
		
		noizzy_edge_add_admin_page(
			array(
				'slug'  => '__404_error_page',
				'title' => esc_html__( '404 Error Page', 'noizzy' ),
				'icon'  => 'fa fa-exclamation-triangle'
			)
		);
		
		$panel_404_header = noizzy_edge_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_header',
				'title' => esc_html__( 'Header', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_background_color_header',
				'label'       => esc_html__( 'Background Color', 'noizzy' ),
				'description' => esc_html__( 'Choose a background color for header area', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'text',
				'name'          => '404_menu_area_background_transparency_header',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'noizzy' ),
				'description'   => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'noizzy' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_border_color_header',
				'label'       => esc_html__( 'Border Color', 'noizzy' ),
				'description' => esc_html__( 'Choose a border bottom color for header area', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'select',
				'name'          => '404_header_style',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'noizzy' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'noizzy' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'noizzy' ),
					'light-header' => esc_html__( 'Light', 'noizzy' ),
					'dark-header'  => esc_html__( 'Dark', 'noizzy' )
				)
			)
		);
		
		$panel_404_options = noizzy_edge_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_options',
				'title' => esc_html__( '404 Page Options', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type'   => 'color',
				'name'   => '404_page_background_color',
				'label'  => esc_html__( 'Background Color', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_image',
				'label'       => esc_html__( 'Background Image', 'noizzy' ),
				'description' => esc_html__( 'Choose a background image for 404 page', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'noizzy' ),
				'description' => esc_html__( 'Choose a pattern image for 404 page', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_title_image',
				'label'       => esc_html__( 'Title Image', 'noizzy' ),
				'description' => esc_html__( 'Choose a background image for displaying above 404 page Title', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'noizzy' ),
				'description'   => esc_html__( 'Enter title for 404 page. Default label is "404".', 'noizzy' )
			)
		);
		
		$first_level_group = noizzy_edge_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'first_level_group',
				'title'       => esc_html__( 'Title Style', 'noizzy' ),
				'description' => esc_html__( 'Define styles for 404 page title', 'noizzy' )
			)
		);
		
		$first_level_row1 = noizzy_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_title_color',
				'label'  => esc_html__( 'Text Color', 'noizzy' ),
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_title_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'noizzy' ),
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$first_level_row2 = noizzy_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2',
				'next'   => true
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'noizzy' ),
				'options'       => noizzy_edge_get_font_style_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'noizzy' ),
				'options'       => noizzy_edge_get_font_weight_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'noizzy' ),
				'options'       => noizzy_edge_get_text_transform_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_subtitle',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle', 'noizzy' ),
				'description'   => esc_html__( 'Enter subtitle for 404 page. Default label is "PAGE NOT FOUND".', 'noizzy' )
			)
		);
		
		$second_level_group = noizzy_edge_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Subtitle Style', 'noizzy' ),
				'description' => esc_html__( 'Define styles for 404 page subtitle', 'noizzy' )
			)
		);
		
		$second_level_row1 = noizzy_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent' => $second_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_subtitle_color',
				'label'  => esc_html__( 'Text Color', 'noizzy' ),
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_subtitle_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'noizzy' ),
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_row2 = noizzy_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2',
				'next'   => true
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'noizzy' ),
				'options'       => noizzy_edge_get_font_style_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'noizzy' ),
				'options'       => noizzy_edge_get_font_weight_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'noizzy' ),
				'options'       => noizzy_edge_get_text_transform_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_text',
				'default_value' => '',
				'label'         => esc_html__( 'Text', 'noizzy' ),
				'description'   => esc_html__( 'Enter text for 404 page.', 'noizzy' )
			)
		);
		
		$third_level_group = noizzy_edge_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => '$third_level_group',
				'title'       => esc_html__( 'Text Style', 'noizzy' ),
				'description' => esc_html__( 'Define styles for 404 page text', 'noizzy' )
			)
		);
		
		$third_level_row1 = noizzy_edge_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row1'
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_text_color',
				'label'  => esc_html__( 'Text Color', 'noizzy' ),
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'noizzy' ),
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$third_level_row2 = noizzy_edge_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row2',
				'next'   => true
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'noizzy' ),
				'options'       => noizzy_edge_get_font_style_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'noizzy' ),
				'options'       => noizzy_edge_get_font_weight_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_text_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'noizzy' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'noizzy' ),
				'options'       => noizzy_edge_get_text_transform_array()
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'text',
				'name'        => '404_back_to_home',
				'label'       => esc_html__( 'Back to Home Button Label', 'noizzy' ),
				'description' => esc_html__( 'Enter label for "Back to home" button', 'noizzy' )
			)
		);
		
		noizzy_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'select',
				'name'          => '404_button_style',
				'default_value' => '',
				'label'         => esc_html__( 'Button Skin', 'noizzy' ),
				'description'   => esc_html__( 'Choose a style to make Back to Home button in that predefined style', 'noizzy' ),
				'options'       => array(
					''            => esc_html__( 'Default', 'noizzy' ),
					'light-style' => esc_html__( 'Light', 'noizzy' )
				)
			)
		);
	}
	
	add_action( 'noizzy_edge_options_map', 'noizzy_edge_error_404_options_map', 19 );
}