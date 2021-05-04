<?php

//Events

if(!function_exists('noizzy_edge_map_events_meta_fields')) {

    function noizzy_edge_map_events_meta_fields() {

        $event_meta_box = noizzy_edge_create_meta_box(
            array(
                'scope' => array('event'),
                'title' => esc_html__('Event', 'noizzy-music'),
                'name' => 'event_meta'
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_tickets_status',
                'type'        => 'select',
                'label'       => esc_html__('Tickets Status','noizzy-music'),
                'description' => '',
                'options' => array(
                    'available' => esc_html__('Available','noizzy-music'),
                    'free' => esc_html__('Free','noizzy-music'),
                    'sold' => esc_html__('Sold Out','noizzy-music')
                ),
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_date',
                'type'        => 'date',
                'label'       => esc_html__('Date','noizzy-music'),
                'description' => '',
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_time',
                'type'        => 'text',
                'label'       => esc_html__('Time','noizzy-music'),
                'description' => esc_html__('Please input the time in a HH:MM format. If you are using a 12 hour time format, please also input AM or PM markers.','noizzy-music'),
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_location',
                'type'        => 'text',
                'label'       => esc_html__('Location','noizzy-music'),
                'description' => '',
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_pin',
                'type'        => 'image',
                'label'       => esc_html__('Pin','noizzy-music'),
                'description' => esc_html__('Upload Google Map Pin Image','noizzy-music'),
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_website',
                'type'        => 'text',
                'label'       => esc_html__('Website','noizzy-music'),
                'description' => '',
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_event_type',
                'type'        => 'text',
                'label'       => esc_html__('Event Type','noizzy-music'),
                'description' => '',
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_target_audience',
                'type'        => 'text',
                'label'       => esc_html__('Target Audience','noizzy-music'),
                'description' => '',
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_organized_by',
                'type'        => 'text',
                'label'       => esc_html__('Organized By','noizzy-music'),
                'description' => '',
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_link',
                'type'        => 'text',
                'label'       => esc_html__('Buy Tickets Link','noizzy-music'),
                'description' => esc_html__('Enter the external link where users can buy the tickets','noizzy-music'),
                'parent'      => $event_meta_box
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_item_target',
                'type'        => 'selectblank',
                'label'       => esc_html__('Target','noizzy-music'),
                'description' => '',
                'parent'      => $event_meta_box,
                'options' => array(
                    '_self' => esc_html__('Self','noizzy-music'),
                    '_blank' => esc_html__('Blank','noizzy-music')
                )
            )
        );

        noizzy_edge_create_meta_box_field(
            array(
                'name'        => 'edge_event_back_to_link',
                'type'        => 'text',
                'label'       => esc_html__('"Back To" Link','noizzy-music'),
                'description' => esc_html__('Choose "Back To" page to link from event single page','noizzy-music'),
                'parent'      => $event_meta_box,
            )
        );
    }

    add_action('noizzy_edge_meta_boxes_map', 'noizzy_edge_map_events_meta_fields');
}