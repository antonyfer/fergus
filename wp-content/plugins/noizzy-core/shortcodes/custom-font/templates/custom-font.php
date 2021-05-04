<<?php echo esc_attr( $title_tag ); ?> class="edge-custom-font-holder <?php echo esc_attr( $holder_classes ); ?>" <?php noizzy_edge_inline_style( $holder_styles ); ?> <?php echo noizzy_edge_get_inline_attrs( $holder_data ); ?>>
	<?php echo wp_kses_post( $title ); ?>
</<?php echo esc_attr( $title_tag ); ?>>