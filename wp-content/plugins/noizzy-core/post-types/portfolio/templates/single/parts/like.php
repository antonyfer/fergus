<?php if(noizzy_edge_core_plugin_installed()) { ?>
    <div class="edge-ps-info-item edge-ps-like">
        <?php if( function_exists('noizzy_edge_get_like') ) noizzy_edge_get_like(); ?>
    </div>
<?php } ?>