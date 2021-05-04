<?php if(have_posts()): while(have_posts()) : the_post(); ?>
    <div class="edge-container">
        <div class="edge-container-inner clearfix">
            <?php if(post_password_required()) {
                echo get_the_password_form();
            } else {
                //event single html
                ?>
                <div class="<?php echo esc_attr($holder_class); ?>">
                    <div class="edge-grid-row">
                        <div class="edge-grid-col-12">
                            <?php
                                //get event title
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/title','events');
                            ?>
                        </div>
                    </div>
                    <div class="edge-grid-row">
                        <div class="edge-grid-col-4">
                            <div class="edge-event-image-buy-tickets-holder">
                                <?php
                                //get event featured image
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/image','events');

                                //get event details section
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/details', 'events', '', array('date' => $date,'time' => $time,'website' => $website,'organized_by' => $organized_by, 'location' => $location, 'event_type' => $event_type, 'target_audience' => $target_audience));

                                //get event but tickets section
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/buy_tickets','events','', array('link' => $link, 'target' => $target, 'tickets_status' => $tickets_status));
                                ?>
                            </div>
                        </div>
                        <div class="edge-grid-col-8">
                            <div class="edge-event-info-holder">
                                <?php

                                //get event map section
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/google_map', 'events', '', array('pin'=>$pin, 'location' => $location ));

                                //get event about tour section
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/about_tour', 'events');

                                //get event follow and share section
                                noizzy_music_get_cpt_single_module_template_part('templates/single/parts/follow_and_share', 'events');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            //load event comments
            noizzy_music_get_cpt_single_module_template_part('templates/single/parts/comments', 'events');
            ?>

        </div>
    </div>
    <?php

    //load event navigation
    noizzy_music_get_cpt_single_module_template_part('templates/single/parts/navigation', 'events', '', array('back_to_link' => $back_to_link));


    ?>
    <?php
endwhile;
endif;
?>