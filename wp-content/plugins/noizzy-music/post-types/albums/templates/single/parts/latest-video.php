<?php 
	$videolink = get_post_meta( get_the_ID(), "edge_album_video_link_meta", true );
	$videoimg  = get_post_meta( get_the_ID(), "edge_album_video_image_meta", true );

	if ($videolink !== ''): 
	    $args = array(
	        'video_link'		=> $videolink,
	        'video_image'		=> noizzy_edge_get_attachment_id_from_url($videoimg),
	    ); 
?>

<h5 class="edge-latest-video-holder-title"><?php esc_html_e('Latest Video:', 'noizzy-music'); ?></h5>

<?php
    echo noizzy_edge_execute_shortcode('edge_video_button', $args);
endif; ?>
