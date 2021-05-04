<div class="edge-album <?php echo esc_attr($size); ?>">
    <div class = "edge-album-image-holder">
        <a class="edge-album-image-link" href="<?php echo esc_url($album_link); ?>">
            <?php echo get_the_post_thumbnail(get_the_ID(),$thumb); ?>
            <span class="edge-album-disc-image-holder">
                <img class="edge-album-disc-image" src="<?php echo wp_get_attachment_url($cd_image); ?>">
            </span>
        </a>
    <div class="edge-album-text-holder">
        <<?php echo esc_attr( $title_tag ); ?> class="edge-album-title">
        <a href="<?php echo esc_url($album_link); ?>">
            <?php echo esc_attr(get_the_title()); ?>
        </a>
        </<?php echo esc_attr( $title_tag ); ?>>
    </div>
    </div>
</div>