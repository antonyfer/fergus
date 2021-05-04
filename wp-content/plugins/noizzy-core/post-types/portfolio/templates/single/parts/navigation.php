<?php  if ( noizzy_edge_options()->getOptionValue( 'portfolio_single_hide_pagination' ) == 'no' ) : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    ?>
    <div class="edge-portfolio-nav edge-container">
        <div class="edge-portfolio-nav-inner edge-grid">
            <?php if ( get_previous_post() !== '' ) : ?>
                <div class="edge-portfolio-prev">
                    <?php previous_post_link( '%link', sprintf( '<span class="fa fa-angle-double-left"></span>%s', esc_html__( 'Prev Post', 'noizzy-music' ) ) ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $back_to_link !== '' ) : ?>
                <div class="edge-portfolio-back-btn">
                    <a href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ( get_next_post() !== '' ) : ?>
                <div class="edge-portfolio-next">
                    <?php next_post_link( '%link', sprintf('%s<span class="fa fa-angle-double-right"></span>', esc_html__( 'Next Post', 'noizzy-music' ))); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>
