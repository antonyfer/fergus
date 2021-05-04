<div class="edge-pli-read-more">
<?php
    echo noizzy_edge_execute_shortcode('edge_button', array(
        'type'      => 'outline',
        'size'      => 'large',
        'text'      => esc_html__('See more', 'noizzy-core'),
        'link'      => get_the_permalink(),
        'fa_icon'   => 'fa-arrow-right',
        'icon_pack' => 'font_awesome',
        'padding'   => '13px 50px'
    ));
?>
</div>
