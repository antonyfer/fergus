<div class="edge-album <?php echo esc_attr($size); ?>">
	<div class = "edge-album-image-holder">
		<a class="edge-album-image-link" href="<?php echo esc_url($album_link); ?>">
			<?php echo get_the_post_thumbnail(get_the_ID(),$thumb); ?>
		</a>
        <?php $button_params = array(
        'text'                   => esc_html__('LISTEN NOW', 'noizzy-music'),
        'size'                   => 'small',
        'link'                   => esc_url($album_link),
        'type'                   => 'simple',
        'icon_pack'              => "font_awesome",
        'fa_icon'                => "fa-angle-double-right"
        );

        echo noizzy_edge_execute_shortcode('edge_button', $button_params); ?>
	</div>
	<div class="edge-album-text-holder">
		<<?php echo esc_attr( $title_tag ); ?> class="edge-album-title">
			<a href="<?php echo esc_url($album_link); ?>">
				<?php echo esc_attr(get_the_title()); ?>
			</a>	
		</<?php echo esc_attr( $title_tag ); ?>>
        <?php
			print $label_html;
		?>
	</div>
</div>