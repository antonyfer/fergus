<?php 
	$people = get_post_meta(get_the_ID(), 'edge_album_people', true);
	if ($people !== '') {
		?>
		<div class="edge-album-details edge-album-people">
			<span><?php esc_html_e('Publisher:', 'noizzy-music'); ?></span>
			<span><?php echo esc_attr($people); ?></span>
		</div>

		<?php
	}
	    ?>