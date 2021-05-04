<div class="edge-portfolio-category-list-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="edge-pcl-inner edge-outer-space clearfix">
		<?php
			if ( ! empty( $query_results ) ) {
				foreach ( $query_results as $query ) {
					$termID            = $query->term_id;
					$params['image']   = get_term_meta( $termID, 'edge_portfolio_category_image_meta', true );
					$params['title']   = $query->name;
					$params['excerpt'] = $query->description;
					?>
					<article class="edge-pcl-item edge-item-space">
						<div class="edge-pcl-item-inner">
							<?php echo noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/image', '', $params ); ?>
							<div class="edge-pcli-text-holder">
								<div class="edge-pcli-text-wrapper">
									<div class="edge-pcli-text">
										<?php echo noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/title', '', $params ); ?>
										<?php echo noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/excerpt', '', $params ); ?>
									</div>
								</div>
							</div>
							<a itemprop="url" class="edge-pcli-link" href="<?php echo get_term_link( $termID ); ?>"></a>
						</div>
					</article>
				<?php }
			} else {
				echo noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/posts-not-found', '', $params );
			}
		?>
	</div>
</div>