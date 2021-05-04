<?php

if(noizzy_music_theme_installed() && noizzy_edge_visual_composer_installed()) {

    if(!function_exists('noizzy_music_bandsintown_events')) {
        function noizzy_music_bandsintown_events() {
            vc_map(array(
                'name'                    => esc_html__('Bandsintown Events', 'noizzy-music'),
                'base'                    => 'bandsintown_events',
                'category'                =>  esc_html__('by NOIZZY MUSIC', 'noizzy-music'),
                'icon'                    => 'icon-wpb-bands-in-town-events extended-custom-music-icon',
                'show_settings_on_create' => true,
                'params'                  => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Artist', 'noizzy-music'),
                        'param_name'  => 'artist',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Display Limit', 'noizzy-music'),
                        'param_name'  => 'display_limit',
                        'admin_label' => true
                    )
                )
            ));
        }

        add_action('vc_before_init', 'noizzy_music_bandsintown_events');
    }

}