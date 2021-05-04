<div class="edge-team-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edge-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="edge-team-image">
                <?php echo wp_get_attachment_image($team_image, 'full'); ?>
			</div>
		<?php } ?>
		<div class="edge-team-info">
			<?php if ($team_name !== '') { ?>
				<<?php echo esc_attr($team_name_tag); ?> class="edge-team-name" <?php echo noizzy_edge_get_inline_style($team_name_styles); ?>><?php echo esc_html($team_name); ?></<?php echo esc_attr($team_name_tag); ?>>
			<?php } ?>
			<?php if ($team_position !== "") { ?>
				<p class="edge-team-position" <?php echo noizzy_edge_get_inline_style($team_position_styles); ?>><?php echo esc_html($team_position); ?></p>
			<?php } ?>
			<?php if ($team_text !== "") { ?>
				<p class="edge-team-text" <?php echo noizzy_edge_get_inline_style($team_text_styles); ?>><?php echo esc_html($team_text); ?></p>
			<?php } ?>
			<?php if (!empty($team_social_icons)) { ?>
				<div class="edge-team-social-holder">
					<?php foreach( $team_social_icons as $team_social_icon ) { ?>
						<span class="edge-team-icon"><?php echo wp_kses_post($team_social_icon); ?></span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>