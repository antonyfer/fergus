<?php
$audio_type = get_post_meta( get_the_ID(), "edge_audio_type_meta", true );
$has_audio_link = get_post_meta(get_the_ID(), "edge_post_audio_custom_meta", true) !== '' || get_post_meta(get_the_ID(), "edge_post_audio_link_meta", true) !== '';
$show_featured = get_post_meta(get_the_ID(), 'edge_blog_single_show_featured_image_meta', true) == 'yes';
$audio_holder_class = !$show_featured ? 'edge-no-featured-image' : ''
?>
<?php if($has_audio_link) { ?>
    <div class="edge-blog-audio-holder <?php echo esc_attr($audio_holder_class); ?>">
        <?php if ( $audio_type == 'social_networks' ) {
            $audiolink = get_post_meta( get_the_ID(), "edge_post_audio_link_meta", true );
            echo wp_oembed_get( esc_url($audiolink) );
        } else if ( $audio_type == 'self' ) { ?>
            <audio class="edge-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "edge_post_audio_custom_meta", true)) ?>" controls="controls">
                <?php esc_html_e("Your browser don't support audio player", "noizzy"); ?>
            </audio>
        <?php } ?>
    </div>
<?php } ?>