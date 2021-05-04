<?php

if ( ! function_exists( 'noizzy_music_albums_meta_box_functions' ) ) {
    function noizzy_music_albums_meta_box_functions( $post_types ) {
        $post_types[] = 'album';

        return $post_types;
    }

    add_filter( 'noizzy_edge_meta_box_post_types_save', 'noizzy_music_albums_meta_box_functions' );
    add_filter( 'noizzy_edge_meta_box_post_types_remove', 'noizzy_music_albums_meta_box_functions' );
}

if ( ! function_exists( 'noizzy_music_albums_scope_meta_box_functions' ) ) {
    function noizzy_music_albums_scope_meta_box_functions( $post_types ) {
        $post_types[] = 'album';

        return $post_types;
    }

    add_filter( 'noizzy_edge_set_scope_for_meta_boxes', 'noizzy_music_albums_scope_meta_box_functions' );
}

if ( ! function_exists( 'noizzy_music_register_albums_cpt' ) ) {

    function noizzy_music_register_albums_cpt( $cpt_class_name ) {

        $cpt_class = array(
        'NoizzyMusic\CPT\Albums\AlbumsRegister'
        );

        $cpt_class_name = array_merge( $cpt_class_name, $cpt_class );

        return $cpt_class_name;

    }

    add_filter( 'noizzy_music_filter_register_custom_post_types', 'noizzy_music_register_albums_cpt' );
}

if ( ! function_exists( 'noizzy_music_enqueue_scripts_for_albums' ) ) {
    /**
     * Function that includes all necessary 3rd party scripts for this post type
     */
    function noizzy_music_enqueue_scripts_for_albums() {
        wp_enqueue_script( 'playlist', NOIZZY_MUSIC_CPT_URL_PATH . '/albums/assets/js/plugins/jplayer.playlist.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'jplayer', NOIZZY_MUSIC_CPT_URL_PATH . '/albums/assets/js/plugins/jquery.jplayer.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'dynamics', NOIZZY_MUSIC_CPT_URL_PATH . '/albums/assets/js/plugins/dynamics.min.js', array( 'jquery', 'noizzy-music-script' ), false, true );
    }

    add_action( 'noizzy_edge_enqueue_third_party_scripts', 'noizzy_music_enqueue_scripts_for_albums' );
}

// Load albums shortcodes
if(!function_exists('noizzy_music_include_albums_shortcodes_files')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function noizzy_music_include_albums_shortcodes_files() {
        foreach(glob(NOIZZY_MUSIC_CPT_PATH.'/albums/shortcodes/*/load.php') as $shortcode_load) {
            include_once $shortcode_load;
        }
    }

    add_action('noizzy_music_action_include_shortcodes_file', 'noizzy_music_include_albums_shortcodes_files');
}

if(!function_exists('noizzy_music_single_album')) {
    function noizzy_music_single_album() {
        $back_to_link = get_post_meta( get_the_ID(), 'edge_album_back_to_link', true );
        $album_type = noizzy_edge_get_meta_field_intersect('album_type');
        $store_type = ($album_type == 'comprehensive') ? 'image' : 'text';
        $params = array(
            'back_to_link' => $back_to_link,
            'store_type' => $store_type,
        );

        $album_skin = get_post_meta( get_the_ID(), 'edge_album_skin', true );
        $params['album_skin'] = ($album_skin == '')? 'default' : $album_skin;

        noizzy_music_get_cpt_single_module_template_part('templates/single/'.$album_type, 'albums', '', $params);
    }
}

if ( ! function_exists( 'noizzy_music_albums_add_social_share_option' ) ) {
    function noizzy_music_albums_add_social_share_option( $container ) {
        noizzy_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_social_share_on_album',
                'default_value' => 'no',
                'label'         => esc_html__( 'Albums', 'noizzy-core' ),
                'description'   => esc_html__( 'Show Social Share for Albums', 'noizzy-core' ),
                'parent'        => $container
            )
        );
    }

    add_action( 'noizzy_edge_post_types_social_share', 'noizzy_music_albums_add_social_share_option', 10, 1 );
}

if(!function_exists('noizzy_music_single_stores_names_and_images')) {
    function noizzy_music_single_stores_names_and_images($store, $type = '') {

        switch ($store):
            case 'google-play':
                $name = esc_html__('GooglePlay', 'noizzy-music');
                break;
            case 'bandcamp':
                $name = esc_html__('Bandcamp', 'noizzy-music');
                break;
            case 'spotify':
                $name = esc_html__('Spotify', 'noizzy-music');
                break;
            case 'amazonmp3':
                $name = esc_html__('AmazonMP3', 'noizzy-music');
                break;
            case 'deezer':
                $name = esc_html__('Deezer', 'noizzy-music');
                break;
            default:
                $name = esc_html__('iTunes', 'noizzy-music');
                break;
        endswitch;

        $image = '<img src="'.NOIZZY_MUSIC_URL_PATH.'/assets/img/stores/'.$store.'.png" alt="'.$name.'" />';

        if($type == 'image') {
            return $image;
        }

        return $name;

    }
}

if(!function_exists('noizzy_music_album_playlist')){

    function noizzy_music_album_playlist(){

        if(isset($_POST) && isset($_POST['album_id'])){

            $album_id = $_POST['album_id'];
            $json_data = array();
            $tracks = get_post_meta($album_id, 'edge_tracks_repeater', true);
            $i = 0;

            $artists   = wp_get_post_terms($album_id, 'album-artist');
            $artists_names = array();

            if(is_array($artists) && count($artists)) :
                foreach($artists as $artist) {
                    $artists_names[] = $artist->name;
                }
            endif;

            if($tracks){
                foreach($tracks as $track){

                    $track_id	= noizzy_edge_get_attachment_id_from_url($track['edge_track_file']);
                    $json_data[$i]['unique_id']	= 'edge-unique-track-'.$album_id.'-'.$track_id;
                    $json_data[$i]['mp3']	= $track['edge_track_file'];

                    if($track['edge_track_image']){
                        $json_data[$i]['poster'] = $track['edge_track_image'];
                    }

                    if($track['edge_track_title']){
                        $json_data[$i]['title']	= $track['edge_track_title'];
                    }

                    $json_data[$i]['artist_name'] = $artists_names;
                    $i++;
                }
//                var_dump($json_data);
                noizzy_music_ajax_status('success', '', $json_data);
            } else {
                noizzy_music_ajax_status('error', esc_html__('No tracks Founded.', 'noizzy-music'), $json_data);
            }


        }

        wp_die();
    }
}


add_action('wp_ajax_nopriv_noizzy_music_album_playlist', 'noizzy_music_album_playlist');
add_action( 'wp_ajax_noizzy_music_album_playlist', 'noizzy_music_album_playlist' );


if ( ! function_exists( 'noizzy_music_ajax_status' ) ) {

    function noizzy_music_ajax_status($status, $message, $data = NULL) {

        $response = array (
            'status'	=> $status,
            'message'	=> $message,
            'sdata'		=> $data
        );

        $output = json_encode($response);

        exit($output);

    }

}

/**
 * Loads more function for albums.
 *
 */
if(!function_exists('noizzy_music_albums_ajax_load_more')){

    function noizzy_music_albums_ajax_load_more(){

        $shortcode_params = array();
        if ( ! empty( $_POST ) ) {
            foreach ( $_POST as $key => $value ) {
                if ( $key !== '' ) {
                    $addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
                    $setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );

                    $shortcode_params[ $setAllLettersToLowercase ] = $value;
                }
            }
        }

        $port_list = new \NoizzyMusic\CPT\Shortcodes\Albums\AlbumsList();

        $query_array                     = $port_list->getQueryArray( $shortcode_params );
        $query_results                   = new \WP_Query( $query_array );
        $shortcode_params['this_object'] = $port_list;

        $html = '';
        if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();

                $shortcode_params['current_id'] = get_the_ID();
                $shortcode_params['album_link'] = get_permalink($shortcode_params['current_id']);
                $shortcode_params['artist_html'] = $port_list->getAlbumArtistsHtml($shortcode_params);

                if($shortcode_params['type'] === 'standard-with-space' || $shortcode_params['type'] === 'standard-no-space') {
                    $html .= noizzy_music_get_cpt_shortcode_module_template_part( 'albums', 'albums-list', 'standard', '', $shortcode_params );

                } else {
                    $html .= noizzy_music_get_cpt_shortcode_module_template_part( 'albums', 'albums-list', 'gallery', '', $shortcode_params );

                }

            endwhile;
        else:
            $html .= '<p>'. esc_html__('Sorry, no albums matched your criteria.', 'noizzy-music') .'</p>';
        endif;

        wp_reset_postdata();

        $return_obj = array(
            'html' => $html,
        );

        echo json_encode( $return_obj );
        exit;
    }
}

add_action('wp_ajax_nopriv_noizzy_music_albums_ajax_load_more', 'noizzy_music_albums_ajax_load_more');
add_action( 'wp_ajax_noizzy_music_albums_ajax_load_more', 'noizzy_music_albums_ajax_load_more' );