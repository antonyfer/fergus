<?php

namespace NoizzyMusic\CPT\Shortcodes\Events;

use NoizzyMusic\Lib;

class EventsSlider implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edge_events_slider';

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
                    'name'                      => esc_html__('Events Slider', 'noizzy-music'),
                    'base'                      => $this->base,
                    'category'                  => esc_html__('by NOIZZY MUSIC', 'noizzy-music'),
                    'icon'                      => 'icon-wpb-events-slider extended-custom-music-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__('Number of Events', 'noizzy-music'),
                            'param_name'  => 'number',
                            'value'       => '-1',
                            'admin_label' => true,
                            'description' => esc_html__('(enter -1 to show all)', 'noizzy-music'),
                            'group'       => esc_html__('Query and Layout Options', 'noizzy-music'),
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
            'order_by'       => 'start-date',
            'order'          => 'ASC',
            'number'         => '-1',
            'event_status'   => 'all',
        );

        $params = shortcode_atts($args, $atts);

        //Extract params for use in method
        extract($params);

        $html = '';

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);
        $params['query_results'] = $query_results;

        $params['slider_data'] = $this->getSliderData();


        $html .= '<div class="edge-events-slider-holder-outer edge-medium-space">';
        $html .= '<div class="edge-events-slider-holder edge-owl-slider" ' . noizzy_edge_get_inline_attrs($params['slider_data']) . '>';


        if ($query_results->have_posts()):
            while ($query_results->have_posts()) : $query_results->the_post();
                $current_id = get_the_ID();
                $params['title'] = get_the_title($current_id);
                $params['date'] = get_post_meta($current_id, 'edge_event_item_date', true);
                $params['link'] = get_post_meta($current_id, 'edge_event_item_link', true);
                $params['target'] = get_post_meta($current_id, 'edge_event_item_target', true);
                $params['tickets_status'] = get_post_meta($current_id, 'edge_event_item_tickets_status', true);

                $html .= noizzy_music_get_cpt_shortcode_module_template_part('events', 'events-slider', 'events-slider-template', '', $params);

            endwhile;
        else:
            $html .= '<p>' . esc_html__('Sorry, no events matched your criteria.', 'noizzy-music') . '</p>';

        endif;

        $html .= '</div>';

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

        return $query_array;
    }

    private function getSliderData() {
        $slider_data = array();

        $slider_data['data-number-of-items']   = '3';
        $slider_data['data-enable-navigation'] = 'no';
        $slider_data['data-enable-pagination'] = 'yes';

        return $slider_data;
    }


}