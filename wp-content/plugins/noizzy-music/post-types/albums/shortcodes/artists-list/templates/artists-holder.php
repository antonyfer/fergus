<div class="edge-artists-list edge-artists-list-holder <?php echo esc_attr($holder_classes); ?>">

    <?php if(!empty($artists)) {
    foreach ($artists as $artist) {
        $albums = $self->getAlbumsArray($artist->term_id);
        $album = $self->getLatestAlbum($albums);
        $image = get_term_meta ($artist->term_id, 'artist_image', true );
    ?>
    <div class="edge-artist">
        <div class="edge-artist-inner">
            <?php if ($image !== '') { ?>
                <div class="edge-artist-image">
                    <?php echo wp_get_attachment_image($image,'full');?>
                    
                    <div class="edge-artist-social-holder">
                        <div class="edge-artist-social">
                            <div class="edge-artist-social-inner">
                                <div class="edge-artist-social-wrapp">
                                    <h5 class="edge-artists-soc-title"><?php esc_html_e('Follow Me', 'noizzy-music'); ?></h5>
                                    <?php echo wp_kses( $self->getSocialIcons($artist->term_id),
                                        array(
                                            'a' => array(
                                                'href'  => true,
                                                'class' => true
                                            ),
                                            'i' => array(
                                                'class' => true
                                            )
                                        )
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>

            <?php if ($album !== '' || $artist->name !== '') { ?>
                <div class="edge-artist-info">
                    <div class="edge-artist-title-holder">
                        <?php if ($artist->name !== '') { ?>
                            <h5 class="edge-artist-name">
                                <?php echo esc_attr($artist->name); ?>
                            </h5>
                            <?php if ($album !== '') { ?>
                                <span class="edge-artist-ablum-name"><?php esc_html_e('Album: ', 'noizzy-music'); ?><?php esc_html_e($album); ?></span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php }
    } else { ?>
        <p><?php esc_html_e('Sorry, no artists matched your criteria.', 'edge-cpt'); ?></p>
    <?php } ?>
</div>
