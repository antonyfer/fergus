<?php if (get_the_content() != ''): ?>
<div class="edge-event-item edge-event-info edge-event-content-holder">
    <h5 class='edge-event-section-title'><?php esc_html_e('About Tour', 'noizzy-music'); ?></h5>
    <div class="edge-event-item edge-event-info-content edge-event-single-content">
   		<?php the_content(); ?>
	</div>
</div>
<?php endif; ?>