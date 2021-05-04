<?php
$gallery_classes = '';
$number_of_columns = noizzy_edge_get_meta_field_intersect('portfolio_single_gallery_columns_number');
if(!empty($number_of_columns)) {
	$gallery_classes .= ' edge-ps-'.$number_of_columns.'-columns';
}
$space_between_items = noizzy_edge_get_meta_field_intersect('portfolio_single_gallery_space_between_items');
if(!empty($space_between_items)) {
	$gallery_classes .= ' edge-'.$space_between_items.'-space';
}
?>
<div class="edge-grid-row">
    <div class="edge-grid-col-12">
        <?php
        //get portfolio title
        noizzy_core_get_cpt_single_module_template_part('templates/single/parts/title', 'portfolio', $item_layout);
        ?>
    </div>
</div>
<div class="edge-ps-image-holder edge-ps-gallery-images edge-disable-bottom-space <?php echo esc_attr($gallery_classes); ?>">
	<div class="edge-ps-image-inner edge-outer-space">
		<?php
		$media = noizzy_core_get_portfolio_single_media();
		
		if(is_array($media) && count($media)) : ?>
			<?php foreach($media as $single_media) : ?>
				<div class="edge-ps-image edge-item-space">
					<?php noizzy_core_get_portfolio_single_media_html($single_media); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<div class="edge-grid-row">
        <div class="edge-grid-col-8">
            <div class="edge-ps-info-holder">
            <?php noizzy_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);

            //get portfolio share section
            noizzy_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
            ?>
            </div>
        </div>
	<div class="edge-grid-col-4">
		<div class="edge-ps-info-holder right">
			<?php
			//get portfolio custom fields section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			noizzy_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>