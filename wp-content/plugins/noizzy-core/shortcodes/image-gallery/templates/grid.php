<?php
$i    = 0;
$rand = rand(0,1000);
?>
<div class="edge-image-gallery <?php echo esc_attr($holder_classes); ?>">
	<div class="edge-ig-inner edge-outer-space <?php echo esc_attr($inner_classes); ?>">
		<?php foreach ($images as $image) { ?>
			<div class="edge-ig-image edge-item-space">
				<div class="edge-ig-image-inner">
					<?php if ($image_behavior === 'lightbox') { ?>
						<a itemprop="image" class="edge-ig-lightbox" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
					<?php } else if ($image_behavior === 'custom-link' && !empty($custom_links)) { ?>
						<a itemprop="url" class="edge-ig-custom-link" href="<?php echo esc_url($custom_links[$i++]); ?>" target="<?php echo esc_attr($custom_link_target); ?>" title="<?php echo esc_attr($image['title']); ?>">
					<?php } ?>
						<?php if(is_array($image_size) && count($image_size)) :
							echo noizzy_edge_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
						else:
							echo wp_get_attachment_image($image['image_id'], $image_size);
						endif; ?>
					<?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>