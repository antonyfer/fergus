<?php  if(noizzy_edge_options()->getOptionValue( 'album_comments' ) == 'yes') : ?>
    <?php comments_template('', true); ?>
<?php endif;  ?>
