<div class="edge-vertical-flow-slider swiper-container full-page" <?php echo noizzy_edge_get_inline_attrs($data_params); ?>>
    <div class="swiper-wrapper">
        <?php foreach ($vertical_flow_slider as $object) :
            $slide_styles = array();
            if (isset($object['background_image'])) {
                 $slide_styles[] = 'background-image: url(' . wp_get_attachment_url($object['background_image']) . ')';
             } else {
                $slide_styles[] = '';
             }
           
            ?>
            <div class="swiper-slide" <?php echo noizzy_edge_get_inline_style($slide_styles); ?>>
                <?php if (!empty($object['parallax_image'])) { ?>
                    <div class="edge-slide-parallax-image-holder">
                        <div class="edge-slide-parallax-image" data-swiper-parallax="-50%">
                            <?php echo wp_get_attachment_image($object['parallax_image'], 'full'); ?>
                        </div>
                    </div>
                <?php } ?>

            </div>

        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="edge-vertical-flow-slider-links-holder">
        <?php
            $links_html = '';
            foreach ($vertical_flow_slider as $object) : 
                if (!empty($object['link_text'])) {

                    if (!empty($object['link'])) {
                        $links_html .= '<a href="' . esc_url($object['link']). '" class="edge-slide-link" target="' . esc_attr($object['link_target']) . '"> ';
                    }
                    
                    $links_html .= '<span class="edge-slide-link-text">' .esc_html($object['link_text']) . '</span>';

                    if (!empty($object['link'])) {
                        $links_html .=   '</a>';
                    }

                }
            endforeach;
            print noizzy_edge_get_module_part($links_html);
        ?>

    </div>
</div>