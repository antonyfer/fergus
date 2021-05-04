<?php

class NoizzyEdgeRecentPosts extends NoizzyEdgeWidget
{
    public function __construct() {
        parent::__construct(
            'edge_recent_posts',
            esc_html__('Noizzy Recent Posts', 'noizzy'),
            array('description' => esc_html__('Select recent posts that you would like to display', 'noizzy'))
        );

        $this->setParams();
    }

    protected function setParams() {
        $post_types = apply_filters('noizzy_edge_search_post_type_widget_params_post_type', array('post' => esc_html__('Post', 'noizzy')));

        $this->params = array(
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__('Widget Title', 'noizzy')
            ),
            array(
                'type'        => 'dropdown',
                'name'        => 'post_type',
                'title'       => esc_html__('Post Type', 'noizzy'),
                'description' => esc_html__('Choose post type that you want to be searched for', 'noizzy'),
                'options'     => $post_types
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_tag',
                'title'   => esc_html__('Title Tag', 'noizzy'),
                'options' => noizzy_edge_get_title_tag(true, array('p' => 'p'))
            )
        );
    }

    public function widget($args, $instance) {

        if (!is_array($instance)) {
            $instance = array();
        }

        if ($instance['post_type'] !== '') {
            $type = $instance['post_type'];
        } else {
            $type = 'post';
        }

        if (empty($instance['title_tag'])) {
            $instance['title_tag'] = 'h6';
        }

        $params = array(
            'post_type'      => $type,
            'post_status'    => 'publish',
            'order'          => 'DESC',
            'orderby'        => 'date',
            'posts_per_page' => 3
        );


        $query = new WP_Query($params);

        $html = '';
        $html .= '<div class="widget edge-recent-post-widget">';

        if (!empty($instance['widget_title'])) {
            $html .= wp_kses_post($args['before_title']) . esc_html($instance['widget_title']) . wp_kses_post($args['after_title']);
        }

        if ($query->have_posts()) {
            $html .= '<ul class="edge-recent-posts">';
            while ($query->have_posts()) {
                $query->the_post();
                $html .= '<li class="edge-rp-item">' .
                    '<a href="' . get_the_permalink() . '">' .
                    '<div class="edge-rp-image">' . get_the_post_thumbnail(get_the_ID(), array(107, 107)) .
                    '</div><div class="edge-rp-content">' .
                    '<' . $instance['title_tag'] . ' class="edge-rp-title">' . get_the_title() . '</' . $instance['title_tag'] . '>' .
                    '<div class="edge-rp-date">' . get_the_time(get_option('date_format')) . '</div></div></a>' .
                    '</li>';
            }
            $html .= '</ul>';
        } else {
            $html .= esc_html__('Sorry, there are no posts matching your criteria', 'noizzy');
        }

        $html .= '</div>';

        wp_reset_postdata();

        print wp_kses_post($html);
    }
}