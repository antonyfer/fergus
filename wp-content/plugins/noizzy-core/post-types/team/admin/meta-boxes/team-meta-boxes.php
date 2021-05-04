<?php

if ( ! function_exists( 'noizzy_core_map_team_single_meta' ) ) {
	function noizzy_core_map_team_single_meta() {
		
		$meta_box = noizzy_edge_create_meta_box(
			array(
				'scope' => 'team-member',
				'title' => esc_html__( 'Team Member Info', 'noizzy-core' ),
				'name'  => 'team_meta'
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_team_member_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Position', 'noizzy-core' ),
				'description' => esc_html__( 'The members\'s role within the team', 'noizzy-core' ),
				'parent'      => $meta_box
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_team_member_birth_date',
				'type'        => 'date',
				'label'       => esc_html__( 'Birth date', 'noizzy-core' ),
				'description' => esc_html__( 'The members\'s birth date', 'noizzy-core' ),
				'parent'      => $meta_box
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_team_member_email',
				'type'        => 'text',
				'label'       => esc_html__( 'Email', 'noizzy-core' ),
				'description' => esc_html__( 'The members\'s email', 'noizzy-core' ),
				'parent'      => $meta_box
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_team_member_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Phone', 'noizzy-core' ),
				'description' => esc_html__( 'The members\'s phone', 'noizzy-core' ),
				'parent'      => $meta_box
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_team_member_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Address', 'noizzy-core' ),
				'description' => esc_html__( 'The members\'s addres', 'noizzy-core' ),
				'parent'      => $meta_box
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_team_member_education',
				'type'        => 'text',
				'label'       => esc_html__( 'Education', 'noizzy-core' ),
				'description' => esc_html__( 'The members\'s education', 'noizzy-core' ),
				'parent'      => $meta_box
			)
		);
		
		noizzy_edge_create_meta_box_field(
			array(
				'name'        => 'edge_team_member_resume',
				'type'        => 'file',
				'label'       => esc_html__( 'Resume', 'noizzy-core' ),
				'description' => esc_html__( 'Upload members\'s resume', 'noizzy-core' ),
				'parent'      => $meta_box
			)
		);
		
		for ( $x = 1; $x < 6; $x ++ ) {
			
			$social_icon_group = noizzy_edge_add_admin_group(
				array(
					'name'   => 'edge_team_member_social_icon_group' . $x,
					'title'  => esc_html__( 'Social Link ', 'noizzy-core' ) . $x,
					'parent' => $meta_box
				)
			);
			
			$social_row1 = noizzy_edge_add_admin_row(
				array(
					'name'   => 'edge_team_member_social_icon_row1' . $x,
					'parent' => $social_icon_group
				)
			);
			
			NoizzyEdgeIconCollections::get_instance()->getIconsMetaBoxOrOption(
				array(
					'label'            => esc_html__( 'Icon ', 'noizzy-core' ) . $x,
					'parent'           => $social_row1,
					'name'             => 'edge_team_member_social_icon_pack_' . $x,
					'defaul_icon_pack' => '',
					'type'             => 'meta-box',
					'field_type'       => 'simple'
				)
			);
			
			$social_row2 = noizzy_edge_add_admin_row(
				array(
					'name'   => 'edge_team_member_social_icon_row2' . $x,
					'parent' => $social_icon_group
				)
			);
			
			noizzy_edge_create_meta_box_field(
				array(
					'type'            => 'textsimple',
					'label'           => esc_html__( 'Link', 'noizzy-core' ),
					'name'            => 'edge_team_member_social_icon_' . $x . '_link',
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'edge_team_member_social_icon_pack_'. $x  => ''
						)
					)
				)
			);
			
			noizzy_edge_create_meta_box_field(
				array(
					'type'            => 'selectsimple',
					'label'           => esc_html__( 'Target', 'noizzy-core' ),
					'name'            => 'edge_team_member_social_icon_' . $x . '_target',
					'options'         => noizzy_edge_get_link_target_array(),
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'edge_team_member_social_icon_' . $x . '_link'  => ''
						)
					)
				)
			);
		}
	}
	
	add_action( 'noizzy_edge_meta_boxes_map', 'noizzy_core_map_team_single_meta', 46 );
}