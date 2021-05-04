<div class="edge-team-list-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edge-tl-inner edge-outer-space <?php echo esc_attr($inner_classes); ?>" <?php echo noizzy_edge_get_inline_attrs($data_attrs); ?>>
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					$params['member_id'] = get_the_ID();
					echo noizzy_edge_execute_shortcode('edge_team_member', $params);
				endwhile;
			else:
				esc_html_e( 'Sorry, no posts matched your criteria.', 'noizzy-core' );
			endif;
		
			wp_reset_postdata();
		?>
	</div>
</div>