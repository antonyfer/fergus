<?php
get_header();
noizzy_edge_get_title();
do_action( 'noizzy_edge_before_main_content' ); ?>
<div class="edge-container edge-default-page-template">
	<?php do_action( 'noizzy_edge_after_container_open' ); ?>
	<div class="edge-container-inner clearfix">
		<?php
			$noizzy_taxonomy_id   = get_queried_object_id();
			$noizzy_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$noizzy_taxonomy      = ! empty( $noizzy_taxonomy_id ) ? get_term_by( 'id', $noizzy_taxonomy_id, $noizzy_taxonomy_type ) : '';
			$noizzy_taxonomy_slug = ! empty( $noizzy_taxonomy ) ? $noizzy_taxonomy->slug : '';
			$noizzy_taxonomy_name = ! empty( $noizzy_taxonomy ) ? $noizzy_taxonomy->taxonomy : '';
			
			noizzy_core_get_archive_portfolio_list( $noizzy_taxonomy_slug, $noizzy_taxonomy_name );
		?>
	</div>
	<?php do_action( 'noizzy_edge_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
