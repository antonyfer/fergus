<?php
namespace NoizzyMusic\CPT\Shortcodes\Albums;

use NoizzyMusic\Lib;

class AlbumPlayer implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edge_album_player';

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
					'name' => esc_html__('Album Player', 'noizzy-music'),
					'base' => $this->base,
					'category' => esc_html__('by NOIZZY MUSIC','noizzy-music'),
					'icon' => 'icon-wpb-album-player extended-custom-music-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Type','noizzy-music'),
							'param_name' 	=> 'type',
							'value' => array(	
								esc_html__('Standard','noizzy-music')		=> 'standard',
                                esc_html__('With Featured Image','noizzy-music') => 'featured',
								esc_html__('Simple','noizzy-music')		=> 'simple',
								esc_html__('With Images','noizzy-music') 	=> 'with_images'
							),
							'admin_label' 	=> true
						),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'image',
                            'heading'     => esc_html__( 'Image', 'noizzy-music' ),
                            'description' => esc_html__( 'Select image from media library', 'noizzy-music' ),
                            'dependency'  => array( 'element' => 'type', 'value' => 'featured' )
                        ),
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Album','noizzy-music'),
							'param_name' 	=> 'album',
							'value' 		=> $this->getAlbums(),
							'admin_label' 	=> true,
							'save_always' 	=> true
						),
						array(
	                        'type'        => 'dropdown',
	                        'heading'     => esc_html__('Content In Grid','noizzy-music'),
	                        'param_name'  => 'full_width_bg',
	                        'value'       => array(
	                            esc_html__('Yes','noizzy-music')     => 'yes',
	                            esc_html__('No','noizzy-music')      => 'no'
	                        ),
	                        'admin_label' => true,
	               			'save_always' => true
	                    ),
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Skin','noizzy-music'),
							'param_name' 	=> 'skin',
							'value' => array(
								esc_html__('Dark','noizzy-music')		=> 'dark',
								esc_html__('Light','noizzy-music')   	=> 'light'
							),
							'admin_label' 	=> true,
							'save_always' 	=> true
						),
						array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Enable Shadow','noizzy-music'),
                            'param_name'  => 'shadow',
                            'value'       => array(
                                esc_html__('No','noizzy-music')      => 'no',
                                esc_html__('Yes','noizzy-music')     => 'yes',
                            ),
                            'admin_label' => true,
                            'save_always' => true
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
			'type'			=> 'standard',
			'image'         => '',
			'album'			=> '',
			'full_width_bg'	=> '',
			'skin'			=> 'dark',
            'shadow'        => 'no'

		);

		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['player_id'] = rand();
		$params['player_classes'] = $this->getPlayerClasses($params);
		$html = '';

		$html .= noizzy_music_get_cpt_shortcode_module_template_part('albums', 'album-player', 'album-player-'.str_replace('_', '-', $params['type']).'-template', '', $params);
		return $html;
	}

	private function getAlbums(){

		$albums_array = array();
		$args = array(
			'post_type' => 'album',
			'posts_per_page' => '-1'
		);

		$query = new \WP_Query($args);
		if($query->have_posts()) :
			while($query->have_posts()) : $query->the_post();
				$albums_array[get_the_ID()] = get_the_title();
			endwhile;
		endif;

		return  array_flip($albums_array);
	}

	private function getPlayerClasses($params) {

		$player_classes = array();

		if ($params['skin'] == 'light') {
			$player_classes[] = 'edge-player-light';
		}

		if ($params['full_width_bg'] == 'no') {
			$player_classes[] = 'edge-player-full-background';
		}

		if ($params['type'] == 'with_images') {
			$player_classes[] = 'edge-player-with-images';
		}

        if ($params['type'] == 'featured') {
            $player_classes[] = 'edge-player-featured-image';
        }

        if ($params['shadow'] == 'yes') {
            $player_classes[] = 'edge-player-shadow';
        }


		return implode(' ', $player_classes);
	}

	private function getTracks($params){

		$tracks_array = array();
		$tracks = get_post_meta($params['album'], 'edge_tracks_repeater', true);

		$i = 0;

		if($tracks){
			foreach($tracks as $track){

                $file = $track['edge_track_file'];
                $titles = $track['edge_track_title'];
                $videos = $track['edge_track_video_link'];
                $free_download = $track['edge_track_free_download'];
                $lyrics = $track['edge_track_lyrics'];
				/*------------------------------------------------------------------------------------------*/
				//if import is executed second time and file does exists in 'uploads' but not in database
				//usercase ex: user empties db, but not 'uploads' folder
				if(noizzy_edge_get_attachment_id_from_url($file) == null){
					$i++;
					continue;
				}
				/*------------------------------------------------------------------------------------------*/



				$tracks_array[$i]['track_file'] = $file;
				$track_id = noizzy_edge_get_attachment_id_from_url($file);

				$track_data = wp_get_attachment_metadata($track_id);
				$tracks_array[$i]['track_time'] = $track_data['length_formatted'];
				if(isset($videos)){
					$tracks_array[$i]['video_link'] = $videos;
				}

                if(isset($lyrics)){
                    $tracks_array[$i]['lyrics'] = $lyrics;
                }

				if(isset($titles)){
					$tracks_array[$i]['title']	= $titles;
				}

				if(isset($free_download) && $free_download != ''){
					$tracks_array[$i]['free_download']	= $free_download;
				}
				$i++;
			}
		}

		return  $tracks_array;
	}

}