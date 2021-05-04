<div class="edge-process-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="edge-mark-horizontal-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="edge-process-mark">
				<div class="edge-process-line"></div>
				<div class="edge-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="edge-mark-vertical-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="edge-process-mark">
				<div class="edge-process-line"></div>
				<div class="edge-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="edge-process-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>