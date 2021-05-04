<div class="edge-album-disc <?php echo esc_attr($holder_classes); ?>">
	<?php if ($link !== '')  { ?>
		<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target) ?>"></a>
	<?php } ?>
	<div class="edge-album-disc-inner">
		<div class="edge-album-disc-case-holder">
			<img class="edge-album-disc-case" src="<?php echo wp_get_attachment_url($cd_case_image) ?>" alt="<?php echo get_the_title($cd_case_image);?>" />
		</div>
		<div class="edge-album-disc-element">
			<div class="edge-album-disc-image-holder">
				<div class="edge-album-disc-image" style="background-image:url(<?php echo wp_get_attachment_url($cd_image); ?>)"></div>
			</div>			
		</div>
	</div>
</div>