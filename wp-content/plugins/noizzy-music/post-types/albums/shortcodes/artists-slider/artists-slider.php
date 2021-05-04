<?php
namespace NoizzyMusic\CPT\Shortcodes\Albums;

use NoizzyMusic\Lib;

class ArtistsSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edge_artists_slider';

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
				    'name'                      => esc_html__( 'Artists Slider', 'noizzy-music' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by NOIZZY MUSIC', 'noizzy-music' ),
				    'icon'                      => 'icon-wpb-artists-slider extended-custom-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'visible_items',
                            'heading'    => esc_html__( 'Visible Items', 'noizzy-music' ),
                            'value'      => array(
                                esc_html__( 'One', 'noizzy-music' )   => '1',
                                esc_html__( 'Two', 'noizzy-music' )   => '2',
                                esc_html__( 'Three', 'noizzy-music' ) => '3',
                                esc_html__( 'Four', 'noizzy-music' )  => '4',
                                esc_html__( 'Five', 'noizzy-music' )  => '5'
                            ),
                            'dependency' => array( 'element' => 'layout', 'value' => 'blocks' ),
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
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_mousewheel',
                            'heading'     => esc_html__( 'Enable Mouse Wheel Scroll', 'noizzy-music' ),
                            'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, true ) ),
                            'save_always' => true,
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
            'order_by'			=> 'name',
            'order' 			=> 'ASC',
            'enable_mousewheel' => '',
            'selected_artists' 	=> '',
            'visible_items'     => '1',
            'space_between_items'  => 'no',
		);
		$params = shortcode_atts( $args, $atts );

        $params['holder_classes'] = $this->getHolderClasses( $params, $args );
        $params['artists']        = $this->getTaxonomyArray($params);
        $params['self']           = $this;
        $params['data_atts']      = $this->getDataAtts($params);
		
		$html = noizzy_music_get_cpt_shortcode_module_template_part( 'albums', 'artists-slider', 'artists-holder', '', $params );
		
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

    public function getLatestAlbumLink($albums){
        $albumLink = '';

        if ( ! empty( $albums->query ) ) {
            $albumLink = get_permalink($albums->query[0]->ID);
        }

        return $albumLink;
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

        $data_attr['data-number-of-items'] = $params['visible_items'];
        $data_attr['data-enable-center'] = 'yes';
        $data_attr['data-slider-padding'] = 'yes';
        $data_attr['data-slider-mousewheel'] = $params['enable_mousewheel'];

        if(!empty($params['order_by'])){
            $data_attr['data-order-by'] = $params['order_by'];
        }
        if(!empty($params['order'])){
            $data_attr['data-order'] = $params['order'];
        }

        if(!empty($params['selected_artists'])){
            $data_attr['data-selected-artists'] = $params['selected_artists'];
        }

        return $data_attr;
    }
	
	/**
	 * Generates team holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderClasses( $params, $args ) {
		$classes = array('edge-owl-slider');
		
		$classes[] = ! empty( $params['visible_items'] ) ? 'edge-' . $params['visible_items'] . '-columns' : 'edge-' . $args['visible_items'] . '-columns';
		
		return implode( ' ', $classes );
	}
}