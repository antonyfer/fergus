<?php
    $tracks = get_post_meta(get_the_ID(), 'edge_tracks_repeater', true);
	$i = 0;
?>
<?php if(is_array($tracks) && count($tracks) > 0): ?>
<div class="edge-lyrics-holder-inner">
    <h5 class="edge-lyrics-holder-title"><?php esc_html_e('Lyrics:', 'noizzy-music'); ?></h5>
    <div class="edge-accordion-holder clearfix edge-accordion edge-initial">
<?php
foreach($tracks as $track) : ?>
    <?php
        if (($track['edge_track_lyrics'] !== '') && ($track['edge_track_title'] !== '')):
            ?>
            <p class="clearfix edge-lyrics-holder">
                <span class="edge-tab-title">
					<span class="edge-tab-title-inner">
						<?php echo esc_attr($track['edge_track_title'])?>
					</span>
				</span>
                <span class="edge-accordion-mark edge-left-mark">
                    <span class="edge-accordion-mark-icon">
                        <span class="icon icon_plus"></span>
                        <span class="icon icon_minus-06"></span>
                    </span>
                </span>
            </p>
            <div class="edge-accordion-content">
                <div class="edge-accordion-content-inner">
                    <?php echo nl2br($track['edge_track_lyrics']); ?>
                </div>
            </div>
        <?php
        endif;
    ?>
<?php $i++; endforeach; ?>
    </div>
</div>
<?php endif; ?>