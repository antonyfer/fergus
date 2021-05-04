<?php

//Albums

if(!function_exists('noizzy_edge_map_album_meta_fields')) {

    function noizzy_edge_map_album_meta_fields() {

        $album_meta_box = noizzy_edge_create_meta_box(
            array(
                'scope' => array('album'),
                'title' => esc_html__('Album', 'noizzy-music'),
                'name' => 'album_meta_box'
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_album_type_meta',
                'type'        => 'select',
                'label'       => esc_html__('Album Type', 'noizzy-music'),
                'description' => '',
                'options' => array(
                    '' => esc_html__('Default','noizzy-music'),
                    'comprehensive' => esc_html__('Album Comprehensive','noizzy-music'),
                    'compact'		=> esc_html__('Album Compact','noizzy-music')
                ),
                'parent'      => $album_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_album_skin',
                'type'        => 'select',
                'label'       => esc_html__('Album Skin', 'noizzy-music'),
                'description' => '',
                'options' => array(
                    'dark' => esc_html__('Dark','noizzy-music'),
                    'light' => esc_html__('Light','noizzy-music')
                ),
                'parent'      => $album_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'          => 'edge_albums_list_dimensions_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Dimensions for albums list', 'noizzy-music' ),
                'description'   => esc_html__( 'Choose image layout when it appears in Albums List', 'noizzy-music' ),
                'default_value' => '',
                'parent'        => $album_meta_box,
                'options'       => array(
                    ''                   => esc_html__( 'Default', 'noizzy-music' ),
                    'edge-large-width'        => esc_html__( 'Large Width', 'noizzy-music' ),
                )
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_album_release_date',
                'type'        => 'date',
                'label'       => esc_html__('Release Date', 'noizzy-music'),
                'description' => '',
                'parent'      => $album_meta_box
            )
        );
        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_album_people',
                'type'        => 'text',
                'label'       => esc_html__('Publisher', 'noizzy-music'),
                'description' => '',
                'parent'      => $album_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_album_video_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Latest Video Link', 'noizzy-music'),
                'description' => esc_html__('Enter Video Link', 'noizzy-music'),
                'parent'      => $album_meta_box,

            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_album_video_image_meta',
                'type'        => 'image',
                'label'       => esc_html__('Latest Video Background Image', 'noizzy-music'),
                'description' => esc_html__('Upload background image for latest video section on comprehensive single album page', 'noizzy-music'),
                'parent'      => $album_meta_box,

            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_album_back_to_link',
                'type'        => 'text',
                'label'       => esc_html__('"Back To" Link','noizzy-music'),
                'description' => esc_html__('Choose "Back To" page to link from album single page', 'noizzy-music'),
                'parent'      => $album_meta_box,

            )
        );

        $tracks_meta_box = noizzy_edge_create_meta_box(
            array(
                'scope' => array('album'),
                'title' => esc_html__('Tracks', 'noizzy-music'),
                'name' => 'tracks_meta_box'
            )
        );
        noizzy_edge_add_repeater_field(
            array(
                'name'        => 'edge_tracks_repeater',
                'label'       => esc_html__('Tracks', 'noizzy-music'),
                'fields' => array(
                    array(
                        'name'        => 'edge_track_file',
                        'type'        => 'file',
                        'label'       => esc_html__('Audio File', 'noizzy-music'),
                    ),
                    array(
                        'name'        => 'edge_track_title',
                        'type'        => 'text',
                        'label'       => esc_html__('Title', 'noizzy-music'),
                    ),
                    array(
                        'name'        => 'edge_track_buy_link',
                        'type'        => 'text',
                        'label'       => esc_html__('Buy Link', 'noizzy-music'),
                    ),
                    array(
                        'name'        	=> 'edge_track_free_download',
                        'type'        	=> 'yesno',
                        'default_value'  => 'no',
                        'label'      	=> esc_html__('Free Download', 'noizzy-music'),
                    ),
                    array(
                        'name'        => 'edge_track_video_link',
                        'type'        => 'text',
                        'label'       => esc_html__('Video Link', 'noizzy-music'),
                    ),
                    array(
                        'name'        => 'edge_track_lyrics',
                        'type'        => 'textarea',
                        'label'       => esc_html__('Lyrics', 'noizzy-music')
                    ),
                    array(
                        'name'        => 'edge_track_image',
                        'type'        => 'image',
                        'label'       => esc_html__('Image', 'noizzy-music')
                    ),
                ),
                'parent'      => $tracks_meta_box,
                'description' => ''
            )
        );

        $reviews_meta_box = noizzy_edge_create_meta_box(
            array(
                'scope' => array('album'),
                'title' => esc_html__('Reviews', 'noizzy-music'),
                'name' => 'reviews_meta_box'
            )
        );
        noizzy_edge_add_repeater_field(
            array(
                'name'        => 'edge_reviews_repeater',
                'label'       => esc_html__('Reviews', 'noizzy-music'),
                'fields' => array(
                    array(
                        'name'        => 'edge_review_author',
                        'type'        => 'text',
                        'label'       => esc_html__('Review Author', 'noizzy-music'),
                    ),
                    array(
                        'name'        => 'edge_review_text',
                        'type'        => 'textarea',
                        'label'       => esc_html__('Review Title', 'noizzy-music')
                    )

                ),
                'parent'      => $reviews_meta_box
            )
        );
        $stores_meta_box = noizzy_edge_create_meta_box(
            array(
                'scope' => array('album'),
                'title' => esc_html__('Stores', 'noizzy-music'),
                'name' => 'stores_meta_box'
            )
        );
        noizzy_edge_add_repeater_field(
            array(
                'name'        => 'edge_stores_repeater',
                'label'       => esc_html__('Stores', 'noizzy-music'),
                'fields' => array(
                    array(
                        'name'        => 'edge_store_name',
                        'type'        => 'select',
                        'options'	  => array(
                            'itunes'		=> esc_html__('iTunes', 'noizzy-music'),
                            'google-play'	=> esc_html__('Google Play', 'noizzy-music'),
                            'bandcamp'		=> esc_html__('Bandcamp', 'noizzy-music'),
                            'spotify'		=> esc_html__('Spotify', 'noizzy-music'),
                            'amazonmp3'		=> esc_html__('AmazonMP3', 'noizzy-music'),
                            'deezer'		=> esc_html__('Deezer', 'noizzy-music')
                        ),
                        'label'       => esc_html__('Store', 'noizzy-music'),
                    ),
                    array(
                        'name'        => 'edge_store_link',
                        'type'        => 'text',
                        'label'       => esc_html__('Store Link', 'noizzy-music')
                    )

                ),
                'parent'      => $stores_meta_box
            )
        );
    }

    add_action('noizzy_edge_meta_boxes_map', 'noizzy_edge_map_album_meta_fields');
}
