<?php

if ( ! function_exists('noizzy_edge_albums_options_map') ) {

    function noizzy_edge_albums_options_map() {

        noizzy_edge_add_admin_page(array(
            'slug'  => '_albums',
            'title' => esc_html__('Albums','noizzy-music'),
            'icon'  => 'fa fa-music'
        ));

        $panel = noizzy_edge_add_admin_panel(array(
            'title' => esc_html__('Albums','noizzy-music'),
            'name'  => 'panel_albums',
            'page'  => '_albums'
        ));

        noizzy_edge_add_admin_field(
            array(
                'name'			=> 'album_type',
                'type'			=> 'select',
                'label'			=> esc_html__('Album Type', 'noizzy-music'),
                'default_value'	=> 'comprehensive',
                'options' => array(
                    'comprehensive' => esc_html__('Album Comprehensive','noizzy-music'),
                    'compact'		=> esc_html__('Album Compact','noizzy-music')
                ),
                'parent'      => $panel
            )
        );

        noizzy_edge_add_admin_field(array(
            'name'          => 'album_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments','noizzy-music'),
            'description'   => esc_html__('Enabling this option will show comments on your album.','noizzy-music'),
            'parent'        => $panel,
            'default_value' => 'no'
        ));

        noizzy_edge_add_admin_field(array(
            'name'          => 'album_pagination',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Pagination','noizzy-music'),
            'description'   => esc_html__('Enabling this option will turn on album pagination functionality.','noizzy-music'),
            'parent'        => $panel,
            'default_value' => 'no',
        ));

    }

    add_action( 'noizzy_edge_options_map', 'noizzy_edge_albums_options_map', 14);

}