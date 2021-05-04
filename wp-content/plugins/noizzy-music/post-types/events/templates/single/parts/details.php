<?php 
$event_types   = wp_get_post_terms(get_the_ID(), 'event-type');
$event_types_names = array();
if (($date != '') || ($target_audience != '') || ($event_type != '') ||($time != '') || ($location != '') || ($website != '') || ($organized_by != '') || (is_array($event_types) && count($event_types))): ?>
<div class="edge-event-item edge-event-info edge-event-details-holder">
    <h5 class='edge-event-section-title'><?php esc_html_e('Details', 'noizzy-music'); ?></h5>
    <div class="edge-event-item edge-event-info-content edge-event-details">

        <?php if ($date != ''): ?>
   		<div class="edge-event-item edge-event-details-time">
            <span class="edge-event-detail-title"><?php esc_html_e('Date:', 'noizzy-music'); ?></span>
            <span><?php print date_i18n( 'F d, Y' , strtotime( $date ) ); ?></span>
        </div>
        <?php endif; ?>

        <?php if ($time != ''): ?>
            <div class="edge-event-item edge-event-details-time">
                <span class="edge-event-detail-title"><?php esc_html_e('Time:', 'noizzy-music'); ?></span>
                <span><?php print $time; ?></span>
            </div>
        <?php endif; ?>

        <?php if ($location != ''): ?>
            <div class="edge-event-item edge-event-details-location">
                <span class="edge-event-detail-title"><?php esc_html_e('Location:', 'noizzy-music'); ?></span><span><?php print $location; ?></span>
            </div>
        <?php endif; ?>

        <?php if ($website != ''): ?>
        <div class="edge-event-item edge-event-details-website">
            <span class="edge-event-detail-title"><?php esc_html_e('Website:', 'noizzy-music'); ?></span>
            <span class="edge-event-detail-website-link"><a href="<?php echo esc_url($website); ?>" target = '_blank'><?php echo esc_url($website); ?></a></span>
        </div>
        <?php endif; ?>
        <?php
            if(is_array($event_types) && count($event_types)) { ?>
        <div class="edge-event-item edge-event-details-event-type">
            <span class="edge-event-detail-title"><?php esc_html_e('Event Types:', 'noizzy-music'); ?></span>
            <span>
                <?php
                    foreach($event_types as $event_type) {
                        $event_types_names[] = $event_type->name;
                    }
                    echo esc_html(implode(', ', $event_types_names)); 
                ?>
            </span>
        </div>
        <?php } else { ?>
            <div class="edge-event-item edge-event-details-organized-by">
                <span class="edge-event-detail-title"><?php esc_html_e('Event Type:', 'noizzy-music'); ?></span>
                <span><?php echo esc_attr($event_type); ?></span>
            </div>
        <?php } ?>
        <?php if ($target_audience != ''): ?>
            <div class="edge-event-item edge-event-details-organized-by">
                <span class="edge-event-detail-title"><?php esc_html_e('Target Audience:', 'noizzy-music'); ?></span>
                <span><?php echo esc_attr($target_audience); ?></span>
            </div>
        <?php endif; ?>
        <?php if ($organized_by != ''): ?>
        <div class="edge-event-item edge-event-details-organized-by">
            <span class="edge-event-detail-title"><?php esc_html_e('Organised By:', 'noizzy-music'); ?></span>
            <span><?php echo esc_attr($organized_by); ?></span>
        </div>
        <?php endif; ?>
	</div>
</div>

<?php endif; ?>