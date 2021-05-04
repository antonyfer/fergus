<?php if ( noizzy_edge_options()->getOptionValue( 'enable_social_share' ) == 'yes' && noizzy_edge_options()->getOptionValue( 'enable_social_share_on_portfolio-item' ) == 'yes' ) : ?>
	<div class="edge-ps-info-item edge-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo noizzy_edge_get_social_share_html( array( 'type'  => 'list', 'title' => esc_attr__( 'Share Via:', 'noizzy-core' ) ) ); ?>
	</div>
<?php endif; ?>