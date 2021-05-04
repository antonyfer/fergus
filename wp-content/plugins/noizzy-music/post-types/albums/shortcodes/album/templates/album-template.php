<div class="edge-album-track-list <?php echo esc_attr($alb_skin); ?>" id="<?php echo esc_attr($random_id); ?>">
<?php
	$i = 1;
	foreach($tracks as $track):?>
		<div class="edge-album-track" data-track-order="<?php echo esc_attr($i); ?>">
			<span class="edge-at-title">
				<?php if(isset($track['title']) && $track['title'] != '') :
						$j = $i . '. ';
				?>
					<span class="edge-at-number"><?php echo esc_attr($j); ?></span><?php echo esc_attr($track['title']); ?>
				<?php endif; ?>
			</span>
			<span class="edge-at-time"><?php echo esc_attr($track['track_time']); ?></span>
            <a class="edge-at-play-button">
                <audio src="<?php echo esc_url($track['track_file']); ?>"></audio>
                <i class="icon fa fa-play edge-at-play-icon"></i><i class="icon fa fa-pause edge-at-pause-icon"></i>
            </a>
			<span class="edge-at-video-button-holder">
				<?php if(isset($track['video_link']) && $track['video_link'] != '') : ?>
					<a class="edge-at-video-button" href="<?php echo esc_url($track['video_link']); ?>" data-rel="prettyPhoto" >
						<i class="icon fa fa-video-camera"></i>
					</a>
				<?php endif; ?>
			</span>
			<span class="edge-at-download-holder">
				<?php if(isset($track['free_download']) && $track['free_download'] == 'yes') : ?>
					<a href="<?php echo esc_url($track['track_file']); ?>" class="edge-at-download" download><i class="icon fa fa-download"></i></a>
				<?php endif; ?>
			</span>
		</div>
<?php
		$i++;
	endforeach;
?>
</div>