<div class="edge-album <?php echo esc_attr($size); ?>">
	<div class = "edge-album-image-holder">
        <a class="edge-album-image-link" href="<?php echo esc_url($album_link); ?>">
			<?php echo get_the_post_thumbnail(get_the_ID(),$thumb); ?>
		</a>
	</div>
	<div class="edge-album-text-holder edge-album-buttons">
        <?php if ( ! empty( $google_store ) ) { ?>
            <a class="edge-store-button edge-google-play" href="<?php echo esc_url($google_store); ?>" target="_blank">
                <img src="<?php echo NOIZZY_CORE_ASSETS_URL_PATH . '/img/google-play.png'; ?>" alt="google play store" />
            </a>
        <?php } ?>
        <?php if ( ! empty( $app_store ) ) { ?>
            <a class="edge-store-button edge-app-store" href="<?php echo esc_url($app_store); ?>" target="_blank">
                <img src="<?php echo NOIZZY_CORE_ASSETS_URL_PATH . '/img/app-store.png'; ?>" alt="app store" />
            </a>
        <?php } ?>
	</div>
</div>