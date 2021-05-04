<?php if(noizzy_edge_options()->getOptionValue('enable_social_share') == 'yes'
        && noizzy_edge_options()->getOptionValue('enable_social_share_on_album') == 'yes') : ?>
<div class="edge-album-follow-share-holder">
    <h5 class='edge-album-follow-share-holder-title'><?php esc_html_e('Share Via:', 'noizzy-music'); ?></h5>
    <div class="edge-album-follow-share">
     	<?php echo noizzy_edge_get_social_share_html() ?>
    </div>
</div>
<?php endif; ?>