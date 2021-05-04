<?php
namespace NoizzyMusic\CPT\Shortcodes\Albums;

use NoizzyMusic\Lib;

class Album implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edge_album';

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
					'name' => esc_html__('Album', 'noizzy-music'),
					'base' => $this->base,
					'category' => esc_html__('by NOIZZY MUSIC','noizzy-music'),
					'icon' => 'icon-wpb-album extended-custom-music-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Album','noizzy-music'),
							'param_name' 	=> 'album',
							'value' 		=> $this->getAlbums(),
							'admin_label' 	=> true,
							'save_always' 	=> true
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Album Skin','noizzy-music'),
							'param_name' => 'album_skin',
							'value' => array(
								esc_html__('Default','noizzy-music') 	=> '',
								esc_html__('Dark','noizzy-music') 		=> 'dark',
								esc_html__('Light','noizzy-music') 		=> 'light'
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => ''
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
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'album'		 => '',
			'album_skin' => '',
		);

		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['alb_skin'] = $this->getAlbumClasses($params);

		$html = '';
		$params['random_id'] = 'edge-album-id-'.rand();
		$params['tracks'] = $this->getTracks($params);

		$html .= noizzy_music_get_cpt_shortcode_module_template_part('albums','album','album-template', '', $params);
		return $html;
	}


	private function getAlbums(){

		$albums_array = array();
		$args = array(
			'post_type'			=> 'album',
			'posts_per_page'	=> '-1'
		);

		$query = new \WP_Query($args);
		if($query->have_posts()) :
			while($query->have_posts()) : $query->the_post();
				$albums_array[get_the_ID()] = get_the_title();
			endwhile;
		endif;

		return  array_flip($albums_array);
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

				$pos = strpos($track_data['length_formatted'], ':');
				$minutes = substr($track_data['length_formatted'], 0, $pos); 
				if ( strlen($minutes) < 2 ) {
					$minutes = '0'.$minutes;
				}
				$seconds = substr($track_data['length_formatted'], $pos + 1);
				if ( strlen($seconds) < 2 ) {
					$seconds = '0'.$seconds;
				}
				$tracks_array[$i]['track_time'] = $minutes.':'.$seconds;
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

	private function getAlbumClasses($params) {

		$album_classes = array();

		if ($params['album_skin'] == 'light') {
			$album_classes[] = 'edge-album-light';
		} else if ($params['album_skin'] == 'dark') {
			$album_classes[] = 'edge-album-dark';
		}

		return implode(';', $album_classes);
	}

}