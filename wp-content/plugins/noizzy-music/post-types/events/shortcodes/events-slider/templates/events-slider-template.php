<div class="edge-event-content edge-events<?php echo esc_attr(get_the_ID()) ?>">
    <a href="<?php echo esc_url(get_permalink(get_the_ID())) ?>" target="_blank">
        <?php the_post_thumbnail(get_the_ID()); ?>
        <div class="edge-event-details">
            <div class="edge-event-content-item edge-event-date-holder">
                <?php if (!empty($date)) { ?>
                    <div class="edge-event-date-day-holder">
                        <?php print date('d', strtotime($date)) ?>
                    </div>
                <?php } ?>
                <div class="edge-event-content-item edge-event-weekday-month-holder">
                    <?php if (!empty($date)) { ?>
                        <div class="edge-event-weekday-holder">
                            <?php echo date('D', strtotime($date)); ?>
                        </div>
                        <div class="edge-event-month-holder">
                            <?php echo date('M', strtotime($date)); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="edge-event-content-item edge-event-title-holder">
                <h5 class="edge-event-title">
                    <?php echo esc_attr($title); ?>
                </h5>
            </div>
        </div>
    </a>
</div>