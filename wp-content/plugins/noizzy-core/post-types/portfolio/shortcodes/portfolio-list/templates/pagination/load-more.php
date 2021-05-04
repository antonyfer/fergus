<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="edge-pl-loading">
		<div class="edge-pl-loading-bounce1"></div>
		<div class="edge-pl-loading-bounce2"></div>
		<div class="edge-pl-loading-bounce3"></div>
	</div>
	<div class="edge-pl-load-more-holder">
		<div class="edge-pl-load-more" <?php noizzy_edge_inline_style($holder_styles); ?>>
			<?php 
				echo noizzy_edge_get_button_html(array(
					'link' => 'javascript: void(0)',
                    'type' => 'solid',
					'size' => 'large',
					'text' => esc_html__('LOAD MORE', 'noizzy-core'),
                    'icon_pack'    => "font_awesome",
                    'fa_icon'      => "fa-angle-double-right"
				));
			?>
		</div>
	</div>
<?php }