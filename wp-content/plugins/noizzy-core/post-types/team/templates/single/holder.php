<div class="edge-container">
	<div class="edge-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if(post_password_required()) {
				echo get_the_password_form();
			} else { ?>
				<div class="edge-team-single-holder">
					<div class="edge-grid-row">
						<div <?php echo noizzy_edge_get_content_sidebar_class(); ?>>
							<div class="edge-team-single-outer">
								<?php
								//load team info
								noizzy_core_get_cpt_single_module_template_part('templates/single/parts/info', 'team', '', $params);
								
								//load content
								noizzy_core_get_cpt_single_module_template_part('templates/single/parts/content', 'team', '', $params);
								?>
							</div>
						</div>
						<?php if($sidebar_layout !== 'no-sidebar') { ?>
							<div <?php echo noizzy_edge_get_sidebar_holder_class(); ?>>
								<?php get_sidebar(); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php endwhile;	endif; ?>
	</div>
</div>