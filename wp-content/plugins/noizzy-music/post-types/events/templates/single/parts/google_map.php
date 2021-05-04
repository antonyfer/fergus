<?php
    $args = array(
		'address1' => $location,
    	'pin' => $pin,
    	'map_height' => '387',
        'zoom'  => '16',
        'snazzy_map_style' => 'yes',
        'custom_map_style' => 'no',
        'location_map' => 'yes',
        'snazzy_map_code' => ''
    );

    $args['snazzy_map_code'] = '`{`
{
``featureType``: ``all``,
``elementType``: ``labels``,
``stylers``: `{`
{
``visibility``: ``on``
}
`}`
},
{
``featureType``: ``all``,
``elementType``: ``labels.text.fill``,
``stylers``: `{`
{
``saturation``: 36
},
{
``color``: ``#000000``
},
{
``lightness``: 40
}
`}`
},
{
``featureType``: ``all``,
``elementType``: ``labels.text.stroke``,
``stylers``: `{`
{
``visibility``: ``on``
},
{
``color``: ``#000000``
},
{
``lightness``: 16
}
`}`
},
{
``featureType``: ``all``,
``elementType``: ``labels.icon``,
``stylers``: `{`
{
``visibility``: ``off``
}
`}`
},
{
``featureType``: ``administrative``,
``elementType``: ``geometry.fill``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 20
}
`}`
},
{
``featureType``: ``administrative``,
``elementType``: ``geometry.stroke``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 17
},
{
``weight``: 1.2
}
`}`
},
{
``featureType``: ``administrative.country``,
``elementType``: ``labels.text.fill``,
``stylers``: `{`
{
``color``: ``#e5c163``
}
`}`
},
{
``featureType``: ``administrative.locality``,
``elementType``: ``labels.text.fill``,
``stylers``: `{`
{
``color``: ``#c4c4c4``
}
`}`
},
{
``featureType``: ``administrative.neighborhood``,
``elementType``: ``labels.text.fill``,
``stylers``: `{`
{
``color``: ``#e5c163``
}
`}`
},
{
``featureType``: ``landscape``,
``elementType``: ``geometry``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 20
}
`}`
},
{
``featureType``: ``poi``,
``elementType``: ``geometry``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 21
},
{
``visibility``: ``on``
}
`}`
},
{
``featureType``: ``poi.business``,
``elementType``: ``geometry``,
``stylers``: `{`
{
``visibility``: ``on``
}
`}`
},
{
``featureType``: ``road.highway``,
``elementType``: ``geometry.fill``,
``stylers``: `{`
{
``color``: ``#e5c163``
},
{
``lightness``: ``0``
}
`}`
},
{
``featureType``: ``road.highway``,
``elementType``: ``geometry.stroke``,
``stylers``: `{`
{
``visibility``: ``off``
}
`}`
},
{
``featureType``: ``road.highway``,
``elementType``: ``labels.text.fill``,
``stylers``: `{`
{
``color``: ``#ffffff``
}
`}`
},
{
``featureType``: ``road.highway``,
``elementType``: ``labels.text.stroke``,
``stylers``: `{`
{
``color``: ``#e5c163``
}
`}`
},
{
``featureType``: ``road.arterial``,
``elementType``: ``geometry``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 18
}
`}`
},
{
``featureType``: ``road.arterial``,
``elementType``: ``geometry.fill``,
``stylers``: `{`
{
``color``: ``#575757``
}
`}`
},
{
``featureType``: ``road.arterial``,
``elementType``: ``labels.text.fill``,
``stylers``: `{`
{
``color``: ``#ffffff``
}
`}`
},
{
``featureType``: ``road.arterial``,
``elementType``: ``labels.text.stroke``,
``stylers``: `{`
{
``color``: ``#2c2c2c``
}
`}`
},
{
``featureType``: ``road.local``,
``elementType``: ``geometry``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 16
}
`}`
},
{
``featureType``: ``road.local``,
``elementType``: ``labels.text.fill``,
``stylers``: `{`
{
``color``: ``#999999``
}
`}`
},
{
``featureType``: ``transit``,
``elementType``: ``geometry``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 19
}
`}`
},
{
``featureType``: ``water``,
``elementType``: ``geometry``,
``stylers``: `{`
{
``color``: ``#000000``
},
{
``lightness``: 17
}
`}`
}
`}`';

    if ($location != ''):
?>
<div class="edge-event-item edge-event-info edge-event-map-holder">
    <div class="edge-event-item edge-event-info-content edge-event-map">
    	<?php
		$google_map_html = noizzy_edge_execute_shortcode('edge_google_map', $args);
		$google_map_html = str_replace("\n", '', $google_map_html);

		print $google_map_html;
		?>
    </div>
</div>

<?php endif; ?>
