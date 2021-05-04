<div class="edge-full-screen-sections <?php echo esc_attr($holder_classes); ?>" <?php echo noizzy_edge_get_inline_attrs($holder_data); ?>>
	<div class="edge-fss-wrapper">
		<?php echo do_shortcode($content); ?>
	</div>
	<?php if($enable_navigation === 'yes') { ?>
		<div class="edge-fss-nav-holder">
			<a id="edge-fss-nav-up" href="#"><span class='icon-arrows-up'></span></a>
			<a id="edge-fss-nav-down" href="#"><span class='icon-arrows-down'></span></a>
		</div>
	<?php } ?>
</div>