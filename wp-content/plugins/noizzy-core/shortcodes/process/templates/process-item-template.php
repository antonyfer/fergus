<div class="edge-process-item <?php echo esc_attr( $holder_classes ); ?>">
	<div class="edge-pi-content">
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="edge-pi-title" <?php echo noizzy_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="edge-pi-text" <?php echo noizzy_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>