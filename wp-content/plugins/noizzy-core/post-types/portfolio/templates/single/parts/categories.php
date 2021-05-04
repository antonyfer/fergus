<?php if(noizzy_edge_options()->getOptionValue('portfolio_single_enable_categories') === 'yes') : ?>
    <?php
    $categories   = wp_get_post_terms(get_the_ID(), 'portfolio-category');
    if(is_array($categories) && count($categories)) : ?>
        <div class="edge-ps-info-item edge-ps-categories">
	        <?php noizzy_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Category:', 'noizzy-core') ) ); ?>
            <?php foreach($categories as $cat) { ?>
                <a itemprop="url" class="edge-ps-info-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
            <?php } ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
