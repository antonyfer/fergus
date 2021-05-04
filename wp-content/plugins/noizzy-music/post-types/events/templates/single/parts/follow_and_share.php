<?php if(noizzy_edge_options()->getOptionValue('enable_social_share') == 'yes'
        && noizzy_edge_options()->getOptionValue('enable_social_share_on_event') == 'yes') : ?>
<div class="edge-event-item edge-event-info edge-event-follow-share-holder">
    <div class="edge-event-follow-share-label"><?php esc_html_e('Share Via', 'noizzy-music'); ?></div>
    <div class="edge-event-item edge-event-info-content edge-event-follow-share">
     	<?php echo noizzy_edge_get_social_share_html() ?>
    </div>
</div>
<?php endif; ?>


