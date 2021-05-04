<?php
namespace NoizzyMusic\CPT\Shortcodes\Albums;

use NoizzyMusic\Lib;

class ArtistsList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edge_artists_list';

        add_action('vc_before_init', array($this, 'vcMap'));
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
				    'name'                      => esc_html__( 'Artists List', 'noizzy-music' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by NOIZZY MUSIC', 'noizzy-music' ),
				    'icon'                      => 'icon-wpb-artists-list extended-custom-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'layout',
                            'heading'    => esc_html__( 'Layout', 'noizzy-music' ),
                            'value'      => array(
                                esc_html__( 'Standard', 'noizzy-music' )   => 'holder',
                                esc_html__( 'Text List', 'noizzy-music' )  => 'text',
                            ),
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'number_of_columns',
                            'heading'    => esc_html__( 'Number of Columns', 'noizzy-music' ),
                            'value'      => array(
                                esc_html__( 'One', 'noizzy-music' )   => '1',
                                esc_html__( 'Two', 'noizzy-music' )   => '2',
                                esc_html__( 'Three', 'noizzy-music' ) => '3',
                                esc_html__( 'Four', 'noizzy-music' )  => '4',
                                esc_html__( 'Five', 'noizzy-music' )  => '5'
                            ),
                            'dependency' => array( 'element' => 'layout', 'value' => 'holder' ),
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__( 'Space Between Items', 'noizzy-music' ),
                            'value'       => array_flip( noizzy_edge_get_space_between_items_array(false, true, true, true) ),
                            'save_always' => true,
                            'dependency' => array( 'element' => 'layout', 'value' => 'holder' ),
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Text Before List', 'noizzy-music'),
                            'param_name' => 'text',
                            'value' => '',
                            'admin_label' => true,
                            'dependency' => array( 'element' => 'layout', 'value' => 'text' ),
                            'description' => esc_html__('Text To Be shown before the artists text list', 'noizzy-music'),
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Order By', 'noizzy-music'),
                            'param_name' => 'order_by',
                            'value' => array(
                                esc_html__('Name', 'noizzy-music') => 'name',
                                esc_html__('Order Number', 'noizzy-music') => 'artist_order'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => '',
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Order', 'noizzy-music'),
                            'param_name' => 'order',
                            'value' => array(
                                'ASC' => 'ASC',
                                'DESC' => 'DESC',
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => '',
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Show Only Artists with Listed IDs', 'noizzy-music'),
                            'param_name' => 'selected_artists',
                            'value' => '',
                            'admin_label' => true,
                            'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'noizzy-music'),
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
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
	public function render( $atts, $content = null ) {
		$args   = array(
		    'layout'            => 'holder',
            'order_by'			=> 'name',
            'order' 			=> 'ASC',
            'selected_artists' 	=> '',
            'number_of_columns' => '3',
            'space_between_items'  => 'tiny',
            'text'                 => ''
		);
		$params = shortcode_atts( $args, $atts );

        $params['holder_classes'] = $this->getHolderClasses( $params, $args );
        $params['artists']        = $this->getTaxonomyArray($params);
        $params['self']           = $this;
        $params['data_atts']      = $this->getDataAtts($params);

        $html = '<div class="edge-artists-list-holder-outer">';
        
		$html .= noizzy_music_get_cpt_shortcode_module_template_part( 'albums', 'artists-list', 'artists-' . $params['layout'], '', $params );

		if ($params['layout'] === 'holder') {
            $html .= '<div class="edge-artist-single-expander"></div>';
            $html .= '<div class="edge-artist-view-single">';
            if (!empty($params['artists'])) {
                $counter = 1;
                $params['number_of_artists'] = sprintf("%02d", count($params['artists']));
                foreach ($params['artists'] as $artist) {
                    $params['artist'] = $artist;
                    $params['counter'] = sprintf("%02d", $counter);
                    $html .= noizzy_music_get_cpt_shortcode_module_template_part('albums', 'artists-list', 'artist-single', '', $params);
                    $counter++;
                }
                $html .= noizzy_music_get_cpt_shortcode_module_template_part('albums', 'artists-list', 'artist-single-navigation', '', $params);
            }
            $html .= '</div>'; //close edge-artist-view-single

            wp_reset_postdata();
            $html .= '</div>'; // close edge-artists-list-holder-outer
        }

		return $html;
	}

    /**
     * Generates albums list query attribute array
     *
     * @param $params
     *
     * @return array
     */
    public function getTaxonomyArray($params){
        $tax = 'album-artist';

        $args = array(
            'hide_empty' => false,
            'order' => $params['order'],
        );

        if($params['order_by'] == 'artist_order'){
            $args['meta_key'] = 'artist_order';
            $args['orderby'] = 'meta_value';
        }else{
            $args['orderby'] = $params['order_by'];
        }

        if (!empty($params['selected_artists'])) {
            $args['include'] = $params['selected_artists'];
        }

        $artists = get_terms($tax, $args);

        return $artists;
    }

    public function getAlbumsArray($artist){
        $tax = 'album-artist';

        $args = get_posts(array(
            'post_type'   => 'album',
            'numberposts' => -1,
            'order_by'    => 'date',
            'order'       => 'DESC',
            'tax_query'   => array(
                array(
                    'taxonomy' => $tax,
                    'field'    => 'id',
                    'terms'    => $artist,
                    'include_children' => false
                )
            )
        ));

        $artists = new \WP_Query($args);

        return $artists;
    }

    public function getLatestAlbum($albums){
        $album = '';

       if ( ! empty( $albums->query ) ) {
            $album = $albums->query[0]->post_title;
       }

        return $album;
    }

    /**
     * Generates datta attributes array
     *
     * @param $params
     *
     * @return array
     */
    public function getDataAtts($params){

        $data_attr = array();
        $data_return_string = '';

        if(!empty($params['order_by'])){
            $data_attr['data-order-by'] = $params['order_by'];
        }
        if(!empty($params['order'])){
            $data_attr['data-order'] = $params['order'];
        }

        if(!empty($params['selected_artists'])){
            $data_attr['data-selected-artists'] = $params['selected_artists'];
        }

        foreach($data_attr as $key => $value) {
            if($key !== '') {
                $data_return_string .= $key . '= "' . esc_attr( $value ) . '" ';
            }
        }

        return $data_return_string;
    }
	
	/**
	 * Generates team holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['number_of_columns'] ) ? 'edge-' . $params['number_of_columns'] . '-columns' : 'edge-' . $args['number_of_columns'] . '-columns';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'edge-' . $params['space_between_items'] . '-space' : 'edge-' . $args['space_between_items'] . '-space';
        $classes[] = $params['layout'] ? 'edge-' . $params['layout'] : '';
		
		return implode( ' ', $classes );
	}

	public function getSocialIcons($id) {
		$social_icons = '';

        $artist_fb       = get_term_meta( $id, 'artist_fb', true );
        $artist_insta    = get_term_meta( $id, 'artist_insta', true );
        $artist_tw       = get_term_meta( $id, 'artist_tw', true );
        $artist_yt       = get_term_meta( $id, 'artist_yt', true );

        if ( ! empty( $artist_fb ) ) {
            $social_icons .= '<a href="' . esc_attr($artist_fb) . '"><i class="fa fa-facebook"></i></a>';
        }

        if ( ! empty( $artist_insta ) ) {
            $social_icons .= '<a href="' . esc_attr($artist_insta) . '"><i class="fa fa-instagram"></i></a>';
        }

        if ( ! empty( $artist_tw ) ) {
            $social_icons .= '<a href="' . esc_attr($artist_tw) . '"><i class="fa fa-twitter"></i></a>';
        }

        if ( ! empty( $artist_yt ) ) {
            $social_icons .= '<a href="' . esc_attr($artist_yt) . '"><i class="fa fa-youtube"></i></a>';
        }

		return $social_icons;
	}
}