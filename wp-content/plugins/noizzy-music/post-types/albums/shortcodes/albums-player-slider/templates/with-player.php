<div class="edge-album <?php echo esc_attr($size); ?>">
    <div class = "edge-album-image-holder">
        <a class="edge-album-image-link" href="<?php echo esc_url($album_link); ?>">
            <?php echo get_the_post_thumbnail(get_the_ID(),$thumb); ?>
            <span class="edge-album-disc-image-holder">
                <img class="edge-album-disc-image" src="<?php echo wp_get_attachment_url($cd_image); ?>" alt="<?php echo get_post_meta( $cd_image, '_wp_attachment_image_alt', true); ?>">
            </span>
        </a>

        <div class="edge-audio-player-wrapper edge-player-featured-image">
            <div id= "edge-player-<?php echo esc_attr($player_id); ?>" class="jp-jplayer"></div>
                    <div id= "edge-player-container-<?php echo esc_attr($player_id); ?>" class="edge-audio-player-holder edge-audio-player-simple " data-album-id="<?php echo esc_attr($album); ?>">
                        <div class="edge-audio-player-controls-holder">
                            <div class="jp-audio player-box">
                                <div class="jp-gui jp-interface">
                                    <ul class="jp-controls">
                                        <li class="edge-audio-prev"><a class="jp-previous" ><i class="icon fa fa-fast-backward"></i></a></li><!--
                            --><li><a class="jp-play" ><i class="icon fa fa-play edge-play-button"></i><i class="icon fa fa-pause edge-pause-button"></i></a></li><!--
                            --><li class="edge-audio-next"><a class="jp-next" ><i class="icon fa fa-fast-forward"></i></a></li>
                                    </ul>
                                </div>
                                <div class="edge-audio-player-box-inner">
                                    <div class="edge-audio-player-time-holder">
                                        <div class="edge-audio-player-progress-holder">
                                            <div class="jp-progress">
                                                <div class="jp-seek-bar">
                                                    <div class="jp-play-bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edge-audio-player-details-holder">
                                        <div class= "edge-audio-player-details">
                                            <span class="jp-current-time"></span>
                                            <span class="edge-audio-player-title"></span>
                                            <span class="jp-duration"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="jp-type-playlist">
                                    <div class="jp-playlist">
                                        <ul class="tracks-list">
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

        <div class="edge-album-text-holder">
            <<?php echo esc_attr( $title_tag ); ?> class="edge-album-title">
            <a href="<?php echo esc_url($album_link); ?>">
                <?php echo esc_attr(get_the_title()); ?>
            </a>
        </<?php echo esc_attr( $title_tag ); ?>>
    </div>
</div>
</div>