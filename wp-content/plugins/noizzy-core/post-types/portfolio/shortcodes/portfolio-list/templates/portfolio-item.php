<article class="edge-pl-item edge-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
	<div class="edge-pl-item-inner" <?php  noizzy_edge_inline_style($this_object->getArticleHolderStyles( $params )); ?>>
		<?php echo noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>

		<a itemprop="url" class="edge-pli-link edge-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>"></a>
	</div>
</article>