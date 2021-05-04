<?php if(noizzy_edge_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="edge-ps-info-item edge-ps-date">
	    <?php noizzy_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Date:', 'noizzy-core') ) ); ?>
        <p itemprop="dateCreated" class="edge-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(noizzy_edge_get_page_id()); ?>"/>
    </div>
<?php endif; ?>