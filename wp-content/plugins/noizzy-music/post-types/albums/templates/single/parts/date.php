<?php 
	$release_date = get_post_meta(get_the_ID(), 'edge_album_release_date', true);
	if ($release_date !== '') {

		$old_date_timestamp = strtotime($release_date);
		$new_date = date('d/m/Y', $old_date_timestamp);

		?>
		<div class="edge-album-details edge-album-date">
			<span><?php esc_html_e('Release Date:', 'noizzy-music'); ?></span>
			<span><?php echo esc_attr($new_date); ?></span>
		</div>

		<?php
	}
	    ?>