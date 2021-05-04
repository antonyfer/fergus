<?php  if(noizzy_edge_options()->getOptionValue( 'event_comments' ) == 'yes') : ?>
    <?php comments_template('', true); ?>
<?php endif;  ?>
