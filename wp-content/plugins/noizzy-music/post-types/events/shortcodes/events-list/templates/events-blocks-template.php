<div class="edge-event-content-blocks edge-item-space edge-events<?php echo esc_attr(get_the_ID()) ?>" <?php echo noizzy_edge_get_inline_style($border_color_style); ?>>
    <div class="edge-event-block-item">
        <?php echo get_the_post_thumbnail(get_the_ID()); ?>
        <div class="edge-event-content-item edge-event-date-holder" <?php echo noizzy_edge_get_inline_style($text_color_style); ?>>
            <?php if (!empty($date)) { ?>
                <div class="edge-event-date-day-holder">
                    <?php print date('d', strtotime($date)) ?>
                </div>
                <div class="edge-event-month-holder">
                    <?php echo date('M', strtotime($date)); ?>
                </div>
            <?php } ?>
        </div>

        <div class="edge-event-content-item edge-event-title-holder">
            <<?php echo $title_tag ?> class="edge-event-title" >
            <a <?php echo noizzy_edge_get_inline_style($text_color_style); ?>
                href="<?php echo esc_url(get_permalink(get_the_ID())) ?>" target="_blank">
                <?php echo esc_attr($title); ?>
            </a>
            </<?php echo $title_tag ?>>
            <span class="edge-event-location"><?php echo esc_html($location); ?></span>

        </div>

        <div class="edge-event-content-item edge-event-buy-tickets-holder">
            <?php

            if ($tickets_status == 'available') {
                $color_one = $skin === 'dark' ? '#fff' : '#000';
                $color_three = $skin === 'light' ? '#f2d87c' : '#f04d4b';

                $button_params = array(
                    'text'                   => esc_html__('BUY TICKETS', 'noizzy-music'),
                    'custom_class'           => 'event-buy-tickets-button',
                    'size'                   => 'small',
                    'link'                   => $link,
                    'target'                 => $target,
                    'type'                   => 'solid',
                    'icon_pack'              => "font_awesome",
                    'fa_icon'                => "fa-angle-double-right"
                );

                echo noizzy_edge_execute_shortcode('edge_button', $button_params);
            } else if ($tickets_status == 'sold') { ?>
                <span class="edge-event-sold-out-holder" <?php echo noizzy_edge_get_inline_style($text_color_style); ?>>
              <?php echo esc_html__('SOLD OUT', 'noizzy-music'); ?>
            </span>
                <?php
            } else { ?>
                <span class="edge-event-free-holder" <?php echo noizzy_edge_get_inline_style($text_color_style); ?>>
              <?php echo esc_html__('FREE', 'noizzy-music'); ?>
            </span>
                <?php
            }
            ?>
        </div>
    </div>
</div>