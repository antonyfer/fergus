<div class="edge-progress-bar <?php echo esc_attr($holder_classes); ?>">
	<<?php echo esc_attr($title_tag); ?> class="edge-pb-title-holder" <?php echo noizzy_edge_inline_style($title_styles); ?>>
		<span class="edge-pb-title"><?php echo esc_html($title); ?></span>
		<span class="edge-pb-percent">0</span>
	</<?php echo esc_attr($title_tag); ?>>
	<div class="edge-pb-content-holder" <?php echo noizzy_edge_inline_style($inactive_bar_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent); ?> class="edge-pb-content" <?php echo noizzy_edge_inline_style($active_bar_style); ?>></div>
	</div>
</div>