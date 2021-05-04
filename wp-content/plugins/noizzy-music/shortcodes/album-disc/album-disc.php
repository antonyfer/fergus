<?php
namespace NoizzyMusic\CPT\Shortcodes\AlbumDisc;

use NoizzyMusic\Lib;


class AlbumDisc implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct() {
        $this->base = 'edge_album_disc';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name'                      => esc_html__('Album Disc', 'noizzy-music'),
                'base'                      => $this->base,
                'category'                  => esc_html__('by NOIZZY MUSIC', 'noizzy-music'),
                'icon'                      => 'icon-wpb-album-disc extended-custom-music-icon',
                'allowed_container_element' => 'vc_row',
                'params'                    =>  array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('CD Case Image', 'noizzy-music'),
                        'param_name' => 'cd_case_image'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'enable_cd_case_shadow',
                        'heading'     => esc_html__( 'Enable CD Case Image Shadow', 'noizzy-core' ),
                        'value'       => array_flip( noizzy_edge_get_yes_no_select_array( false, false ) ),
                        'save_always' => false
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('CD Image', 'noizzy-music'),
                        'param_name' => 'cd_image',
                        'description' => esc_html('Set an image to be placed upon the CD template', 'noizzy-music')
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('CD Image Outer Border Color', 'noizzy-music'),
                        'param_name' => 'cd_image_outer_border_color',
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Link', 'noizzy-music'),
                        'param_name'  => 'link',
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading'     => esc_html__('Link Target', 'noizzy-music'),
                        'param_name' => 'link_target',
                        'value' => array(
                            esc_html__('Same Window', 'noizzy-music')  => '_self',
                            esc_html__('New Window', 'noizzy-music')   => '_blank'
                        ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading'     => esc_html__('Animate', 'noizzy-music'),
                        'param_name' => 'animate',
                        'value' => array(
                            esc_html__('On Appear', 'noizzy-music') => 'appear',
                            esc_html__('On Hover', 'noizzy-music')  => 'hover',
                            esc_html__('None', 'noizzy-music')      => 'none'
                        ),
                        'admin_label' => true,
                        'group' => esc_html__('Behavior', 'noizzy-music')
                    ),
                ),
            ));
        }
    }

    /**
     * Renders HTML for audio playlist shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'cd_case_image'                 => '',
            'enable_cd_case_shadow'         => '',
            'cd_image'                      => '',
            'cd_image_outer_border_color'   => '',
            'link'                          => '',
            'link_target'                   => '_self',
            'animate'                       => 'appear'
        );

        $params = shortcode_atts($args, $atts);

        $params['holder_classes']   = $this->getHolderClasses($params);
        $params['cd_image_styles']  = $this->getCDImageStyles($params);

        return noizzy_music_get_shortcode_module_template_part('templates/album-disc-template', 'album-disc', '', $params);
    }

    /**
     * Return Holder classes
     *
     * @param $params
     * @return array
     */
    private function getHolderClasses($params) {
        $holder_classes = array();

        if ($params['animate'] !== '') {
            $holder_classes[] = 'edge-animate-on-'. $params['animate'];
        }

        if ($params['enable_cd_case_shadow'] === 'yes') {
            $holder_classes[] = 'edge-cd-case-shadow-on';
        }

        return implode(' ', $holder_classes);
    }

     /**
     * Returns array of cd image styles
     *
     * @param $params
     *
     * @return array
     */
    private function getCDImageStyles($params) {
        $styles = array();

        if(!empty($params['cd_image_outer_border_color'])) {
            $styles[] = 'border-color: '.$params['cd_image_outer_border_color'];
        }

        return $styles;
    }
}