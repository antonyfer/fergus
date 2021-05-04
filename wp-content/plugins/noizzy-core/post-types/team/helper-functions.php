<?php

if ( ! function_exists( 'noizzy_core_team_meta_box_functions' ) ) {
	function noizzy_core_team_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'noizzy_edge_meta_box_post_types_save', 'noizzy_core_team_meta_box_functions' );
	add_filter( 'noizzy_edge_meta_box_post_types_remove', 'noizzy_core_team_meta_box_functions' );
}

if ( ! function_exists( 'noizzy_core_team_scope_meta_box_functions' ) ) {
	function noizzy_core_team_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'noizzy_edge_set_scope_for_meta_boxes', 'noizzy_core_team_scope_meta_box_functions' );
}

if ( ! function_exists( 'noizzy_core_team_enqueue_meta_box_styles' ) ) {
	function noizzy_core_team_enqueue_meta_box_styles() {
		global $post;
		
		if ( $post->post_type == 'team-member' ) {
			wp_enqueue_style( 'edge-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}
	}
	
	add_action( 'noizzy_edge_enqueue_meta_box_styles', 'noizzy_core_team_enqueue_meta_box_styles' );
}

if ( ! function_exists( 'noizzy_core_register_team_cpt' ) ) {
	function noizzy_core_register_team_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'NoizzyCore\CPT\Team\TeamRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'noizzy_core_filter_register_custom_post_types', 'noizzy_core_register_team_cpt' );
}

// Load team shortcodes
if(!function_exists('noizzy_core_include_team_shortcodes_files')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function noizzy_core_include_team_shortcodes_files() {
        foreach(glob(NOIZZY_CORE_CPT_PATH.'/team/shortcodes/*/load.php') as $shortcode_load) {
            include_once $shortcode_load;
        }
    }

    add_action('noizzy_core_action_include_shortcodes_file', 'noizzy_core_include_team_shortcodes_files');
}

if ( ! function_exists( 'noizzy_core_get_single_team' ) ) {
	/**
	 * Loads holder template for doctor single
	 */
	function noizzy_core_get_single_team() {
		$team_member_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => noizzy_edge_sidebar_layout(),
			'position'       => get_post_meta( $team_member_id, 'edge_team_member_position', true ),
			'birth_date'     => get_post_meta( $team_member_id, 'edge_team_member_birth_date', true ),
			'email'          => get_post_meta( $team_member_id, 'edge_team_member_email', true ),
			'phone'          => get_post_meta( $team_member_id, 'edge_team_member_phone', true ),
			'address'        => get_post_meta( $team_member_id, 'edge_team_member_address', true ),
			'education'      => get_post_meta( $team_member_id, 'edge_team_member_education', true ),
			'resume'         => get_post_meta( $team_member_id, 'edge_team_member_resume', true ),
			'social_icons'   => noizzy_core_single_team_social_icons( $team_member_id ),
		);
		
		noizzy_core_get_cpt_single_module_template_part( 'templates/single/holder', 'team', '', $params );
	}
}

if ( ! function_exists( 'noizzy_core_single_team_social_icons' ) ) {
	function noizzy_core_single_team_social_icons( $id ) {
		$social_icons = array();
		
		for ( $i = 1; $i < 6; $i ++ ) {
			$team_icon_pack = get_post_meta( $id, 'edge_team_member_social_icon_pack_' . $i, true );
			if ( $team_icon_pack !== '' ) {
				$team_icon_collection = noizzy_edge_icon_collections()->getIconCollection( get_post_meta( $id, 'edge_team_member_social_icon_pack_' . $i, true ) );
				$team_social_icon     = get_post_meta( $id, 'edge_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true );
				$team_social_link     = get_post_meta( $id, 'edge_team_member_social_icon_' . $i . '_link', true );
				$team_social_target   = get_post_meta( $id, 'edge_team_member_social_icon_' . $i . '_target', true );
				
				if ( $team_social_icon !== '' ) {
					$team_icon_params                                 = array();
					$team_icon_params['icon_pack']                    = $team_icon_pack;
					$team_icon_params[ $team_icon_collection->param ] = $team_social_icon;
					$team_icon_params['link']                         = ! empty( $team_social_link ) ? $team_social_link : '';
					$team_icon_params['target']                       = ! empty( $team_social_target ) ? $team_social_target : '_self';
					
					$social_icons[] = noizzy_edge_execute_shortcode( 'edge_icon', $team_icon_params );
				}
			}
		}
		
		return $social_icons;
	}
}

if ( ! function_exists( 'noizzy_core_get_team_category_list' ) ) {
	function noizzy_core_get_team_category_list( $category = '' ) {
		$number_of_columns = 3;
		
		$params = array(
			'number_of_columns' => $number_of_columns
		);
		
		if ( ! empty( $category ) ) {
			$params['category'] = $category;
		}
		
		$html = noizzy_edge_execute_shortcode( 'edge_team_list', $params );

        print noizzy_edge_get_module_part($html);
	}
}

if ( ! function_exists( 'noizzy_core_add_team_to_search_types' ) ) {
	function noizzy_core_add_team_to_search_types( $post_types ) {
		$post_types['team-member'] = esc_html__( 'Team Member', 'noizzy-core' );
		
		return $post_types;
	}
	
	add_filter( 'noizzy_edge_search_post_type_widget_params_post_type', 'noizzy_core_add_team_to_search_types' );
}