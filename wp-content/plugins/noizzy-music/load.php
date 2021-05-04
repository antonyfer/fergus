<?php

require_once 'const.php';

require_once 'lib/helpers-functions.php';

//load post-post-types
require_once 'lib/post-type-interface.php';
require_once 'post-types/post-types-functions.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last

//load shortcodes
require_once 'lib/shortcode-interface.php';
require_once 'lib/shortcode-functions.php';


//load admin
if(!function_exists('noizzy_music_load_admin')) {
    function noizzy_music_load_admin() {
        require_once 'admin/options/map.php';
    }
    add_action('noizzy_edge_before_options_map', 'noizzy_music_load_admin');
}

//load custom styles
if(!function_exists('noizzy_music_load_custom_styles')) {
    function noizzy_music_load_custom_styles() {
        require_once 'assets/custom-styles/music.php';
    }
    add_action('after_setup_theme','noizzy_music_load_custom_styles');
}