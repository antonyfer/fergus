<?php  if ( noizzy_edge_options()->getOptionValue( 'album_pagination' ) == 'yes' ) : ?>
<div class="edge-album-nav edge-container">
	<div class="edge-album-nav-inner edge-grid">
		<?php if ( get_previous_post() !== '' ) : ?>
			<div class="edge-album-prev">
				<?php previous_post_link( '%link', sprintf( '<span class="fa fa-angle-double-left"></span>%s', esc_html__( 'Prev Post', 'noizzy-music' ) ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $back_to_link !== '' ) : ?>
			<div class="edge-album-back-btn">
				<a href="<?php echo esc_url($back_to_link); ?>">
					<span></span>
                    <span></span>
                    <span></span>
                    <span></span>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( get_next_post() !== '' ) : ?>
			<div class="edge-album-next">
				<?php next_post_link( '%link', sprintf('%s<span class="fa fa-angle-double-right"></span>', esc_html__( 'Next Post', 'noizzy-music' ))); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>