<?php
// this option doesn't exist
$show_related_posts = noizzy_edge_options()->getOptionValue('portfolio_single_related_posts') == 'yes' ? true : false;

$post_id = get_the_ID();
$related_posts = noizzy_core_get_portfolio_single_related_posts($post_id);

$holder_classes = 'edge-pl-gallery edge-normal-space edge-pl-three-columns edge-pl-gallery-overlay edge-pl-pag-no-pagination edge-pag-below-slider';
$holder_inner_classes = 'edge-owl-slider edge-pl-is-slider';
$holder_data = 'data-type=gallery data-number-of-columns=3 data-space-between-items=normal data-number-of-items=9 data-image-proportions=full data-enable-fixed-proportions=no data-enable-image-shadow=no data-orderby=date data-order=ASC data-item-style=gallery-overlay data-item-skin=light data-enable-title=yes data-title-tag=h4 data-enable-category=yes data-enable-count-images=yes data-enable-excerpt=no data-excerpt-length=20 data-pagination-type=no-pagination data-filter=no data-filter-order-by=name data-enable-article-animation=no data-portfolio-slider-on=yes data-enable-loop=yes data-enable-autoplay=yes data-slider-speed=5000 data-slider-speed-animation=600 data-enable-navigation=no data-enable-pagination=no data-pagination-position=below-slider data-max-num-pages=1 data-next-page=2';

?>
<?php if($show_related_posts) { ?>
<div class="edge-ps-related-posts-holder">
    <h5 class="edge-ps-related-posts-title"><?php _e('Related projects', 'noizzy-core')?></h5>
    <div class="edge-portfolio-slider-holder">
        <div class="edge-portfolio-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
            <div class="edge-pl-inner edge-outer-space <?php echo esc_attr($holder_inner_classes); ?> clearfix">
                <?php
                if($related_posts && $related_posts->have_posts()):

                    while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                        <article class="edge-pl-item edge-item-space edge-pl-item edge-item-space portfolio-item type-portfolio-item">
                            <div class="edge-pl-item-inner">
                                <div class="edge-pli-image">
                                    <?php the_post_thumbnail('noizzy_edge_square'); ?>
                                </div>
                                <div class="edge-pli-text-holder">
                                    <div class="edge-pli-text-wrapper">
                                        <div class="edge-pli-text">
                                            <h4 itemprop="name" class="edge-pli-title entry-title"> <?php the_title(); ?></h4>

                                            <?php $categories = wp_get_post_terms($post_id, 'portfolio-category'); ?>
                                            <?php if(!empty($categories)) { ?>
                                                <div class="edge-pli-category-holder">
                                                    <?php foreach ($categories as $cat) { ?>
                                                        <a itemprop="url" class="edge-pli-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>

                                <a itemprop="url" class="edge-pli-link edge-block-drag-link" href="<?php the_permalink(); ?>"></a>
                            </div>
                        </article>
                    <?php endwhile;
                endif;

                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
