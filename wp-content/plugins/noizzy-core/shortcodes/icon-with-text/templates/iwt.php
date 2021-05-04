<div <?php noizzy_edge_class_attribute($holder_classes); ?>>
	<div class="edge-iwt-icon">
		<?php if(!empty($link)) : ?>
			<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
		<?php endif; ?>
			<?php if(!empty($custom_icon)) : ?>
				<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
			<?php else: ?>
				<?php echo noizzy_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
			<?php endif; ?>
		<?php if(!empty($link)) : ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="edge-iwt-content" <?php noizzy_edge_inline_style($content_styles); ?>>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="edge-iwt-title" <?php noizzy_edge_inline_style($title_styles); ?>>
				<?php if(!empty($link)) : ?>
					<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
				<?php endif; ?>
				<span class="edge-iwt-title-text"><?php echo esc_html($title); ?></span>
				<?php if(!empty($link)) : ?>
					</a>
				<?php endif; ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="edge-iwt-text" <?php noizzy_edge_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>