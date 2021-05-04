<?php
namespace NoizzyMusic\CPT\Events;

use NoizzyMusic\Lib;

class EventsRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base		= 'event';
        $this->taxBase	= 'event-type';

        add_filter('single_template', array($this, 'registerSingleTemplate'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }


    /**
     * Registers event single template if one doesn't exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-event.php')) {
                return NOIZZY_MUSIC_CPT_PATH.'/events/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';
        $slug = $this->base;

        if ( noizzy_music_theme_installed() ) {
            if ( noizzy_edge_options()->getOptionValue( 'event_single_slug' ) ) {
                $slug = noizzy_edge_options()->getOptionValue( 'event_single_slug' );
            }
        }

        register_post_type( $this->base,
            array(
                'labels'		=> array(
                    'name'			=> esc_html__( 'Noizzy Events','noizzy-music' ),
                    'singular_name'	=> esc_html__( 'Noizzy Event','noizzy-music' ),
                    'add_item'		=> esc_html__( 'New Event','noizzy-music' ),
                    'add_new_item'	=> esc_html__( 'Add New Event','noizzy-music' ),
                    'edit_item'		=> esc_html__( 'Edit Event','noizzy-music' )
                ),
                'public'		=> true,
                'has_archive'	=> true,
                'rewrite'		=> array('slug' => $slug),
                'menu_position'	=> $menuPosition,
                'show_ui'		=> true,
                'supports'		=> array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'		=> $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'				=> esc_html__( 'Event Types', 'noizzy-music' ),
            'singular_name'		=> esc_html__( 'Event Type', 'noizzy-music' ),
            'search_items'		=> esc_html__( 'Search Event Types', 'noizzy-music' ),
            'all_items'			=> esc_html__( 'All Event Types', 'noizzy-music' ),
            'parent_item'		=> esc_html__( 'Parent Event Type', 'noizzy-music' ),
            'parent_item_colon'	=> esc_html__( 'Parent Event Type:', 'noizzy-music' ),
            'edit_item'			=> esc_html__( 'Edit Event Type', 'noizzy-music' ),
            'update_item'		=> esc_html__( 'Update Event Type', 'noizzy-music' ),
            'add_new_item'		=> esc_html__( 'Add New Event Type', 'noizzy-music' ),
            'new_item_name'		=> esc_html__( 'New Event Type Name', 'noizzy-music' ),
            'menu_name'			=> esc_html__( 'Event Types', 'noizzy-music' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $labels,
            'show_ui'			=> true,
            'query_var'			=> true,
            'show_admin_column'	=> true,
            'rewrite'			=> array( 'slug' => 'event-type' ),
        ));
    }
}