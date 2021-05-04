<?php
namespace NoizzyMusic\CPT\Shortcodes\Albums;

use NoizzyMusic\Lib;

class AlbumsList implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edge_albums_list';

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
	 *
	 * @see vc_map
	 */

	public function vcMap() {
		if(function_exists('vc_map')) {

			vc_map( array(
					'name' => esc_html__('Albums List', 'noizzy-music'),
					'base' => $this->getBase(),
					'category' => esc_html__('by NOIZZY MUSIC', 'noizzy-music'),
					'icon' => 'icon-wpb-albums-list extended-custom-music-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Albums List Template', 'noizzy-music'),
							'param_name' => 'type',
							'value' => array(
								esc_html__('Gallery With Space', 'noizzy-music')    => 'gallery-with-space',
								esc_html__('Gallery No Space', 'noizzy-music')      => 'gallery-no-space',
                                esc_html__('Gallery With Buttons', 'noizzy-music')  => 'gallery-with-buttons',
								esc_html__('Standard With Space', 'noizzy-music')   => 'standard-with-space',
								esc_html__('Standard No Space', 'noizzy-music')     => 'standard-no-space',
                                esc_html__('Standard With Buttons', 'noizzy-music') => 'with-buttons'
							),
							'admin_label' => true,
							'description' => ''
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'google_store',
                            'heading'    => esc_html__( 'Google Play Store Link', 'noizzy-core' ),
                            'admin_label' 	=> true,
                            'dependency' => array( 'element' => 'type', 'value' => array('with-buttons', 'gallery-with-buttons') ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'app_store',
                            'heading'    => esc_html__( 'App Store Link', 'noizzy-core' ),
                            'admin_label' 	=> true,
                            'dependency' => array( 'element' => 'type', 'value' => array('with-buttons', 'gallery-with-buttons') ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__('Show Predefined Button Instead of Category', 'noizzy-music'),
                            'param_name' => 'button',
                            'value'      => array(
                                esc_html__('No', 'noizzy-music')  => 'no',
                                esc_html__('Yes', 'noizzy-music') => 'yes'

                            ),
                            'dependency' => array( 'element' => 'type', 'value' => array('gallery-no-space', 'gallery-with-space') ),
                        ),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Order By', 'noizzy-music'),
							'param_name' => 'order_by',
							'value' => array(
								esc_html__('Date', 'noizzy-music') 		=> 'date',
								esc_html__('Title', 'noizzy-music') 		=> 'title',
								esc_html__('Menu Order', 'noizzy-music') => 'menu_order'
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
							'heading' => esc_html__('One-Label Albums List', 'noizzy-music'),
							'param_name' => 'label',
							'value' => '',
							'admin_label' => true,
							'description' => esc_html__('Enter one label slug (leave empty for showing all labels)', 'noizzy-music'),
							'group' => esc_html__('Query and Layout Options', 'noizzy-music')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('One-Genre Albums List', 'noizzy-music'),
							'param_name' => 'genre',
							'value' => '',
							'admin_label' => true,
							'description' => esc_html__('Enter one genre slug (leave empty for showing all genres)', 'noizzy-music'),
							'group' => esc_html__('Query and Layout Options', 'noizzy-music')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('One-Artist Albums List', 'noizzy-music'),
							'param_name' => 'artist',
							'value' => '',
							'admin_label' => true,
							'description' => esc_html__('Enter one artist slug (leave empty for showing all artists)', 'noizzy-music'),
							'group' => esc_html__('Query and Layout Options', 'noizzy-music')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Number of Albums Per Page', 'noizzy-music'),
							'param_name' => 'number',
							'value' => '-1',
							'admin_label' => true,
							'description' => esc_html__('(enter -1 to show all)', 'noizzy-music'),
							'group' 	  => esc_html__('Query and Layout Options', 'noizzy-music')
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Number of Columns', 'noizzy-music'),
							'param_name' => 'columns',
							'value' => array(
								'' 								=> '',
								esc_html__('Two', 'noizzy-music') 	=> '2',
								esc_html__('Three', 'noizzy-music')	=> '3',
								esc_html__('Four', 'noizzy-music') 	=> '4'
							),
							'admin_label' => true,
							'description' => esc_html__('Default value is Three', 'noizzy-music'),
							'group' 	  => esc_html__('Query and Layout Options', 'noizzy-music')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Show Only Albums with Listed IDs', 'noizzy-music'),
							'param_name' => 'selected_albums',
							'value' => '',
							'admin_label' => true,
							'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'noizzy-music'),
							'group' => esc_html__('Query and Layout Options', 'noizzy-music')
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Show Load More', 'noizzy-music'),
							'param_name' => 'show_load_more',
							'value' => array(
								esc_html__('No', 'noizzy-music') 	=> 'no',
								esc_html__('Yes', 'noizzy-music') 	=> 'yes'

							),
							'group' => esc_html__('Query and Layout Options', 'noizzy-music')
						),
						array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Title Tag', 'noizzy-music'),
                            'param_name'  => 'title_tag',
                            'value'       => array(
                                ''   => '',
                                'h1' => 'h1',
                                'h2' => 'h2',
                                'h3' => 'h3',
                                'h4' => 'h4',
                                'h5' => 'h5',
                                'h6' => 'h6',
                            ),
                            'admin_label' => true,
                            'description' => '',
                            'group'       => esc_html__('Query and Layout Options', 'noizzy-music'),
                        ),
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
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type' 				=> 'gallery-with-space',
            'button'            => 'no',
			'columns' 			=> '3',
			'order_by'			=> 'date',
			'order' 			=> 'ASC',
			'number' 			=> '-1',
			'label' 			=> '',
			'genre' 			=> '',
			'artist'			=> '',
			'selected_albums' 	=> '',
			'show_load_more' 	=> '',
			'title_tag'			=> 'h5',
            'albums_slider_on'  => 'no',
			'google_store'      => '',
			'app_store'         => '',
            'enable_navigation'      => 'no'
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);
		$params['query_results'] = $query_results;

		$classes = $this->getAlbumsClasses($params);
        $holder_inner_classes = $this->getHolderInnerClasses($params);
		$data_atts = $this->getDataAtts($params);
		$data_atts .= 'data-max-num-pages = '.$query_results->max_num_pages;

		$html = '';

		$html .= '<div class = "edge-albums-list-holder-outer '.esc_attr($classes).'" '.$data_atts. '>';

		$html .= '<div class = "edge-albums-list-holder clearfix ' . esc_attr($holder_inner_classes) . '" >';
		

		if($query_results->have_posts()):
			while ( $query_results->have_posts() ) : $query_results->the_post();

				$params['current_id']  = get_the_ID();
				$params['size']        = get_post_meta(get_the_ID(), 'edge_albums_list_dimensions_meta', true);
				$params['album_link']  = get_permalink($params['current_id']);
				$params['artist_html'] = $this->getAlbumArtistsHtml($params);
                $params['label_html'] = $this->getAlbumLabelsHtml($params);
                $params['thumb']       = 'full';

				if ( $params['size'] === 'edge-large-width' ) {
                    $params['thumb'] = 'noizzy_edge_landscape';
                }

				if($type == 'standard-with-space' || $type == 'standard-no-space' ) {
                    $html .= noizzy_music_get_cpt_shortcode_module_template_part('albums', 'albums-list', 'standard', '', $params);

				} elseif($type == 'with-buttons' ){
                    $html .= noizzy_music_get_cpt_shortcode_module_template_part('albums','albums-list',$type, '', $params);

				} elseif($type == 'gallery-with-buttons' ){
                    $html .= noizzy_music_get_cpt_shortcode_module_template_part('albums','albums-list',$type, '', $params);

                } else {
					$html .= noizzy_music_get_cpt_shortcode_module_template_part('albums','albums-list','gallery', '', $params);
				}

			endwhile;
		else:

			$html .= '<p>'. esc_html_e( 'Sorry, no albums matched your criteria.', 'noizzy-music') .'</p>';

		endif;

		$html .= '</div>'; //close edge-albums-list-holder
		if($show_load_more == 'yes'){
			$html .= noizzy_music_get_cpt_shortcode_module_template_part('albums','albums-list','load-more-template', '', $params);
		}
		wp_reset_postdata();
		$html .= '</div>'; // close edge-albums-list-holder-outer
		return $html;
	}

	/**
	 * Generates albums list query attribute array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getQueryArray($params){

		$query_array = array(
			'post_type' => 'album',
			'orderby' =>$params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number']
		);

		if(!empty($params['label'])){
			$query_array['album-label'] = $params['label'];
		}

		if(!empty($params['genre'])){
			$query_array['album-genre'] = $params['genre'];
		}

		if(!empty($params['artist'])){
			$query_array['album-artist'] = $params['artist'];
		}

		$albums_ids = null;
		if (!empty($params['selected_albums'])) {
			$albums_ids = explode(',', $params['selected_albums']);
			$query_array['post__in'] = $albums_ids;
		}

		$paged = '';
		if(empty($params['next_page'])) {
			if(get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif(get_query_var('page')) {
				$paged = get_query_var('page');
			}
		}

		if(!empty($params['next_page'])){
			$query_array['paged'] = $params['next_page'];

		}else{
			$query_array['paged'] = 1;
		}

		return $query_array;
	}

    public function getHolderInnerClasses( $params ) {
        $classes = array();

        $classes[] = $params['albums_slider_on'] === 'yes' ? 'edge-owl-slider edge-pl-is-slider' : '';

        return implode( ' ', $classes );
    }

	/**
	 * Generates albums classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getAlbumsClasses($params){
		$classes = array();
		$type = $params['type'];
		$columns = $params['columns'];

		switch($type):
            case 'standard-with-space':
                $classes[] = 'edge-alb-standard edge-alb-standard-with-space';
                break;
			case 'standard-no-space':
				$classes[] = 'edge-alb-standard';
				break;
            case 'gallery-with-space':
                $classes[] = 'edge-alb-gallery edge-alb-gallery-with-space';
                break;
			case 'gallery-no-space':
				$classes[] = 'edge-alb-gallery';
				break;
            case 'gallery-with-buttons':
                $classes[] = 'edge-alb-gallery with-buttons edge-alb-gallery-with-space';
                break;
		endswitch;
	    
		switch ($columns):
			case '2':
				$classes[] = 'edge-alb-two-columns';
				break;
			case '3':
				$classes[] = 'edge-alb-three-columns';
				break;
			case '4':
				$classes[] = 'edge-alb-four-columns';
				break;
		endswitch;

		if($type == 'standard-no-space' || $type == 'gallery-no-space' ){
			$classes[] = "edge-album-wide";
		}

		if($params['show_load_more'] == 'yes') {
			$classes[] = "edge-albums-load-more";
		}

		return implode(' ',$classes);

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

		if(get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		if(!empty($paged)) {
			$data_attr['data-next-page'] = $paged + 1;
		}

		if(!empty($params['type'])){
			$data_attr['data-type'] = $params['type'];
		}
		if(!empty($params['columns'])){
			$data_attr['data-number-of-columns'] = $params['columns'];
		}
		if(!empty($params['order_by'])){
			$data_attr['data-order-by'] = $params['order_by'];
		}
		if(!empty($params['order'])){
			$data_attr['data-order'] = $params['order'];
		}
		if(!empty($params['number'])){
			$data_attr['data-number'] = $params['number'];
		}
		if(!empty($params['label'])){
			$data_attr['data-label'] = $params['label'];
		}
		if(!empty($params['genre'])){
			$data_attr['data-genre'] = $params['genre'];
		}
		if(!empty($params['artist'])){
			$data_attr['data-artist'] = $params['artist'];
		}
		if(!empty($params['selected_albums'])){
			$data_attr['data-selected-albums'] = $params['selected_albums'];
		}
		if(!empty($params['title_tag'])){
			$data_attr['data-title-tag'] = $params['title_tag'];
		}
		if ( $params['albums_slider_on'] === 'yes' ) {
		    $data_attr['data-enable-center'] = 'yes';
        }

        if ( $params['enable_navigation'] === 'yes' ) {
            $data_attr['data-enable-navigation'] = 'yes';
        } else {
            $data_attr['data-enable-navigation'] = 'no';
        }

		foreach($data_attr as $key => $value) {
			if($key !== '') {
				$data_return_string .= $key . '= "' . esc_attr( $value ) . '" ';
			}
		}
		return $data_return_string;
	}


	/**
	 * Generates album artists html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getAlbumArtistsHtml($params){
		$id = $params['current_id'];

		$artists = wp_get_post_terms($id, 'album-artist');
		$artist_html = '<div class="edge-alb-artists-holder">';
		$k = 1;
		foreach ($artists as $art) {
			$artist_html .= '<span class="edge-alb-artists"><span>'.$art->name.'</span>';
			if (count($artists) != $k) {
				$artist_html .= ' / ';
			}
			$k++;
		}
		$artist_html .= '</div>';
		return $artist_html;
	}


    /**
     * Generates album labels html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getAlbumLabelsHtml($params){
        $id = $params['current_id'];

        $label = wp_get_post_terms($id, 'album-label');
        $label_html = '<div class="edge-alb-label-holder">';
        $k = 1;
        foreach ($label as $lab) {
            $label_html .= '<span class="edge-alb-labels">'.$lab->name.'</span>';
            if (count($label) != $k) {
                $label_html .= ' / ';
            }
            $k++;
        }
        $label_html .= '</div>';
        return $label_html;
    }
}