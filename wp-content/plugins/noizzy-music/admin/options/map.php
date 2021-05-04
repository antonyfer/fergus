<?php

if(noizzy_music_theme_installed()) {
    if(!function_exists('noizzy_music_options_map')) {

        function noizzy_music_options_map() {


            noizzy_edge_add_admin_page(array(
                'title' => esc_html__('Music', 'noizzy-music'),
                'slug'  => '_music',
                'icon'  => 'fa fa-building-o'
            ));

            // added options in post meta

            //do_action('noizzy_hotel_room_action_single_fields');
        }


        /*add_action('noizzy_edge_options_map', 'noizzy_music_options_map', 75); //one after elements*/
    }
}