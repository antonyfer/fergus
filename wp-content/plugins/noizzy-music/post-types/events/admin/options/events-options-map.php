<?php

if ( ! function_exists('noizzy_edge_events_options_map') ) {

    function noizzy_edge_events_options_map() {

        noizzy_edge_add_admin_page(array(
            'slug'  => '_events',
            'title' => esc_html__('Events', 'noizzy-music'),
            'icon'  => 'fa fa-calendar'
        ));

        $panel = noizzy_edge_add_admin_panel(array(
            'title' => esc_html__('Event', 'noizzy-music'),
            'name'  => 'panel_event',
            'page'  => '_events'
        ));

        noizzy_edge_add_admin_field(array(
            'name'          => 'event_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments', 'noizzy-music'),
            'description'   => esc_html__('Enabling this option will show comments on your page.', 'noizzy-music'),
            'parent'        => $panel,
            'default_value' => 'no'
        ));

        noizzy_edge_add_admin_field(array(
            'name'          => 'event_pagination',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Pagination', 'noizzy-music'),
            'description'   => esc_html__('Enabling this option will turn on events pagination functionality.', 'noizzy-music'),
            'parent'        => $panel,
            'default_value' => 'no',
        ));

        noizzy_edge_add_admin_field(array(
            'name'        => 'event_single_slug',
            'type'        => 'text',
            'label'       => esc_html__('Event Single Slug','noizzy-music'),
            'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)','noizzy-music'),
            'parent'      => $panel,
            'args'        => array(
                'col_width' => 3
            )
        ));

    }

    add_action( 'noizzy_edge_options_map', 'noizzy_edge_events_options_map', 15);

}