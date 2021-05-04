<div class="edge-audio-player-wrapper <?php echo esc_attr($player_classes) ?>">
    <div class="edge-audio-featured-img">
        <?php echo wp_get_attachment_image(esc_attr($image), 'full'); ?>
    </div>
    <div id= "edge-player-<?php echo esc_attr($player_id); ?>" class="jp-jplayer"></div>
    <?php if ($full_width_bg == 'yes'): ?>
    <div class="edge-container">
        <div class="clearfix edge-grid">
            <?php endif; ?>
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
            <?php if ($full_width_bg == 'yes'): ?>
        </div>
    </div>
<?php endif; ?>
</div>