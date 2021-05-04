<?php

if ( ! function_exists( 'noizzy_music_events_meta_box_functions' ) ) {
    function noizzy_music_events_meta_box_functions( $post_types ) {
        $post_types[] = 'event';

        return $post_types;
    }

    add_filter( 'noizzy_edge_meta_box_post_types_save', 'noizzy_music_events_meta_box_functions' );
    add_filter( 'noizzy_edge_meta_box_post_types_remove', 'noizzy_music_events_meta_box_functions' );
}

if ( ! function_exists( 'noizzy_music_events_scope_meta_box_functions' ) ) {
    function noizzy_music_events_scope_meta_box_functions( $post_types ) {
        $post_types[] = 'event';

        return $post_types;
    }

    add_filter( 'noizzy_edge_set_scope_for_meta_boxes', 'noizzy_music_events_scope_meta_box_functions' );
}

if ( ! function_exists( 'noizzy_music_register_events_cpt' ) ) {

    function noizzy_music_register_events_cpt( $cpt_class_name ) {

        $cpt_class = array(
            'NoizzyMusic\CPT\Events\EventsRegister'
        );

        $cpt_class_name = array_merge( $cpt_class_name, $cpt_class );

        return $cpt_class_name;

    }

    add_filter( 'noizzy_music_filter_register_custom_post_types', 'noizzy_music_register_events_cpt' );
}

// Load events shortcodes
if(!function_exists('noizzy_music_include_events_shortcodes_files')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function noizzy_music_include_events_shortcodes_files() {
        foreach(glob(NOIZZY_MUSIC_CPT_PATH.'/events/shortcodes/*/load.php') as $shortcode_load) {
            include_once $shortcode_load;
        }
    }

    add_action('noizzy_music_action_include_shortcodes_file', 'noizzy_music_include_events_shortcodes_files');
}

if ( ! function_exists( 'noizzy_music_events_add_social_share_option' ) ) {
    function noizzy_music_events_add_social_share_option( $container ) {
        noizzy_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_social_share_on_event',
                'default_value' => 'no',
                'label'         => esc_html__( 'Events', 'noizzy-core' ),
                'description'   => esc_html__( 'Show Social Share for Events', 'noizzy-core' ),
                'parent'        => $container
            )
        );
    }

    add_action( 'noizzy_edge_post_types_social_share', 'noizzy_music_events_add_social_share_option', 10, 1 );
}

if(!function_exists('noizzy_music_single_event')) {
    function noizzy_music_single_event() {
        $current_id = get_the_ID();
        $location = get_post_meta($current_id, 'edge_event_item_location', true);
        $pin = get_post_meta($current_id, 'edge_event_item_pin', true);
        $link = get_post_meta($current_id, 'edge_event_item_link', true);
        $target = get_post_meta($current_id, 'edge_event_item_target', true);
        $tickes_status = get_post_meta($current_id, 'edge_event_item_tickets_status', true);
        $date = get_post_meta($current_id, 'edge_event_item_date', true);
        $time = get_post_meta($current_id, 'edge_event_item_time', true);
        $website = get_post_meta($current_id, 'edge_event_item_website', true);
        $organized_by = get_post_meta($current_id, 'edge_event_item_organized_by', true);
        $event_type = get_post_meta($current_id, 'edge_event_item_event_type', true);
        $target_audience = get_post_meta($current_id, 'edge_event_item_target_audience', true);
        $back_to_link = get_post_meta( get_the_ID(), 'edge_event_back_to_link', true );
        $pin_id = noizzy_edge_get_attachment_id_from_url($pin);

        $params = array(
            'holder_class'  => 'edge-event-single-holder',
            'location'  => $location,
            'pin' => $pin_id,
            'link' => $link,
            'target' => $target,
            'tickets_status' => $tickes_status,
            'date' => $date,
            'time' => $time,
            'website' => $website,
            'organized_by' => $organized_by,
            'event_type' => $event_type,
            'target_audience' => $target_audience,
            'back_to_link' => $back_to_link
        );

        noizzy_music_get_cpt_single_module_template_part('templates/single/holder', 'events', '', $params);
    }
}

/**
 * Loads more function for events.
 *
 */
if(!function_exists('noizzy_music_events_ajax_load_more')){

    function noizzy_music_events_ajax_load_more(){
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

        $port_list = new \NoizzyMusic\CPT\Shortcodes\Events\EventsList();

        $query_array                     = $port_list->getQueryArray( $shortcode_params );
        $query_results                   = new \WP_Query( $query_array );
        $shortcode_params['this_object'] = $port_list;

        $html = '';
        if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();

                $current_id = get_the_ID();
                $shortcode_params['title'] = get_the_title($current_id);
                $shortcode_params['date'] = get_post_meta($current_id, 'edge_event_item_date', true);
                $shortcode_params['link'] = get_post_meta($current_id, 'edge_event_item_link', true);
                $shortcode_params['target'] = get_post_meta($current_id, 'edge_event_item_target', true);
                $shortcode_params['tickets_status'] = get_post_meta($current_id, 'edge_event_item_tickets_status', true);

                $html .= noizzy_music_get_cpt_shortcode_module_template_part( 'events', 'events-list', 'events-' . $shortcode_params['layout'] . '-template', '', $shortcode_params );
            endwhile;
        else:
            $html .= '<p>'. esc_html__('Sorry, no events matched your criteria.', 'noizzy-music') .'</p>';
        endif;

        wp_reset_postdata();

        $return_obj = array(
            'html' => $html,
        );

        echo json_encode( $return_obj );
        exit;
    }
}

add_action('wp_ajax_nopriv_noizzy_music_events_ajax_load_more', 'noizzy_music_events_ajax_load_more');
add_action( 'wp_ajax_noizzy_music_events_ajax_load_more', 'noizzy_music_events_ajax_load_more' );