<?php if($query_results->max_num_pages>1){ ?>
	<div class="edge-albums-list-paging">
		<span class="edge-albums-list-load-more">
			<?php 
				echo noizzy_edge_get_button_html(array(
					'link' 	    => 'javascript: void(0)',
					'type' 	    => 'solid',
                    'size'      => 'medium',
					'text'      => esc_html__('Show All', 'noizzy-music'),
                    'icon_pack' => "font_awesome",
                    'fa_icon'   => "fa-angle-double-right"
				));
			?>
		</span>
	</div>
<?php }