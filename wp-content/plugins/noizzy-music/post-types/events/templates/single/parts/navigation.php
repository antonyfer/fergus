<?php  if ( noizzy_edge_options()->getOptionValue( 'event_pagination' ) == 'yes' ) : ?>

	<div class="edge-event-nav edge-container">
		<div class="edge-event-nav-inner edge-grid">
			<?php if ( get_previous_post() !== '' ) : ?>
				<div class="edge-event-prev">
					<?php previous_post_link( '%link', sprintf( '<span class="fa fa-angle-double-left"></span>%s', esc_html__( 'Prev Event', 'noizzy-music' ) ) ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $back_to_link !== '' ) : ?>
				<div class="edge-event-back-btn">
					<a href="<?php echo esc_url($back_to_link); ?>">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( get_next_post() !== '' ) : ?>
				<div class="edge-event-next">
					<?php next_post_link( '%link', sprintf('%s<span class="fa fa-angle-double-right"></span>', esc_html__( 'Next Event', 'noizzy-music' ))); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

<?php endif; ?>