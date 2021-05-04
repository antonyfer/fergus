<?php
//get portfolio title
noizzy_core_get_cpt_single_module_template_part('templates/single/parts/title', 'portfolio', $item_layout);
?>
<div class="edge-ps-image-holder">
    <div class="edge-ps-image-inner edge-owl-slider">
        <?php
        $media = noizzy_core_get_portfolio_single_media();

        if(is_array($media) && count($media)) : ?>
            <?php foreach($media as $single_media) : ?>
                <div class="edge-ps-image">
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