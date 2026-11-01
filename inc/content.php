<?php
/**
 * Inhalte der Startseite: Vorgaben, Zugriff und Aufbereitung.
 * Alle Texte lassen sich im WordPress-Menü "Inhalte" ändern.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Felder. type: text | area | lines | html | inline
 * lines = eine Zeile pro Eintrag, area = mehrzeiliger Text, html = Editor, inline = Text mit <strong>/<em>
 */
function ka_fields() {
	static $f = null;
	if ( null !== $f ) { return $f; }

	$f = array();
	$add = function ( $section, $key, $label, $type, $default, $help = '' ) use ( &$f ) {
		$f[ $key ] = compact( 'section', 'label', 'type', 'default', 'help' );
	};

	/* ---- Allgemein und Kontakt ---- */
	$s = 'Allgemein und Kontakt';
	$add( $s, 'brand', 'Name der Praxis', 'text', 'Kreuzberg Ästhetik' );
	$add( $s, 'lead_in', 'Begrüßung über dem Praxisnamen', 'text', 'Willkommen bei' );
	$add( $s, 'email', 'E-Mail-Adresse', 'text', 'info@kreuzberg-aesthetik.de' );
	$add( $s, 'phone_display', 'Handynummer (so wird sie angezeigt)', 'text', '+49 173 2874413' );
	$add( $s, 'phone_link', 'Handynummer (nur Ziffern mit Ländervorwahl, für den WhatsApp-Link)', 'text', '+491732874413' );
	$add( $s, 'sms_text', 'Vorbereitete Nachricht (WhatsApp und E-Mail)', 'area', 'Hallo Manuel, ich interessiere mich für eine Behandlung bei Kreuzberg Ästhetik und möchte gerne einen Termin anfragen. Mein Anliegen: ' );
	$add( $s, 'msg_label', 'Beschriftung der Nachricht-Knöpfe', 'text', 'WhatsApp schreiben' );
	$add( $s, 'msg_sub', 'Zusatz im Nachricht-Kasten (hinter der Nummer)', 'text', '' );
	$add( $s, 'footer_text', 'Fußzeile', 'text', 'Kreuzberg Ästhetik · Berlin-Kreuzberg' );

	/* ---- Start ---- */
	$s = 'Startbereich';
	$add( $s, 'hero_h1', 'Praxisbeschreibung unter dem Namen (fett mit <strong>…</strong>)', 'inline', 'Privatpraxis für ästhetische Medizin &amp; Longevity in Berlin-Kreuzberg' );
	$add( $s, 'hero_brand', 'Praxisname groß im Startbereich', 'text', 'Kreuzberg Ästhetik' );
	$add( $s, 'hero_name', 'Satz neben dem Bild', 'text', 'Hi, ich bin Manuel.' );
	$add( $s, 'hero_sub', 'Kleine Zeile unter dem Satz neben dem Bild', 'text', 'Ich lebe und arbeite in Berlin-Kreuzberg.' );
	$add( $s, 'hero_phil_h', 'Startbereich: Zwischenüberschrift', 'text', 'Meine Philosophie:' );
	$add( $s, 'hero_vals', 'Startbereich: drei Werte als Kacheln (eine Zeile je Wert)', 'lines', "Professionalität\nAuthentizität\nIntegrität" );
	$add( $s, 'hero_phil_lead', 'Startbereich: fetter Satz', 'text', 'Professionell, authentisch und offen für alle:' );
	$add( $s, 'hero_text', 'Startbereich: Text', 'area', 'Ich biete Dir eine persönliche Beratung und nehme mir Zeit für Deine Fragen, bevor wir über eine mögliche Behandlung sprechen.' );
	$add( $s, 'hero_btn', 'Beschriftung des Knopfs', 'text', 'Termin anfragen' );
	$add( $s, 'home_lei_intro', 'Startseite: Text über den Behandlungen', 'area', 'Alle Behandlungen mit Preisen findest Du übersichtlich auf einer eigenen Seite.' );
	$add( $s, 'home_about_h2', 'Über mich: Überschrift auf der Startseite', 'text', 'Hallo, ich bin Manuel Fella!' );
	$add( $s, 'home_about_text', 'Über mich: Kurztext auf der Startseite', 'text', 'Ich lebe und arbeite in Berlin-Kreuzberg.' );
	$add( $s, 'home_about_link', 'Über mich: Link-Text', 'text', 'Mehr über meine Praxis und mich erfahren' );
	$add( $s, 'say_text', 'Satz unter dem Startbereich', 'text', 'Termine vergebe ich aktuell persönlich. Schreibe mir einfach!' );
	$add( $s, 'tz_eyebrow', 'Kacheln: kleine Zeile über der Überschrift', 'text', 'Entdecke mehr' );
	$add( $s, 'tz_h2', 'Kacheln: Überschrift', 'text', 'Was Dich bei mir erwartet' );
	$add( $s, 'tz_btn', 'Kacheln: Beschriftung des Links', 'text', 'Mehr erfahren' );
		$add( $s, 'tz_items', 'Kacheln', 'lines', "Behandlungen | Alle Behandlungen mit Preisen im Überblick, dazu ein kleines Gespräch zum Antippen.\nÜber mich | Mein Weg, meine Haltung und die Werte, die meine Arbeit leiten.\nAblauf und Fragen | So läuft ein Termin ab, was Du mitbringen kannst und Antworten auf häufige Fragen.\nKontakt | Schreibe mir per WhatsApp, E-Mail oder über das Formular.", 'Vier Zeilen im Format: Titel | Text. Reihenfolge: Leistungen, Über mich, Ablauf und Fragen, Kontakt.' );

	/* ---- Über mich ---- */
	$s = 'Über mich';
	$add( $s, 'about_eyebrow', 'Kleine Zeile über der Überschrift', 'text', 'Über mich' );
	$add( $s, 'about_h2', 'Überschrift', 'text', 'Hallo, ich bin Manuel!' );
	$add( $s, 'about_main', 'Haupttext', 'html', "Ich lebe und arbeite in Berlin-Kreuzberg.\n\nIn meiner Praxis geht es mir darum, Menschen in ihrer eigenen Ausdruckskraft zu stärken und ihnen das Gefühl zu geben, mit sich im Einklang zu sein. Diese Haltung prägt meine Arbeit. Sie verbindet medizinisches Wissen, künstlerisches Feingefühl und Respekt vor der Individualität jedes Menschen, weil Ästhetik weit mehr ist als das Streben nach Schönheit.\n\nMein Weg in die ästhetische Medizin begann nach meinem Studium der Humanmedizin in Würzburg und München. Nach einem spannenden Jahr in Valencia zog es mich nach Berlin, wo ich meine Facharztausbildung als Pathologe begann. Während dieser Zeit habe ich nicht nur mein Auge für Details bis in mikroskopische Ebenen geschult, sondern auch ein tiefes Verständnis für die anatomischen Strukturen des menschlichen Körpers entwickelt. 2021 habe ich mich dann ganz der ästhetischen Medizin verschrieben. Diese Entscheidung erlaubt mir, meine Leidenschaft für Präzision und Gestaltung mit dem direkten Kontakt zu Menschen zu verbinden." );
	$add( $s, 'about_values_h', 'Zwischenüberschrift', 'text', 'Meine Philosophie und Werte' );
	$add( $s, 'about_values_intro', 'Text vor den Werten', 'area', 'Mit Kreuzberg Ästhetik habe ich einen Ort geschaffen, an dem moderne Behandlungen und ein aufrichtiges Verständnis für Deine Bedürfnisse zusammenkommen. Dabei leiten mich klare Prinzipien:' );
	$add( $s, 'about_values', 'Werte', 'lines', "Professionalität | Durch meinen medizinischen Hintergrund und stetige Fortbildungen garantiere ich Dir höchste Standards. Mein Ziel ist eine Behandlung auf dem neuesten Stand der Wissenschaft, die Deine Sicherheit an erste Stelle setzt.\nAuthentizität & Integrität | Ich stehe persönlich und mit voller Überzeugung hinter jeder Behandlung, die ich in meiner Praxis anbiete. Für mich bedeutet Authentizität, dass ich als Arzt und Mensch echt bleibe und Dir mit meinem ehrlichen Blick begegne. Diese persönliche Haltung verbinde ich untrennbar mit meiner fachlichen Integrität. Auf mein Wort und mein medizinisches Urteil kannst Du Dich verlassen, denn ich empfehle Dir nur das, was ich ethisch und ästhetisch voll vertreten kann. Wenn eine Behandlung nicht zu Deinem Wohl oder Deinem langfristigen Erscheinungsbild beiträgt, kommuniziere ich das offen und transparent.\nInklusivität | Ich schätze die Vielfalt Berlins und heiße jeden Menschen in meiner Praxis willkommen. Mir ist es wichtig, einen diskriminierungsfreien Raum zu schaffen, in dem Du Dich sicher und in Deiner Identität respektiert fühlst.\nFokus auf Longevity", 'Eine Zeile pro Wert. Mit Text zum Aufklappen im Format: Wert | Text. Ohne Text bleibt der Wert eine einfache Pille.' );
	$add( $s, 'about_after', 'Text nach den Werten', 'html', 'Neben Behandlungen mit Neuromodulatoren, Hyaluron-Fillern oder Biostimulatoren in meiner Praxis in Kreuzberg widme ich mich zunehmend auch dem Bereich Longevity Medicine. Dabei geht es mir um mehr als um Ästhetik im engeren Sinn. Es geht um Deine Gesundheit, Deine Ausstrahlung und Deine Lebensqualität und darum, sie langfristig zu erhalten.' );
	$add( $s, 'home_tl_h', 'Startseite: Überschrift über dem Zeitstrahl', 'text', 'Mein Weg zu Kreuzberg Ästhetik' );
	$add( $s, 'tl_h', 'Überschrift des Zeitstrahls', 'text', 'Mein Weg' );
	$add( $s, 'tl_items', 'Zeitstrahl', 'lines', "Studium der Humanmedizin | Würzburg und München. Hier habe ich die Grundlage für mein medizinisches Wissen gelegt.\nEin Jahr in Valencia | Ein spannendes Jahr, bevor es nach Berlin ging.\nFacharztausbildung zum Pathologen | In Berlin, mit dem Blick für Details bis in mikroskopische Ebenen. Diese Genauigkeit prägt meine Arbeit bis heute.\nSeit 2021 ästhetische Medizin | Präzision und Gestaltung im direkten Kontakt mit Menschen, mit Neuromodulatoren, Hyaluron-Fillern und Biostimulatoren.\nKreuzberg Ästhetik | Meine Praxis in Berlin-Kreuzberg: ein Ort, an dem moderne Behandlungen und ein aufrichtiges Verständnis für Deine Bedürfnisse zusammenkommen.", 'Eine Zeile pro Station im Format: Titel | Text. Es passen fünf Stationen gut. Die Symbole werden der Reihe nach vergeben.' );
	$add( $s, 'portrait_url', 'Portrait (Adresse eines Bilds aus der Mediathek, leer = Bild aus dem Theme)', 'text', '' );
	$add( $s, 'portrait_alt', 'Beschreibung des Portraits (für Screenreader)', 'text', 'Portrait von Manuel Fella' );

	/* ---- Leistungen ---- */
	$s = 'Behandlungen';
	$add( $s, 'lei_eyebrow', 'Kleine Zeile über der Überschrift', 'text', 'Behandlungen' );
	$add( $s, 'nav_services', 'Kopfleiste: Beschriftung für Behandlungen', 'text', 'Behandlungen' );
	$add( $s, 'lei_h2', 'Überschrift', 'text', 'Was ich für Dich tun kann' );
	$add( $s, 'lei_intro', 'Einleitung', 'area', 'Hier siehst Du alle Behandlungen mit Preisen. Nach einem ausführlichen Gespräch entscheiden wir gemeinsam, was für Dich sinnvoll ist.' );
	$add( $s, 'chat_h', 'Überschrift über dem Gespräch', 'text', 'Unsicher, was zu Dir passt?' );
	$add( $s, 'chat_intro', 'Erste Frage im Chat', 'text', 'Was beschäftigt Dich gerade?' );
	$add( $s, 'chat_fine', 'Kleingedrucktes unter den Preisen im Chat', 'text', 'Preise inklusive 19 % MwSt., Abrechnung auf Honorarbasis.' );
	$add( $s, 'chat_topics', 'Themen im Chat', 'area',
"## Falten und Mimik
Mimische Falten behandle ich gezielt und sparsam. Wir besprechen erst, welche Zonen Dich stören und was realistisch ist.
- 1 Zone | ab 169,-
- 2 Zonen | ab 259,-
- 3 Zonen | ab 349,-
- Jede weitere Zone | ab 90,-

## Hautqualität
Für eine bessere Hautqualität arbeite ich mit Peelings, Needling und Polynukleotiden. Was sinnvoll ist, hängt von Deiner Haut ab.
- TCA-Peeling | ab 149,-
- Retinol-Peeling | ab 199,-
- Microneedling | ab 249,-
- Polynukleotide 2 ml | ab 349,-

## Volumen und Kontur
Mit Hyaluron lassen sich Kontur und Volumen sanft anpassen. Ich wähle das Produkt passend zu Deiner Anatomie und erkläre Dir, warum.
- Hyaluron-Filler 0,55 ml | ab 249,-
- Hyaluron-Filler 0,7 ml | ab 299,-
- Hyaluron-Filler 1 ml | ab 349,-
- Hyaluronidase, Auflösen von Hyaluron | ab 149,-

## Schwitzen oder Zähneknirschen
Auch dafür gibt es eine Behandlung. Wir klären im Gespräch, ob sie für Dich passt.
- Hyperhidrose, pro Bereich | ab 499,-
- Bruxismus / Masseter | ab 299,-

## Kleine Fettpölsterchen
Die Fett-weg-Spritze (Lipolyse) ist für kleine, umschriebene Areale gedacht. Wir schauen gemeinsam, ob sie bei Dir sinnvoll ist.
- Lipolyse, enzymatisch | ab 499,-
- Lipolyse, chemisch (traditionell) | ab 249,-
- Lipolyse, lymphatisch | ab 249,-

## Longevity
Ästhetik und Gesundheit gehören für mich zusammen. Longevity-Medizin schaut auf die kommenden Jahre und nicht nur auf das Aussehen: Wie bleiben Gesundheit, Ausstrahlung und Lebensqualität langfristig erhalten?
Wir sprechen über Deine Ziele und Deine Ausgangslage und legen dann gemeinsam fest, was für Dich sinnvoll ist.

## Ich weiß es noch nicht
Das ist völlig in Ordnung. Dafür ist das Erstgespräch da. Wir sprechen über das, was Dich stört oder beschäftigt, und ich sage Dir ehrlich, was sinnvoll ist. Auch, wenn die Antwort lautet: noch nichts.",
		"Aufbau: Jedes Thema beginnt mit ## und dem Namen. Jede Textzeile darunter ist ein Absatz. Zeilen mit - vorne sind Preiszeilen im Format: Name | Preis." );
	$add( $s, 'all_summary', 'Beschriftung zum Aufklappen der ganzen Liste', 'text', 'Alle Behandlungen' );
	$add( $s, 'price_groups', 'Komplette Preisliste', 'area',
"## Neuromodulator | Falten, Schwitzen, Kontur
Für mimische Falten, starkes Schwitzen oder Zähneknirschen. Wir besprechen vorab, welche Zonen sinnvoll sind und was realistisch ist.
### Mimische Falten
1 Zone | ab 169,-
2 Zonen | ab 259,-
3 Zonen | ab 349,-
Jede weitere Zone | ab 90,-
### Schwitzen und Zähneknirschen
Hyperhidrose, pro Bereich | ab 499,-
Bruxismus / Masseter | ab 299,-
### Kontur
Nefertiti komplett | ab 399,-
Jawline | ab 269,-
Platysma | ab 269,-
Trapezius | ab 349,-

## Filler und Booster | Volumen und Hautqualität
Für Kontur, Volumen und eine bessere Hautqualität. Ich wähle das Produkt passend zu Deiner Anatomie und erkläre Dir, warum.
### Hyaluron-Filler
0,55 ml | ab 249,-
0,7 ml | ab 299,-
1 ml | ab 349,-
### Booster für die Hautqualität
Polynukleotide 2 ml | ab 349,-
Skinbooster 1 ml | ab 199,-
### Biostimulatoren
Calciumhydroxylapatit (CaHA) 1,5 ml | ab 449,-
Poly-L-Milchsäure (PLLA) 1 Vial | ab 599,-
Polycaprolacton (PCL) 1 ml | ab 399,-
### Korrektur
Hyaluronidase, Auflösen von Hyaluron | ab 149,-

## Haut und Körper | Peelings, Needling, Lipolyse
Peelings, Needling und Mesotherapie für die Haut, dazu Lipolyse für kleine, umschriebene Areale.
### Peelings
TCA-Peeling | ab 149,-
Retinol-Peeling | ab 199,-
### Needling und Mesotherapie
Microneedling | ab 249,-
Microneedling mit Exosomen | ab 399,-
Mesotherapie (Hyaluron-Vitamin-Komplex) | ab 249,-
### Lipolyse (Fett-weg-Spritze)
Enzymatisch | ab 499,-
Chemisch (traditionell) | ab 249,-
Lymphatisch | ab 249,-

## Longevity | Medizin für lange Gesundheit | dunkel
Ästhetik und Gesundheit gehören für mich zusammen. Longevity-Medizin schaut auf die kommenden Jahre und nicht nur auf das Aussehen: Wie bleiben Gesundheit, Ausstrahlung und Lebensqualität langfristig erhalten? Wir sprechen über Deine Ziele und Deine Ausgangslage und legen dann gemeinsam fest, welche Maßnahmen für Dich sinnvoll sind. [Vorschlag: Prüfe, ob das zu Deinem Konzept passt, und ergänze Details zu den Angeboten.]

## Pakete | Mehrere Termine, günstigerer Preis | breit
Wenn mehrere Termine sinnvoll sind, bekommst Du die Behandlungen im Paket zu einem günstigeren Preis.
2 × PLLA-Behandlung innerhalb von 6 Monaten | ab 999,- | 1198,-
3 × PLLA-Behandlung innerhalb eines Jahres | ab 1399,- | 1797,-
4 × Retinol-Peeling innerhalb von 6 Monaten | ab 699,- | 796,-
4 × TCA-Peeling innerhalb von 6 Monaten | ab 499,- | 596,-
2 × Exosomen + Needling | ab 699,- | 798,-
3 × Exosomen + Needling | ab 999,- | 1197,-
3 × Polynukleotide | ab 899,- | 1047,-
4 × Polynukleotide | ab 1199,- | 1396,-
Lip-Flip + 0,7 ml Hyaluron (Abstand 2 Wochen) | ab 349,- | 458,-",
		"Aufbau: Jede Gruppe beginnt mit ## Titel | Kleine Zeile. Am Ende der Zeile kann | dunkel (dunkle Karte) oder | breit (volle Breite) stehen. Die Zeilen darunter ohne | sind der Beschreibungstext. Preiszeilen haben das Format: Name | Preis | durchgestrichener alter Preis (der dritte Teil ist optional)." );
	$add( $s, 'lei_note', 'Hinweis unter der Preisliste', 'area', 'Alle Angaben in Euro, inklusive 19 % MwSt. Die endgültige Abrechnung erfolgt auf Honorarbasis. Nachbehandlungen im Ermessen des Behandlers sind kostenfrei.' );

	/* ---- Ablauf ---- */
	$s = 'Ablauf';
	$add( $s, 'abl_eyebrow', 'Kleine Zeile über der Überschrift', 'text', 'Ablauf und Fragen' );
	$add( $s, 'abl_h2', 'Überschrift', 'text', 'So läuft ein Termin' );
	$add( $s, 'abl_steps', 'Schritte', 'lines', "Anfrage | Du schreibst mir per WhatsApp, E-Mail oder Formular. Ich antworte persönlich.\nErstgespräch | Wir sprechen über Deine Wünsche, Vorerkrankungen und das, was realistisch ist.\nAufklärung und Behandlung | Du bekommst die Aufklärung in Ruhe. Erst danach entscheiden wir über die Behandlung.\nDokumentation und Nachsorge | Produkt, Menge und Stelle werden festgehalten. Du erfährst, worauf Du danach achten solltest.", 'Eine Zeile pro Schritt im Format: Titel | Text.' );
	$add( $s, 'check_h3', 'Überschrift der Checkliste', 'text', 'Für Dein Erstgespräch' );
	$add( $s, 'check_intro', 'Text über der Checkliste', 'area', 'Das hilft mir, Dich gut zu beraten. Alles davon ist freiwillig, und Du kannst es auch im Gespräch nachreichen.' );
	$add( $s, 'check_items', 'Checkliste', 'lines', "Eine Liste Deiner Medikamente, auch Nahrungsergänzung und Blutverdünner\nVorerkrankungen und Allergien\nFrühere ästhetische Behandlungen: was, wann und womit\nAktuelle Befunde oder Laborwerte, falls Du welche hast\nHinweis, falls Du schwanger bist oder stillst\nDeine Fragen und Wünsche, auch Dinge, die Dich stören", 'Eine Zeile pro Punkt.' );

	/* ---- Fragen ---- */
	$s = 'Fragen und Antworten';
	$add( $s, 'faq_eyebrow', 'Kleine Zeile über der Überschrift', 'text', 'Fragen und Antworten' );
	$add( $s, 'faq_h2', 'Überschrift', 'text', 'Gut zu wissen' );
	$add( $s, 'faq_items', 'Fragen und Antworten', 'area',
"Wie bekomme ich einen Termin?
Termine vergebe ich aktuell persönlich. Schreibe mir per WhatsApp, E-Mail oder über das Formular, ich melde mich bei Dir.

Was passiert im Erstgespräch?
Wir sprechen über Deine Wünsche, Vorerkrankungen und darüber, was realistisch ist. Du bekommst die Aufklärung in Ruhe. Erst danach entscheiden wir, ob und wie wir behandeln.

Wird direkt behandelt?
Nein. Zuerst kommt das Gespräch. Wenn eine Behandlung für Dich nicht sinnvoll ist, sage ich Dir das offen.

Was bedeutet \"ab\" bei den Preisen?
Die Preise sind Ausgangswerte inklusive 19 % MwSt. Die endgültige Abrechnung erfolgt auf Honorarbasis. [Ergänzen: Wann nennst Du den genauen Betrag, zum Beispiel im Erstgespräch?]

Was kosten Nachbehandlungen?
Nachbehandlungen im Ermessen des Behandlers sind kostenfrei.

Übernimmt die Krankenkasse die Kosten?
[Bitte prüfen und ergänzen: Ästhetische Behandlungen sind in der Regel Selbstzahlerleistungen. Wie ist das bei Deinen Angeboten, zum Beispiel bei Hyperhidrose oder Bruxismus?]

Wie läuft die Nachsorge?
Ich dokumentiere jede Behandlung und sage Dir, worauf Du danach achten solltest. [Ergänzen: Wie erreichen Patientinnen und Patienten Dich bei Fragen nach der Behandlung?]",
		'Aufbau: Erste Zeile = Frage, die Zeilen darunter = Antwort. Zwischen zwei Fragen steht eine Leerzeile. Text in [eckigen Klammern] wird im Entwurfsmodus als offene Stelle markiert.' );

	/* ---- Kontakt ---- */
	$s = 'Kontakt';
	$add( $s, 'kon_eyebrow', 'Kleine Zeile über der Überschrift', 'text', 'Kontakt' );
	$add( $s, 'kon_h2', 'Überschrift', 'text', 'Schreibe mir einfach.' );
	$add( $s, 'kon_text', 'Text', 'area', 'Termine vergebe ich aktuell persönlich. Du bekommst von mir eine Antwort, sobald ich Deine Nachricht gelesen habe. Bitte schicke keine Fotos oder Gesundheitsdaten über das Formular.' );
	$add( $s, 'kon_consent', 'Text der Einwilligung', 'area', 'Ich bin einverstanden, dass meine Angaben zur Beantwortung meiner Anfrage verarbeitet werden. Mehr dazu steht in der Datenschutzerklärung.' );
	$add( $s, 'kon_send', 'Beschriftung des Absende-Knopfs', 'text', 'Anfrage senden' );
	$add( $s, 'kon_ok', 'Meldung nach dem Absenden', 'text', 'Danke, Deine Nachricht ist bei mir angekommen. Ich melde mich persönlich bei Dir.' );
	$add( $s, 'kon_err', 'Meldung bei Fehlern', 'text', 'Das hat leider nicht geklappt. Bitte fülle alle Felder aus und stimme der Datenverarbeitung zu, oder schreibe mir direkt.' );

	return $f;
}

/** Wert eines Felds (gespeichert oder Vorgabe). */
function ka_raw( $key ) {
	$fields = ka_fields();
	$opt    = get_option( 'ka_content', array() );
	if ( is_array( $opt ) && isset( $opt[ $key ] ) && '' !== trim( (string) $opt[ $key ] ) ) {
		return (string) $opt[ $key ];
	}
	return isset( $fields[ $key ] ) ? (string) $fields[ $key ]['default'] : '';
}

/** [Text in Klammern] im Entwurfsmodus markieren. */
function ka_mark( $html ) {
	if ( defined( 'KA_DRAFT' ) && KA_DRAFT ) {
		$html = preg_replace( '/\[([^\]\[]+)\]/u', '<span class="todo">[$1]</span>', $html );
	} else {
		// Live: offene [Stellen] werden nicht angezeigt.
		$html = trim( preg_replace( '/\s*\[[^\]\[]+\]/u', '', $html ) );
	}
	return $html;
}

/** Einfacher Text, maskiert. */
function ka( $key ) { return ka_mark( esc_html( ka_raw( $key ) ) ); }

/** Text mit <strong>/<em>/<br>. */
function ka_inline( $key ) {
	return ka_mark( wp_kses( ka_raw( $key ), array( 'strong' => array(), 'em' => array(), 'br' => array() ) ) );
}

/** Editor-Inhalt mit Absätzen. */
function ka_html( $key ) { return ka_mark( wpautop( wp_kses_post( ka_raw( $key ) ) ) ); }

/** Zeilen als Liste. */
function ka_lines( $key ) {
	$out = array();
	foreach ( preg_split( '/\R/u', ka_raw( $key ) ) as $l ) {
		$l = trim( $l );
		if ( '' !== $l ) { $out[] = $l; }
	}
	return $out;
}

function ka_digits( $s ) { return preg_replace( '/[^0-9+]/', '', $s ); }

function ka_sms_href() {
	return 'https://wa.me/' . ltrim( ka_digits( ka_raw( 'phone_link' ) ), '+' ) . '?text=' . rawurlencode( ka_raw( 'sms_text' ) );
}

function ka_mail_href() {
	return 'mailto:' . antispambot( ka_raw( 'email' ) ) . '?subject=' . rawurlencode( 'Terminanfrage' ) . '&body=' . rawurlencode( ka_raw( 'sms_text' ) );
}

/** Schritte: array( array( Titel, Text ), … ) */
function ka_steps() {
	$out = array();
	foreach ( ka_lines( 'abl_steps' ) as $l ) {
		$p = array_map( 'trim', explode( '|', $l, 2 ) );
		$out[] = array( $p[0], isset( $p[1] ) ? $p[1] : '' );
	}
	return $out;
}

/** FAQ: array( array( Frage, Antwort ), … ) */
function ka_faq() {
	$out = array();
	foreach ( preg_split( '/\R\s*\R/u', trim( ka_raw( 'faq_items' ) ) ) as $block ) {
		$rows = array_values( array_filter( array_map( 'trim', preg_split( '/\R/u', $block ) ), 'strlen' ) );
		if ( count( $rows ) < 1 ) { continue; }
		$q = array_shift( $rows );
		$ans = implode( ' ', $rows );
		if ( ! KA_DRAFT ) { $ans = trim( preg_replace( '/\s*\[[^\]\[]+\]/u', '', $ans ) ); if ( '' === $ans ) { continue; } }
		$out[] = array( $q, $ans );
	}
	return $out;
}

/** Preisgruppen. */
function ka_groups() {
	$out = array();
	$g   = null;
	foreach ( preg_split( '/\R/u', ka_raw( 'price_groups' ) ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) { continue; }
		if ( 0 === strpos( $line, '###' ) ) {
			if ( $g ) { $g['rows'][] = array( '', '', '', trim( substr( $line, 3 ) ) ); }
			continue;
		}
		if ( 0 === strpos( $line, '##' ) ) {
			if ( $g ) { $out[] = $g; }
			$p = array_map( 'trim', explode( '|', ltrim( substr( $line, 2 ) ), 3 ) );
			$flags = isset( $p[2] ) ? mb_strtolower( $p[2] ) : '';
			$g = array(
				'title' => $p[0],
				'tag'   => isset( $p[1] ) ? $p[1] : '',
				'deep'  => false !== strpos( $flags, 'dunkel' ),
				'wide'  => false !== strpos( $flags, 'breit' ),
				'desc'  => array(),
				'rows'  => array(),
			);
			continue;
		}
		if ( ! $g ) { continue; }
		if ( 0 === strpos( $line, '###' ) ) {
			$g['rows'][] = array( '', '', '', trim( substr( $line, 3 ) ) );
			continue;
		}
		if ( false !== strpos( $line, '|' ) ) {
			$r = array_map( 'trim', explode( '|', $line, 3 ) );
			$g['rows'][] = array( $r[0], isset( $r[1] ) ? $r[1] : '', isset( $r[2] ) ? $r[2] : '' );
		} else {
			$g['desc'][] = $line;
		}
	}
	if ( $g ) { $out[] = $g; }
	return $out;
}

/** Chat-Themen. */
function ka_topics() {
	$out = array();
	$t   = null;
	foreach ( preg_split( '/\R/u', ka_raw( 'chat_topics' ) ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) { continue; }
		if ( 0 === strpos( $line, '##' ) ) {
			if ( $t ) { $out[] = $t; }
			$lab = trim( substr( $line, 2 ) );
			$t = array( 'label' => esc_html( $lab ), 'icon' => ka_icon( ka_icon_for( $lab ) ), 'text' => array(), 'prices' => null );
			continue;
		}
		if ( ! $t ) { continue; }
		if ( 0 === strpos( $line, '- ' ) ) {
			$r = array_map( 'trim', explode( '|', substr( $line, 2 ), 2 ) );
			if ( null === $t['prices'] ) { $t['prices'] = array(); }
			$t['prices'][] = array( esc_html( $r[0] ), esc_html( isset( $r[1] ) ? $r[1] : '' ) );
		} else {
			$t['text'][] = esc_html( $line );
		}
	}
	if ( $t ) { $out[] = $t; }
	return $out;
}

/** Daten für das Skript (Chat, Links). */
function ka_js_data() {
	return array(
		'phone'      => ka_digits( ka_raw( 'phone_link' ) ),
		'mail'       => ka_raw( 'email' ),
		'smsText'    => ka_raw( 'sms_text' ),
		'btn'        => ka_raw( 'msg_label' ),
		'chatIntro'  => esc_html( ka_raw( 'chat_intro' ) ),
		'chatFine'   => esc_html( ka_raw( 'chat_fine' ) ),
		'topics'     => ka_topics(),
		'steps'      => array_map( function ( $s ) { return array( esc_html( $s[0] ), esc_html( $s[1] ) ); }, ka_steps() ),
		'checkIntro' => esc_html( ka_raw( 'check_intro' ) ),
		'checks'     => array_map( 'esc_html', ka_lines( 'check_items' ) ),
	);
}

/** Zeitstrahl: array( array( Titel, Text ), … ) */
function ka_timeline() {
	$out = array();
	foreach ( ka_lines( 'tl_items' ) as $l ) {
		$p = array_map( 'trim', explode( '|', $l, 2 ) );
		$out[] = array( $p[0], isset( $p[1] ) ? $p[1] : '' );
	}
	return $out;
}

/** Kacheln der Startseite: array( array( Titel, Text ), … ) */
function ka_teasers() {
	$out = array();
	foreach ( ka_lines( 'tz_items' ) as $l ) {
		$p = array_map( 'trim', explode( '|', $l, 2 ) );
		$out[] = array( $p[0], isset( $p[1] ) ? $p[1] : '' );
	}
	return $out;
}
