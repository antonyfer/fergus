<?php
$tags = wp_get_post_terms(get_the_ID(), 'portfolio-tag');
$tag_names = array();

if(is_array($tags) && count($tags)) : ?>
    <div class="edge-ps-info-item edge-ps-tags">
	    <?php noizzy_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Tags:', 'noizzy-core') ) ); ?>
        <?php foreach($tags as $tag) { ?>
            <a itemprop="url" class="edge-ps-info-tag" href="<?php echo esc_url(get_term_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
        <?php } ?>
    </div>
<?php endif; ?>