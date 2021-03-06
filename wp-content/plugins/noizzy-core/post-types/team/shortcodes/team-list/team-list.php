<?php
namespace NoizzyCore\CPT\Shortcodes\Team;

use NoizzyCore\Lib;

class TeamList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edge_team_list';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Team category filter
	    add_filter( 'vc_autocomplete_edge_team_list_category_callback', array( &$this, 'teamCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Team category render
	    add_filter( 'vc_autocomplete_edge_team_list_category_render', array( &$this, 'teamCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Team selected projects filter
	    add_filter( 'vc_autocomplete_edge_team_list_selected_members_callback', array( &$this, 'teamIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Team selected projects render
	    add_filter( 'vc_autocomplete_edge_team_list_selected_members_render', array( &$this, 'teamIdAutocompleteRender', ), 10, 1 ); // Render exact team. Must return an array (label,value)
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Team List', 'noizzy-core' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by NOIZZY', 'noizzy-core' ),
				    'icon'                      => 'icon-wpb-team-list extended-custom-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
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
						    'description' => esc_html__( 'Default value is Three', 'noizzy-core' )
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
						    'heading'     => esc_html__( 'Number of team members per page', 'noizzy-core' ),
						    'description' => esc_html__( 'Set number of items for your team list. Enter -1 to show all.', 'noizzy-core' ),
						    'value'       => '-1'
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Team List', 'noizzy-core' ),
						    'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'noizzy-core' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'selected_members',
						    'heading'     => esc_html__( 'Show Only Members with Listed IDs', 'noizzy-core' ),
						    'settings'    => array(
							    'multiple'      => true,
							    'sortable'      => true,
							    'unique_values' => true
						    ),
						    'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'noizzy-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'orderby',
						    'heading'     => esc_html__('Order By', 'noizzy-core'),
						    'value'       => array_flip(noizzy_edge_get_query_order_by_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'order',
						    'heading'    => esc_html__('Order', 'noizzy-core'),
						    'value'      => array_flip(noizzy_edge_get_query_order_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'team_member_layout',
						    'heading'     => esc_html__( 'Team Member Layout', 'noizzy-core' ),
						    'value'       => array(
								esc_html__( 'Info Bellow', 'noizzy-core' ) => 'info-bellow',
								esc_html__( 'Info on Hover', 'noizzy-core' ) => 'info-hover',
						    ),
						    'save_always' => true,
						    'group'       => esc_html__( 'Content Layout', 'noizzy-core' )
					    )
				    )
			    )
		    );
	    }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'number_of_columns'     => '3',
            'space_between_items'   => 'normal',
	        'number_of_items'       => '-1',
            'category'              => '',
            'selected_members'     => '',
	        'tag'                   => '',
            'orderby'               => 'date',
            'order'                 => 'ASC',
	        'team_member_layout'    => 'info-bellow',
	        'team_slider'           => 'no',
	        'slider_navigation'	    => 'no',
	        'slider_pagination'	    => 'no'
        );
		$params = shortcode_atts($args, $atts);
	
	    /***
	     * @params query_results
	     * @params holder_data
	     * @params holder_classes
	     */
		$additional_params = array();
	    
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);
	    $additional_params['query_results'] = $query_results;

	    $additional_params['holder_classes'] = $this->getHolderClasses($params);
	    $additional_params['inner_classes']  = $this->getInnerClasses($params);
	    $additional_params['data_attrs']     = $this->getDataAttribute($params);
	
	    $params['this_object'] = $this;
	    
	    $html = noizzy_core_get_cpt_shortcode_module_template_part('team', 'team-list', 'team-holder', '', $params, $additional_params);

        return $html;
	}

	/**
    * Generates team list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'team-member',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);

		if(!empty($params['category'])){
			$query_array['team-category'] = $params['category'];
		}

		$member_ids = null;
		if (!empty($params['selected_members'])) {
            $member_ids = explode(',', $params['selected_members']);
			$query_array['post__in'] = $member_ids;
		}

		return $query_array;
	}

	/**
    * Generates team holder classes
    *
    * @param $params
    *
    * @return string
    */
	public function getHolderClasses($params){
		$classes = array();

		$number_of_columns   = $params['number_of_columns'];

        $classes[] = !empty($params['space_between_items']) ? 'edge-'.$params['space_between_items'].'-space' : 'edge-normal-space';

        if($params['team_slider'] !== 'yes') {
            switch ($number_of_columns):
                case '1':
                    $classes[] = 'edge-tl-one-columns';
                    break;
                case '2':
                    $classes[] = 'edge-tl-two-columns';
                    break;
                case '3':
                    $classes[] = 'edge-tl-three-columns';
                    break;
                case '4':
                    $classes[] = 'edge-tl-four-columns';
                    break;
                case '5':
                    $classes[] = 'edge-tl-five-columns';
                    break;
                default:
                    $classes[] = 'edge-tl-three-columns';
                    break;
            endswitch;
        } else {
            $classes[] = 'edge-tl-slider';
        }

        return implode(' ', $classes);
	}
	
	/**
	 * Generates team inner classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getInnerClasses($params){
		$classes = array();
		
		if($params['team_slider'] === 'yes') {
			$classes[] = 'edge-owl-slider';
		}
		
		return implode(' ', $classes);
	}

    /**
     * Return Team Slider data attribute
     *
     * @param $params
     *
     * @return array
     */

    private function getDataAttribute($params) {
        $data_attrs = array();
	
	    $data_attrs['data-number-of-items']   = !empty($params['number_of_columns']) ? $params['number_of_columns'] : '3';
	    $data_attrs['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
	    $data_attrs['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $data_attrs;
    }

	public function getTeamSocialIcons($id) {
		$social_icons = array();

		for($i = 1; $i < 6; $i++) {
			$team_icon_pack = get_post_meta($id, 'edge_team_member_social_icon_pack_'.$i, true);
			if($team_icon_pack) {
				$team_icon_collection = noizzy_edge_icon_collections()->getIconCollection(get_post_meta($id, 'edge_team_member_social_icon_pack_' . $i, true));
				$team_social_icon = get_post_meta($id, 'edge_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true);
				$team_social_link = get_post_meta($id, 'edge_team_member_social_icon_' . $i . '_link', true);
				$team_social_target = get_post_meta($id, 'edge_team_member_social_icon_' . $i . '_target', true);

				if ($team_social_icon !== '') {

					$team_icon_params = array();
					$team_icon_params['icon_pack'] = $team_icon_pack;
					$team_icon_params[$team_icon_collection->param] = $team_social_icon;
					$team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
					$team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';

					$social_icons[] = noizzy_edge_execute_shortcode('edge_icon', $team_icon_params);
				}
			}
		}

		return $social_icons;
	}

	/**
	 * Filter team categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function teamCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS team_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'team-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['team_category_title'] ) > 0 ) ? esc_html__( 'Category', 'noizzy-core' ) . ': ' . $value['team_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find team category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function teamCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get team category
			$team_category = get_term_by( 'slug', $query, 'team-category' );
			if ( is_object( $team_category ) ) {

				$team_category_slug = $team_category->slug;
				$team_category_title = $team_category->name;

				$team_category_title_display = '';
				if ( ! empty( $team_category_title ) ) {
					$team_category_title_display = esc_html__( 'Category', 'noizzy-core' ) . ': ' . $team_category_title;
				}

				$data          = array();
				$data['value'] = $team_category_slug;
				$data['label'] = $team_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter teams by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function teamIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$team_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'team-member' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $team_id > 0 ? $team_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'noizzy-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'noizzy-core' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find team by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function teamIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get team
			$team = get_post( (int) $query );
			if ( ! is_wp_error( $team ) ) {

				$team_id = $team->ID;
				$team_title = $team->post_title;

				$team_title_display = '';
				if ( ! empty( $team_title ) ) {
					$team_title_display = ' - ' . esc_html__( 'Title', 'noizzy-core' ) . ': ' . $team_title;
				}

				$team_id_display = esc_html__( 'Id', 'noizzy-core' ) . ': ' . $team_id;

				$data          = array();
				$data['value'] = $team_id;
				$data['label'] = $team_id_display . $team_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}