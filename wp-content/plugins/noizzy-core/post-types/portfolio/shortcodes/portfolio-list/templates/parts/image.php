<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="edge-pli-image">
	<?php if ( has_post_thumbnail() ) {
		$image_src = get_the_post_thumbnail_url( get_the_ID() );
		
		if ( strpos( $image_src, '.gif' ) !== false ) {
			echo get_the_post_thumbnail( get_the_ID(), 'full' );
		} else {
			echo get_the_post_thumbnail( get_the_ID(), $thumb_size );
		}
	} else { ?>
		<img itemprop="image" class="edge-pl-original-image" width="800" height="600" src="<?php echo NOIZZY_CORE_CPT_URL_PATH.'/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Portfolio Featured Image', 'noizzy-core'); ?>" />
	<?php } ?>
</div>