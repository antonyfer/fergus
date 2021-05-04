<?php
$media = noizzy_core_get_portfolio_single_media();
?>
<article class="edge-pl-item edge-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
	<div class="edge-pl-item-inner">
		<?php echo noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>
		
		<?php if ( is_array( $media ) && count( $media ) > 0 ) : ?>
			<?php echo noizzy_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/image-gallery', '', $params ); ?>
		<?php endif; ?>
	</div>
</article>