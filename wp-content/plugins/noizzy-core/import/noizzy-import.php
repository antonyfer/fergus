<?php

if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class NoizzyCoreImport {
	/**
	 * @var instance of current class
	 */
	private static $instance;
	
	/**
	 * Name of folder where revolution slider will stored
	 * @var string
	 */
	private $revSliderFolder;
	
	/**
	 *
	 * URL where are import files
	 * @var string
	 */
	private $importURI;
	
	/**
	 * @return NoizzyCoreImport
	 */
	public static function getInstance() {
		if ( self::$instance === null ) {
			return new self();
		}
		
		return self::$instance;
	}
	
	public $message = "";
	public $attachments = false;
	
	function __construct() {
		$this->revSliderFolder = 'edge-rev-sliders';
		$this->importURI       = defined( 'EDGE_PROFILE_SLUG' ) ? 'http://export.' . EDGE_PROFILE_SLUG . '-themes.com/' : '';
		
		add_action( 'admin_menu', array( &$this, 'edge_admin_import' ) );
		add_action( 'admin_init', array( &$this, 'edge_register_theme_settings' ) );

	}
	
	function edge_register_theme_settings() {
		register_setting( 'edge_options_import_page', 'edge_options_import' );
	}
	
	public function import_content( $file ) {
		ob_start();
		require_once( NOIZZY_CORE_ABS_PATH . '/import/class.wordpress-importer.php' );
		$noizzy_import = new WP_Import();
		set_time_limit( 0 );
		
		$noizzy_import->fetch_attachments = $this->attachments;
		$returned_value                  = $noizzy_import->import( $file );
		
		if ( is_wp_error( $returned_value ) ) {
			$this->message = esc_html__( 'An Error Occurred During Import', 'noizzy-core' );
		} else {
			$this->message = esc_html__( 'Content imported successfully', 'noizzy-core' );
		}
		
		ob_get_clean();
	}
	
	public function import_widgets( $file, $file2 ) {
		$this->import_custom_sidebars( $file2 );
		$options = $this->file_options( $file );
		
		foreach ( (array) $options['widgets'] as $noizzy_widget_id => $noizzy_widget_data ) {
			update_option( 'widget_' . $noizzy_widget_id, $noizzy_widget_data );
		}
		
		$this->import_sidebars_widgets( $file );
		$this->message = esc_html__( 'Widgets imported successfully', 'noizzy-core' );
	}
	
	public function import_sidebars_widgets( $file ) {
		$noizzy_sidebars = get_option( "sidebars_widgets" );
		unset( $noizzy_sidebars['array_version'] );
		$data = $this->file_options( $file );
		
		if ( is_array( $data['sidebars'] ) ) {
			$noizzy_sidebars = array_merge( (array) $noizzy_sidebars, (array) $data['sidebars'] );
			unset( $noizzy_sidebars['wp_inactive_widgets'] );
			$noizzy_sidebars                  = array_merge( array( 'wp_inactive_widgets' => array() ), $noizzy_sidebars );
			$noizzy_sidebars['array_version'] = 2;
			wp_set_sidebars_widgets( $noizzy_sidebars );
		}
	}
	
	public function import_custom_sidebars( $file ) {
		$options = $this->file_options( $file );
		update_option( 'edge_sidebars', $options );
		$this->message = esc_html__( 'Custom sidebars imported successfully', 'noizzy-core' );
	}
	
	public function import_options( $file ) {
		$options       = $this->file_options( $file );
		$result        = update_option( 'edge_options_noizzy', $options );
		$this->message = esc_html__( 'Options imported successfully', 'noizzy-core' );
	}
	
	public function import_menus( $file ) {
		global $wpdb;
		$noizzy_terms_table = $wpdb->prefix . "terms";
		$this->menus_data  = $this->file_options( $file );
		$menu_array        = array();
		
		foreach ( $this->menus_data as $registered_menu => $menu_slug ) {
			$term_rows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $noizzy_terms_table where slug=%s", $menu_slug ), ARRAY_A );
			
			if ( isset( $term_rows[0]['term_id'] ) ) {
				$term_id_by_slug = $term_rows[0]['term_id'];
			} else {
				$term_id_by_slug = null;
			}
			
			$menu_array[ $registered_menu ] = $term_id_by_slug;
		}
		
		set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_array ) );
	}
	
	public function import_settings_pages( $file ) {
		$pages = $this->file_options( $file );
		
		foreach ( $pages as $noizzy_page_option => $noizzy_page_id ) {
			update_option( $noizzy_page_option, $noizzy_page_id );
		}
	}
	
	public function rev_sliders() {
		$rev_sldiers = array(
			'home-1.zip',
			'home-3.zip',
			'home-7.zip',
			'home-8.zip',
			'home-vertical-slider.zip',
			'landing-content-slider-1.zip',
			'landing-content-slider-4.zip',
			'landing-content-slider-5.zip',
			'landing-content-slider-6.zip',
			'landing-content-slider-7.zip',
			'landing-top-slider.zip'
		);
		
		return $rev_sldiers;
	}
	
	public function create_rev_slider_files( $folder ) {
		$rev_list = $this->rev_sliders();
		$dir_name = $this->revSliderFolder;
		
		$upload     = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/' . $dir_name;
		if ( ! is_dir( $upload_dir ) ) {
			mkdir( $upload_dir, 0700 );
			mkdir( $upload_dir . '/' . $folder, 0700 );
		}
		
		foreach ( $rev_list as $rev_slider ) {
			file_put_contents( WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider, file_get_contents( $this->importURI . '/' . $folder . '/revslider/' . $rev_slider ) );
		}
	}
	
	public function rev_slider_import( $folder ) {
		$this->create_rev_slider_files( $folder );
		
		$rev_sliders   = $this->rev_sliders();
		$dir_name      = $this->revSliderFolder;
		$absolute_path = __FILE__;
		$path_to_file  = explode( 'wp-content', $absolute_path );
		$path_to_wp    = $path_to_file[0];
		
		require_once( $path_to_wp . '/wp-load.php' );
		require_once( $path_to_wp . '/wp-includes/functions.php' );
		require_once( $path_to_wp . '/wp-admin/includes/file.php' );
		
		$rev_slider_instance = new RevSlider();
		
		foreach ( $rev_sliders as $rev_slider ) {
			$nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider;
			$rev_slider_instance->importSliderFromPost( true, true, $nf );
		}
	}
	
	public function file_options( $file ) {
		$file_content = $this->edge_file_contents( $file );
		
		if ( $file_content ) {
			$unserialized_content = unserialize( base64_decode( $file_content ) );
			
			if ( $unserialized_content ) {
				return $unserialized_content;
			}
		}
		
		return false;
	}
	
	function edge_file_contents( $path ) {
		$url      = $this->importURI . $path;
		$response = wp_remote_get( $url );
		$body     = wp_remote_retrieve_body( $response );
		
		return $body;
	}
	
	function edge_admin_import() {
		if ( noizzy_core_theme_installed() ) {
			global $noizzy_edge_Framework;
			
			$slug           = "_tabimport";
			$this->pagehook = add_submenu_page(
                EDGE_OPTIONS_SLUG,
				esc_html__( 'Noizzy Options - Noizzy Import', 'noizzy-core' ), // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Import', 'noizzy-core' ),                     // The text of the menu in the administrator's sidebar
				'administrator',                                          // What roles are able to access the menu
                EDGE_OPTIONS_SLUG . $slug,                  // The ID used to bind submenu items to this menu
				array( $noizzy_edge_Framework->getSkin(), 'renderImport' )
			);
			
			add_action( 'admin_print_scripts-' . $this->pagehook, 'noizzy_edge_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $this->pagehook, 'noizzy_edge_enqueue_admin_styles' );
		}
	}

	function edgtf_update_meta_fields_after_import( $folder ) {
		global $wpdb;

		$url       = esc_url( home_url( '/' ) );
		$demo_urls = $this->edgtf_import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$sql_query   = "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key LIKE 'edgtf%' AND meta_value LIKE '" . esc_url( $demo_url ) . "%';";
			$meta_values = $wpdb->get_results( $sql_query );

			if ( ! empty( $meta_values ) ) {
				foreach ( $meta_values as $meta_value ) {
					$new_value = $this->edgtf_recalc_serialized_lengths( str_replace( $demo_url, $url, $meta_value->meta_value ) );

					$wpdb->update( $wpdb->postmeta,	array( 'meta_value' => $new_value ), array( 'meta_id' => $meta_value->meta_id )	);
				}
			}
		}
	}

	function edgtf_update_options_after_import( $folder ) {
		$url       = esc_url( home_url( '/' ) );
		$demo_urls = $this->edgtf_import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$global_options    = get_option( 'edge_options_noizzy' );
			$new_global_values = str_replace( $demo_url, $url, $global_options );

			update_option( 'edge_options_noizzy', $new_global_values );
		}
	}

	function edgtf_import_get_demo_urls( $folder ) {
		$demo_urls  = array();
		$domain_url = defined( 'EDGE_PROFILE_SLUG' ) ? str_replace( '/', '', $folder ) . '.' . EDGE_PROFILE_SLUG . '-themes.com/' : '';

		$demo_urls[] = ! empty( $domain_url ) ? 'http://' . $domain_url : '';
		$demo_urls[] = ! empty( $domain_url ) ? 'https://' . $domain_url : '';

		return $demo_urls;
	}

	function edgtf_recalc_serialized_lengths( $sObject ) {
		$ret = preg_replace_callback( '!s:(\d+):"(.*?)";!', 'edgtf_recalc_serialized_lengths_callback', $sObject );

		return $ret;
	}

	function edgtf_recalc_serialized_lengths_callback( $matches ) {
		return "s:" . strlen( $matches[2] ) . ":\"$matches[2]\";";
	}
}