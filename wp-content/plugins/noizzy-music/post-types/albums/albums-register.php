<?php
namespace NoizzyMusic\CPT\Albums;

use NoizzyMusic\Lib;

/**
 * Class AlbumsRegister
 * @package NoizzyMusic\CPT\Albums
 */
class AlbumsRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base				= 'album';
        $this->taxGenreBase		= 'album-genre';
        $this->taxLabelBase		= 'album-label';
        $this->taxArtistBase	= 'album-artist';

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
     * Registers album single template if one does'nt exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if ( ! empty( $post ) && $post->post_type == $this->base ) {
            if(!file_exists(get_template_directory().'/single-album.php')) {
                return NOIZZY_MUSIC_CPT_PATH.'/albums/templates/single-'.$this->base.'.php';
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

        register_post_type( $this->base,
            array(
                'labels'		=> array(
                    'name'			=> esc_html__( 'Noizzy Albums','noizzy-music' ),
                    'singular_name'	=> esc_html__( 'Noizzy Album','noizzy-music' ),
                    'add_item'		=> esc_html__( 'New Album','noizzy-music' ),
                    'add_new_item'	=> esc_html__( 'Add New Album','noizzy-music' ),
                    'edit_item'		=> esc_html__( 'Edit Album','noizzy-music' )
                ),
                'public'		=> true,
                'has_archive'	=> true,
                'rewrite'		=> array('slug' => 'album'),
                'menu_position'	=> $menuPosition,
                'show_ui'		=> true,
                'supports'		=> array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'		=>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $label_labels = array(
            'name'				=> esc_html__( 'Labels', 'noizzy-music' ),
            'singular_name'		=> esc_html__( 'Label', 'noizzy-music' ),
            'search_items'		=> esc_html__( 'Search Labels', 'noizzy-music' ),
            'all_items'			=> esc_html__( 'All Labels', 'noizzy-music' ),
            'parent_item'		=> esc_html__( 'Parent Label', 'noizzy-music' ),
            'parent_item_colon'	=> esc_html__( 'Parent Label:', 'noizzy-music' ),
            'edit_item'			=> esc_html__( 'Edit Label', 'noizzy-music' ),
            'update_item'		=> esc_html__( 'Update Label', 'noizzy-music' ),
            'add_new_item'		=> esc_html__( 'Add New Label', 'noizzy-music' ),
            'new_item_name'		=> esc_html__( 'New Label Name', 'noizzy-music' ),
            'menu_name'			=> esc_html__( 'Labels', 'noizzy-music' ),
        );

        register_taxonomy($this->taxLabelBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $label_labels,
            'show_ui'			=> true,
            'query_var'			=> true,
	        'show_admin_column'	=> true
        ));

		$genre_labels = array(
			'name'				=> esc_html__( 'Genres', 'noizzy-music' ),
			'singular_name'		=> esc_html__( 'Genre', 'noizzy-music' ),
			'search_items'		=> esc_html__( 'Genres', 'noizzy-music' ),
			'all_items'			=> esc_html__( 'Genres', 'noizzy-music' ),
			'parent_item'		=> esc_html__( 'Parent Genre', 'noizzy-music' ),
			'parent_item_colon'	=> esc_html__( 'Parent Genres:', 'noizzy-music' ),
			'edit_item'			=> esc_html__( 'Edit Genre', 'noizzy-music' ),
			'update_item'		=> esc_html__( 'Update Genre', 'noizzy-music' ),
			'add_new_item'		=> esc_html__( 'Add New Genre', 'noizzy-music' ),
			'new_item_name'		=> esc_html__( 'New Genre', 'noizzy-music' ),
			'menu_name'			=> esc_html__( 'Genres', 'noizzy-music' ),
		);

		register_taxonomy($this->taxGenreBase,array($this->base), array(
			'hierarchical'		=> true,
			'labels'			=> $genre_labels,
			'show_ui'			=> true,
			'query_var'			=> true,
			'show_admin_column'	=> true
		));

		$artist_labels = array(
			'name'				=> esc_html__( 'Artists', 'noizzy-music' ),
			'singular_name'		=> esc_html__( 'Artist', 'noizzy-music' ),
			'search_items'		=> esc_html__( 'Artists', 'noizzy-music' ),
			'all_items'			=> esc_html__( 'Artists', 'noizzy-music' ),
			'parent_item'		=> esc_html__( 'Parent Artist', 'noizzy-music' ),
			'parent_item_colon'	=> esc_html__( 'Parent Artists:', 'noizzy-music' ),
			'edit_item'			=> esc_html__( 'Edit Artist', 'noizzy-music' ),
			'update_item'		=> esc_html__( 'Update Artist', 'noizzy-music' ),
			'add_new_item'		=> esc_html__( 'Add New Artist', 'noizzy-music' ),
			'new_item_name'		=> esc_html__( 'New Artist Name', 'noizzy-music' ),
			'menu_name'			=> esc_html__( 'Artists', 'noizzy-music' ),
		);

		register_taxonomy($this->taxArtistBase,array($this->base), array(
			'hierarchical'		=> true,
			'labels'			=> $artist_labels,
			'show_ui'			=> true,
			'query_var'			=> true,
			'show_admin_column'	=> true
		));
    }

}