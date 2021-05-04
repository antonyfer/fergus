<?php if(have_posts()): while(have_posts()) : the_post(); ?>
		<div class="edge-container">
		    <div class="edge-container-inner clearfix">
		    	<?php if(post_password_required()) {
	                echo get_the_password_form();
	            } else {
	                //album single html
	                ?>
	            <div class="edge-album-minimal edge-album-<?php echo esc_attr($album_skin); ?>">
	                <div class="edge-two-columns-50-50 clearfix">
						<div class="edge-two-columns-50-50-inner clearfix">
							<div class="edge-column">
								<div class="edge-column-inner">
									<?php
                                    //get album title
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/title','albums');

									//get album featured image
									noizzy_music_get_cpt_single_module_template_part('templates/single/parts/image','albums');

									//get album player
									noizzy_music_get_cpt_single_module_template_part('templates/single/parts/player','albums');

									?>
									<div class="edge-album-details-holder">
										<?php
										//get album artist
										noizzy_music_get_cpt_single_module_template_part('templates/single/parts/artist','albums');

										//get album label
										noizzy_music_get_cpt_single_module_template_part('templates/single/parts/label','albums');

										//get album date
										noizzy_music_get_cpt_single_module_template_part('templates/single/parts/date','albums');

										//get album genre
										noizzy_music_get_cpt_single_module_template_part('templates/single/parts/genre','albums');

										//get album people
										noizzy_music_get_cpt_single_module_template_part('templates/single/parts/people','albums');
										?>
									</div>

									<?php 
									//get album available on
									noizzy_music_get_cpt_single_module_template_part('templates/single/parts/available-on','albums','', array('store_type' => $store_type));
									?>

								</div>
							</div>
							<div class="edge-column">
								<div class="edge-column-inner">
									<div class="edge-album-tracks-holder ">
										<?php
                                            //get album artist
                                            noizzy_music_get_cpt_single_module_template_part('templates/single/parts/album-title','albums');
											//get album tracks
											noizzy_music_get_cpt_single_module_template_part('templates/single/parts/tracks','albums');
										?>
									</div>
									<div class="edge-about-album-holder">
										<?php
											//get about album
											noizzy_music_get_cpt_single_module_template_part('templates/single/parts/about','albums');
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	            <?php }  
					//load comments
					noizzy_music_get_cpt_single_module_template_part('templates/single/parts/comments', 'albums');
	            ?>
	        </div>
	    </div>
	    <div class="edge-album-navigation-holder">
			<?php
				//get navigation
				noizzy_music_get_cpt_single_module_template_part('templates/single/parts/navigation','albums','',$params);
			?>
		</div>
<?php
	endwhile;
	endif;
?>