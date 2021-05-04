<div class="edge-artists-list <?php echo esc_attr($holder_classes); ?>">
    <?php if(!empty($artists)) { ?> <h3 class="edge-artists-text"><?php echo esc_html($text); ?></h3><?php } ?>
    <?php if(!empty($artists)) {
    foreach ($artists as $artist) { ?>

    <div class="edge-artist">

        <?php if ($artist->name !== '') { ?>
            <?php if ($artist->name !== '') { ?>
                <h3 class="edge-artist-name">
                    <?php echo esc_attr($artist->name); ?>
                </h3>
            <?php } ?>
        <?php } ?>

    </div>
    <?php }
    } else { ?>
        <p><?php esc_html_e('Sorry, no artists matched your criteria.', 'edge-cpt'); ?></p>
    <?php } ?>
</div>
