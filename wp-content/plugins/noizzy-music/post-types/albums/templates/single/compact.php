<?php if(have_posts()): while(have_posts()) : the_post(); ?>
		<div class="edge-container">
		    <div class="edge-container-inner clearfix">
		    	<?php if(post_password_required()) {
	                echo get_the_password_form();
	            } else {
	                //album single html
	                ?>
	            <div class="edge-album-compact edge-album-<?php echo esc_attr($album_skin); ?> " >
	                <div class="edge-grid-row">

                        <div class="edge-grid-col-12">
                            <div class="edge-album-title-holder">
                                <?php
                                    //get album title
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/title','albums');
                                ?>
                            </div>
                        </div>

						<div class="edge-grid-col-6">
							<div class="edge-album-left-holder">
								<?php
									//get album featured image
									noizzy_music_get_cpt_single_module_template_part('templates/single/parts/image','albums');

									//get album player
										noizzy_music_get_cpt_single_module_template_part('templates/single/parts/player','albums');
								?>
                                <div class="edge-about-album-holder">
                                <?php
                                    //get album playlist
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/playlist','albums', '', array('album_skin' => $album_skin));
                                ?>
                                <?php
                                    //get album available on
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/available-on','albums','', array('store_type' => $store_type));

                                    //get album share part
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/follow_and_share','albums');
                                ?>
                                </div>
							</div>
						</div>
						<div class="edge-grid-col-6">
							<div class="edge-album-right-holder">
								<div class="edge-album-tracks-holder">
                                    <?php
                                    //get about album
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/about','albums');
                                    ?>
                                </div>
                                <div class="edge-album-details-holder">
                                    <?php
                                    //get album artist
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/artist','albums');

                                    //get album genre
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/genre','albums');

                                    //get album people
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/people','albums');

                                    //get album date
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/date','albums');

                                    //get album label
                                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/label','albums');

                                    ?>
                                </div>
                                <?php
                                //get about album
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/lyrics','albums');

                                //get reviews
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/album-review','albums');
                                ?>
							</div>
						</div>
					</div>
				</div>
		        <?php } 
					//load comments
					noizzy_music_get_cpt_single_module_template_part('templates/single/parts/comments', 'albums');
				?>
                <div class="edge-latest-video-holder">
                    <?php
                    //get album latest video
                    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/latest-video','albums');
                    ?>
                </div>
	        </div>
	    </div>
	    <div class="edge-album-navigation-holder edge-compact-<?php echo esc_attr($album_skin); ?>">
			<?php
				//get navigation
				noizzy_music_get_cpt_single_module_template_part('templates/single/parts/navigation','albums','',$params);
			?>
		</div>
<?php
	endwhile;
	endif;
?>