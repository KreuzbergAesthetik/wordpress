Kreuzberg Ästhetik, WordPress-Theme

INSTALLATION
1. WordPress: Design > Themes > Neues Theme hinzufügen > Theme hochladen > ZIP wählen > Installieren > Aktivieren.
   (Bei WordPress.com ist das Hochladen eigener Themes nur im Business-Tarif oder höher möglich.)
2. Seiten anlegen (Seiten > Erstellen) mit genau diesen Seitenadressen: Über mich = ueber-mich, Behandlungen = leistungen, Ablauf = ablauf, Kontakt = kontakt. Der Inhalt dieser Seiten bleibt leer, das Theme setzt ihn selbst ein. Die alte Adresse /fragen/ leitet auf /ablauf/#fragen weiter. Impressum und Datenschutz sind normale Seiten mit eigenem Text, das Theme findet sie automatisch.
3. Einstellungen > Lesen: als Startseite die Seite "Startseite" wählen oder "Neueste Beiträge" lassen. Das Theme zeigt die Startseite automatisch.
4. In functions.php: KA_DRAFT steht auf false (live). Mit true erscheinen ein Entwurfs-Hinweis und offene [Stellen] werden markiert. KA_MAIL_TO ist der Empfänger des Kontaktformulars.
5. Nach der Installation prüfen: Kontaktformular mit einer Testnachricht abschicken, Menü "Inhalte" öffnen, Impressum und Datenschutz verlinkt? Cache-Plugins (z. B. Autoptimize) einmal leeren.

TEXTE UND PREISE ÄNDERN
Alles (Texte, Preise, Fragen, Chat-Themen, Namen) steht in WordPress im Menü "Inhalte" in der linken Leiste. Ein leeres Feld zeigt wieder den ursprünglichen Text. Text in [eckigen Klammern] sind noch zu ergänzende Stellen.

WAS DAS THEME KANN
- Startkarte: Begrüßung, Foto, "Hallo, ich bin Manuel.", Text und zwei Knöpfe (Behandlungen, Kontakt).
- Kopfleiste: Beim ersten Scrollen steht die Seite still. Die Leiste blendet von vorn ein und der Schriftzug schrumpft hinein. Danach scrollt die Seite normal. Bei niedrigen Fenstern oder reduzierter Bewegung bleibt die Leiste fest oben.
- Sanduhr-Logo: Sobald die Leiste oben ist, dreht sich die Sanduhr einmal (nur einmal pro Sitzung), danach steht das Logo ohne Sand. Im Seitenmenü läuft sie beim ersten Öffnen einmal.
- Menü: Seitenmenü mit Darstellung (Hell, Dunkel, Wie Gerät) und Schalter "Animationen reduzieren".
- Behandlungen (Preisliste) mit Suche und einem Gespräch zum Antippen (Chat), das auf WhatsApp weiterleitet.
- Ablauf und Fragen, Über mich mit Zeitleiste, Kontakt mit Formular (E-Mail über den WordPress-Server, mit Spamschutz).
- Nachrichten laufen über WhatsApp, nicht SMS.
- Schriften (Literata, Quicksand) liegen im Theme, es werden keine Daten an Google übertragen.
- Der Tages- und Nachtverlauf des Hintergrunds folgt der Scrollposition.

HINWEISE ZUM BILD
Das Foto auf der Startseite und auf der Seite "Über mich" wird per Filter leicht entsättigt. Für ein dauerhaft sauberes Ergebnis das Foto besser in einem Bildprogramm bearbeiten (Farbton, Weißabgleich) und unter "Inhalte" bei Portrait die Bildadresse eintragen.


GESTALTUNGS-STANDARDS (verbindlich für alle weiteren Sitzungen, Stand Version 174)
Diese Regeln gelten für jede Änderung am Theme. Wer etwas Neues baut, nimmt die Werte von hier und erfindet keine eigenen.

Grundsätze
- Im Zweifel immer die elegantere, ruhigere, stilvollere Variante wählen.
- Einheitlich vor originell: Bestehende Muster und Animationen wiederverwenden, nichts doppelt neu erfinden.
- Im Zweifel ein Symbol oder eine Beschriftung weglassen, statt etwas zu quetschen.
- Jede Änderung in hell und dunkel und auf allen Geräten prüfen (siehe "Prüfen").
- Von Manuel einzeln abgestimmte Dinge (Startbereich, Porträt, Chat, Kopfleiste) nur auf ausdrücklichen Wunsch verändern.

Farben
- Praxisblau #012265 (Überschriften, gefüllte Knöpfe, dunkler Grundton). Grün #004d17 (Etiketten, Symbole), im Dunkelmodus #9be8b0.
- Hell: Seitenhintergrund überall #f5f8fd. Nebentext mindestens #5b6b8c (Kontrast mindestens 4,5:1), nichts Blasseres.
- Dunkel: Grundton Praxisblau, Variablen --dk-card, --dk-line, --dk-mute, --dk-green. Kein Schwarz, kein Grau als Fläche.
- Chat: Kopf Verlauf #012265 > #0c3290 > #3a63c7, Fußleiste gespiegelt. Blasen Manuel #eeeff2, Besucher #e3eaf8.

Schriften
- Literata: Überschriften. Quicksand: Fließtext, Knöpfe, Etiketten. Lora: Unterzeilen und Leitgedanke.
- Mindestgrößen: Fließtext 13 px, Zusatzzeilen 11,5 px, Etiketten 11 px. Nichts kleiner.

Knöpfe
- Eine Form für alle Textknöpfe: Pille, 36 px hoch, Schrift 15 px in mittlerer Stärke (500), Symbol 17 px. Nicht fett, nicht höher.
- Symbol und Text bilden eine Einheit und stehen zusammen mittig, auch in der Höhe.
- Gefüllt = Hauptaktion, Umriss = Nebenaktion. Pro Gruppe höchstens ein gefüllter Knopf.
- Ausnahmen: Startbereich am Desktop skaliert mit dem Bild (42 px bei 1440 px Breite). Runde Symbolknöpfe: Kontaktband 36 px, Termin-Knopf im Chat 48 bis 57 px, schwebender Nachrichtenknopf 56 px (Handy 48 px).
- Tippfläche: mindestens 44 px. Flache Knöpfe und kleine Symbole bekommen dafür eine unsichtbare Erweiterung (::after mit negativem inset), die Optik bleibt flach.
- Dunkel: helle Knöpfe ohne Schatten, beim Überfahren ein sanftes Leuchten (Halo) statt Schatten.

Animationen
- Ein Tempo und eine Kurve für alles, was auf Überfahren oder Antippen reagiert: 0,3 s, cubic-bezier(.25,.8,.35,1). Kein Nachfedern.
- Überfahren: leichtes Wachsen (3 bis 5 %), Farben blenden weich um, nie schlagartig.
- Aufklapper (Fragen, Werte, Behandlungskarten): Inhalt blendet weich ein (ka-open, 0,35 s). Es ist immer nur einer offen.
- Scroll-Effekte (Kopfleiste, Zeitstrahl, Ablauf, Füllen der Symbole) hängen am Scrollweg, nicht an einer Uhr.
- "Animationen reduzieren" und die Systemeinstellung setzen die Klasse calm auf <html>: Dann läuft nichts, alles steht im Endzustand. Neue Animationen immer mit html:not(.calm) schreiben.
- Hell: Tiefe durch Schatten. Dunkel: Tiefe durch Leuchten.

Karten und Abstände
- Rundung, Schatten und Rand kommen aus den Variablen --r-card (22 px, Handy 18 px), --r-small (12 px, Handy 11 px), --sh-card, --bd-card. Keine eigenen Werte.
- Etiketten über Überschriften sind grüne Pillen. Abschnitte trennt die Sanduhr-Linie.

Geräte
- Handy: bis 700 px Breite. Eine Spalte, Porträt mittig.
- Tablet hochkant (701 bis 900 px, Hochformat): Startbereich wie Desktop, aber auf volle Breite vergrößert (--u: 1.22vw).
- Querformat und Desktop (ab 701 px): Startbereich in --u = min(1vw, 16px), Text links, Porträt rechts. Behandlungskarten zweispaltig (links Filler und Haut, rechts Neuromodulator und Pakete).
- Nirgends seitliches Scrollen. Der schwebende Nachrichtenknopf ist ausgeblendet, solange der Text des Startbereichs, das Kontaktband, das Formular oder die Fußzeile zu sehen ist.

Technik beim Schreiben von CSS
- Neue Regeln ans Ende von style.css, mit kurzem Kommentar und Versionsnummer.
- Wenn eine Regel sicher gewinnen muss: html:not(#ka) davor setzen, statt lange Selektor-Ketten zu bauen.

Prüfen (vor jedem "fertig")
- Größen: 390x844 (Handy), 768x1024 (Tablet hoch), 1024x768 (Tablet quer), 844x390 (Handy quer), 1440x900 (Desktop). Jeweils hell und dunkel.
- uebergabe/audit.js prüft alle Seiten auf Überstand, Kontrast, zu kleine Schrift und zu kleine Tippflächen und legt Bilder ab. Es muss ohne Überstand und ohne Kontrastfehler durchlaufen.
- Veröffentlicht wird nur auf Manuels ausdrücklichen Befehl. Ablauf siehe uebergabe/UEBERGABE.md.
