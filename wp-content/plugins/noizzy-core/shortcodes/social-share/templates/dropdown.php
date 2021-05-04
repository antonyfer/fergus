<div class="edge-social-share-holder edge-dropdown">
	<a class="edge-social-share-dropdown-opener" href="javascript:void(0)">
        <span class="edge-social-share-title"><?php esc_html_e('Share this', 'noizzy-core') ?></span>
		<i class="social_share"></i>
	</a>
	<div class="edge-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				echo wp_kses($net, array(
					'li'   => array(
						'class' => true
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true
					),
					'span' => array(
						'class' => true
					)
				));
			} ?>
		</ul>
	</div>
</div>