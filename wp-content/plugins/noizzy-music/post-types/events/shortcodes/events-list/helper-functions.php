<?php

if ( ! function_exists( 'noizzy_music_add_events_list_shortcode' ) ) {
    function noizzy_music_add_events_list_shortcode( $shortcodes_class_name ) {
        $shortcodes = array(
            'NoizzyMusic\CPT\Shortcodes\Events\EventsList'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'noizzy_music_filter_add_vc_shortcode', 'noizzy_music_add_events_list_shortcode' );
}

if ( ! function_exists( 'noizzy_music_set_events_list_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for events list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function noizzy_music_set_events_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-events-list';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'noizzy_music_filter_add_vc_shortcodes_custom_icon_class', 'noizzy_music_set_events_list_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'noizzy_music_inverseHex' ) ) {
    /**
     * Inverses a provided hex color. If you pass a hex string with a
     * hash(#), the function will return a string with a hash prepended
     * @param string $color Hex color to flip
     * @return string Reversed hex color
     *
     */
    function noizzy_music_inverseHex( $color )
    {
        $color       = trim($color);
        $prependHash = FALSE;

        if(strpos($color,'#')!==FALSE) {
            $prependHash = TRUE;
            $color       = str_replace('#',NULL,$color);
        }

        switch($len=strlen($color)) {
            case 3:
                $color=preg_replace("/(.)(.)(.)/","\\1\\1\\2\\2\\3\\3",$color);
                break;
            case 6:
                break;
            default:
                trigger_error("Invalid hex length ($len). Must be a minimum length of (3) or maxium of (6) characters", E_USER_ERROR);
        }

        if(!preg_match('/^[a-f0-9]{6}$/i',$color)) {
            $color = htmlentities($color);
            trigger_error( "Invalid hex string #$color", E_USER_ERROR );
        }

        $r = dechex(255-hexdec(substr($color,0,2)));
        $r = (strlen($r)>1)?$r:'0'.$r;
        $g = dechex(255-hexdec(substr($color,2,2)));
        $g = (strlen($g)>1)?$g:'0'.$g;
        $b = dechex(255-hexdec(substr($color,4,2)));
        $b = (strlen($b)>1)?$b:'0'.$b;

        return ($prependHash?'#':NULL).$r.$g.$b;
    }
}