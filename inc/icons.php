<?php
/**
 * Linien-Icons (24 x 24, Strich in der Textfarbe).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ka_icon_paths() {
	return array(
		'bubble'    => 'M4 5h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H10l-5 4v-4H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z',
		'talk'      => 'M3 5h11a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8l-3 3v-3H3zM17 9h3a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-1v3l-3-3h-5',
		'list'      => 'M9 6h11M9 12h11M9 18h11M4.5 6h.01M4.5 12h.01M4.5 18h.01',
		'clipboard' => 'M9 4h6v3H9zM7 5H6a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-1M9 14l2 2 4-4',
		'document'  => 'M7 3h7l5 5v12a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM14 3v5h5M12 18c-1.8-1.2-3-2.2-3-3.4a1.6 1.6 0 0 1 3-.7 1.6 1.6 0 0 1 3 .7c0 1.2-1.2 2.2-3 3.4z',
		'shield'    => 'M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6zM9 12l2 2 4-4',
		'heart'     => 'M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10z',
		'people'    => 'M9 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM3 20v-1a5 5 0 0 1 5-5h2a5 5 0 0 1 5 5v1M17 11a2.5 2.5 0 1 0 0-5M16.5 14.2A4.5 4.5 0 0 1 21 18.7V20',
		'hourglass' => 'M6 3h12M6 21h12M7 3c0 5 3.5 6 5 9-1.5 3-5 4-5 9M17 3c0 5-3.5 6-5 9 1.5 3 5 4 5 9',
		'wave'      => 'M3 8c2-2 4-2 6 0s4 2 6 0 4-2 6 0M3 14c2-2 4-2 6 0s4 2 6 0 4-2 6 0',
		'drop'      => 'M12 3c3.5 4.2 6 7.3 6 10.2A6 6 0 0 1 6 13.2C6 10.3 8.5 7.2 12 3z',
		'sparkle'   => 'M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8zM19 16l.8 2.2L22 19l-2.2.8L19 22l-.8-2.2L16 19l2.2-.8z',
		'layers'    => 'M4 9l8-4 8 4-8 4zM4 13l8 4 8-4M4 17l8 4 8-4',
		'syringe'   => 'M14 4l6 6M16 6L7 15l-3 1 1-3 9-9M4 20l3-3M12 8l4 4',
		'question'  => 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18zM9.6 9.2a2.6 2.6 0 1 1 3.6 2.4c-.8.4-1.2 1-1.2 1.8M12 17h.01',
		'mail'      => 'M4 6h16v12H4zM4 7l8 6 8-6',
		'cap'       => 'M2 9l10-5 10 5-10 5zM6 11.5V16c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5v-4.5',
		'plane'     => 'M3 12l18-8-7 17-3-7z',
		'microscope'=> 'M8 3h4l1 6H7zM10 9v4M6 21h12M8 17h8a4 4 0 0 0 0-8',
		'face'      => 'M11 4c-3.200.4-5 3.200-5 6.700 0 4.500 2.600 8.300 6 9.800 3.400-1.500 6-5.300 6-7.200M9 10.500c.8.600 1.600.6 2.400 0M12.600 10.500c.8.600 1.600.6 2.400 0M10.200 16.500c1.100.8 2.500.8 3.600 0M18 3l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7z',
		'person'    => 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM5 20c0-3.6 3.1-6 7-6s7 2.4 7 6',
		'whatsapp'  => 'M4.5 19.5l1.2-3.6A8 8 0 1 1 8.4 18.6zM9 8.5c0 3.5 3 6.5 6.5 6.5l1-1.6-2-1-1 .9c-1-.4-1.9-1.3-2.3-2.3l.9-1-1-2z',
		'leaf'      => 'M5 19c0-8 5-13 14-14 0 9-5 14-13 14zM5 19c3-4 6-7 10-9',
		'search'    => 'M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14zM20 20l-4-4',
		'star'      => 'M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9z',
	);
}

/** SVG-Code für ein Icon. */
function ka_icon( $name, $class = 'ico' ) {
	$p = ka_icon_paths();
	$d = isset( $p[ $name ] ) ? $p[ $name ] : $p['sparkle'];
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="' . esc_attr( $d ) . '"/></svg>';
}

/** Icon-Name passend zu einem Begriff. */
function ka_icon_for( $label ) {
	$l   = mb_strtolower( $label );
	$map = array(
		'wave'      => array( 'falte', 'mimik', 'neuromod' ),
		'drop'      => array( 'schwitz', 'zähne', 'hyperhidrose', 'bruxismus' ),
		'syringe'   => array( 'fett', 'körper', 'lipolyse', 'pölster' ),
		'layers'    => array( 'volumen', 'kontur', 'filler', 'hyaluron' ),
		'leaf'      => array( 'longevity', 'langlebig' ),
		'question'  => array( 'weiß', 'unsicher', 'frage' ),
		'sparkle'   => array( 'haut', 'peel', 'needling', 'qualität' ),
		'shield'    => array( 'professional' ),
		'heart'     => array( 'authentiz' ),
		'people'    => array( 'inklusiv' ),
	);
	foreach ( $map as $icon => $words ) {
		foreach ( $words as $w ) {
			if ( false !== mb_strpos( $l, $w ) ) { return $icon; }
		}
	}
	return 'sparkle';
}
