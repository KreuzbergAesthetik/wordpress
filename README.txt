Kreuzberg Ästhetik, WordPress-Theme

INSTALLATION
1. WordPress: Design > Themes > Neues Theme hinzufügen > Theme hochladen > ZIP wählen > Installieren > Aktivieren.
   (Bei WordPress.com ist das Hochladen eigener Themes nur im Business-Tarif oder höher möglich.)
2. Seiten anlegen (Seiten > Erstellen) mit genau diesen Seitenadressen: Über mich = ueber-mich, Leistungen = leistungen, Ablauf = ablauf, Kontakt = kontakt. Der Inhalt dieser Seiten bleibt leer, das Theme setzt ihn selbst ein. Die alte Adresse /fragen/ leitet auf /ablauf/#fragen weiter. Impressum und Datenschutz sind normale Seiten mit eigenem Text, das Theme findet sie automatisch.
3. Einstellungen > Lesen: als Startseite die Seite "Startseite" wählen oder "Neueste Beiträge" lassen. Das Theme zeigt die Startseite automatisch.
4. In functions.php: KA_DRAFT steht auf false (live). Mit true erscheinen ein Entwurfs-Hinweis und offene [Stellen] werden markiert. KA_MAIL_TO ist der Empfänger des Kontaktformulars.
5. Nach der Installation prüfen: Kontaktformular mit einer Testnachricht abschicken, Menü "Inhalte" öffnen, Impressum und Datenschutz verlinkt? Cache-Plugins (z. B. Autoptimize) einmal leeren.

TEXTE UND PREISE ÄNDERN
Alles (Texte, Preise, Fragen, Chat-Themen, Namen) steht in WordPress im Menü "Inhalte" in der linken Leiste. Ein leeres Feld zeigt wieder den ursprünglichen Text. Text in [eckigen Klammern] sind noch zu ergänzende Stellen.

WAS DAS THEME KANN
- Startkarte: Begrüßung, Foto, "Hi, ich bin Manuel.", Text und Button.
- Kopfleiste: Beim ersten Scrollen steht die Seite still. Die Leiste blendet von vorn ein und der Schriftzug schrumpft hinein. Danach scrollt die Seite normal. Bei niedrigen Fenstern oder reduzierter Bewegung bleibt die Leiste fest oben.
- Sanduhr-Logo: Sobald die Leiste oben ist, dreht sich die Sanduhr einmal (nur einmal pro Sitzung), danach steht das Logo ohne Sand. Im Seitenmenü läuft sie beim ersten Öffnen einmal.
- Menü: Seitenmenü mit Darstellung (Hell, Dunkel, Wie Gerät) und Schalter "Animationen reduzieren".
- Leistungen und Preise mit Suche und einem Gespräch zum Antippen (Chat), das auf WhatsApp weiterleitet.
- Ablauf und Fragen, Über mich mit Zeitleiste, Kontakt mit Formular (E-Mail über den WordPress-Server, mit Spamschutz).
- Nachrichten laufen über WhatsApp, nicht SMS.
- Schriften (Literata, Quicksand) liegen im Theme, es werden keine Daten an Google übertragen.
- Der Tages- und Nachtverlauf des Hintergrunds folgt der Scrollposition.

HINWEISE ZUM BILD
Das Foto auf der Startseite und auf der Seite "Über mich" wird per Filter leicht entsättigt. Für ein dauerhaft sauberes Ergebnis das Foto besser in einem Bildprogramm bearbeiten (Farbton, Weißabgleich) und unter "Inhalte" bei Portrait die Bildadresse eintragen.
