<?php

namespace NoizzyMusic\CPT\Shortcodes\Events;

use NoizzyMusic\Lib;

class EventsList implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edge_events_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map()
     */

    public function vcMap() {
        if (function_exists('vc_map')) {

            vc_map(array(
                    'name'                      => esc_html__('Events List', 'noizzy-music'),
                    'base'                      => $this->base,
                    'category'                  => esc_html__('by NOIZZY MUSIC', 'noizzy-music'),
                    'icon'                      => 'icon-wpb-events-list extended-custom-music-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Title Tag', 'noizzy-music'),
                            'param_name'  => 'title_tag',
                            'value'       => array(
                                ''   => '',
                                'h1' => 'h1',
                                'h2' => 'h2',
                                'h3' => 'h3',
                                'h4' => 'h4',
                                'h5' => 'h5',
                                'h6' => 'h6',
                            ),
                            'admin_label' => true,
                            'description' => '',
                            'group'       => esc_html__('Design Options', 'noizzy-music'),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__('Content In Grid', 'noizzy-music'),
                            'param_name' => 'grid',
                            'value'      => array(
                                esc_html__('No', 'noizzy-music')  => 'no',
                                esc_html__('Yes', 'noizzy-music') => 'yes'

                            ),
                            'group'      => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Layout', 'noizzy-music'),
                            'param_name' => 'layout',
                            'value' => array(
                                'List'   => 'list',
                                'Blocks' => 'blocks',
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => '',
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__('Number of Events Per Page', 'noizzy-music'),
                            'param_name'  => 'number',
                            'value'       => '-1',
                            'admin_label' => true,
                            'description' => esc_html__('(enter -1 to show all)', 'noizzy-music'),
                            'group'       => esc_html__('Query and Layout Options', 'noizzy-music'),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'number_of_columns',
                            'heading'    => esc_html__( 'Number of Columns', 'noizzy-music' ),
                            'value'      => array(
                                esc_html__( 'One', 'noizzy-music' )   => '1',
                                esc_html__( 'Two', 'noizzy-music' )   => '2',
                                esc_html__( 'Three', 'noizzy-music' ) => '3',
                                esc_html__( 'Four', 'noizzy-music' )  => '4',
                                esc_html__( 'Five', 'noizzy-music' )  => '5'
                            ),
                            'dependency' => array( 'element' => 'layout', 'value' => 'blocks' ),
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__( 'Space Between Items', 'noizzy-music' ),
                            'value'       => array_flip( noizzy_edge_get_space_between_items_array(false, true, true, true) ),
                            'save_always' => true,
                            'dependency' => array( 'element' => 'layout', 'value' => 'blocks' ),
                            'group' => esc_html__('Query and Layout Options', 'noizzy-music'),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Order By', 'noizzy-music'),
                            'param_name'  => 'order_by',
                            'value'       => array(
                                esc_html__('Start Date', 'noizzy-music') => 'start-date',
                                esc_html__('Menu Order', 'noizzy-music') => 'menu_order',
                                esc_html__('Title', 'noizzy-music')      => 'title',
                                esc_html__('Date', 'noizzy-music')       => 'date'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => '',
                            'group'       => esc_html__('Query and Layout Options', 'noizzy-music'),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Order', 'noizzy-music'),
                            'param_name'  => 'order',
                            'value'       => array(
                                'ASC'  => 'ASC',
                                'DESC' => 'DESC',
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => '',
                            'group'       => esc_html__('Query and Layout Options', 'noizzy-music'),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__('Show Event by Status', 'noizzy-music'),
                            'param_name' => 'event_status',
                            'value'      => array(
                                esc_html__('All', 'noizzy-music')                  => 'all',
                                esc_html__('Current and Upcoming', 'noizzy-music') => 'upcoming',
                                esc_html__('Past', 'noizzy-music')                 => 'past',
                            ),
                            'group'      => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__('Show Load More', 'noizzy-music'),
                            'param_name' => 'show_load_more',
                            'value'      => array(
                                esc_html__('No', 'noizzy-music')  => 'no',
                                esc_html__('Yes', 'noizzy-music') => 'yes'

                            ),
                            'group'      => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Load More Button Skin', 'noizzy-music'),
                            'param_name'  => 'button_skin',
                            'value'       => array(
                                esc_html__('Dark', 'noizzy-music')  => 'dark',
                                esc_html__('Light', 'noizzy-music') => 'light',
                                esc_html__('Default', 'noizzy-music') => 'default',
                            ),
                            'dependency' => array( 'element' => 'show_load_more', 'value' => 'yes' ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => '',
                            'group'      => esc_html__('Query and Layout Options', 'noizzy-music')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Skin', 'noizzy-music'),
                            'param_name'  => 'skin',
                            'value'       => array(
                                esc_html__('Dark', 'noizzy-music')  => 'dark',
                                esc_html__('Light', 'noizzy-music') => 'light',
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => '',
                            'group'       => esc_html__('Design Options', 'noizzy-music'),
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => esc_html__('Text Color', 'noizzy-music'),
                            'param_name'  => 'text_color',
                            'admin_label' => true,
                            'group'       => esc_html__('Design Options', 'noizzy-music'),
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => esc_html__('Border Color', 'noizzy-music'),
                            'param_name'  => 'border_color',
                            'admin_label' => true,
                            'group'       => esc_html__('Design Options', 'noizzy-music'),
                        ),
                    )
                )
            );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'grid'              => 'no',
            'layout' 		    => 'list',
            'order_by'          => 'start-date',
            'order'             => 'ASC',
            'number'            => '-1',
            'number_of_columns' => '3',
            'space_between_items'  => 'normal',
            'event_status'      => 'all',
            'title_tag'         => 'h5',
            'skin'              => 'dark',
            'text_color'        => '',
            'border_color'      => '',
            'show_load_more'    => '',
            'button_skin'       => '',
        );

        $params = shortcode_atts($args, $atts);

        //Extract params for use in method
        extract($params);

        $html = '';

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);
        $params['query_results'] = $query_results;

        $data_atts = $this->getDataAtts($params);
        $data_atts .= 'data-max-num-pages = ' . $query_results->max_num_pages;

        $params['text_color_style'] = $this->getEventsListTextColor($params);
        $params['border_color_style'] = $this->getEventsListBorderColor($params);
        $classes = $this->getEventsClasses($params, $args);


        $html .= '<div class="edge-events-list-holder-outer ' . $classes . '" ' . $data_atts . '>';

        $list_type_outer_class = $layout === 'blocks' ? 'edge-outer-space' : '';
        $html .= '<div class="edge-events-list-holder ' . esc_attr($list_type_outer_class) . ' clearfix">';

        if ( 'yes' === $grid ) {
            $html .= '<div class="edge-grid">';
        }


        if ($query_results->have_posts()):
            while ($query_results->have_posts()) : $query_results->the_post();
                global $post;
                $current_id = $post->ID;
                $params['title'] = get_the_title($current_id);
                $params['date'] = get_post_meta($current_id, 'edge_event_item_date', true);
                $params['link'] = get_post_meta($current_id, 'edge_event_item_link', true);
                $params['target'] = get_post_meta($current_id, 'edge_event_item_target', true);
                $params['tickets_status'] = get_post_meta($current_id, 'edge_event_item_tickets_status', true);
                $params['location'] = get_post_meta($current_id, 'edge_event_item_location', true);
                $params['image'] = wp_get_attachment_image_url(get_post_thumbnail_id($post), 'full');

                $html .= noizzy_music_get_cpt_shortcode_module_template_part('events', 'events-list', "events-$layout-template", '', $params);

            endwhile;
        else:
            $html .= '<p>' . esc_html__('Sorry, no events matched your criteria.', 'noizzy-music') . '</p>';

        endif;

        if ( 'yes' === $grid ) {
            $html .= '</div>';
        }

        $html .= '</div>';

        if ($show_load_more == 'yes') {
            $html .= noizzy_music_get_cpt_shortcode_module_template_part('events', 'events-list', 'load-more-template', '', $params);
        }

        wp_reset_postdata();

        $html .= '</div>';

        return $html;
    }

    /**
     * Generates events list query attribute array
     *
     * @param $params
     *
     * @return array
     */
    public function getQueryArray($params) {

        $query_array = array();
        $meta_query = array();
        $order_by = $params['order_by'];

        if ($params['order_by'] == 'start-date') {
            $order_by = 'meta_value';
        }

        $query_array = array(
            'post_type'      => 'event',
            'orderby'        => $order_by,
            'order'          => $params['order'],
            'posts_per_page' => $params['number']
        );

        if ($params['order_by'] == 'start-date') {
            $query_array['meta_key'] = 'edge_event_item_date'; //here because has to be added to query
        }

        //display date by event status, ex. end date larger then todays date or if it doesn't exist compare start date
        switch ($params['event_status']) {
            case 'upcoming':
                $meta_query = array(
                    'key'     => 'edge_event_item_date',
                    'value'   => date("Y-m-d H:i"),
                    'compare' => '>=',
                    'type'    => 'DATETIME'
                );
                break;
            case 'past':
                $meta_query = array(
                    'key'     => 'edge_event_item_date',
                    'value'   => date("Y-m-d H:i"),
                    'compare' => '<',
                    'type'    => 'DATETIME'
                );
                break;
        }

        if (is_array($meta_query) && count($meta_query)) {
            $query_array['meta_query'][] = $meta_query;
        }

        $paged = '';
        if (empty($params['next_page'])) {
            if (get_query_var('paged')) {
                $paged = get_query_var('paged');
            } elseif (get_query_var('page')) {
                $paged = get_query_var('page');
            }
        }

        if (!empty($params['next_page'])) {
            $query_array['paged'] = $params['next_page'];

        } else {
            $query_array['paged'] = 1;
        }

        return $query_array;
    }


    private function getEventsListTextColor($params) {

        $text_color = array();

        if ($params['text_color'] !== '') {
            $text_color[] = 'color:' . $params['text_color'];
        }
        return implode(';', $text_color);
    }

    private function getEventsListBorderColor($params) {

        $border_color = array();

        if ($params['border_color'] !== '') {
            $border_color[] = 'border-color:' . $params['border_color'];
        }

        return implode(';', $border_color);
    }

    /**
     * Generates datta attributes array
     *
     * @param $params
     *
     * @return array
     */
    public function getDataAtts($params) {

        $data_attr = array();
        $data_return_string = '';

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        if (!empty($paged)) {
            $data_attr['data-next-page'] = $paged + 1;
        }

        if (!empty($params['order_by'])) {
            $data_attr['data-order-by'] = $params['order_by'];
        }

        if (!empty($params['order'])) {
            $data_attr['data-order'] = $params['order'];
        }

        if (!empty($params['event_status'])) {
            $data_attr['data-event-status'] = $params['event_status'];
        }

        if (!empty($params['number'])) {
            $data_attr['data-number'] = $params['number'];
        }

        if (!empty($params['title_tag'])) {
            $data_attr['data-title-tag'] = $params['title_tag'];
        }

        if (!empty($params['skin'])) {
            $data_attr['data-skin'] = $params['skin'];
        }

        if (!empty($params['text_color'])) {
            $data_attr['data-text-color'] = $params['text_color'];
        }

        if (!empty($params['border_color'])) {
            $data_attr['data-border-color'] = $params['border_color'];
        }


        $data_attr['data-layout'] = $params['layout'];

        foreach ($data_attr as $key => $value) {
            if ($key !== '') {
                $data_return_string .= $key . '= "' . esc_attr($value) . '" ';
            }
        }
        return $data_return_string;
    }

    /**
     * Generates events classes
     *
     * @param $params
     *
     * @return string
     */
    public function getEventsClasses($params, $default_atts) {
        $classes = array();
        $classes[] = $this->getColumnNumberClass( $params['number_of_columns'] );
        $classes[] = ! empty( $params['space_between_items'] ) ? 'edge-' . $params['space_between_items'] . '-space' : 'edge-' . $default_atts['space_between_items'] . '-space';

        if ($params['show_load_more'] == 'yes') {
            $classes[] = "edge-events-load-more";
        }

        if ($params['skin'] == 'light') {
            $classes[] = "edge-events-light-skin";
        }

        if ($params['layout'] == 'blocks') {
            $classes[] = "edge-events-block-layout";
        }

        if ($params['layout'] == 'blocks') {
            $classes[] = "edge-events-block-layout";
        }

        $classes[] = ! empty( $params['button_skin'] ) ? 'edge-' . $params['button_skin'] . '-button' : 'edge-' . $default_atts['button_skin'] . '-button';


        return implode(' ', $classes);

    }

    public function getColumnNumberClass( $params ) {
        switch ( $params ) {
            case 1:
                $classes = 'edge-bl-one-column';
                break;
            case 2:
                $classes = 'edge-bl-two-columns';
                break;
            case 3:
                $classes = 'edge-bl-three-columns';
                break;
            case 4:
                $classes = 'edge-bl-four-columns';
                break;
            case 5:
                $classes = 'edge-bl-five-columns';
                break;
            default:
                $classes = 'edge-bl-three-columns';
                break;
        }

        return $classes;
    }

}