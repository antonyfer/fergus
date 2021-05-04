<?php 
  if($tickets_status == 'available'){
                        
    $button_params = array( 
      'text'         => esc_html__( 'Buy Tickets','noizzy-music' ),
      'custom_class' => 'event-buy-tickets-button',
      'size'         => 'medium',
      'link'         => $link,
      'target'       => $target,
        'icon_pack'  => "font_awesome",
        'fa_icon'    => "fa-angle-double-right"
    );

    echo noizzy_edge_execute_shortcode('edge_button', $button_params);
    }
?>