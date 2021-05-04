<?php 
    $id = get_the_ID();
    $args = array(
		'type'			=> 'featured',
		'album'			=> $id
	);

    echo noizzy_edge_execute_shortcode('edge_album_player', $args);
?>