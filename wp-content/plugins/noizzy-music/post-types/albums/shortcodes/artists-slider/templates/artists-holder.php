<div class="edge-artists-slider  <?php echo esc_attr($holder_classes); ?>" <?php echo noizzy_edge_get_inline_attrs($data_atts); ?>>

    <?php if(!empty($artists)) {
    foreach ($artists as $artist) {
        $albums = $self->getAlbumsArray($artist->term_id);
        $album = $self->getLatestAlbum($albums);
        $albumlink = $self->getLatestAlbumLink($albums);
        $image = get_term_meta ($artist->term_id, 'artist_image', true );
    ?>
    <div class="edge-artist">
        <div class="edge-artist-inner">
            <?php if ($albumlink !== '') { ?>
            <a class="edge-artist-latest-alb-link" href="<?php echo esc_url($albumlink); ?>" target="_self">
            <?php } ?>
                <?php if ($image !== '') { ?>
                    <div class="edge-artist-image" style="background-image: url(<?php echo wp_get_attachment_image_url($image,'full');?>)"></div>
                <?php } ?>

                <?php if ($album !== '' || $artist->name !== '') { ?>
                    <div class="edge-artist-info">
                        <div class="edge-artist-title-holder">
                            <?php if ($artist->name !== '') { ?>
                                <h3 class="edge-artist-name">
                                    <?php echo esc_attr($artist->name); ?>
                                </h3>
                                <?php if ($album !== '') { ?>
                                    <span><?php esc_html_e('Album: ', 'noizzy-music'); ?><?php esc_html_e($album); ?></span>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php if ($albumlink !== '') { ?>
            </a>
            <?php } ?>
        </div>
    </div>
    <?php }
    } else { ?>
        <p><?php esc_html_e('Sorry, no artists matched your criteria.', 'edge-cpt'); ?></p>
    <?php } ?>
</div>
