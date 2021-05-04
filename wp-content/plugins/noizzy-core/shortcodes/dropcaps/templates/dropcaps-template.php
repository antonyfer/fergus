<?php
/**
 * Dropcaps shortcode template
 */
?>

<span class="edge-dropcaps <?php echo esc_attr($dropcaps_class);?>" <?php noizzy_edge_inline_style($dropcaps_style);?>>
	<?php echo esc_html($letter);?>
</span>