<?php
$albums = $self->getAlbumsArray($artist->term_id);
$album = $self->getLatestAlbum($albums);
?>
<div class="edge-atrist-single">
    <div class="edge-grid-row edge-grid-huge-gutter">
        <div class="edge-image-wrap edge-grid-col-7">
            <div class="edge-atrist-image-holder">
                <a href="<?php echo esc_url(get_term_meta ($artist->term_id, 'artist_link', true )); ?>">
                    <img class="edge-atrist-image" src="<?php echo wp_get_attachment_url(get_term_meta($artist->term_id, 'artist_image', true )); ?>" alt="<?php esc_attr($artist->name);?>" />
                </a>
            </div>
        </div>
        <div class="edge-artist-popup-data edge-grid-col-5">
            <div class="edge-artist-title-holder">
                <?php if ($artist->name !== '') { ?>
                    <h4 class="edge-artist-name">
                        <?php echo esc_attr($artist->name); ?>
                    </h4>
                <?php } ?>
            </div>
            <p class="edge-artist-desc"><?php echo esc_html($artist->description); ?></p>
            <?php echo noizzy_edge_execute_shortcode('edge_button', array(
                'text' => esc_html__('BUY TICKET', 'noizzy-music'),
                'link'         => get_term_meta ( $artist->term_id, 'artist_url', true ),
                'icon_pack'    => "font_awesome",
                'fa_icon'      => "fa-angle-double-right"
            )); ?>
        </div>
    </div>
</div>