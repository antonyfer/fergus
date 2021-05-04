<div class="edge-price-table edge-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="edge-pt-inner" <?php echo noizzy_edge_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="edge-pt-title-holder">
				<span class="edge-pt-title" <?php echo noizzy_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="edge-pt-prices">
				<sup class="edge-pt-value" <?php echo noizzy_edge_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></sup>
				<span class="edge-pt-price" <?php echo noizzy_edge_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<h6 class="edge-pt-mark" <?php echo noizzy_edge_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
			</li>
			<li class="edge-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="edge-pt-button">
					<?php echo noizzy_edge_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'large',
                        'icon_pack'    => "font_awesome",
                        'fa_icon'      => "fa-angle-double-right"
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>