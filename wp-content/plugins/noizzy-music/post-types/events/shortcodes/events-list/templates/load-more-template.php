<?php if($query_results->max_num_pages>1){ ?>
    <div class="edge-events-list-paging">
		<span class="edge-events-list-load-more">
			<?php
            echo noizzy_edge_get_button_html(array(
                'link'      => 'javascript: void(0)',
                'type'      => 'solid',
                'size'      => 'medium',
                'text'      => esc_html__('Show More', 'noizzy-music'),
                'icon_pack' => "font_awesome",
                'fa_icon'   => "fa-angle-double-right"
            ));
            ?>
		</span>
        <div class="edge-stripes">
            <div class="edge-rect1"></div>
            <div class="edge-rect2"></div>
            <div class="edge-rect3"></div>
            <div class="edge-rect4"></div>
            <div class="edge-rect5"></div>
        </div>
    </div>
<?php }