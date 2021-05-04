<?php
$thumb_size = $this_object->getImageSize($params);
$switch_featured_image = $this_object->getSwitchFeaturedImage($params);
?>
<div class="edge-pli-image">
	<?php if(has_post_thumbnail()) { ?>
		<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_size); ?>
	<?php } else { ?>
		<img itemprop="image" class="edge-pl-original-image" width="800" height="600" src="<?php echo NOIZZY_CORE_CPT_URL_PATH.'/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Portfolio Featured Image', 'noizzy-core'); ?>" />
	<?php } ?>

    <?php if (!empty($switch_featured_image)) {
        if ($thumb_size === 'full') { ?>
            <img itemprop="image" class="edge-pl-hover-image" src="<?php echo esc_url($switch_featured_image); ?>" alt="<?php esc_attr_e('Portfolio Hover Featured Image', 'noizzy-core'); ?>" />
        <?php } else {
            $thumb_image_size = noizzy_edge_get_image_size($thumb_size);
            echo noizzy_edge_generate_thumbnail(null, $switch_featured_image, $thumb_image_size['width'], $thumb_image_size['height']);
        }
    } ?>
</div>