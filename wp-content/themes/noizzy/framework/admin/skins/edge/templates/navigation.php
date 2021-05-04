<div class="edge-tabs-navigation-wrapper">
    <ul class="nav nav-tabs">
        <?php
        foreach (noizzy_edge_options()->adminPages as $key => $page ) {
            $slug = "";
            if (!empty($page->slug)) $slug = "_tab".$page->slug;
            ?>
            <li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>>
                <a href="<?php echo esc_url(get_admin_url().'admin.php?page='.EDGE_OPTIONS_SLUG.$slug); ?>">
                    <?php if($page->icon !== '') { ?>
                        <i class="<?php echo esc_attr($page->icon); ?> edge-tooltip edge-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i>
                    <?php } ?>
                    <span><?php echo esc_html($page->title); ?></span>
                </a>
            </li>
        <?php
        }
        ?>
        <?php if (noizzy_edge_core_plugin_installed()) { ?>
			<li <?php if($is_backup_options_page) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page='.EDGE_OPTIONS_SLUG.'_backup_options'); ?>"><i class="fa fa-database edge-tooltip edge-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_attr_e('Backup Options','noizzy'); ?>"></i><span><?php esc_html_e('Backup Options','noizzy'); ?></span></a></li>
			<li <?php if($is_import_page) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page='.EDGE_OPTIONS_SLUG.'_tabimport'); ?>"><i class="fa fa-download edge-tooltip edge-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_attr_e('Import','noizzy'); ?>"></i><span><?php esc_html_e('Import','noizzy'); ?></span></a></li>
        <?php } ?>
    </ul>
</div>