<?php
/**
 * Ansichten: Startseite und Unterseiten.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ka_url( $slug ) { return home_url( '/' . $slug . '/' ); }

/** Adresse einer bestehenden Seite (zum Beispiel Datenschutz), auch wenn die Seitenadresse leicht abweicht. */
function ka_legal_url( $slugs ) {
	foreach ( (array) $slugs as $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page ) { return get_permalink( $page ); }
	}
	return ka_url( reset( $slugs ) );
}

/** Seitenanfang: Hinweis, Grafiken, Kopfleiste. */
function ka_chrome() {
	?>
<?php if ( KA_DRAFT ) : ?><div class="draft">Entwurf. Alle Texte sind Vorschläge. Markierte [Stellen] musst Du mit Deinen Angaben ergänzen.</div><?php endif; ?>

<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
  <defs>
    <symbol id="hgs" viewBox="0 0 24 40"><path d="M3 2h18v3c0 6-6 9-6 15s6 9 6 15v3H3v-3c0-6 6-9 6-15S3 11 3 5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" fill="none"/></symbol>
  </defs>
</svg>
<div class="loader" aria-hidden="true"><span class="hgi"></span></div>
<div class="page">
<div class="tint" id="tint" aria-hidden="true"><i class="a"></i><i class="b"></i></div>

<div class="mast" id="mast">
  <nav class="mastnav" id="mastnav" aria-label="Hauptnavigation">
    <a class="pl" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Zur Startseite"><span class="slot-hg"></span></a>
    <ul class="nl nl-l">
      <li><a href="<?php echo esc_url( ka_url( 'leistungen' ) ); ?>"><?php echo ka( 'nav_services' ); ?></a></li>
      <li><a href="<?php echo esc_url( ka_url( 'ueber-mich' ) ); ?>"><?php echo ka( 'about_eyebrow' ); ?></a></li>
    </ul>
    <ul class="nl nl-r"><li><a href="<?php echo esc_url( ka_url( 'ablauf' ) ); ?>"><?php echo ka( 'abl_eyebrow' ); ?></a></li></ul>
    <button class="hb" id="hbbtn" type="button" aria-label="Menü öffnen" aria-expanded="false" aria-controls="navmenu"><span></span></button>
    <button class="logo-btn" id="logobtn" type="button" aria-label="Menü öffnen" aria-expanded="false" aria-controls="navmenu"></button>
  </nav>
  <a class="wm" id="wm" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo ka( 'brand' ); ?></a>
  <div class="wmk" id="wmk" aria-hidden="true"><span class="lg-s"></span><span class="lg-f" id="lgf"></span><span class="ls" id="lgs"></span><span class="wst" id="lgt"></span></div>
</div>
<?php
}

/** Seitenende: Fußzeile, Menü, Nachricht-Knopf. */
function ka_footer() {
	$sms  = esc_attr( ka_sms_href() );
	$mail = esc_attr( ka_mail_href() );
	?>
<footer>
  <div class="wrap">
    <span class="logo-img footer-logo" role="img" aria-label="Kreuzberg Ästhetik"></span>
    <span><?php echo ka( 'footer_text' ); ?></span>
    <span><a href="<?php echo esc_url( ka_legal_url( array( 'impressum' ) ) ); ?>">Impressum</a> · <a href="<?php echo esc_url( ka_legal_url( array( 'datenschutz', 'datenschutzerklaerung', 'datenschutzerklarung' ) ) ); ?>">Datenschutz</a></span>
  </div>
</footer>
</div>

<div class="scrim" id="scrim"></div>
<aside class="side" id="navmenu" role="dialog" aria-modal="true" aria-label="Menü" aria-hidden="true">
  <div class="side-top"><div class="wmk wmk-side" id="sidehg" aria-hidden="true"><span class="lg-s"></span><span class="lg-f"></span><span class="ls"></span><span class="wst"></span></div><button class="side-close" id="sideclose" type="button" aria-label="Menü schließen">&times;</button></div>
  <nav class="side-links" aria-label="Menü">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a>
    <a href="<?php echo esc_url( ka_url( 'leistungen' ) ); ?>"><?php echo ka( 'lei_eyebrow' ); ?></a>
    <a href="<?php echo esc_url( ka_url( 'ueber-mich' ) ); ?>"><?php echo ka( 'about_eyebrow' ); ?></a>
    <a href="<?php echo esc_url( ka_url( 'ablauf' ) ); ?>"><?php echo ka( 'abl_eyebrow' ); ?></a>
    <a href="<?php echo esc_url( ka_url( 'kontakt' ) ); ?>"><?php echo ka( 'kon_eyebrow' ); ?></a>
  </nav>
  <div class="div side-div" aria-hidden="true"><span class="hgi"></span></div>
  <div class="appearance-control">
    <label for="ka-appearance">Darstellung</label>
    <select id="ka-appearance" name="ka-appearance">
      <option value="auto">Wie auf Deinem Gerät</option>
      <option value="light">Hell</option>
      <option value="dark">Dunkel</option>
    </select>
  </div>
  <label class="calm-control"><input type="checkbox" id="ka-calm"> <span>Animationen reduzieren</span></label>
  <div class="side-contact">
    <a class="btn" href="<?php echo $sms; ?>"><?php echo ka( 'msg_label' ); ?></a>
    <a class="mail" href="<?php echo $mail; ?>"><?php echo ka( 'email' ); ?></a>
  </div>
</aside>
<a class="wa" id="wa-float" href="<?php echo $sms; ?>" aria-label="<?php echo esc_attr( ka_raw( 'msg_label' ) ); ?>"><?php echo ka_icon( 'bubble' ); ?><span class="wa-t"><?php echo ka( 'msg_label' ); ?></span></a>
<?php
}

/** Eine komplette Seite ausgeben. */
function ka_render( $view ) {
	get_header();
	ka_chrome();
	echo '<main class="view view-' . esc_attr( $view ) . '">';
	call_user_func( 'ka_view_' . $view );
	echo '</main>';
	ka_footer();
	get_footer();
}

/** Teaser-Kacheln der Startseite. */
function ka_view_home() {
	$sms  = esc_attr( ka_sms_href() );
	$mail = esc_attr( ka_mail_href() );
	$portrait = ka_raw( 'portrait_url' );
	if ( '' === $portrait ) { $portrait = get_theme_file_uri( 'assets/portrait.webp' ); }
	$about_teaser = '';
	if ( preg_match_all( '#<p\b[^>]*>(.*?)</p>#is', ka_html( 'about_main' ), $about_paragraphs ) ) {
		$plain = trim( preg_replace( '/\s+/u', ' ', wp_strip_all_tags( implode( ' ', array_slice( $about_paragraphs[1], 0, 2 ) ) ) ) );
		if ( mb_strlen( $plain ) > 240 ) {
			$cut  = mb_substr( $plain, 0, 240 );
			$pos  = max( (int) mb_strrpos( $cut, '. ' ), (int) mb_strrpos( $cut, '! ' ) );
			$plain = $pos > 90 ? mb_substr( $cut, 0, $pos + 1 ) : rtrim( $cut, " ,;" ) . ' …';
		}
		$about_teaser = '<p>' . esc_html( $plain ) . '</p>';
	}
	?>
<div class="hero-only">
  <div class="pin" id="pin"><div class="pinned">
  <div class="hero-intro">
    <span class="hg-slot" id="hgslot" aria-hidden="true"></span>
    <p class="hero-greeting"><?php echo ka( 'lead_in' ); ?></p>
    <h1 class="hero-brand" id="wmslot"><?php echo ka( 'hero_brand' ); ?></h1>
    <p class="hero-service"><?php echo ka_inline( 'hero_h1' ); ?></p>
  </div>
  <header class="hero hero-v5 glow" id="start">
    <div class="hero-copy">
      <div class="hero-head">
        <p class="hero-greeting"><?php echo ka( 'lead_in' ); ?></p>
        <h1 class="hero-brand" id="wmslot2"><?php echo ka( 'hero_brand' ); ?></h1>
        <p class="hero-service"><?php echo ka_inline( 'hero_h1' ); ?></p>
      </div>
      <figure class="hero-portrait">
        <img class="hero-photo" src="<?php echo esc_url( get_theme_file_uri( 'assets/portrait-cutout.webp' ) ); ?>" width="900" height="1229" alt="<?php echo esc_attr( ka_raw( 'portrait_alt' ) ); ?>">
      </figure>
      <div class="hero-who">
        <h2 class="hero-name"><?php echo ka( 'hero_name' ); ?></h2>
        <p class="hero-sub"><?php echo ka( 'hero_sub' ); ?></p>
      </div>
      <span class="hero-rule" aria-hidden="true"></span>
      <div class="hero-phil">
        <h3 class="hero-phil-h"><?php echo ka( 'hero_phil_h' ); ?></h3>
        <ul class="hero-vals">
          <?php $vi = array( 'star', 'heart', 'shield' ); foreach ( ka_lines( 'hero_vals' ) as $i => $hv ) : ?>
          <li><?php echo ka_icon( $vi[ $i % 3 ] ); ?><span><?php echo esc_html( $hv ); ?></span></li>
          <?php endforeach; ?>
        </ul>
        <p class="hero-text"><?php echo ka( 'hero_text' ); ?></p>
      </div>
      <p class="hero-cta hero-pills">
        <a class="btn hero-main" href="<?php echo $mail; ?>"><?php echo ka_icon( 'mail' ); ?><span>E-Mail<span class="bt-long"> schreiben</span></span></a>
        <a class="btn hero-main" href="<?php echo $sms; ?>"><?php echo ka_icon( 'whatsapp' ); ?><span>WhatsApp<span class="bt-long"> schreiben</span></span></a>
      </p>
    </div>
  </header>
  </div></div>
</div>
<?php
	$slugs = array( 'leistungen', 'ueber-mich', 'ablauf', 'kontakt' );
	$icons = array( 'syringe', 'person', 'question', 'bubble' );
	$tz    = ka_teasers();
	?>
<nav class="qk-sec" aria-label="Bereiche">
  <div class="qk">
    <?php foreach ( $tz as $i => $t ) : if ( ! isset( $slugs[ $i ] ) ) { break; } ?>
    <a class="qkc qkc-<?php echo (int) $i + 1; ?>" href="<?php echo esc_url( ka_url( $slugs[ $i ] ) ); ?>">
      <span class="qkbg" aria-hidden="true"><?php echo ka_icon( $icons[ $i ] ); ?></span>
            <span class="qkt"><?php echo esc_html( $t[0] ); ?></span>
      <span class="qkd"><?php echo esc_html( $t[1] ); ?></span>
      <span class="qkm"><?php echo ka( 'tz_btn' ); ?> <i aria-hidden="true">&rarr;</i></span>
    </a>
    <?php endforeach; ?>
  </div>
</nav>

<?php
	// Kurze Zusammenfassungen der Bereiche, in der Reihenfolge der Kacheln
	$groups = ka_groups();
	$steps  = ka_steps();
	$tl     = ka_timeline();
	$div    = '<div class="wrap divwrap" aria-hidden="true"><div class="div"><span class="hgi"></span></div></div>';
	?>
<?php echo $div; ?>
<section class="sum sum-lei" aria-labelledby="sum-lei-h">
  <div class="wrap">
    <div class="intro">
      <p class="eyebrow"><?php echo ka( 'lei_eyebrow' ); ?></p>
      <h2 id="sum-lei-h"><?php echo ka( 'lei_h2' ); ?></h2>
    </div>
    <div class="lei-two">
      <div class="lei-col">
        <span class="lei-ico"><?php echo ka_icon( 'document' ); ?></span>
        <h3>Behandlungsübersicht</h3>
        <p><?php echo ka( 'home_lei_intro' ); ?></p>
        <a class="btn deep" href="<?php echo esc_url( ka_url( 'leistungen' ) ); ?>">Zur Behandlungsübersicht <span aria-hidden="true">&rarr;</span></a>
      </div>
      <div class="lei-col">
        <span class="lei-ico"><?php echo ka_icon( 'bubble' ); ?></span>
        <h3>Unsicher?</h3>
        <p>Lass Dich im interaktiven Chat beraten: ein paar Antworten antippen und Du siehst, was zu Dir passen könnte.</p>
        <a class="btn deep" href="<?php echo esc_url( ka_url( 'leistungen' ) . '#chat-hilfe' ); ?>">Zum Chat <span aria-hidden="true">&rarr;</span></a>
      </div>
    </div>
  </div>
</section>

<?php echo $div; ?>
<section class="sum sum-about" aria-labelledby="sum-about-h">
  <div class="wrap">
    <div class="intro">
      <p class="eyebrow"><?php echo ka( 'about_eyebrow' ); ?></p>
      <h2 id="sum-about-h"><?php echo ka( 'home_tl_h' ); ?></h2>
    </div>
  </div>
  <?php if ( $tl ) : $ti = array( 'cap', 'plane', 'microscope', 'face', 'hourglass' ); ?>
  <div class="wrap tl-wrap">
    <ol class="tl" id="tl" style="--n:<?php echo (int) count( $tl ); ?>">
      <?php foreach ( $tl as $i => $e ) : ?>
      <li><span class="node"><?php echo ( $i === count( $tl ) - 1 ) ? '<span class="logo-w"></span>' : ka_icon( $ti[ $i % count( $ti ) ] ); ?></span><b><?php echo esc_html( $e[0] ); ?></b><span><?php echo esc_html( $e[1] ); ?></span></li>
      <?php endforeach; ?>
    </ol>
  </div>
  <?php endif; ?>
  <div class="wrap"><p class="sum-more"><a class="btn deep" href="<?php echo esc_url( ka_url( 'ueber-mich' ) ); ?>">Mehr über mich <span aria-hidden="true">&rarr;</span></a></p></div>
</section>

<?php echo $div; ?>
<section class="sum sum-abl" aria-labelledby="sum-abl-h">
  <div class="wrap">
    <div class="intro">
      <p class="eyebrow"><?php echo ka( 'abl_eyebrow' ); ?></p>
      <h2 id="sum-abl-h"><?php echo ka( 'abl_h2' ); ?></h2>
    </div>
    <ol class="steps">
      <?php $si = array( 'bubble', 'talk', 'clipboard', 'document' ); foreach ( $steps as $i => $s ) : ?>
      <li><span class="sico"><?php echo ka_icon( $si[ $i % count( $si ) ] ); ?></span><h3><?php echo esc_html( $s[0] ); ?></h3><p><?php echo esc_html( $s[1] ); ?></p></li>
      <?php endforeach; ?>
    </ol>
    <p class="sum-more"><a class="btn deep" href="<?php echo esc_url( ka_url( 'ablauf' ) ); ?>">Ablauf und häufige Fragen <span aria-hidden="true">&rarr;</span></a></p>
  </div>
</section>

<?php echo $div; ?>
<section class="sum sum-kon" aria-labelledby="sum-kon-h">
  <div class="wrap">
    <div class="intro">
      <p class="eyebrow"><?php echo ka( 'kon_eyebrow' ); ?></p>
      <h2 id="sum-kon-h"><?php echo ka( 'kon_h2' ); ?></h2>
      <p><?php echo esc_html( trim( preg_replace( '/\s*Schreibe? mir einfach!?\s*/u', ' ', ka_raw( 'say_text' ) ) ) ); ?></p>
    </div>
    <p class="sum-more sum-contact">
      <a class="btn deep" href="<?php echo $mail; ?>"><?php echo ka_icon( 'mail' ); ?>E-Mail</a>
      <a class="btn deep" href="<?php echo $sms; ?>"><?php echo ka_icon( 'whatsapp' ); ?>WhatsApp</a>
      <a class="btn deep" href="<?php echo esc_url( ka_url( 'kontakt' ) ); ?>"><?php echo ka_icon( 'document' ); ?>Formular</a>
    </p>
  </div>
</section>
<?php
}

function ka_view_about() {
	$portrait = ka_raw( 'portrait_url' );
	if ( '' === $portrait ) { $portrait = get_theme_file_uri( 'assets/portrait.webp' ); }
	?>
<section id="ueber-mich" class="sub-sec">
  <div class="wrap about">
    <div class="pframe"><img class="portrait" src="<?php echo esc_url( $portrait ); ?>" width="900" height="1229" alt="<?php echo esc_attr( ka_raw( 'portrait_alt' ) ); ?>"></div>
    <div>
      <p class="eyebrow"><?php echo ka( 'about_eyebrow' ); ?></p>
      <h2><?php echo ka( 'about_h2' ); ?></h2>
      <?php echo ka_html( 'about_main' ); ?>
      <h3 class="about-h"><?php echo ka( 'about_values_h' ); ?></h3>
      <p><?php echo ka( 'about_values_intro' ); ?></p>
      <div class="values">
      <?php foreach ( ka_lines( 'about_values' ) as $v ) :
		$p = array_map( 'trim', explode( '|', $v, 2 ) );
		if ( isset( $p[1] ) && '' !== $p[1] ) : ?>
        <details class="val"><summary><?php echo ka_icon( ka_icon_for( $p[0] ) ); ?><span><?php echo esc_html( $p[0] ); ?></span></summary><p><?php echo ka_mark( esc_html( $p[1] ) ); ?></p></details>
      <?php else : ?>
        <div class="val plain"><?php echo ka_icon( ka_icon_for( $p[0] ) ); ?><span><?php echo esc_html( $p[0] ); ?></span></div>
      <?php endif; endforeach; ?>
      </div>
      <?php echo ka_html( 'about_after' ); ?>
    </div>
  </div>
</section>

<div class="wrap divwrap" aria-hidden="true"><div class="div"><span class="hgi"></span></div></div>
<?php $tl = ka_timeline(); if ( $tl ) : $ti = array( 'cap', 'plane', 'microscope', 'face', 'hourglass' ); ?>
<div class="wrap tl-wrap">
  <h3 class="tl-h"><?php echo ka( 'tl_h' ); ?></h3>
  <ol class="tl" id="tl" style="--n:<?php echo (int) count( $tl ); ?>">
    <?php foreach ( $tl as $i => $e ) : ?>
    <li><span class="node"><?php echo ( $i === count( $tl ) - 1 ) ? '<span class="logo-w"></span>' : ka_icon( $ti[ $i % count( $ti ) ] ); ?></span><b><?php echo esc_html( $e[0] ); ?></b><span><?php echo esc_html( $e[1] ); ?></span></li>
    <?php endforeach; ?>
  </ol>
</div>
<?php endif; ?>

<?php
}

function ka_view_services() {
	?>
<section id="leistungen" class="sub-sec">
  <div class="wrap">
    <div class="intro">
      <p class="eyebrow"><?php echo ka( 'lei_eyebrow' ); ?></p>
      <h2><?php echo ka( 'lei_h2' ); ?></h2>
      <p><?php echo ka( 'lei_intro' ); ?></p>
    </div>
    <details class="all" open>
      <summary><?php echo ka( 'all_summary' ); ?></summary>
      <p class="note note-top"><?php echo ka( 'lei_note' ); ?></p>
      <div class="search" id="suche">
        <button class="search-toggle" type="button" aria-label="Behandlung suchen" aria-expanded="false" aria-controls="preissuche"><?php echo ka_icon( 'search' ); ?></button>
        <label for="preissuche" class="screen-reader-text">Behandlung suchen</label>
        <input id="preissuche" type="search" placeholder="Behandlung suchen, z. B. Peeling oder Filler" autocomplete="off">
      </div>
      <p id="nohit" role="status" hidden>Dazu finde ich nichts in der Liste. Schreibe mir gern, ich helfe Dir weiter.</p>
      <div class="groups">
      <?php foreach ( ka_groups() as $g ) : ?>
        <article class="grp<?php echo $g['deep'] ? ' deep glow' : ''; ?><?php echo $g['wide'] ? ' wide' : ''; ?>">
          <span class="tag"><?php echo esc_html( $g['tag'] ); ?></span>
          <h3><?php echo esc_html( $g['title'] ); ?></h3>
          <?php if ( $g['desc'] ) : ?><p class="about-g"><?php echo ka_mark( esc_html( implode( ' ', $g['desc'] ) ) ); ?></p><?php endif; ?>
          <?php if ( $g['rows'] ) : ?>
          <table><tbody>
            <?php foreach ( $g['rows'] as $r ) : ?>
            <?php if ( ! empty( $r[3] ) ) : ?><tr class="sub"><th colspan="2" scope="rowgroup"><?php echo esc_html( $r[3] ); ?></th></tr><?php continue; endif; ?>
            <tr><td><?php echo ka_row_label( $r[0] ); ?></td><td class="pr"><?php echo $r[2] ? '<s>' . esc_html( $r[2] ) . '</s>' : ''; ?><?php echo esc_html( $r[1] ); ?></td></tr>
            <?php endforeach; ?>
          </tbody></table>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
      </div>
    </details>
    <div class="wrap divwrap" aria-hidden="true"><div class="div"><span class="hgi"></span></div></div>
    <div class="chat-help" id="chat-hilfe">
      <h3 class="chat-h"><?php echo ka( 'chat_h' ); ?></h3>
      <div class="chat" id="chat" role="log" aria-live="polite" aria-relevant="additions"></div>
    </div>
  </div>
</section>

<?php
}

function ka_view_process() {
	?>
<section id="ablauf" class="sub-sec">
  <div class="wrap">
    <div class="intro">
      <p class="eyebrow"><?php echo ka( 'abl_eyebrow' ); ?></p>
      <h2><?php echo ka( 'abl_h2' ); ?></h2>
    </div>
    <ol class="steps">
      <?php $si = array( 'bubble', 'talk', 'clipboard', 'document' ); foreach ( ka_steps() as $i => $s ) : ?>
      <li><span class="sico"><?php echo ka_icon( $si[ $i % count( $si ) ] ); ?></span><h3><?php echo esc_html( $s[0] ); ?></h3><p><?php echo esc_html( $s[1] ); ?></p></li>
      <?php endforeach; ?>
    </ol>
    <div class="check">
      <h3><?php echo ka( 'check_h3' ); ?></h3>
      <p><?php echo ka( 'check_intro' ); ?></p>
      <ul>
        <?php foreach ( ka_lines( 'check_items' ) as $i => $c ) : ?>
        <li><label for="c<?php echo (int) $i + 1; ?>"><input id="c<?php echo (int) $i + 1; ?>" type="checkbox"><span><?php echo esc_html( $c ); ?></span></label></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<div class="wrap divwrap" aria-hidden="true"><div class="div"><span class="hgi"></span></div></div>
<?php
	ka_view_faq();
}

function ka_view_faq() {
	?>
<section id="fragen" class="sub-sec">
  <div class="wrap">
    <div class="intro">
      <p class="eyebrow"><?php echo ka( 'faq_eyebrow' ); ?></p>
      <h2><?php echo ka( 'faq_h2' ); ?></h2>
    </div>
    <div class="faq">
      <?php foreach ( ka_faq() as $i => $qa ) : ?>
      <details<?php echo 0 === $i ? ' open' : ''; ?>><summary><?php echo esc_html( $qa[0] ); ?></summary><p><?php echo ka_mark( esc_html( $qa[1] ) ); ?></p></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
}

function ka_view_contact() {
	$sms = esc_attr( ka_sms_href() );
	$ka  = isset( $_GET['ka'] ) ? sanitize_key( wp_unslash( $_GET['ka'] ) ) : '';
	?>
<section id="kontakt" class="sub-sec">
  <div class="wrap contact">
    <div class="txt">
      <p class="eyebrow"><?php echo ka( 'kon_eyebrow' ); ?></p>
      <h2><?php echo ka( 'kon_h2' ); ?></h2>
      <p><?php echo ka( 'kon_text' ); ?></p>
    </div>
    <form id="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
      <input type="hidden" name="action" value="ka_contact">
      <input type="hidden" name="ka_back" value="<?php echo esc_url( ka_url( 'kontakt' ) ); ?>">
      <?php wp_nonce_field( 'ka_contact', 'ka_nonce' ); ?>
      <div class="hp" aria-hidden="true"><label>Bitte leer lassen<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
      <label for="vorname">Vorname<input id="vorname" name="vorname" autocomplete="given-name" required></label>
      <label for="nachname">Nachname<input id="nachname" name="nachname" autocomplete="family-name" required></label>
      <label class="full" for="email">E-Mail<input id="email" name="email" type="email" autocomplete="email" required></label>
      <label class="full" for="nachricht">Deine Nachricht<textarea id="nachricht" name="nachricht" required></textarea></label>
      <label class="full consent" for="consent"><input id="consent" name="consent" value="1" type="checkbox" required><span><?php echo ka( 'kon_consent' ); ?></span></label>
      <div class="full"><button class="btn deep" type="submit"><?php echo ka( 'kon_send' ); ?></button></div>
      <p id="note" role="status"<?php echo $ka ? '' : ' hidden'; ?>><?php echo 'sent' === $ka ? ka( 'kon_ok' ) : ( $ka ? ka( 'kon_err' ) : '' ); ?></p>
    </form>
  </div>
</section>
<?php
}

function ka_view_legal() {
	?>
<div class="wrap legal-wrap">
  <?php while ( have_posts() ) : the_post(); ?>
  <article class="legal-card">
    <h1><?php the_title(); ?></h1>
    <?php
	// Doppelte Überschrift vermeiden: Steht der Seitentitel schon am Anfang des Textes, wird er dort entfernt.
	$content = apply_filters( 'the_content', get_the_content() );
	if ( preg_match( '#^\s*<h[1-4][^>]*>(.*?)</h[1-4]>#is', $content, $m ) && mb_strtolower( trim( wp_strip_all_tags( $m[1] ) ) ) === mb_strtolower( trim( get_the_title() ) ) ) {
		$content = preg_replace( '#^\s*<h[1-4][^>]*>.*?</h[1-4]>#is', '', $content, 1 );
	}
	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput
	?>
  </article>
  <?php endwhile; ?>
</div>
<?php
}

/** Zeilenname der Preisliste: Erklärungen (Klammer am Ende, "innerhalb …") klein und grau darunter. */
function ka_row_label( $s ) {
	if ( preg_match( '/^(.*?)\s+(innerhalb\b.*|im Abstand\b.*|\([^()]*\))$/u', $s, $m ) ) {
		$ex = trim( $m[2], '() ' );
		return esc_html( $m[1] ) . '<small class="ex">' . esc_html( $ex ) . '</small>';
	}
	return esc_html( $s );
}
