<div class="edge-store-buttons-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <?php if ( ! empty( $google_store ) ) { ?>
        <a class="edge-store-button edge-google-play" href="<?php echo esc_url($google_store); ?>">
            <img src="<?php echo NOIZZY_CORE_ASSETS_URL_PATH . '/img/google-play.png'; ?>" alt="google play store" />
        </a>
    <?php } ?>
    <?php if ( ! empty( $app_store ) ) { ?>
        <a class="edge-store-button edge-app-store" href="<?php echo esc_url($app_store); ?>">
            <img src="<?php echo NOIZZY_CORE_ASSETS_URL_PATH . '/img/app-store.png'; ?>" alt="app store" />
        </a>
    <?php } ?>
</div>
