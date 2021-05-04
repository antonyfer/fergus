<?php

namespace NoizzyMusic\CPT\Shortcodes\Albums;

use NoizzyMusic\Lib;

class AlbumsPlayerSlider implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'edge_albums_player_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Albums Player Slider', 'noizzy-music'),
                    'base' => $this->base,
                    'category' => esc_html__('by NOIZZY MUSIC', 'noizzy-music'),
                    'icon' => 'icon-wpb-portfolio-slider extended-custom-icon',
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'param_name' => 'number_of_items',
                            'heading' => esc_html__('Number of Albums', 'noizzy-music'),
                            'admin_label' => true,
                            'description' => esc_html__('Set number of items for your albums slider. Enter -1 to show all', 'noizzy-music')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'genre',
                            'heading' => esc_html__('One-Genre Albums List', 'noizzy-music'),
                            'description' => esc_html__('Enter one genre slug (leave empty for showing all genres)', 'noizzy-music')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'artist',
                            'heading' => esc_html__('One-Artist Albums List', 'noizzy-music'),
                            'description' => esc_html__('Enter one artist slug (leave empty for showing all artists)', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'orderby',
                            'heading' => esc_html__('Order By', 'noizzy-music'),
                            'value' => array_flip(noizzy_edge_get_query_order_by_array()),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'order',
                            'heading' => esc_html__('Order', 'noizzy-music'),
                            'value' => array_flip(noizzy_edge_get_query_order_array()),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading' => esc_html__('Title Tag', 'noizzy-music'),
                            'value' => array_flip(noizzy_edge_get_title_tag(true)),
                            'dependency' => array('element' => 'enable_title', 'value' => array('yes')),
                            'group' => esc_html__('Content Layout', 'noizzy-music')
                        ),
                        array(
                            'type' => 'attach_image',
                            'heading' => esc_html__('CD Image', 'noizzy-music'),
                            'param_name' => 'cd_image',
                            'description' => esc_html('Setting an image will animate in on slider transition', 'noizzy-music'),
                            'dependency' => array('element' => 'type', 'value' => array('with-player')),
                            'group' => esc_html__('Slider Settings', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_mousewheel',
                            'heading' => esc_html__('Enable Mouse Wheel Scroll', 'noizzy-music'),
                            'value' => array_flip(noizzy_edge_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'dependency' => array('element' => 'type', 'value' => array('with-player')),
                            'group' => esc_html__('Slider Settings', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_loop',
                            'heading' => esc_html__('Enable Slider Loop', 'noizzy-music'),
                            'value' => array_flip(noizzy_edge_get_yes_no_select_array(false, false)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'noizzy-music'),
                            'dependency' => array('element' => 'item_type', 'value' => array(''))
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_autoplay',
                            'heading' => esc_html__('Enable Slider Autoplay', 'noizzy-music'),
                            'value' => array_flip(noizzy_edge_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'noizzy-music')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed',
                            'heading' => esc_html__('Slide Duration', 'noizzy-music'),
                            'description' => esc_html__('Default value is 5000 (ms)', 'noizzy-music'),
                            'group' => esc_html__('Slider Settings', 'noizzy-music')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed_animation',
                            'heading' => esc_html__('Slide Animation Duration', 'noizzy-music'),
                            'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'noizzy-music'),
                            'group' => esc_html__('Slider Settings', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_navigation',
                            'heading' => esc_html__('Enable Slider Navigation Arrows', 'noizzy-music'),
                            'value' => array_flip(noizzy_edge_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'noizzy-music')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'navigation_skin',
                            'heading' => esc_html__('Navigation Skin', 'noizzy-music'),
                            'value' => array(
                                esc_html__('Default', 'noizzy-music') => '',
                                esc_html__('Light', 'noizzy-music') => 'light',
                                esc_html__('Dark', 'noizzy-music') => 'dark'
                            ),
                            'dependency' => array('element' => 'enable_navigation', 'value' => array('yes')),
                            'group' => esc_html__('Slider Settings', 'noizzy-music')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null)
    {
        $args = array(
            'number_of_items'        => '4',
            'columns'                => 'one',
            'space_between_items'    => 'normal',
            'image_proportions'      => 'full',
            'album'			         => '',
            'genre'                  => '',
            'selected_albums'        => '',
            'artist'                 => '',
            'order_by'			     => 'date',
            'order' 			     => 'ASC',
            'number' 			     => '-1',
            'title_tag'              => 'h3',
            'albums_slider_on'       => 'yes',
            'slider_type'            => '',
            'type'                   => 'with-player',
            'cd_image'               => '',
            'enable_loop'            => 'no',
            'enable_autoplay'        => 'no',
            'slider_speed'           => '5000',
            'slider_speed_animation' => '600',
            'enable_navigation'      => 'yes',
            'navigation_skin'        => '',
            'enable_pagination'      => 'no',
            'pagination_skin'        => '',
            'pagination_position'    => 'on-slider',
            'enable_mousewheel'      => 'no',
            'albums_slider_padding'  => 'yes'
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);
        $params['query_results'] = $query_results;

        $classes = $this->getAlbumsClasses($params);
        $holder_inner_classes = $this->getHolderInnerClasses($params);
        $data_atts = $this->getDataAtts($params);
        $data_atts .= 'data-max-num-pages = '.$query_results->max_num_pages;

        $params['type'] = !empty($params['type']) ? $params['type'] : $args['type'];
        $params['enable_navigation'] = !empty($params['enable_navigation']) ? $params['enable_navigation'] : $args['enable_navigation'];
        $params['enable_mousewheel'] = !empty($params['enable_mousewheel']) ? $params['enable_mousewheel'] : $args['enable_mousewheel'];


        if ($params['type'] === 'with-player') {
            $params['albums_slider_padding'] = 'yes';
            $params['cd_image'] = !empty($params['cd_image']) ? $params['cd_image'] : $args['cd_image'];
        }

        $html = '';
        $html .= '<div class="edge-albums-player-slider-holder">';

        $html .= '<div class = "edge-albums-list-holder-outer ' . esc_attr($classes) . '" ' . $data_atts . '>';

        $html .= '<div class = "edge-albums-list-holder clearfix ' . esc_attr($holder_inner_classes) . '" >';


        if ($query_results->have_posts()):
            while ($query_results->have_posts()) : $query_results->the_post();

                $params['current_id'] = get_the_ID();
                $params['album'] = get_the_ID();
                $params['size'] = get_post_meta(get_the_ID(), 'edge_albums_list_dimensions_meta', true);
                $params['album_link'] = get_permalink($params['current_id']);
                $params['artist_html'] = $this->getAlbumArtistsHtml($params);
                $params['label_html'] = $this->getAlbumLabelsHtml($params);
                $params['thumb'] = 'full';
                $params['player_id'] = rand();

                if ($params['size'] === 'edge-large-width') {
                    $params['thumb'] = 'noizzy_edge_landscape';
                }

                $html .= noizzy_music_get_cpt_shortcode_module_template_part('albums', 'albums-player-slider', $params['type'], '', $params);

            endwhile;
        else:

            $html .= '<p>' . esc_html_e('Sorry, no albums matched your criteria.', 'noizzy-music') . '</p>';

        endif;

        $html .= '</div>'; //close edge-albums-list-holder
        wp_reset_postdata();
        $html .= '</div>'; // close edge-albums-list-holder-outer

        $html .= '</div>'; // close edge-albums-player-slider-holder

        return $html;
    }

    /**
     * Generates albums list query attribute array
     *
     * @param $params
     *
     * @return array
     */
    public function getQueryArray($params)
    {

        $query_array = array(
            'post_type' => 'album',
            'orderby' => $params['order_by'],
            'order' => $params['order'],
            'posts_per_page' => $params['number']
        );

        if (!empty($params['label'])) {
            $query_array['album-label'] = $params['label'];
        }

        if (!empty($params['genre'])) {
            $query_array['album-genre'] = $params['genre'];
        }

        if (!empty($params['artist'])) {
            $query_array['album-artist'] = $params['artist'];
        }

        $albums_ids = null;
        if (!empty($params['selected_albums'])) {
            $albums_ids = explode(',', $params['selected_albums']);
            $query_array['post__in'] = $albums_ids;
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

    public function getHolderInnerClasses($params)
    {
        $classes = array();

        $classes[] = $params['albums_slider_on'] === 'yes' ? 'edge-owl-slider edge-pl-is-slider' : '';

        return implode(' ', $classes);
    }

    /**
     * Generates albums classes
     *
     * @param $params
     *
     * @return string
     */
    public function getAlbumsClasses($params)
    {
        $classes = array();
        $type = $params['type'];
        $columns = $params['columns'];

        switch ($type):
            case 'standard-with-space':
            case 'standard-no-space':
                $classes[] = 'edge-alb-standard';
                break;
            case 'gallery-with-space':
            case 'gallery-no-space':
                $classes[] = 'edge-alb-gallery';
                break;
            case 'gallery-with-buttons':
                $classes[] = 'edge-alb-gallery with-buttons';
                break;
            case 'with-player':
                $classes[] = 'edge-alb-with-player';
                break;
        endswitch;

        switch ($columns):
            case '2':
                $classes[] = 'edge-alb-two-columns';
                break;
            case '3':
                $classes[] = 'edge-alb-three-columns';
                break;
            case '4':
                $classes[] = 'edge-alb-four-columns';
                break;
        endswitch;

        if ($type == 'standard-no-space' || $type == 'gallery-no-space') {
            $classes[] = "edge-album-wide";
        }

        $classes[] = ! empty( $params['navigation_skin'] ) ? 'edge-nav-' . $params['navigation_skin'] . '-skin' : '';

        return implode(' ', $classes);

    }

    /**
     * Generates datta attributes array
     *
     * @param $params
     *
     * @return array
     */
    public function getDataAtts($params)
    {

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

        if (!empty($params['type'])) {
            $data_attr['data-type'] = $params['type'];
        }
        if (!empty($params['order_by'])) {
            $data_attr['data-order-by'] = $params['order_by'];
        }
        if (!empty($params['order'])) {
            $data_attr['data-order'] = $params['order'];
        }
        if (!empty($params['number'])) {
            $data_attr['data-number'] = $params['number'];
        }
        if (!empty($params['label'])) {
            $data_attr['data-label'] = $params['label'];
        }
        if (!empty($params['genre'])) {
            $data_attr['data-genre'] = $params['genre'];
        }
        if (!empty($params['artist'])) {
            $data_attr['data-artist'] = $params['artist'];
        }
        if (!empty($params['selected_albums'])) {
            $data_attr['data-selected-albums'] = $params['selected_albums'];
        }
        if (!empty($params['title_tag'])) {
            $data_attr['data-title-tag'] = $params['title_tag'];
        }
        if ($params['albums_slider_on'] === 'yes') {
            $data_attr['data-enable-center'] = 'yes';
        }

        if ($params['albums_slider_padding'] === 'yes') {
            $data_attr['data-slider-padding'] = 'yes';
        }

        if ($params['enable_navigation'] === 'yes') {
            $data_attr['data-enable-navigation'] = 'yes';
        } else {
            $data_attr['data-enable-navigation'] = 'no';
        }

        if ($params['enable_mousewheel'] === 'yes') {
            $data_attr['data-slider-mousewheel'] = 'yes';
        } else {
            $data_attr['data-slider-mousewheel'] = 'no';
        }

        $data_attr['data-enable-loop'] = ! empty( $params['enable_loop'] ) ? $params['enable_loop'] : 'no';
        $data_attr['data-enable-autoplay'] = ! empty( $params['enable_autoplay'] ) ? $params['enable_autoplay'] : 'no';
        $data_attr['data-slider-speed'] = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';

        foreach ($data_attr as $key => $value) {
            if ($key !== '') {
                $data_return_string .= $key . '= "' . esc_attr($value) . '" ';
            }
        }
        return $data_return_string;
    }


    /**
     * Generates album artists html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getAlbumArtistsHtml($params)
    {
        $id = $params['current_id'];

        $artists = wp_get_post_terms($id, 'album-artist');
        $artist_html = '<div class="edge-alb-artists-holder">';
        $k = 1;
        foreach ($artists as $art) {
            $artist_html .= '<span class="edge-alb-artists"><span>' . $art->name . '</span>';
            if (count($artists) != $k) {
                $artist_html .= ' / ';
            }
            $k++;
        }
        $artist_html .= '</div>';
        return $artist_html;
    }


    /**
     * Generates album labels html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getAlbumLabelsHtml($params)
    {
        $id = $params['current_id'];

        $label = wp_get_post_terms($id, 'album-label');
        $label_html = '<div class="edge-alb-label-holder">';
        $k = 1;
        foreach ($label as $lab) {
            $label_html .= '<span class="edge-alb-labels">' . $lab->name . '</span>';
            if (count($label) != $k) {
                $label_html .= ' / ';
            }
            $k++;
        }
        $label_html .= '</div>';
        return $label_html;
    }
}