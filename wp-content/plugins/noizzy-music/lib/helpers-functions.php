<?php

if ( ! function_exists( 'noizzy_music_get_cpt_shortcode_module_template_part' ) ) {
    /**
     * Loads module template part.
     *
     * @param string $post_type name of the post type of shortcode
     * @param string $shortcode name of the shortcode
     * @param string $template name of the template to load
     * @param string $slug
     * @param array $params array of parameters to pass to template
     * @param array $additional_params array of additional parameters to pass to template
     *
     * @return html
     */
    function noizzy_music_get_cpt_shortcode_module_template_part( $post_type, $shortcode, $template, $slug = '', $params = array(), $additional_params = array() ) {

        //HTML Content from template
        $html          = '';
        $template_path = NOIZZY_MUSIC_CPT_PATH . '/' . $post_type . '/shortcodes/' . $shortcode . '/templates';

        $temp = $template_path . '/' . $template;
        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        if ( is_array( $additional_params ) && count( $additional_params ) ) {
            extract( $additional_params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( $template ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        return $html;
    }
}

if ( ! function_exists( 'noizzy_music_get_cpt_single_module_template_part' ) ) {
    /**
    * Loads module template part.
    *
    * @param string $cpt_name name of the cpt folder
    * @param string $template name of the template to load
    * @param string $slug
    * @param array $params array of parameters to pass to template
    *
    * @return html
    */
    function noizzy_music_get_cpt_single_module_template_part( $template, $cpt_name, $slug = '', $params = array() ) {

        //HTML Content from template
        $html          = '';
        $template_path = NOIZZY_MUSIC_CPT_PATH . '/' . $cpt_name;

        $temp = $template_path . '/' . $template;

        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                 }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( ! empty( $template ) ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        print $html;
    }
}

if ( ! function_exists( 'noizzy_music_get_shortcode_module_template_part' ) ) {
    /**
     * Loads module template part.
     *
     * @param string $template name of the template to load
     * @param string $shortcode name of the shortcode folder
     * @param string $slug
     * @param array $params array of parameters to pass to template
     *
     * @return html
     */
    function noizzy_music_get_shortcode_module_template_part( $template, $shortcode, $slug = '', $params = array() ) {

        //HTML Content from template
        $html          = '';
        $template_path = NOIZZY_MUSIC_SHORTCODES_PATH . '/' . $shortcode;

        $temp = $template_path . '/' . $template;

        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( $template ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        return $html;
    }
}