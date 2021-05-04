<button type="submit" <?php noizzy_edge_inline_style($button_styles); ?> <?php noizzy_edge_class_attribute($button_classes); ?> <?php echo noizzy_edge_get_inline_attrs($button_data); ?> <?php echo noizzy_edge_get_inline_attrs($button_custom_attrs); ?>>
    <span class="edge-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo noizzy_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>