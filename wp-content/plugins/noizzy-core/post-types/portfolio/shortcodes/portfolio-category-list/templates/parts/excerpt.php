<?php if ( ! empty( $excerpt ) ) { ?>
	<p itemprop="description" class="edge-pcli-excerpt"><?php echo wp_kses_post( $excerpt ); ?></p>
<?php } ?>