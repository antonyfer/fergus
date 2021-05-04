<div class="edge-team-single-info-holder">
	<div class="edge-grid-row">
		<div class="edge-ts-image-holder edge-grid-col-6">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="edge-ts-details-holder edge-grid-col-6">
			<h3 itemprop="name" class="edge-name entry-title"><?php the_title(); ?></h3>
			<p class="edge-position"><?php echo esc_html($position); ?>
				<?php foreach ($social_icons as $social_icon) {
					echo wp_kses_post($social_icon);
				} ?>
			</p>
			<div class="edge-ts-bio-holder">
				<?php if(!empty($birth_date)) { ?>
					<div class="edge-ts-info-row">
						<span aria-hidden="true" class="icon_calendar edge-ts-bio-icon"></span>
						<span class="edge-ts-bio-info"><?php echo esc_html__('born on: ', 'noizzy-core').esc_html($birth_date); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($email)) { ?>
					<div class="edge-ts-info-row">
						<span aria-hidden="true" class="icon_mail_alt edge-ts-bio-icon"></span>
						<span itemprop="email" class="edge-ts-bio-info"><?php echo esc_html__('email: ', 'noizzy-core').sanitize_email(esc_html($email)); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($phone)) { ?>
					<div class="edge-ts-info-row">
						<span aria-hidden="true" class="icon_phone edge-ts-bio-icon"></span>
						<span class="edge-ts-bio-info"><?php echo esc_html__('phone: ', 'noizzy-core').esc_html($phone); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($address)) { ?>
					<div class="edge-ts-info-row">
						<span aria-hidden="true" class="icon_building_alt edge-ts-bio-icon"></span>
						<span class="edge-ts-bio-info"><?php echo esc_html__('lives in: ', 'noizzy-core').esc_html($address); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($education)) { ?>
					<div class="edge-ts-info-row">
						<span aria-hidden="true" class="icon_ribbon_alt edge-ts-bio-icon"></span>
						<span class="edge-ts-bio-info"><?php echo esc_html__('education: ', 'noizzy-core').esc_html($education); ?></span>
					</div>
				<?php } ?>
				<?php if(!empty($resume)) { ?>
					<div class="edge-ts-info-row">
						<span aria-hidden="true" class="icon_document_alt edge-ts-bio-icon"></span>
						<a href="<?php echo esc_url($resume); ?>" download target="_blank"><span class="edge-ts-bio-info"><?php echo esc_html__('Download Resume', 'noizzy-core'); ?></span></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>