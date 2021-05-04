<?php
	$labels   = wp_get_post_terms(get_the_ID(), 'album-label');
	$label_names = array();

if(is_array($labels) && count($labels)) :
	foreach($labels as $label) {
		$label_names[] = $label->name;
	}

	?>
	<div class="edge-album-details edge-album-labels">
		<span><?php 
            if (count($labels) > 1) { 
                esc_html_e('Labels:', 'noizzy-music');
            } else {
                esc_html_e('Label:', 'noizzy-music');
            } ?>
        </span>
		<span>
			<?php echo esc_html(implode(', ', $label_names)); ?>
		</span>
	</div>
<?php endif; ?>