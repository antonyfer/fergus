<div class="edge-album <?php echo esc_attr($size); ?>">
	<div class="edge-album-inner" >
		<a class ="edge-album-link" href="<?php echo esc_url($album_link); ?>"></a>
		<div class = "edge-album-image-holder">
		<?php
			echo get_the_post_thumbnail(get_the_ID(),$thumb);
		?>				
		</div>
		<div class="edge-album-text-overlay">
			<div class="edge-album-text-overlay-inner">
				<div class="edge-album-text-holder">
                    <<?php echo esc_attr( $title_tag ); ?> class="edge-album-title">
						<?php echo esc_attr(get_the_title()); ?>
                    </<?php echo esc_attr( $title_tag ); ?>>
                    <?php if ( $button === 'no' ) {
						print $artist_html;
                    } else { ?>
                        <a class="edge-event-button" href="<?php echo esc_url($album_link); ?>"><span><?php esc_html_e('Listen Now', 'noizzy-music'); ?></span><i class="fa fa-angle-double-right"></i></a>
                    <?php } ?>
				</div>
			</div>	
		</div>
	</div>
</div>