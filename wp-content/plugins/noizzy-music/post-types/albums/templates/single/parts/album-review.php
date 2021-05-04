<?php
$reviews = get_post_meta(get_the_ID(), 'edge_reviews_repeater', true);
$i = 0;
?>
<?php if(is_array($reviews) && count($reviews) > 0): ?>
    <div class="edge-single-album-reviews-holder">
        <h5 class="edge-single-album-reviews-title"><?php esc_html_e('Reviews:', 'noizzy-music'); ?></h5>
        <div class="edge-single-album-reviews swiper-container">
            <div class="swiper-wrapper">
                <?php
                foreach($reviews as $review) : ?>
                    <div class="edge-single-album-review swiper-slide">
                        <p class="edge-single-album-text"><?php echo "\"" . esc_html($review['edge_review_text']) . "\""; ?></p>
                        <?php if(isset($review['edge_review_author']) && $review['edge_review_author']): ?>
                            <span class="edge-single-album-author"><?php echo "- " . $review['edge_review_author']; ?></span>
                        <?php endif; ?>

                    </div>
                    <?php
                    $i++;
                endforeach;
                ?>
            </div>
            <div class="swiper-navigation">
                <span class="edge-swiper-button swiper-button-prev"><span class="fa fa-angle-double-left"></span></span>
                <div class="swiper-pagination"></div>
                <span class="edge-swiper-button swiper-button-next"><span class="fa fa-angle-double-right"></span></span>
            </div>
        </div>
    </div>
<?php endif; ?>