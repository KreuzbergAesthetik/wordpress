<?php
/**
 * Kreuzberg Ästhetik: Theme-Funktionen
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* true = Entwurfsmodus: zeigt oben einen Hinweis und markiert offene [Stellen]. false = Live. */
if ( ! defined( 'KA_DRAFT' ) ) { define( 'KA_DRAFT', false ); }
/* Empfänger der Kontaktformular-Nachrichten */
if ( ! defined( 'KA_MAIL_TO' ) ) { define( 'KA_MAIL_TO', 'info@kreuzberg-aesthetik.de' ); }

require_once get_theme_file_path( 'inc/icons.php' );
require_once get_theme_file_path( 'inc/content.php' );
require_once get_theme_file_path( 'inc/views.php' );
require_once get_theme_file_path( 'inc/admin.php' );

add_filter( 'body_class', function ( $c ) {
	$c[] = is_front_page() ? 'home-page' : 'sub';
	return $c;
} );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'style', 'script' ) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$v = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'ka-style', get_stylesheet_uri(), array(), $v );
	wp_enqueue_script( 'ka-day-cycle', get_theme_file_uri( 'day-cycle.js' ), array(), $v, array( 'in_footer' => true, 'strategy' => 'defer' ) );
	{
		wp_enqueue_script( 'ka-script', get_theme_file_uri( 'script.js' ), array(), $v, array( 'in_footer' => true, 'strategy' => 'defer' ) );
		wp_add_inline_script( 'ka-script', 'window.KA_DATA=' . wp_json_encode( ka_js_data(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . ';', 'before' );
	}
	// Standard-Block-Styles werden nicht gebraucht.
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

/* Keine externen Emoji-Skripte */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* Beschreibung und strukturierte Daten für Suchmaschinen */
add_action( 'wp_head', function () {
	if ( ! is_front_page() ) { return; }
	$desc = wp_strip_all_tags( ka_raw( 'hero_h1' ) ) . '. ' . ka_raw( 'hero_text' );
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	$ld = array(
		'@context'  => 'https://schema.org',
		'@type'     => 'MedicalBusiness',
		'name'      => ka_raw( 'brand' ),
		'url'       => home_url( '/' ),
		'telephone' => ka_digits( ka_raw( 'phone_link' ) ),
		'email'     => ka_raw( 'email' ),
		'description' => $desc,
		'address'   => array( '@type' => 'PostalAddress', 'addressLocality' => 'Berlin', 'addressCountry' => 'DE' ),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 5 );

/* Kontaktformular */
function ka_contact_handler() {
	$back = home_url( '/' );
	if ( ! empty( $_POST['ka_back'] ) ) {
		$back = wp_validate_redirect( esc_url_raw( wp_unslash( $_POST['ka_back'] ) ), $back );
	}
	$fail = function () use ( $back ) {
		wp_safe_redirect( add_query_arg( 'ka', 'error', $back ) . '#kontakt' );
		exit;
	};
	if ( ! isset( $_POST['ka_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ka_nonce'] ) ), 'ka_contact' ) ) {
		$fail();
	}
	// Honeypot: Bots füllen das Feld aus.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'ka', 'sent', $back ) . '#kontakt' );
		exit;
	}
	$first = isset( $_POST['vorname'] ) ? sanitize_text_field( wp_unslash( $_POST['vorname'] ) ) : '';
	$last  = isset( $_POST['nachname'] ) ? sanitize_text_field( wp_unslash( $_POST['nachname'] ) ) : '';
	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$msg   = isset( $_POST['nachricht'] ) ? sanitize_textarea_field( wp_unslash( $_POST['nachricht'] ) ) : '';
	if ( '' === $first || '' === $last || ! is_email( $email ) || '' === $msg || empty( $_POST['consent'] ) ) {
		$fail();
	}
	$subject = 'Terminanfrage über die Website';
	$body    = "Name: $first $last\nE-Mail: $email\n\n$msg\n\nDie Person hat der Verarbeitung ihrer Angaben zur Beantwortung der Anfrage zugestimmt.";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $first . ' ' . $last . ' <' . $email . '>' );
	$ok = wp_mail( KA_MAIL_TO, $subject, $body, $headers );
	wp_safe_redirect( add_query_arg( 'ka', $ok ? 'sent' : 'error', $back ) . '#kontakt' );
	exit;
}
add_action( 'admin_post_nopriv_ka_contact', 'ka_contact_handler' );
add_action( 'admin_post_ka_contact', 'ka_contact_handler' );
