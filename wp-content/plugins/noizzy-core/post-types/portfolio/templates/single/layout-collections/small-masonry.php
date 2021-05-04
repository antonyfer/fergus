<?php
$masonry_classes = '';
$number_of_columns = noizzy_edge_get_meta_field_intersect('portfolio_single_masonry_columns_number');
if(!empty($number_of_columns)) {
	$masonry_classes .= ' edge-ps-'.$number_of_columns.'-columns';
}
$space_between_items = noizzy_edge_get_meta_field_intersect('portfolio_single_masonry_space_between_items');
if(!empty($space_between_items)) {
	$masonry_classes .= ' edge-'.$space_between_items.'-space';
}
?>
<div class="edge-grid-row">
    <div class="edge-grid-col-12">
        <?php
        //get portfolio title
        noizzy_core_get_cpt_single_module_template_part('templates/single/parts/title', 'portfolio', $item_layout);
        ?>
    </div>

	<div class="edge-grid-col-8">
		<div class="edge-ps-image-holder edge-ps-masonry-images <?php echo esc_attr($masonry_classes); ?>">
			<div class="edge-ps-image-inner edge-outer-space">
				<div class="edge-ps-grid-sizer"></div>
				<div class="edge-ps-grid-gutter"></div>
				<?php
				$media = noizzy_core_get_portfolio_single_media();
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="edge-ps-image edge-item-space <?php echo esc_attr($single_media['holder_classes']); ?>">
							<?php noizzy_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="edge-grid-col-4">
		<div class="edge-ps-info-holder edge-ps-info-sticky-holder">
			<?php
			//get portfolio content section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
			
			//get portfolio custom fields section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			
			//get portfolio share section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>