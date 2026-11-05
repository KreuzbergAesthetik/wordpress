# Übergabe: Website Kreuzberg Ästhetik (WordPress-Theme)

Stand: 5. November 2026. **Theme-Version 153 wird veröffentlicht** (Infoboxen und Preisliste überarbeitet, Suche findet Markennamen und Infotexte, Pakete mit Zusätzen). Nächste Version: 154.

## ZUERST LESEN – Kurzfassung für die neue Sitzung

**Wer/was:** Manuel Fella, Privatpraxis „Kreuzberg Ästhetik“ (Berlin-Kreuzberg). Er möchte **geduzt** werden und Antworten auf Deutsch, kurz und ohne Fachjargon. Eigenes klassisches PHP-Theme für kreuzberg-aesthetik.de (WordPress bei IONOS). Repo: `KreuzbergAesthetik/wordpress` (Theme liegt im Hauptordner des Repos). Arbeitszweig der Sitzung: `ccr-a91dd6cf-p9csol`. Feedback kommt als Kommentar in der Vorschau oder als markierter Screenshot im Chat.

### So arbeitet Manuel mit Dir (wichtig)

- **Nicht nerven:** Er will wenig Rückfragen und keine langen Erklärungen. Nur bei echter Unsicherheit fragen („Frage bei Unsicherheit“ war seine Ansage), vor allem bei unleserlichen Handschrift-Markierungen in Screenshots. Kurz sagen, wie Du es gelesen hast, und weitermachen.
- **Unklare Kommentare:** Er tippt per Sprache und mit Tippfehlern („unsxgatd“ = „unscharf“, „Landgamer“ = „Langsamer“). Sinn erschließen, in der Antwort kurz nennen, wie gelesen.
- **Veröffentlichen nur auf Befehl (Regel von Manuel, 5. November, gilt vor allem anderen):** Nichts geht automatisch auf die Website. Eine gewünschte Änderung wird umgesetzt und getestet und bleibt **unveröffentlicht** auf dem Arbeitszweig. Eine **Vorschau** wird erst auf Nachfrage gemacht. Erst auf einen ausdrücklichen Befehl wie „Veröffentliche“ folgt der Ablauf unten (Version erhöhen, Pull Request, Übertragung). Nicht von selbst nachfragen „soll ich veröffentlichen?“ und nicht aus Sätzen wie „ja“ oder „okay“ auf Veröffentlichen schließen, wenn sie sich auf etwas anderes beziehen. Eine Übertragung nur starten, wenn der Befehl eindeutig dazu da ist. Auch ein Pull Request nach `main` mit Theme-Änderungen zählt zum Veröffentlichen und kommt erst auf den Befehl (reine Dokumentation wie diese Datei ist ausgenommen, damit sie im nächsten Chat ankommt).
- **Gestaltungsfragen:** gern 2–3 Varianten als Bild und eine Empfehlung.
- **Medizinische Texte:** nur fundierte Angaben. Neuromodulator darf „allgemein als Botox bekannt“ heißen, sonst keine Marken bei verschreibungspflichtigen Arzneimitteln, kein „Lemon Bottle“.
- Er prüft am **Handy** (Chrome, auch Querformat) und am Desktop. Immer beides testen (Playwright: 390×844 und 1440×900, bei Kopf-Animation zusätzlich 844×390).

### Ablauf einer Änderung (seit 5. November, ohne ZIP)

Schritte 1 bis 2 passieren bei jeder gewünschten Änderung. **Ab Schritt 3 nur, wenn Manuel es ausdrücklich befiehlt** (zum Beispiel „Veröffentliche“).

1. Änderung machen und auf Desktop und Handy testen (Playwright). Die Vorschau (Artifact) nur auf Nachfrage aktualisieren.
2. Kurz sagen, was geändert wurde und dass es noch nicht veröffentlicht ist (Änderung bleibt auf dem Arbeitszweig).
   *Auf Befehl „Veröffentlichen“:*
3. Versionsnummer in `style.css` Zeile 5 (`Version: NNN`) um 1 erhöhen, kurzen Eintrag oben in dieser Datei ergänzen.
4. Commit, Push auf `ccr-a91dd6cf-p9csol`. Ist der Zweig schon in `main` gemergt, zuerst `git fetch origin && git checkout -B ccr-a91dd6cf-p9csol origin/main`.
5. Pull Request nach `main` öffnen und übernehmen (erlaubt, aber nur im Rahmen des Befehls).
6. Ablauf **„Zu IONOS übertragen“** (`ionos-deploy.yml`) auf `main` starten, Eingabe `publish=true` (Tool `actions_run_trigger`, `run_workflow`).
7. **Manuel gibt in GitHub frei** (Actions → Ablauf → „Review deployments“ → Haken `ionos-production` → „Approve and deploy“). Das kann nur er. Der Ablauf wartet bis dahin. Ist ein älterer Ablauf noch wartend, diesen mit `cancel_workflow_run` abbrechen.
8. Danach Status prüfen (`actions_list`), Manuel sagen: **Autoptimize-Cache leeren** und in der schwarzen Admin-Leiste „Theme NNN“ prüfen.

Rollback: ältere Version über einen neuen Pull Request wiederherstellen und übertragen, oder die ZIP-Datei der Vorgängerversion in WordPress hochladen (ZIP kannst Du aus dem Repo-Stand bauen: Ordner `kreuzberg-aesthetik/` mit `*.php`, `*.css`, `*.js`, `assets`, `inc`, `README.txt`).

### Server und GitHub (einmalig eingerichtet)

- IONOS-SFTP-Zugang endet im Ordner `wp-content`. Das Geheimnis `IONOS_THEME_PATH` lautet deshalb **`/themes/kreuzberg-aesthetik`** (nicht `/wordpress/wp-content/…`). Host: `access-5018625844.webspace-host.com`.
- Geheimnisse (Umgebung `ionos-production`, Manuel ist Pflicht-Prüfer): `IONOS_HOST`, `IONOS_USER`, `IONOS_PASSWORD`, `IONOS_THEME_PATH`, `IONOS_KNOWN_HOSTS`. Passwörter nie im Chat erfragen oder schreiben.
- Hilfsabläufe (laden nichts hoch): „IONOS Server-Schlüssel abrufen“ und „IONOS Ordner anzeigen“. Die Übertragung löscht nichts auf dem Server.
- Aktives Theme in WordPress ist der Ordner `kreuzberg-aesthetik`, eine Übertragung ist also sofort live. Alte Ordner `kreuzberg-aesthetik-theme103…134` auf dem Server sind alte Stände, nicht anfassen.
- Auf die Live-Seite selbst (WordPress-Admin) hast Du **keinen** Zugriff (die WordPress.com-Anbindung sieht die Site nicht). Aus dieser Sitzung heraus kommt man auch nicht per SSH an den Server (nur über die GitHub-Abläufe).

### Vorschau bauen (Artifact)

Vorschau-Adresse (privat, gleiche Adresse immer wieder überschreiben): https://claude.ai/artifact/2dqerjPUV9RJf9L7fh5fjZ

1. Arbeitsordner anlegen, darin `theme3/kreuzberg-aesthetik/` mit den Theme-Dateien (`*.php`, `*.css`, `*.js`, `assets`, `inc`) aus dem Repo.
2. Daneben legen: `uebergabe/build3.py`, `uebergabe/mk.sh`, `uebergabe/stub_tpl.php` und aus `assets/` die Bilder `portrait.jpg`, `logo-light.png`, `logo-dark.png`, `hg-line.png`, `hg-fill.png`, `portrait-cutout.webp`, `avatar.webp`.
3. `bash mk.sh` erzeugt `kt3d.html` (PHP muss installiert sein). In der Datei die erste Zeile `<!doctype html>` und die Zeile mit `claude:viewport-fit-sides` löschen, dann mit dem Artifact-Werkzeug auf dieselbe Adresse veröffentlichen.
4. Kommentare der Vorschau lesen und beantworten mit `ArtifactComments`. Threads offen lassen (Manuel schließt selbst). Mehrere ältere Threads sind „nicht aktiviert“, dort kann man nicht antworten.
5. Die Vorschau hat keine echten Seitenwechsel (Ansichten per `#adresse`) und der Kopf-Skript-Zustand (`ka_head_done_109` in `sessionStorage`) ist frisch. Für Tests „zweiter Besuch der Startseite“ setzt man diesen Schlüssel auf `1`.

### Wichtige Technik

- `ka_render()` legt `<div class="kview" data-view="home|ueber-mich|leistungen|ablauf|kontakt|impressum">` um den Inhalt. Viele CSS-Regeln hängen daran.
- `style.css` ist ein langes Protokoll: neue Regeln **immer ans Ende**, meist mit `!important`. Variablen `--r-card`, `--r-small`, `--sh-card`, `--bd-card`; Startbereich Desktop in `--u` (= min(1vw,16px)).
- Schriften lokal: Quicksand (Fließtext, Knöpfe), Literata (Überschriften), Lora (Leitgedanke, Unterzeilen).
- Texte, Preise, Infoboxen in `inc/content.php` und im WordPress-Menü „Inhalte“ überschreibbar. **Gespeicherte Felder in WordPress überschreiben neue Vorgaben** (Preisliste, `treat_info`, `about_quals`). Dann Feld leeren.
- **Füll-Effekte:** blaue Icons und Sanduhr-Trenner füllen sich beim Scrollen (`--p` per `script.js`), grüne Icons (Startbereich, Qualifikationen) füllen sich ganz auf einmal (`fill-on`), Werte-Icons füllen sich beim Öffnen. Wasserzeichen-Icons (`.sico`, `.qkbg`, `.lon-wm`, `.lei-ico`) werden nie gefüllt.
- **Animationen reduzieren** (Schalter im Menü) und System-„Bewegung reduzieren“ setzen beide die Klasse `calm` auf `<html>`: keine Animation, alle Füllungen im Endzustand.
- **Seitenwechsel:** kurze Sanduhr (halbe Drehung) per `html::before/::after`, Klassen `pgt-on`/`pgt-spin`.
- **Ablauf:** Unterseite = Leiste links, alle Karten rechts, gemeinsamer gestrichelter Kasten um „Erstgespräch“ und „Aufklärung & Behandlung“, i-Hinweis in der Karte „Erstgespräch“. Startseite = Leiste in der Mitte, Karten gleich groß, abwechselnd links/rechts, Punkte grau. Die Kreise sind mathematisch auf die Leiste zentriert (1 px Kartenrand ausgeglichen). „Anfrage“ ist ein Link zur Kontaktseite.
- **Behandlungskarten:** Desktop alle offen und einzeln zuklappbar, Handy nur eine offen. Pakete sind eine normale Karte neben „Haut und Körper“. Eine Sammel-Info nur bei „Kontur“, sonst Info je Zeile (`treat_info` in `content.php`).
- **Impressum/Datenschutz:** kommen aus `inc/legal/*.html`, immer (Konstante `KA_LEGAL_BUNDLED` in `functions.php`). Klammer-Platzhalter werden entfernt.
- Kopf-Animation (`script.js`, `PIN`): Scrollweg 440 bis 760 px, läuft auch im Querformat. Der Text unter dem Schriftzug wird früh unscharf (Blur), solange der Schriftzug darüber fliegt.

### Offen

1. **Rechtliche Prüfung des Datenschutzes** (Löschfrist der Server-Logs bei IONOS; ob WPForms, WPCode, Yoast, Autoptimize Daten verarbeiten; Heilmittelwerbegesetz bei den Leistungsbezeichnungen). Die Platzhalter im Entwurf wurden aus dem Text entfernt, nicht geklärt.
2. **Retinol-Peeling, Ausfallzeit:** steht „feines Schälen 2–4 Tage“. Manuel hatte bei der „4“ etwas geändert, die Zahl blieb unbeantwortet.
3. Produktliste für die Infoboxen (Plinest/PolyPhil/PNBlast sind eingetragen, weitere offen). Infobox-Texte fachlich prüfen lassen (`infoboxen-behandlungen.md`).
4. Offene Vorschau-Threads (Behandlungen „Jede weitere Zone“, „Hyperhidrose pro Bereich“, Zeitstrahl, „Kopf bleibt hängen“) sind umgesetzt oder erledigt, aber Manuel schließt sie selbst.
5. Optional: Praxisfoto (`about_practice_img`), englische Version.
6. Pathologen-Eintrag steht noch im Zeitstrahl der Startseite und in der Biografie (nur aus der Qualifikationsliste entfernt). Manuel hat das so bestätigt.

---

## Ausführliches Änderungsprotokoll (älter → neuer)

## Worum es geht

Neues WordPress-Theme für kreuzberg-aesthetik.de (Privatpraxis Manuel Fella, ästhetische Medizin & Longevity, Berlin-Kreuzberg). Hosting bei IONOS mit WordPress. Das Theme ist auf der Live-Seite bereits installiert; neue Versionen werden als ZIP hochgeladen (altes Theme ersetzen, danach Autoptimize-Cache leeren).

Ansprache: Manuel möchte geduzt werden. Feedback kommt meist als Kommentar in der Vorschau.

## Dateien in diesem Ordner

| Datei / Ordner | Inhalt |
|---|---|
| `kreuzberg-aesthetik-theme.zip` | Aktuelles Theme (Version 136), zum Hochladen in WordPress |
| `theme-quelltext/` | Entpackter Quelltext desselben Themes |
| `legal/` | Entwürfe Impressum und Datenschutz (HTML und Markdown) |
| `hero-vorlage-variante5.md` | Manuels Vorlage für den Startbereich |
| `build3.py`, `mk.sh`, `stub_tpl.php` | Werkzeuge, um aus dem Theme die HTML-Vorschau zu bauen |
| `infoboxen-behandlungen.md` | Alle Infobox-Texte zum Prüfen |
| `varianten-abschnitte/`, `varianten-werte/` | Frühere Gestaltungsvarianten (Bilder + CSS) |

Vorschau (Artifact, privat): https://claude.ai/artifact/Rdvj7GY2bT1qWwiSXGoRHZ

## Aufbau des Themes

- Klassisches PHP-Theme, kein Block-Editor.
- `inc/content.php`: alle Texte, Preise, Chat-Themen, Zeitstrahl als Vorgaben. In WordPress im Menü **Inhalte** änderbar. Gespeicherte Werte dort überschreiben die Vorgaben.
- `inc/views.php`: Seitenaufbau (Startseite, Über mich, Leistungen, Ablauf, Kontakt, Rechtliches).
- `inc/icons.php`: Linien-Symbole.
- `style.css`: sehr lang; neue Regeln werden jeweils am Ende angehängt und überschreiben ältere.
- `script.js`: Kopfleisten-Animation, Zeitstrahl, Preissuche, Chat, Sanduhr-Logo.
- Preisliste-Format: `## Titel | Zeile | dunkel/breit`, Unterkategorie `### Name`, Zeile `Name | Preis | alter Preis`. Erklärungen am Ende in Klammern oder mit "innerhalb …" erscheinen automatisch klein und grau.

## Aktueller Stand (wichtigste Entscheidungen)

- **Startseite:** oben Sanduhr-Logo, "Willkommen bei", groß "Kreuzberg Ästhetik", "Privatpraxis für ästhetische Medizin & Longevity in Berlin-Kreuzberg". Darunter freigestelltes Porträt links (läuft unten weich aus, am Handy reicht der Text in den Verlauf), rechts "Hi, ich bin Manuel.", kursiv "Ich lebe und arbeite in Berlin-Kreuzberg.", grüner Strich, "Meine Philosophie", drei Wert-Kacheln mit kräftigerem Schatten (Professionalität, Authentizität, Integrität), Text, Pillen "E-Mail" (dunkelblau) und "WhatsApp" (hell mit Rand) nebeneinander. Keine blaue Karte, keine Wasserzeichen.
- **Kopfleiste:** beim ersten Scrollen steht die Seite still, Logo und Schriftzug fliegen in die Leiste, Menü-Knopf ist von Anfang an sichtbar. Der Einflug läuft nur einmal pro Sitzung (sessionStorage ka_head_done); danach steht die Leiste sofort oben. Leiste fast deckend, weiß-blauer Verlauf, kräftiger Schatten. Sanduhr läuft bei jedem Andocken und bei jedem Öffnen des Menüs.
- **Unter dem Startbereich:** vier Kacheln (alle hell, großes Symbol als Wasserzeichen, Kurztext, "Mehr erfahren"; beim Überfahren dunkelblau mit weißer Schrift), dann Kurzfassungen in eigenen Kästen (Behandlungen und Ablauf weiß, Über mich hellblau, Kontakt navy): Behandlungen (zwei Spalten: "Behandlungsübersicht" → Preistabelle, "Unsicher?" → Chat; Symbole als Wasserzeichen), Zeitstrahl unter "Mein Weg zu Kreuzberg Ästhetik", läuft nach der letzten Station mit verblassenden Punkten aus (Stationen werden beim Erreichen dunkelblau, Text blendet ein), Ablauf (nur Nummer, Symbol, Überschrift), Kontakt (E-Mail, WhatsApp, Formular).
- **Farben:** Navy #012265, Markengrün #004d17 (kein Türkis), Hintergrund ruhiger hellblauer Verlauf, kein Gold.
- **Preisliste:** mit Unterkategorien, Suche hinter einer Lupe oben links, Longevity-Karte mit Verlauf. Gelöscht: NAD+, Biostimulator (Kollagenaufbau), Nase/Tränenrinne, Hyaluronidase extern, Eigenbluttherapie, Beispiele in Klammern. Skinbooster 1 ml ab 199,-.
- **Chat:** rundes Porträt-Symbol (eigener Ausschnitt `assets/avatar.webp`).
- **Benennung:** "Leistungen und Preise" heißt überall "Behandlungen"; nur die Seitenadresse bleibt `/leistungen/`.

## Offene Punkte

1. Theme Version 136 auf der Live-Seite einspielen und Cache leeren; Live-Seite lief zuletzt noch mit älterer Version.
2. Falls Felder im Menü "Inhalte" gespeichert wurden (Preisliste, Startseiten-Texte), zeigen sie alte Texte. Feld leeren, damit die neuen Vorgaben gelten.
3. Datenschutzerklärung: Löschfrist der Server-Logs bei IONOS eintragen; prüfen, ob weitere Plugins mit Datenverarbeitung laufen (WPForms, WPCode, Yoast, Autoptimize waren in der Admin-Leiste sichtbar).
4. Rechtliche Prüfung (Heilmittelwerberecht) der Leistungsbezeichnungen.
5. Optional: Praxisfotos, englische Version.

## Stand Version 121

- Kopfleiste: links nur "Behandlungen", rechts nur "Kontakt".
- Ladeanzeige (128): hellblauer Verlauf wie der Seitenhintergrund.
- Startbereich Desktop (131, nach Manuels Vorlage): Porträt groß links (ca. 49 vw breit, Kopf knapp unter der Unterüberschrift), läuft nach links, rechts und unten weich aus; Textspalte ab 40 vw rechts daneben, leicht überlappend. Name, Unterzeile, Sanduhr-Trenner, "Meine Philosophie", Werte und Knöpfe mittig, Fließtext linksbündig.
- Werte: Professionalität, Authentizität, Inklusivität, ohne Kärtchen, mit feinen senkrechten Trennlinien. Handy: Name zentriert, Sanduhr-Trenner statt grünem Strich.
- Sanduhr-Trenner zwischen Kontakt-Pillen und Kacheln; Kacheln reinweiß. Handy: "Meine Philosophie" mittig.
- "Was ich für Dich tun kann": Knöpfe links, "Zur Liste".
- Zeitstrahl: "Seit 2021 / ästhetische Medizin" (Schrägstrich mit Leerzeichen = Zeilenumbruch auf der Startseite); Rahmen um die letzte Station seit 129 entfernt; Desktop: Linie bis zum Kreis, Punkte direkt danach. Handy (127): Zeitstrahl nach Manuels Vorlage weiter rechts (16,5 % Einzug), Beschriftungen exakt auf Kreismitte. Letzter Kreis weiß, bis die Zeitleiste ihn erreicht.
- "Dein Weg zur Behandlung": Text mittig, Nummern kräftiger; am Handy richtet sich die Schriftgröße nach dem längsten Wort ("Dokumentation").
- Übergang zum Kontakt-Band ohne Linie: Sanduhr sitzt auf der Kante (oben dunkelblau, unten hell). Kontakt-Etikett grün.
- Fußzeile: Impressum ganz links, Logo mittig, Datenschutz ganz rechts.
- Preisliste: keine gemeinsame Karte mehr, "Alle Behandlungen" mittig, Hinweis (MwSt. usw.) unter der Liste.
- Hintergrund Startseite (124, Übergänge besonders weich): Querstreifen synchron zu den Abschnitten – Startbereich, "Was ich für Dich tun kann" und "Dein Weg zur Behandlung" hellblau getönt, "Über mich" fast weiß, weiche Übergänge; kein Flieder.
- Preisliste (123): aktueller Preis fett auf der Zeile der Behandlung, alter durchgestrichener Preis klein darunter.

## Stand Version 133

- Kontakt-Band (`ka_contact_band()` in `inc/views.php`) auf der Startseite und allen Unterseiten außer "Kontakt"; sitzt direkt über der Fußzeile. In der Vorschau fügt `stub_tpl.php` es ebenfalls ein.
- Schwebender WhatsApp-Knopf blendet aus, sobald Kontakt-Band oder Fußzeile sichtbar sind (`script.js`, Body-Klasse `kon-in`).
- Fußzeile am Handy ohne Einrückung rechts.
- Startseite: "Hi, ich bin Manuel." und Unterzeile mittig in der Textspalte (Quicksand bleibt).

## Einheitliche Gestaltung (seit 132)

Am Ende von `style.css` stehen Gestaltungs-Variablen: `--r-card` (Karten-Rundung 22 px, Handy 18 px), `--r-small` (12/11 px für Aufklapper und Eingabefelder), `--sh-card` (einheitlicher Kartenschatten), `--bd-card` (Kartenrand). Regeln:
- Alle Karten (Kacheln, Behandlungskarten, Schritte, Preisgruppen, Checkliste, Formular, Rechtstexte) nutzen dieselbe Rundung, denselben Schatten und denselben Rand.
- Etiketten über Überschriften überall als grüne Pille.
- Abschnittsüberschriften (h2) Literata 42/31 px, mittig; nur auf den zweispaltigen Seiten "Über mich" und "Kontakt" linksbündig.
- Zwischenüberschriften (h3) Literata 400, 24/22 px; Schritt-Titel Quicksand 700.
- Alle Knöpfe Schriftstärke 700, Pillenform.
- Ablaufseite: Schritte wie Startseite (Symbol als Wasserzeichen, keine Nummer).
- Bewusste Ausnahme: "Hi, ich bin Manuel." und "Meine Philosophie" im Startbereich in Quicksand (nach Manuels Vorlage).
- Werte Startseite: Professionalität / Authentizität / Inklusivität (Erklärung auf "Über mich").

## Arbeitsweise ab Theme 133 (Wunsch von Manuel)

- Neue Theme-ZIPs und Versionsnummern NUR, wenn Manuel ausdrücklich sagt, dass eine neue Version gemacht werden soll. Bis dahin nur die Vorschau aktualisieren.
- `theme-quelltext/` enthält bereits Änderungen nach ZIP 133 (Startbereich: Name, Unterzeile, Sanduhr-Trenner und "Meine Philosophie" exakt auf einer Mittelachse). ZIP 136 enthält alle Änderungen bis Vorschau 184. Beim nächsten ZIP Version auf 137 setzen.
- Außerdem seit ZIP 133 (seit ZIP 134 enthalten): Startbereich Desktop als festes Zwei-Spalten-Raster (Porträt füllt linke Spalte, Kopf immer auf Höhe des Textes, weiches Ausblenden unten/rechts/links); die vier Kacheln sitzen im angepinnten Block direkt unter dem Porträt; Startseite "Dein Weg zur Behandlung": kurze Titel (Anfrage, Erstgespräch, Behandlung, Nachsorge), kompaktere Karten, größere Schrift, Hinweis "Erstgespräch und Behandlung können am selben Tag stattfinden, müssen aber nicht" (Feld `abl_same_day`) mit grüner gestrichelter Klammer NUR auf der Ablaufseite.
- Startbereich Desktop (ab "v136" in style.css): exakt nach Manuels Vorlage nachgebaut. Alle Positionen und Schriftgrößen in `--u` = min(1vw,16px), Elemente absolut positioniert relativ zur Unterkante der Unterüberschrift; Kacheln ebenfalls in `--u` (Titel "Ablauf & FAQ" nur in der Kachel). Vorlage: Manuels Screenshot (825 px breit), 1 u = 8,25 px der Vorlage.
- (älter) Porträt Desktop: absolut in der Textspalte verankert; die Kopfoberkante liegt im Bild bei 16,5 % der Höhe, per `translateY(calc(-16.5% - 14px))` sitzt sie immer 14 px über "Hi, ich bin Manuel." (bei allen Breiten nachgemessen). Text rechts in der Spalte ab 50 %.

- Seit v137 (seit ZIP 134 enthalten): kein Leerraum mehr unter dem Startbereich (`.pin::after{height:0}`). Die Seite scrollt beim ersten Scrollen normal weiter, die Kopfleiste setzt sich dabei zusammen. Logo und Schriftzug werden in `script.js` (anim) so begrenzt, dass sie nie über ihre Zielposition in der Leiste hinausschießen: Sie fahren direkt dorthin und rasten ein; der Schriftzug schrumpft dabei passend zur zurückgelegten Strecke (M.S0 = Startposition) und kommt in Endgröße an. Logo, Leiste (Größe und Deckkraft) und Schriftzug laufen mit demselben Fortschritt (P = Fortschritt des Schriftzugs): Logo fährt nach links, Schriftzug nach oben, beide werden gleichzeitig kleiner und rasten im selben Moment ein. Nach dem Einrasten (M.done) bekommt der Body die Klasse `intro-collapsed`: "Willkommen bei" und der große Schriftzug verschwinden, oben bleibt nur die Unterüberschrift (seit v140 kein zweites Logo mehr); die Scrollposition wird um die entfallene Höhe korrigiert, damit nichts springt. Bei späteren Besuchen (head-done) sieht der Kopf genauso aus.

- Kopfleiste seit v140 ganz leicht durchscheinend (Deckkraft 86 %, 3 px Unschärfe).

- v141 (seit ZIP 134 enthalten): Chat-Abschluss mit zwei Pillen (E-Mail dunkel links, WhatsApp hell rechts, mit Symbolen), "ersten" aus dem Hinweis entfernt, "Noch eine Frage" rechts; Chat-Bereich als eigene Karte. Etikett-Abstand zur Überschrift größer (überall). Kontakt-Band: statt "Termine vergebe ich…" klickbare E-Mail-Adresse und WhatsApp-Nummer (`ka_phone_display()`). Über jedem Kontakt-Band Textlink "<nächste Seite> →" (seit v158 ohne "Weiter:") (Start→Behandlungen→Über mich→Ablauf und FAQ→Kontakt; Rechtliches→Startseite; über `$GLOBALS['ka_view']`). Preisliste: Unterkategorien (seit v146) als eigene, leicht hellblau getönte Blöcke mit dunkelgrüner Überschrift (div.subgrp, Suche filtert pro Block), Kategorie-Etikett dunkelgrün, "Nefertiti" ohne "komplett", "Alle Behandlungen" mittig (mit eigenem Aufklapp-Pfeil, Pfeil+Text exakt in Bildschirmmitte; Lupe links, hellgrau, ohne Fläche), Einleitung und Gruppenbeschreibungen in Lora (lokal in assets/fonts). Ablaufseite: Schritt 4 wieder "Dokumentation & Nachsorge", Zeilenumbruch nach "&", engerer Zeilenabstand, Erstgespräch + Aufklärung & Behandlung grün gestrichelt umrandet (gleiche Markierung vor dem Hinweis "am selben Tag"). Schwebender Knopf mit WhatsApp-Symbol. Kopf-Animation etwas langsamer (Fortschritt = Scrollweg / (1,35 × Strecke), max. PIN).

- v142: Alle Begleittexte unter Überschriften (Einleitungen, Karten- und Gruppenbeschreibungen, Schritte, FAQ-Antworten (Fließtext auf Über mich seit v149 wieder Quicksand), Rechtstexte, Text im Startbereich) in Lora; Zeilenabstand überall geringer (Fließtext 1,55, Begleittexte 1,5).

- v147: Über mich nutzt das freigestellte Porträt (assets/portrait-cutout.webp) ohne Rahmen/Schatten; Handy: unten weich ausgeblendet, Desktop: unten und seitlich leicht ausgeblendet.

- v148: Über mich – Etikett und "Hallo, ich bin Manuel!" mittig in der Textspalte; darunter "Ich lebe und arbeite in Berlin-Kreuzberg." (Feld hero_sub) kursiv in Lora, per script.js exakt auf die Breite der Überschrift skaliert; der Satz wird dafür aus dem Haupttext entfernt. Lora kursiv lokal eingebunden.

- v150: Über mich – Werte als drei Kacheln nebeneinander (Professionalität / Authentizität … / Inklusivität); ein Tipp klappt darunter eine Karteikarte über die volle Breite auf (bei "Authentizität & Integrität" mit Überschrift "… Integrität"). Werte ohne Text (z. B. "Fokus auf Longevity") bleiben Überschrift; Longevity-Abschnitt (v151) in dunkelblauer Karte (.lon-box) wie auf der Behandlungsseite.

- v154: "Meine Philosophie und Werte" mittig; Über mich am Handy ohne Zeitlinie (Stationen als Liste, Texte immer sichtbar); Kontakt-Band überall mittig, Überschrift "Schreibe mir einfach" ohne Punkt, Zeile mit E-Mail/WhatsApp-Text wieder entfernt (die Knöpfe öffnen E-Mail bzw. WhatsApp mit vorausgefülltem Text).
- Werte-Reiter: Variante 2 eingebaut (v155) – grüne Linie im aktiven Reiter unten, in der Karte oben.

- v156: Zeitstrahl "Mein Weg" auf der Über-mich-Seite komplett entfernt (die Infos stehen im Fließtext); auf der Startseite bleibt er.

- v157: Über mich – erster Absatz (Leitgedanke "In meiner Praxis geht es mir darum …") hervorgehoben: Lora kursiv, größer, dunkelblau, weiße Karte mit grünem Streifen links.

- v158: Über mich – "Meine Philosophie und Werte" samt Werte-Reitern in hellblau getöntem, hervorgehobenem Block (.phil-box); Longevity zurückhaltend ohne dunkle Karte, nur mit feiner Trennlinie darüber.

- v160: Leitgedanke-Karte rundum abgerundet, ohne Schatten. Sanduhr-Trenner zwischen Philosophie und Longevity. Abschnitt heißt nur "Longevity", Überschrift mittig, grünes Blatt als Wasserzeichen, darunter Satz aus Feld `about_lon_cta` ("Wenn Dich das Thema interessiert, sprich mich gern direkt darauf an.").

- v161: Biografie-Absatz auf Über mich mit größerem Zeilenabstand (1,8); Longevity-Schlusssatz zurückhaltend (kursiv, grau, normal).

- v162: Über mich – Biografie in zwei Absätzen; Qualifikationen-Liste (Feld `about_quals`, nur gesicherte Angaben, Fortbildungen ergänzbar); optionales Praxisfoto (Feld `about_practice_img`, leer = aus); erster Wert beim Laden aufgeklappt; Porträt am Desktop läuft beim Scrollen mit (sticky); Einladung "Lerne mich im Erstgespräch persönlich kennen." (Feld `about_invite`) seit v165 auf der Über-mich-Seite statt "Schreibe mir einfach" als Überschrift des Kontakt-Bands (kleiner, h2.kon-invite).

- v163: Werte auf Über mich als Aufklappliste (details.vrow in .vlist): Symbol, voller Titel, Pfeil; erster Wert offen, immer nur einer offen (script.js). Ersetzt die Reiter/Karteikarten (vtab/vpanel).

- v166: Alle Knöpfe (.btn, .cbtn) federn beim Überfahren mit der Maus leicht hoch (Feder-Kurve) und werden minimal größer; Symbol und Text darin wachsen zusätzlich mit (Faktor 1,25 seit v171) und bleiben so, solange die Maus darauf ist (v169: script.js packt den Knopfinhalt in span.bt-in, das als Ganzes skaliert wird – vorher wuchsen reine Textteile nicht mit). Nur bei Maus, nicht bei "Bewegung reduzieren".

- v167: Startbereich – Text "Ich biete Dir …" in Quicksand mit Zeilenabstand 1,55 (am Handy war er durch einen Rechenfehler auf 8 px gestaucht); Unterzeile "Ich lebe und arbeite …" kursiv in Lora wie auf Über mich, am Handy einzeilig.

- v168: Hover-Federn kräftiger (Knopf 1,05, Inhalt 1,12) und zusätzlich für Chat-Auswahlknöpfe, Textlinks zur nächsten Seite, Links in Kopfleiste/Seitenmenü und die Werte-Zeilen.

- v172 (in ZIP 135): Behandlungsseite am Handy – Kategorien (Neuromodulator, Filler und Booster, Haut und Körper, Longevity, Pakete) als Aufklapp-Karten mit Pfeil, immer nur eine offen, erste offen; bei aktiver Suche alle offen. Desktop unverändert.

- Preisliste (in ZIP 135): Hyaluron-Filler "0,5 ml" und "1,0 ml"; "Hyaluronidase (Auflösen von Hyaluron)" – der Klammerteil erscheint klein in der nächsten Zeile.

- v173 (in ZIP 135): Behandlungen – Longevity ist keine Aufklapp-Karte mehr, sondern steht als Abschluss nach der Preisliste (Sanduhr-Trenner, Überschrift mittig, Blatt-Wasserzeichen, Satz aus `about_lon_cta`); Pakete ist damit die letzte Karte. MwSt.-Hinweis kleiner und hellgrau. Chat: Antworten der Besucher mit anonymem Personen-Symbol. Kontakt-Band: mehr Abstand zwischen Überschrift und Knöpfen.

- v174 (in ZIP 135): Startseite – Schritt-Titel bei "Dein Weg zur Behandlung" kleiner (Karten am Handy niedriger); Zeitstrahl-Titel fein (500), nur "Kreuzberg Ästhetik" fett; Fußzeilen-Logo verlinkt zur Startseite; "Zur Liste" mit Listen-Symbol, "Zum Chat" mit Sprechblase (neues Symbol "list" in icons.php).

- v175 (in ZIP 135): WICHTIG – ka_render() legt jetzt wie die Vorschau ein <div class="kview" data-view="…"> um den Inhalt (home, ueber-mich, leistungen, ablauf, kontakt, impressum). Viele Regeln in style.css hängen an .kview[data-view=…]; bis ZIP 134 fehlte diese Hülle auf der Live-Seite, daher sah z. B. die Behandlungsseite dort anders aus (Überschrift links, Lora-Texte). Begleittexte unter Überschriften wieder Quicksand (Lora nur Leitgedanke und Unterzeilen "Ich lebe und arbeite …"). Pakete gekürzt auf 2× PLLA, 4× Retinol-Peeling, 3× Polynukleotide, Lip-Flip + "Weitere Pakete | auf Anfrage". Kategorie-Etiketten in der Preisliste größer.

- v176 (in ZIP 136): Infoboxen zu allen Behandlungen. Feld `treat_info` (eine Zeile pro Behandlung: Name | Was ist das? | Dauer | Ausfallzeit | Wirkung | Hält ca. | Produkt | Gut zu wissen). Kleiner "i"-Knopf an der Zeile bzw. Unterkategorie (Mimische Falten, Hyaluron-Filler) klappt die Box auf, immer nur eine offen. Inhalte als Übersicht in `infoboxen-behandlungen.md`. OFFEN: fachliche Prüfung durch Manuel, Produkte bestätigen, HWG-Prüfung (keine Markennamen bei verschreibungspflichtigen Arzneimitteln: Botulinumtoxin, Hyaluronidase), Lemon Bottle/Exosomen rechtlich prüfen.

- v177/178 (in ZIP 136): Infoboxen als kleines Overlay am „i“ (verdrängt nichts mehr), Botox-Hinweis „allgemein als Botox bekannt“, keine unbelegten Verhaltenshinweise, Lemon Bottle entfernt. Kontaktseite: Etikett/Überschrift mittig, E-Mail- und WhatsApp-Knöpfe unter dem Text, „über das Formular“ gestrichen. FAQ „Wie läuft die Nachsorge?“ um Dokumentation und langfristigen Plan ergänzt. Ablaufseite Handy: senkrechte Linie zwischen den Karten, Kästchen vor dem Hinweis entfernt. Über mich: Philosophie-Block dunkelblau; Porträt am Handy kleiner, rechte Kante (Foto endet an der Schulter) weich ausgeblendet. OFFEN: Produktliste von Manuel für die Infoboxen.

## Versionsnummer (wichtig)

- Die Nummer steht im Kopf von `style.css` (`Version: 136`) und muss bei JEDEM neuen ZIP hochgezählt werden; sie entspricht der Nummer im ZIP-Namen.
- WordPress zeigt sie unter Design → Themes, in der schwarzen Admin-Leiste ("Theme 136", nur für angemeldete Admins) und als Kommentar am Ende des Seitenquelltexts.
- Bis Version 119 stand dort fest "1.2.2". Deshalb lieferten Browser und Caches teils alte CSS-/JS-Dateien aus. Seit 120 hängt an jeder Datei Version + Änderungszeit, damit nach einem Update sicher die neuen Dateien geladen werden.

## Hinweise für die neue Sitzung

- Die Vorschau entsteht so: Theme-Ordner nach `theme3/kreuzberg-aesthetik/` legen, `bash mk.sh` ausführen (ruft `build3.py` auf und bettet Bilder als data-URIs ein), Ergebnis `kt3d.html` als Artifact an dieselbe URL veröffentlichen. Benötigt PHP und die Bilddateien `portrait.jpg`, `logo-light.png`, `logo-dark.png`, `hg-line.png`, `portrait-cutout.webp`, `avatar.webp` neben den Skripten (alle im Ordner `theme-quelltext/assets/`).
- Ein Git-Repository gibt es für dieses Projekt nicht.

## Stand Version 109

- Abschnitte der Startseite nach Variante B: durchgehender sanfter Verlauf, keine schwebenden Kästen, Sanduhr-Trennlinien, Kontakt als kompaktes navy Band über die volle Breite.
- Kopfanimation einmal pro Sitzung (Schlüssel `ka_head_done_109` in sessionStorage, Ersatz über window.name). Bei späteren Aufrufen der Startseite ist die obere Begrüßung (Willkommen bei / Kreuzberg Ästhetik / Untertitel) unsichtbar, die Leiste steht oben. Beim Ändern der Animation den Schlüssel hochzählen, damit sie wieder einmal läuft.
- Kacheln: Hover nur bei Maus; "Ablauf und FAQ" statt "Ablauf und Fragen" (auch Menü).
- Zeitstrahl Startseite: nur Überschriften (Studium der Humanmedizin in Würzburg und München / Ein Jahr in Valencia / Facharztausbildung zum Pathologen in Berlin / Seit 2021 ästhetische Medizin / Kreuzberg Ästhetik); letzte Station größer in einem Rahmen, der erst beim Erreichen einblendet (Desktop: Name einzeilig unter dem Kreis; Handy: Zeitstrahl mittig, Name einzeilig neben dem Kreis, lange Titel zweizeilig); nach der letzten Station nur Punkte. Überschrift für "Ein Jahr in Valencia" und Kreuzberg Ästhetik hat Manuel noch nicht neu formuliert.
- "Dein Weg zur Behandlung" (statt "So läuft ein Termin"): Desktop: vier kompakte Karten nebeneinander; Handy (128, nach Manuels Entwurf): senkrechte graue Mittellinie, Karten abwechselnd links/rechts versetzt, Text mittig, große Nummer als Wasserzeichen über die Kartenhöhe, kurze Verbindungsstriche mit kleinem Punkt an der Linie, mit Verbindungslinie, Nummern und Symbolen als Wasserzeichen, größere Beschriftung (weiche Trennstellen in den Titeln); "Aufklärung & Behandlung" und "Dokumentation & Nachsorge" dreizeilig.
- Handy quer (bis 700 px Breite): Porträt und Text nebeneinander.
- Kontakt-Pillen oben mit Symbolen und gleich breit (ebenso die drei Kontaktknöpfe unten); Fußzeile flach: Impressum | Logo | Datenschutz, direkt unter dem Kontakt-Band. Seitenmenü: Sanduhr groß (76 px) und mittig oben.

## Veröffentlichung auf die Website (seit 5. November 2026)

Die Website kreuzberg-aesthetik.de wird per SFTP aktualisiert, ohne ZIP-Upload:

1. Änderungen im Arbeitszweig (`ccr-…`) committen und pushen, Pull Request nach `main` öffnen und übernehmen.
2. In GitHub (Repo KreuzbergAesthetik/wordpress) unter Actions den Ablauf **„Zu IONOS übertragen“** starten, Zweig `main`, Haken „veröffentlichen“.
3. Manuel gibt in der Umgebung `ionos-production` frei („Review deployments“, „Approve and deploy“). Die Freigabe kann nur Manuel geben.
4. Danach in WordPress den Autoptimize-Cache leeren und „Theme <Version>“ in der Admin-Leiste prüfen.

Wichtig: Der SFTP-Zugang beginnt im Ordner `wp-content`. Das Geheimnis `IONOS_THEME_PATH` lautet deshalb `/themes/kreuzberg-aesthetik`. Weitere Geheimnisse (in der Umgebung `ionos-production`): `IONOS_HOST`, `IONOS_USER`, `IONOS_PASSWORD`, `IONOS_KNOWN_HOSTS`. Hilfsabläufe: **„IONOS Server-Schlüssel abrufen“** und **„IONOS Ordner anzeigen“** (laden nichts hoch). Die Übertragung löscht nichts auf dem Server. Aktiv in WordPress ist der Ordner `kreuzberg-aesthetik`, deshalb ist eine Übertragung sofort live.
