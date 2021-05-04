<div class="edge-blog-list-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
	<div class="edge-bl-wrapper edge-outer-space">
		<div class="edge-blog-list">
			<div class="edge-bl-grid-sizer"></div>
			<div class="edge-bl-grid-gutter"></div>
			<?php
			if ( $query_result->have_posts() ):
				while ( $query_result->have_posts() ) : $query_result->the_post();
                    noizzy_edge_get_post_format_html( 'masonry' );
//					noizzy_edge_get_module_template_part( 'shortcodes/blog-list/layout-collections/post', 'blog', $type, $params );
				endwhile;
			else:
				noizzy_edge_get_module_template_part( 'templates/parts/no-posts', 'blog', '', $params );
			endif;
			
			wp_reset_postdata();
			?>
		</div>
	</div>
	<?php noizzy_edge_get_module_template_part( 'templates/parts/pagination/' . $params['pagination_type'], 'blog', '', $params ); ?>
</div>