<div class="edge-audio-player-wrapper <?php echo esc_attr($player_classes) ?>">
    <?php if ( $shadow == 'yes' ) { ?>
       <span class="edge-player-shadow"></span>
    <?php } ?>
	<div id= "edge-player-<?php echo esc_attr($player_id); ?>" class="jp-jplayer"></div>
	<?php if ($full_width_bg == 'yes'): ?>
		<div class="edge-container">
		<div class="clearfix edge-grid">
	<?php endif; ?>
	<div id= "edge-player-container-<?php echo esc_attr($player_id); ?>" class="edge-audio-player-holder edge-audio-player-standard" data-album-id="<?php echo esc_attr($album); ?>">
		<div class="edge-audio-player-details-holder">
			<div class= "edge-audio-player-details">
				<span class="edge-audio-player-artist"></span>
				<span class="edge-audio-player-title"></span>
			</div>
		</div>
		<div class="edge-audio-player-controls-holder">
			<div class="jp-audio player-box">
				<div class="jp-gui jp-interface">
					<ul class="jp-controls">
						<li><a class="jp-previous" ><i class="icon fa fa-fast-backward"></i></a></li><!--
						--><li><a class="jp-play" ><i class="icon fa fa-play edge-play-button"></i><i class="icon fa fa-pause edge-pause-button"></i></a></li><!--
						--><li><a class="jp-next" ><i class="icon fa fa-fast-forward"></i></a></li>
					</ul>
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
        <div class="edge-audio-player-time-holder">
            <div class="edge-audio-player-current-time-holder">
                <div class="jp-audio player-box">
                    <div class="jp-gui jp-interface">
                        <div class="time-box">
                            <span class="jp-current-time"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edge-audio-player-progress-holder">
                <div class="jp-audio player-box">
                    <div class="jp-gui jp-interface">
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edge-audio-player-current-time-holder">
                <div class="jp-audio player-box">
                    <div class="jp-gui jp-interface">
                        <div class="time-box">
                            <span class="jp-duration"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="edge-audio-player-volume-holder">
			<div class="jp-volume-controls">
				<a class="jp-mute" role="button" tabindex="0"><i class="edge-audio-volume-high fa fa-volume-up" aria-hidden="true"></i><i class="edge-audio-volume-mute icon_vol-mute" aria-hidden="true"></i></a>
				<span class="jp-volume-bar">
					<span class="jp-volume-bar-value"></span>
				</span>
			</div>
		</div>
	</div>
	<?php if ($full_width_bg == 'yes'): ?>
		</div>
		</div>
	<?php endif; ?>
    <?php if ( $shadow == 'yes' ) { ?>
        <span class="edge-player-shadow"></span>
    <?php } ?>
</div>