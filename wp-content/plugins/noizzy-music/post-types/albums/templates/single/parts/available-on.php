<?php
$stores = get_post_meta(get_the_ID(), 'edge_stores_repeater', true);
$i = 0;
?>
<?php if(is_array($stores) && count($stores) > 0): ?>
	<div class="edge-single-album-stores-holder">
		<h5 class="edge-single-album-stores-title"><?php esc_html_e('Available on:', 'noizzy-music'); ?></h5>
		<div class="edge-single-album-stores clearfix">
			<?php
			foreach($stores as $store) : ?>
				<span class="edge-single-album-store">
					<?php if(isset($store['edge_store_link']) && $store['edge_store_link']) : ?>
						<a class="edge-single-album-store-link" href="<?php echo esc_url($store['edge_store_link']); ?>" target = "_blank">
							<?php echo noizzy_music_single_stores_names_and_images($store['edge_store_name'], 'name'); ?>
						</a>
					<?php else: ?>
						<?php echo noizzy_music_single_stores_names_and_images($store['edge_store_name'], 'name'); ?>
					<?php endif; ?>
				</span>
				<?php
				$i++;
			endforeach;
			?>
		</div>
	</div>
<?php endif; ?>