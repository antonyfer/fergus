<?php
/**
 * Highlight shortcode template
 */
?>

<span class="edge-highlight" <?php noizzy_edge_inline_style($highlight_style);?>>
	<?php echo esc_html($content);?>
</span>