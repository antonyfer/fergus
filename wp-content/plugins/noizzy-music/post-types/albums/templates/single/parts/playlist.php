<h5 class="edge-tracks-album-holder-title"><?php esc_html_e('Tracklist', 'noizzy-music'); ?></h5>
<?php
    $id = get_the_ID();
  
    if ($album_skin == 'light') {
    	$album_skin = 'default';
    }
    $args = array(
		'album'			=> $id,
		'album_skin' 	=> $album_skin,
	);

    echo noizzy_edge_execute_shortcode('edge_album', $args);
?>