<?php
	$tracks = get_post_meta(get_the_ID(), 'edge_tracks_repeater', true);
	$i = 0;
?>
<div class="edge-tracks-holder">
<?php
foreach($tracks as $track) : ?>
	<div class="edge-track-holder edge-unique-track-<?php echo esc_attr(get_the_ID()); ?>-<?php echo esc_attr(noizzy_edge_get_attachment_id_from_url($track['edge_track_file'])); ?>">
		<?php if(isset($track['edge_track_title']) && $track['edge_track_title'] != ''):?>
			<span class="edge-track-title"  data-track-index="<?php echo esc_attr($i); ?>">
				<span class="edge-track-number">
					<?php 
						if (($i + 1) < 10) {
							echo '0' . esc_attr($i + 1) . '. ';
						} else {
							echo esc_attr($i + 1) . '. ';
						}
					?>
				</span>
				<i class="fa fa-play" aria-hidden="true"></i>
			<?php echo esc_attr($track['edge_track_title']) ?></span>
		<?php endif; ?>
		<?php if((isset($track['edge_track_buy_link']) && $track['edge_track_buy_link'] != '') && (isset($track['edge_track_free_download']) && $track['edge_track_free_download'] != 'yes')) : ?>
			<span class="edge-track-buy"><a href="<?php echo esc_url($track['edge_track_buy_link']) ?>" target = "_blank"><?php esc_html_e('Buy Track', 'noizzy-music'); ?></a></span>
		<?php elseif (isset($track['edge_track_free_download']) && $track['edge_track_free_download']) : ?>
			<span class="edge-track-buy"><a href="<?php echo esc_url($track['edge_track_file']) ?>" download><?php esc_html_e('Download', 'noizzy-music'); ?></a></span>
		<?php endif; ?>
	</div>
<?php $i++; endforeach; ?>
</div>