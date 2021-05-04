<article class="edge-pcl-item edge-item-space">
	<div class="edge-pcl-item-inner">
		<?php echo noizzy_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/image', '', $params); ?>
		
		<div class="edge-pcli-text-holder">
			<div class="edge-pcli-text-wrapper">
				<div class="edge-pcli-text">
					<?php echo noizzy_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/title', '', $params); ?>
				</div>
			</div>
		</div>
		
		<a itemprop="url" class="edge-pcl-link" href="<?php echo get_the_permalink(); ?>"></a>
	</div>
</article>