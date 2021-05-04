<div class="edge-container">
    <div class="edge-container-inner clearfix">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="edge-portfolio-single-holder <?php echo esc_attr($holder_classes); ?>">
                <?php if(post_password_required()) {
                    echo get_the_password_form();
                } else {
                    do_action('noizzy_edge_portfolio_page_before_content');
                
                    noizzy_core_get_cpt_single_module_template_part('templates/single/layout-collections/'.$item_layout, 'portfolio', '', $params);
                
                    do_action('noizzy_edge_portfolio_page_after_content');

                    noizzy_core_get_cpt_single_module_template_part('templates/single/parts/navigation', 'portfolio', $item_layout);

                    noizzy_core_get_cpt_single_module_template_part('templates/single/parts/comments', 'portfolio');

					noizzy_core_get_cpt_single_module_template_part('templates/single/parts/related-posts', 'portfolio', $item_layout);
                } ?>
            </div>

        <?php endwhile; endif; ?>
    </div>
</div>

