<?php
/**
 * Linien-Icons (24 x 24, Strich in der Textfarbe).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ka_icon_paths() {
	return array(
		'sun'       => 'M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4',
		'moon'      => 'M20 14.5A8 8 0 0 1 9.5 4 8 8 0 1 0 20 14.5z',
		'device'    => 'M4 5h16v11H4zM9 20h6M12 16v4',
		'bubble'    => 'M4 5h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H10l-5 4v-4H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z',
		'talk'      => 'M3 5h11a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8l-3 3v-3H3zM17 9h3a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-1v3l-3-3h-5',
		'list'      => 'M9 6h11M9 12h11M9 18h11M4.5 6h.01M4.5 12h.01M4.5 18h.01',
		'clipboard' => 'M9 4h6v3H9zM7 5H6a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-1M9 14l2 2 4-4',
		'document'  => 'M7 3h7l5 5v12a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM14 3v5h5M12 18c-1.8-1.2-3-2.2-3-3.4a1.6 1.6 0 0 1 3-.7 1.6 1.6 0 0 1 3 .7c0 1.2-1.2 2.2-3 3.4z',
		'shield'    => 'M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6zM9 12l2 2 4-4',
		'heart'     => 'M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10z',
		'people'    => 'M11.25 6.3a2.6 2.6 0 1 0-5.2 0 2.6 2.6 0 1 0 5.2 0zM3.3 19.8V16a5.35 5.35 0 0 1 10.7 0v3.8zM18.4 6.8a2.4 2.4 0 1 0-4.8 0 2.4 2.4 0 1 0 4.8 0zM14.1 10.6a4.9 4.9 0 0 1 6.7 4.8v4.4h-4.45V16a7.7 7.7 0 0 0-2.25-5.4z',
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
	$fillable = in_array( $name, array( 'star', 'heart', 'people', 'person', 'leaf', 'drop', 'sparkle', 'hourglass', 'bubble', 'shield' ), true ) || false !== strpos( $class, 'fillable' );
	// Gefüllte Form: saubere, geschlossene Flächen (offene Linien würden komisch ausgefüllt)
	$fill_d = array(
		'people' => 'M11.25 6.3a2.6 2.6 0 1 0-5.2 0 2.6 2.6 0 1 0 5.2 0zM3.3 19.8V16a5.35 5.35 0 0 1 10.7 0v3.8zM18.4 6.8a2.4 2.4 0 1 0-4.8 0 2.4 2.4 0 1 0 4.8 0zM14.1 10.6a4.9 4.9 0 0 1 6.7 4.8v4.4h-4.45V16a7.7 7.7 0 0 0-2.25-5.4z',
		'mail'   => 'M4 6h16v12H4z',
	);
	$cls      = esc_attr( $class ) . ( $fillable ? ' fillable' : '' );
	$inner    = '';
	if ( 'shield' === $name ) {
		// Schild mit Haken: Der Haken wird im gefüllten Teil weiß.
		$body  = 'M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6z';
		$check = 'M9 12l2 2 4-4';
		$inner = '<path d="' . $body . '"/><path class="fl" d="' . $body . '"/><path class="chk" d="' . $check . '"/><path class="chkw" d="' . $check . '"/>';
	} else {
		$fl    = $fillable ? '<path class="fl" d="' . esc_attr( isset( $fill_d[ $name ] ) ? $fill_d[ $name ] : $d ) . '"/>' : '';
		$inner = 'mail' === $name ? $fl . '<path d="' . esc_attr( $d ) . '"/>' : '<path d="' . esc_attr( $d ) . '"/>' . $fl;
	}
	return '<svg class="' . $cls . '" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $inner . '</svg>';
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

/** Ein auslaufender Pinselstrich entlang einer Kurve (Linsenform: in der Mitte kräftig, an den Enden fein). */
function ka_tp( $x0, $y0, $x1, $y1, $x2, $y2, $x3, $y3, $w ) {
	$dx = $x3 - $x0; $dy = $y3 - $y0;
	$l  = sqrt( $dx * $dx + $dy * $dy );
	if ( $l < 0.001 ) { return ''; }
	$nx = -$dy / $l * $w / 2; $ny = $dx / $l * $w / 2;
	$f  = function ( $v ) { return round( $v, 1 ); };
	return '<path d="M' . $f( $x0 ) . ' ' . $f( $y0 ) . 'C' . $f( $x1 + $nx ) . ' ' . $f( $y1 + $ny ) . ' ' . $f( $x2 + $nx ) . ' ' . $f( $y2 + $ny ) . ' ' . $f( $x3 ) . ' ' . $f( $y3 ) . 'C' . $f( $x2 - $nx ) . ' ' . $f( $y2 - $ny ) . ' ' . $f( $x1 - $nx ) . ' ' . $f( $y1 - $ny ) . ' ' . $f( $x0 ) . ' ' . $f( $y0 ) . 'Z"/>';
}

/** Vierzackiger Funke. */
function ka_spark( $x, $y, $s ) {
	return '<path d="M' . $x . ' ' . ( $y - $s ) . 'Q' . $x . ' ' . $y . ' ' . ( $x + $s ) . ' ' . $y . 'Q' . $x . ' ' . $y . ' ' . $x . ' ' . ( $y + $s ) . 'Q' . $x . ' ' . $y . ' ' . ( $x - $s ) . ' ' . $y . 'Q' . $x . ' ' . $y . ' ' . $x . ' ' . ( $y - $s ) . 'Z"/>';
}

/** Große Wasserzeichen-Motive für die Behandlungskarten: elegante Linienzeichnungen mit auslaufenden Strichen (200 x 200). */
function ka_wm_motif( $name ) {
	$d = '';
	switch ( $name ) {
		case 'face': // Gesichtsprofil, fließend, mit Funken
			$d .= ka_tp( 102, 18, 44, 10, 22, 84, 62, 122, 7 );
			$d .= ka_tp( 62, 122, 80, 138, 72, 164, 54, 190, 5 );
			$d .= ka_tp( 98, 30, 62, 34, 48, 84, 72, 112, 3 );
			$d .= ka_tp( 102, 18, 120, 30, 124, 50, 121, 66, 4.5 );
			$d .= ka_tp( 121, 66, 120, 74, 130, 86, 131, 92, 3.5 );
			$d .= ka_tp( 131, 92, 128, 98, 122, 96, 121, 100, 3 );
			$d .= ka_tp( 121, 100, 127, 102, 126, 107, 121, 108, 2.6 );
			$d .= ka_tp( 121, 108, 126, 111, 124, 116, 119, 118, 2.6 );
			$d .= ka_tp( 119, 118, 121, 126, 118, 132, 110, 136, 3.2 );
			$d .= ka_tp( 110, 136, 100, 140, 96, 148, 98, 160, 3 );
			$d .= ka_tp( 98, 160, 102, 172, 112, 180, 128, 186, 3 );
			$d .= ka_tp( 98, 62, 106, 57, 114, 58, 118, 62, 2.2 );
			$d .= ka_tp( 100, 70, 105, 73, 111, 73, 115, 70, 2 );
			$d .= ka_spark( 160, 38, 18 ) . ka_spark( 178, 72, 9 ) . ka_spark( 150, 92, 6 );
			break;
		case 'eye': // fließende Linien, die sich glätten
			for ( $i = 0; $i < 6; $i++ ) {
				$y  = 30 + $i * 28;
				$am = round( 26 * ( 1 - $i / 5 ) + 2, 1 );
				$d .= ka_tp( -4, $y, 40, $y - $am, 80, $y + $am, 100, $y, 5.5 - $i * .6 );
				$d .= ka_tp( 100, $y, 120, $y - $am, 160, $y + $am, 204, $y, 5.5 - $i * .6 );
			}
			break;
		case 'body': // Körperlinie, fließend
			$d .= ka_tp( 100, 8, 82, 8, 82, 38, 100, 38, 4 ) . ka_tp( 100, 8, 118, 8, 118, 38, 100, 38, 4 );
			$d .= ka_tp( 74, 56, 58, 80, 94, 96, 76, 120, 6 );
			$d .= ka_tp( 76, 120, 54, 154, 80, 174, 90, 198, 6 );
			$d .= ka_tp( 128, 56, 144, 80, 108, 96, 126, 120, 6 );
			$d .= ka_tp( 126, 120, 150, 154, 122, 176, 112, 198, 6 );
			$d .= ka_tp( 74, 56, 82, 48, 92, 46, 100, 48, 3 ) . ka_tp( 128, 56, 120, 48, 110, 46, 100, 48, 3 );
			$d .= ka_tp( 128, 56, 158, 70, 168, 100, 186, 116, 3.5 );
			$d .= ka_tp( 74, 56, 52, 42, 40, 22, 66, 14, 3.5 );
			break;
		case 'box': // Paket mit Blatt
			$d .= ka_tp( 40, 102, 62, 106, 78, 112, 100, 124, 4 ) . ka_tp( 100, 124, 122, 112, 138, 106, 160, 102, 4 );
			$d .= ka_tp( 40, 102, 40, 128, 40, 150, 40, 168, 4 ) . ka_tp( 160, 102, 160, 128, 160, 150, 160, 168, 4 );
			$d .= ka_tp( 100, 124, 100, 150, 100, 170, 100, 192, 4 );
			$d .= ka_tp( 40, 168, 62, 176, 80, 184, 100, 192, 4 ) . ka_tp( 100, 192, 120, 184, 138, 176, 160, 168, 4 );
			$d .= ka_tp( 40, 102, 30, 90, 24, 82, 20, 76, 3.5 ) . ka_tp( 20, 76, 46, 82, 72, 92, 92, 104, 3.5 );
			$d .= ka_tp( 160, 102, 170, 90, 176, 82, 180, 76, 3.5 ) . ka_tp( 180, 76, 154, 82, 128, 92, 108, 104, 3.5 );
			$d .= ka_tp( 100, 104, 68, 74, 70, 34, 110, 18, 4.5 ) . ka_tp( 110, 18, 138, 48, 132, 86, 100, 104, 4.5 );
			$d .= ka_tp( 100, 104, 103, 78, 107, 52, 110, 24, 2.2 );
			break;
		default:
			$d .= ka_spark( 100, 100, 60 );
	}
	return '<svg viewBox="0 0 200 200" fill="currentColor" stroke="none" aria-hidden="true" focusable="false">' . $d . '</svg>';
}
