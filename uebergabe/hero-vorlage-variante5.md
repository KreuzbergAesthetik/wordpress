# Kreuzberg Ästhetik: Hero für Claude

Stand: Theme 1.3.2, ausgewählte Variante 5, mit nach links auslaufender blauer Fläche.

## Umfang

Nur der Hero: freigestelltes Porträt, Begrüßung, Praxisname, Praxisbeschreibung, grüner Trennstrich, persönliche Vorstellung und Terminlink. Keine Kopfzeile/Navigation, keine Kontaktkarten, kein Terminhinweis darunter, keine weiteren Sektionen.

## Hinweise zur Weiterbearbeitung

- Bestehende Texte und Leistungen beibehalten. Keine neuen Aussagen erfinden.
- Die Transparenz liegt ausschließlich auf dem Hintergrund-Pseudoelement. Text und Porträt bleiben deckend.
- Desktop: Porträt links überlappend, mit weichem Ausblenden unten. Mobil: Porträt oberhalb des Textes.
- Die Hero-CSS-Regeln sind aus dem aktuellen Theme in Originalreihenfolge extrahiert. Spätere Regeln überschreiben frühere. Nicht umsortieren, ohne die Kaskade aufzulösen.
- Der Klassenkontext `home-page` ist erforderlich und im HTML enthalten.
- Für diesen Ausschnitt wird kein JavaScript benötigt. Die Animation der Kopfzeile gehört nicht dazu.
- Die CSS-Grundlage stellt die sonst geerbten Schriften, Farben, Boxgrößen und Knopfstile bereit.
- Der globale Tages-/Nachtverlauf ist nicht enthalten. Der Dokumenthintergrund entspricht dem hellen Ausgangszustand.

## Externe Dateien

Diese lesbare Textdatei enthält keine eingebetteten Bild- oder Schrift-Binärdaten. Für eine visuell vollständige Umsetzung werden die vorhandenen Dateien aus dem Theme benötigt:

- `assets/portrait-cutout.png`
- `assets/fonts/quicksand-normal-400-latin.woff2`
- `assets/fonts/literata-normal-400-latin.woff2`

In WordPress die Asset-Pfade mit `get_theme_file_uri()` auflösen. Der vorhandene Terminlink `/kontakt/` kann mit `home_url('/kontakt/')` erzeugt werden.

## HTML

Der Dokumentrahmen dient nur zur separaten Darstellung, er enthält keinen Website-Header. Das semantische `header`-Element im Code bezeichnet ausschließlich den Hero.

```html
<!doctype html>
<html lang="de" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kreuzberg Ästhetik: Hero</title>
  <!-- Den CSS-Abschnitt unten hier in ein style-Element einsetzen. -->
</head>
<body class="home-page">
  <main class="hero-only">
<header class="hero hero-v5" id="start">
    <div class="hero-copy"><p class="hero-greeting">Willkommen bei</p>
    <h1 class="hero-brand">Kreuzberg Ästhetik</h1>
    <p class="hero-service">Privatpraxis für ästhetische Medizin &amp; Longevity in Berlin-Kreuzberg.</p><span class="hero-rule" aria-hidden="true"></span>
    
    <figure class="hero-portrait">
      <img src="assets/portrait-cutout.png" width="900" height="1229" alt="Portrait von Manuel Fella">
    </figure>
    <div class="hero-who">
      <h2 class="hero-name">Hi, ich bin Manuel.</h2>
      <p class="hero-sub">Ich lebe und arbeite in Berlin-Kreuzberg.</p>
    </div>
    <p class="hero-text">Professionell, authentisch und offen für jede Person: Ich berate Dich persönlich und nehme mir Zeit für Deine Fragen, bevor wir über eine Behandlung sprechen.</p>
    <p class="hero-cta"><a class="btn glass" href="/kontakt/">Termin anfragen</a></p>
    </div>
  </header>
  </main>
</body>
</html>
```

## CSS

Zuerst die nötigen Basiswerte, danach ausschließlich die Hero-Regeln aus dem bestehenden Theme.

```css
@font-face {font-family:Quicksand;src:url("assets/fonts/quicksand-normal-400-latin.woff2") format("woff2");font-style:normal;font-weight:300 700;font-display:swap;}
@font-face {font-family:Literata;src:url("assets/fonts/literata-normal-400-latin.woff2") format("woff2");font-style:normal;font-weight:200 900;font-display:swap;}
:root {
 --sans:Quicksand,"Segoe UI",sans-serif;
 --serif:Literata,Georgia,serif;
 --navy:#012265;--head:#012265;
 --deep-card:linear-gradient(125deg,#486da9,#244e8b 40%,#012265);
 --shadow:0 12px 30px rgba(1,34,101,.08);
}
* {box-sizing:border-box;}
body {margin:0;font:500 16px/1.75 var(--sans);background:linear-gradient(120deg,#d9ebfc,#b8d9fa 45%,#9fc6f3);}
h1,h2 {margin:0;font-family:var(--serif);font-weight:400;}
p {overflow-wrap:break-word;}
.hero-only {max-width:1536px;margin-inline:auto;padding-inline:3.8vw;}
@media(max-width:700px){.hero-only{padding-inline:18px;}}
.btn {display:inline-block;font:700 .875rem/1.4 var(--sans);padding:.8rem 1.45rem;min-height:46px;border:1px solid transparent;border-radius:999px;text-decoration:none;cursor:pointer;}
.btn:focus-visible {outline:3px solid #58a99a;outline-offset:4px;}

.hero {
  display:grid;
  grid-template-columns:1.2fr .8fr;
  gap:2rem;
  align-items:center;
  background:var(--deep-card);
  color:#fff;
  border-radius:32px;
  box-shadow:var(--shadow);
  padding:3rem 3.2rem;
  margin:2.2rem auto 0;
  max-width:880px
}

.hero h1 {
  color:#fff;
  font-family:var(--sans);
  font-weight:500;
  font-size:clamp(1.6rem,3.6vw,2.4rem);
  line-height:1.35
}

.hero h1 strong {
  font-weight:700
}

.hero p {
  margin:1.2rem 0 1.8rem;
  color:rgba(255,255,255,.92)
}

.hero img {
  width:100%;
  max-width:300px;
  height:auto;
  display:block;
  justify-self:center
}

.hero .btn {
  box-shadow:0 10px 22px rgba(0,8,40,.55),0 2px 4px rgba(0,8,40,.4)
}

@media (max-width:900px) {
.hero {
  grid-template-columns:1fr;
  gap:1rem;
  padding:1.5rem 1.4rem;
  margin-top:1rem;
  text-align:center;
  border-radius:28px
}

.hero img {
  order:-1;
  max-width:96px
}

.hero p {
  margin:.8rem 0 1.2rem
}
}

.hero {
  padding:3.4rem 4.6rem;
  gap:3.6rem;
  margin-top:1.2rem;
  max-width:940px
}

.hero h1 {
  line-height:1.45
}

.hero p {
  margin:1.6rem 0 2.2rem;
  line-height:1.9
}

@media (max-width:900px) {
.hero {
  padding:2.6rem 1.7rem;
  gap:1.6rem;
  margin-top:1.6rem
}

.hero p {
  margin:1.2rem 0 1.8rem
}
}

.hero {
  grid-template-columns:1.25fr .75fr;
  gap:3rem;
  padding:2.8125rem 3.375rem;
  max-width:1000px;
  margin-top:2rem;
  border-radius:28px;
  border:1px solid rgba(255,255,255,.25);
  background:var(--deep-card);
  box-shadow:0 15px 36px rgba(1,34,101,.09)
}

.hero>div {
  position:relative;
  z-index:1;
  min-width:0
}

.hero h1 {
  font-size:clamp(1.65rem,2.8vw,2.1875rem);
  font-weight:500;
  line-height:1.42;
  letter-spacing:-.02em
}

.hero h1 strong {
  display:block;
  font-weight:700
}

.hero p {
  font-size:.9375rem;
  line-height:1.8;
  color:#e5edf9;
  margin:1.25rem 0 1.7rem;
  max-width:31rem
}

.hero img {
  max-width:238px;
  opacity:.95
}

.hero .btn {
  box-shadow:0 4px 14px rgba(0,21,57,.12);
  background:#f9fafc
}

.hero :focus-visible {
  outline-color:var(--gold)
}

@media(min-width:1500px) {
.hero {
  padding-block:3.25rem
}

.hero h1 {
  font-size:2.3125rem
}
}

@media(max-width:1050px) {
.hero {
  padding:2.5rem;
  gap:2rem
}

.hero img {
  max-width:210px
}
}

@media(max-width:900px) {
.hero {
  grid-template-columns:1.2fr .8fr;
  text-align:left;
  padding:2.2rem;
  gap:1.6rem;
  margin-top:1.7rem
}

.hero img {
  order:initial;
  max-width:175px
}

.hero p {
  margin:1.1rem 0 1.5rem
}
}

@media(max-width:700px) {
.hero {
  grid-template-columns:1fr;
  isolation:isolate;
  padding:2rem 1.8rem;
  gap:0;
  border-radius:23px;
  margin-top:1.5rem
}

.hero h1 {
  font-size:1.75rem;
  line-height:1.42
}

.hero p {
  font-size:.875rem;
  line-height:1.9;
  margin:1.2rem 0 1.5rem
}

.hero img {
  position:absolute;
  right:-30px;
  bottom:-32px;
  max-width:none;
  width:270px;
  height:auto;
  opacity:.055;
  z-index:0;
  pointer-events:none
}

.hero .btn {
  font-size:.75rem;
  min-height:45px;
  padding:.8rem 1.3rem
}
}

@media(max-width:370px) {
.hero {
  padding:1.8rem 1.5rem
}

.hero h1 {
  font-size:1.5625rem
}

.hero p {
  font-size:.8125rem
}
}

@media(max-width:700px) {
.hero img {
  position:static;
  order:-1;
  justify-self:start;
  width:72px;
  max-width:72px;
  height:auto;
  opacity:.95;
  margin:0 0 1.4rem;
  z-index:1
}

.hero {
  gap:0
}
}

:root[data-theme="dark"] .hero {
  background:var(--deep-card);
  border-color:rgba(213,227,247,.15)
}

:root[data-theme="dark"] .hero .btn {
  color:#012265;
  background:#f3f6fc
}

.hero {
  grid-template-columns:minmax(0,1fr);
  isolation:isolate
}

.hero>div {
  max-width:38rem
}

.hero img.hero-watermark {
  position:absolute;
  right:18px;
  bottom:16px;
  width:clamp(160px,26vw,280px);
  max-width:none;
  height:auto;
  opacity:.075;
  z-index:0;
  pointer-events:none;
  user-select:none
}

@media(max-width:700px) {
.hero img.hero-watermark {
  right:10px;
  bottom:14px;
  width:180px;
  opacity:.065
}
}

.hero {
  overflow:hidden
}

.hero img.hero-watermark {
  right:calc(clamp(240px,34vw,400px) * -.36);
  bottom:calc(clamp(240px,34vw,400px) * -.36);
  width:clamp(240px,34vw,400px);
  opacity:.16;
  filter:none
}

@media (max-width:700px) {
.hero img.hero-watermark {
  width:230px;
  right:-84px;
  bottom:-84px;
  opacity:.15
}
}

.hero {
  box-shadow:0 26px 54px rgba(1,34,101,.34),0 8px 16px rgba(1,34,101,.2);
  animation:ka-float 7s ease-in-out infinite;
  will-change:transform
}

@media (prefers-reduced-motion:reduce) {
.hero {
  animation:none
}
}

.hero {
  grid-template-columns:minmax(0,200px) minmax(0,1fr)!important;
  gap:1.6rem 3rem!important;
  align-items:center;
  max-width:900px
}

.hero>div,
.hero>.hero-copy {
  max-width:none
}

.hero-portrait {
  margin:0;
  position:relative;
  justify-self:center;
  width:min(100%,200px)
}

.hero .hero-portrait>img:first-child {
  position:static;
  display:block;
  width:100%;
  height:auto;
  max-width:none;
  aspect-ratio:4/5;
  object-fit:cover;
  object-position:50% 22%;
  border-radius:999px;
  opacity:1;
  box-shadow:0 14px 30px rgba(0,8,40,.45);
  border:3px solid rgba(255,255,255,.55)
}

.hero .hero-portrait img.hero-mark {
  position:absolute;
  right:-10px;
  bottom:6px;
  left:auto;
  top:auto;
  width:58px;
  height:58px;
  max-width:none;
  opacity:1;
  background:#fff;
  border-radius:50%;
  padding:5px;
  box-shadow:0 6px 16px rgba(0,8,40,.4);
  z-index:2
}

.hero-cta {
  grid-column:1/-1;
  text-align:center;
  margin:.4rem 0 0!important;
  max-width:none!important
}

.hero .btn.gold {
  background:linear-gradient(180deg,#f3d96a,#e0b93a);
  color:#012265;
  box-shadow:0 10px 22px rgba(0,8,40,.45),0 2px 4px rgba(0,8,40,.3);
  font-weight:700
}

:root[data-theme="dark"] .hero .btn.gold {
  background:linear-gradient(180deg,#f3d96a,#e0b93a);
  color:#012265
}

@media (max-width:700px) {
.hero {
  grid-template-columns:1fr!important;
  text-align:center;
  gap:1.2rem!important
}

.hero-portrait {
  width:150px
}

.hero .hero-portrait img.hero-mark {
  width:48px;
  height:48px;
  right:-12px
}

.hero .hero-copy p {
  margin-inline:auto
}
}

.hero .btn.glass,
:root[data-theme="dark"] .hero .btn.glass {
  background:linear-gradient(180deg,rgba(255,255,255,.26),rgba(255,255,255,.1));
  color:#fff;
  border:1.5px solid rgba(255,255,255,.75);
  box-shadow:0 10px 22px rgba(0,8,40,.4),inset 0 1px 0 rgba(255,255,255,.35);
  -webkit-backdrop-filter:blur(8px);
  backdrop-filter:blur(8px);
  font-weight:700;
  padding-inline:2rem
}

.hero {
  grid-template-columns:minmax(0,210px) minmax(0,1fr)!important;
  gap:1.2rem 2.8rem!important;
  align-items:center;
  text-align:center
}

.hero-copy {
  align-self:center
}

.hero-copy h1 {
  font-size:clamp(1.5rem,2.6vw,2rem);
  line-height:1.4;
  margin:0
}

.hero-copy h1 strong {
  display:inline;
  font-weight:700
}

.hero .hero-name {
  grid-column:1/-1;
  margin:.6rem 0 0;
  font:600 clamp(2rem,4.4vw,3.1rem)/1.15 var(--sans);
  letter-spacing:-.02em;
  color:#fff
}

.hero .hero-text {
  grid-column:1/-1;
  margin:0 auto;
  max-width:36rem;
  font-size:.9375rem;
  line-height:1.75;
  color:#dbe6f7
}

.hero .hero-cta {
  margin-top:.6rem!important
}

@media (max-width:700px) {
.hero {
  grid-template-columns:minmax(0,118px) minmax(0,1fr)!important;
  gap:.9rem 1.1rem!important
}

.hero-portrait {
  width:100%!important
}

.hero-copy h1 {
  font-size:1.15rem;
  text-align:left
}

.hero .hero-name {
  font-size:1.65rem;
  margin-top:.5rem
}

.hero .hero-text {
  font-size:.8125rem;
  line-height:1.7
}
}

.hero .hero-name {
  grid-column:2;
  align-self:center;
  margin:0;
  text-align:left;
  font:600 clamp(1.7rem,3.6vw,2.6rem)/1.2 var(--sans);
  letter-spacing:-.02em;
  color:#fff
}

.hero .hero-h1 {
  grid-column:1/-1;
  margin:.8rem auto 0;
  max-width:34rem;
  text-align:center;
  font-size:clamp(1.45rem,3vw,2.1rem);
  font-weight:500;
  line-height:1.4;
  letter-spacing:-.015em;
  color:#fff
}

.hero .hero-h1 strong {
  display:inline;
  font-weight:700
}

.hero .hero-text {
  margin-top:.2rem
}

@media (max-width:700px) {
.hero .hero-name {
  font-size:1.5rem;
  line-height:1.25
}

.hero .hero-h1 {
  font-size:1.35rem;
  margin-top:.6rem
}
}

.hero {
  grid-template-columns:minmax(0,1fr) minmax(0,1fr)!important;
  gap:1.2rem 2.2rem!important;
  max-width:900px
}

.hero-portrait {
  width:100%!important;
  justify-self:stretch
}

.hero .hero-portrait>img:first-child {
  aspect-ratio:1/1.12;
  border-radius:36% 36% 32% 32%/28% 28% 24% 24%
}

.hero .hero-name {
  font-size:clamp(2rem,5vw,3.4rem)!important;
  line-height:1.15;
  font-weight:600
}

.hero .hero-h1 {
  max-width:none!important;
  font-size:clamp(1.05rem,2.1vw,1.4rem)!important;
  font-weight:400;
  line-height:1.55;
  margin-top:.4rem
}

.hero .hero-h1 strong {
  font-weight:600
}

.hero .hero-text {
  max-width:none!important;
  font-size:.9375rem
}

@media (max-width:700px) {
.hero {
  gap:1rem 1.1rem!important
}

.hero .hero-name {
  font-size:1.9rem!important
}

.hero .hero-h1 {
  font-size:1.05rem!important
}

.hero .hero-text {
  font-size:.8125rem
}
}

.hero .hero-portrait>img:first-child {
  border:1px solid rgba(255,255,255,.4)!important
}

.hero .hero-who {
  grid-column:2;
  align-self:center;
  text-align:left
}

.hero .hero-who .hero-name {
  grid-column:auto;
  margin:0
}

.hero .hero-sub {
  margin:.7rem 0 0;
  font-size:clamp(.9rem,1.6vw,1.05rem);
  line-height:1.5;
  color:#dbe6f7
}

@media (max-width:700px) {
.hero .hero-sub {
  font-size:.8125rem;
  margin-top:.5rem
}
}

.hero .hero-h1 {
  margin:0 auto .6rem!important
}

.hero .hero-who .hero-name {
  font-size:clamp(1.5rem,3.2vw,2.3rem)!important;
  line-height:1.2
}

.hero .hero-sub {
  font-size:clamp(1.05rem,2.2vw,1.4rem)!important;
  margin-top:.8rem;
  color:#e8eefa
}

@media (max-width:700px) {
.hero .hero-who .hero-name {
  font-size:1.3rem!important
}

.hero .hero-sub {
  font-size:1rem!important
}
}

.hero .hero-portrait>img:first-child {
  filter:grayscale(.6) contrast(1.04) brightness(1.02)
}

@media (min-width:701px) {
.hero .hero-portrait>img:first-child {
  aspect-ratio:4/3;
  object-position:50% 22%;
  border-radius:32px
}

.hero {
  padding-block:2.2rem 2.4rem!important
}
}

@media (min-width:701px) {
.hero .hero-portrait>img:first-child {
  aspect-ratio:16/10;
  object-position:50% 20%
}

.hero {
  padding-block:1.7rem 1.9rem!important;
  gap:.9rem 2.2rem!important
}

.hero .hero-h1 {
  margin-bottom:.2rem!important
}
}

.hero .hero-mid {
  grid-column:1/-1;
  display:grid;
  grid-template-columns:minmax(0,1fr) minmax(0,1fr);
  gap:1.4rem 2rem;
  align-items:center;
  padding:.9rem;
  margin:.5rem 0;
  border-radius:24px;
  background:linear-gradient(180deg,rgba(255,255,255,.1),rgba(255,255,255,.04));
  border:1px solid rgba(255,255,255,.2);
  box-shadow:inset 0 1px 0 rgba(255,255,255,.12)
}

.hero .hero-mid .hero-portrait {
  grid-column:1
}

.hero .hero-mid .hero-who {
  grid-column:2;
  padding-right:.6rem
}

.hero .hero-mid .hero-portrait>img:first-child {
  border:0!important;
  border-radius:16px;
  box-shadow:0 8px 20px rgba(0,8,40,.35)
}

@media (min-width:701px) {
.hero .hero-mid .hero-portrait>img:first-child {
  aspect-ratio:16/10
}
}

@media (max-width:700px) {
.hero .hero-mid {
  gap:.8rem 1rem;
  padding:.7rem;
  border-radius:20px
}

.hero .hero-mid .hero-portrait>img:first-child {
  aspect-ratio:4/5;
  border-radius:14px
}

.hero .hero-mid .hero-who {
  padding-right:.2rem
}
}

.hero .hero-portrait>img:first-child {
  filter:grayscale(.22) contrast(1.03)
}

.home-page .hero-v5 {
  display:block!important;
  position:relative;
  overflow:visible;
  isolation:isolate;
  max-width:900px;
  margin:3rem 0 0 auto!important;
  padding:3rem 3rem 3rem 11rem!important;
  min-height:500px;
  border-radius:28px;
  box-shadow:0 12px 32px rgba(1,34,101,.08);
  text-align:left
}

.hero-v5 .hero-copy {
  position:relative;
  z-index:2;
  max-width:none!important
}

.hero-v5 .hero-portrait {
  position:absolute!important;
  left:-220px;
  top:30px;
  bottom:0;
  width:370px!important;
  margin:0;
  z-index:3;
  pointer-events:none;
  mask-image:linear-gradient(#000 82%,transparent);
  -webkit-mask-image:linear-gradient(#000 82%,transparent)
}

.hero-v5 .hero-portrait>img:first-child {
  position:static!important;
  width:100%!important;
  height:100%!important;
  max-width:none!important;
  object-fit:cover!important;
  object-position:50% 24%!important;
  aspect-ratio:auto!important;
  border:0!important;
  border-radius:22px 22px 0 0!important;
  box-shadow:none!important;
  filter:none!important;
  opacity:1!important
}

.hero-v5 .hero-h1 {
  text-align:left!important;
  margin:0 0 1.5rem!important;
  font-size:clamp(1.4rem,2.3vw,1.9rem)!important;
  line-height:1.5!important
}

.hero-v5 .hero-who {
  padding:0!important;
  text-align:left!important
}

.hero-v5 .hero-who .hero-name {
  font-size:clamp(1.6rem,2.8vw,2.4rem)!important;
  text-align:left!important
}

.hero-v5 .hero-sub {
  font-size:1rem!important;
  line-height:1.7!important;
  margin:.75rem 0 0!important
}

.hero-v5 .hero-text {
  font-size:1rem!important;
  line-height:1.85!important;
  max-width:none!important;
  margin:1.5rem 0!important;
  text-align:left!important
}

.hero-v5 .hero-cta {
  text-align:left!important;
  margin:0!important
}

.hero-v5 .btn.glass {
  background:#f8fafc!important;
  color:#012265!important;
  box-shadow:none!important;
  backdrop-filter:none!important
}

.hero-v5 img.hero-watermark {
  display:none!important
}

@media(max-width:1100px) and (min-width:701px) {
.home-page .hero-v5 {
  margin-left:150px!important;
  padding-left:140px!important
}

.hero-v5 .hero-portrait {
  left:-150px;
  width:260px!important
}
}

@media(max-width:700px) {
.home-page .hero-v5 {
  margin:6rem auto 0!important;
  padding:150px 1.5rem 2rem!important;
  min-height:0;
  max-width:none!important
}

.hero-v5 .hero-portrait {
  left:50%!important;
  top:-85px!important;
  bottom:auto!important;
  transform:translateX(-50%);
  width:190px!important;
  height:210px!important;
  mask-image:none;
  -webkit-mask-image:none
}

.hero-v5 .hero-portrait>img:first-child {
  border-radius:20px!important;
  object-position:50% 20%!important
}

.hero-v5 .hero-h1 {
  font-size:1.25rem!important
}

.hero-v5 .hero-who .hero-name {
  font-size:1.6rem!important
}

.hero-v5 .hero-text {
  font-size:.9375rem!important
}

.hero-v5 .hero-sub {
  font-size:.9375rem!important
}
}

.hero-v5 .hero-copy {
  position:static!important
}

.home-page .hero-v5 {
  margin:clamp(145px,11.2vw,180px) 0 0 22%!important;
  max-width:none!important;
  padding:3.4vw 3.8vw 3vw 22vw!important;
  min-height:0;
  background:linear-gradient(112deg,#396dad 0%,#174b94 44%,#012265 100%);
  border:0;
  border-radius:30px;
  box-shadow:none;
  overflow:visible
}

.hero-v5 .hero-portrait {
  left:-35%!important;
  top:-8px!important;
  bottom:-22px!important;
  width:68%!important;
  height:auto!important;
  mask-image:linear-gradient(#000 84%,transparent 100%);
  -webkit-mask-image:linear-gradient(#000 84%,transparent 100%)
}

.hero-v5 .hero-portrait>img:first-child {
  object-fit:cover!important;
  object-position:50% 40%!important;
  border-radius:0!important;
  filter:none!important
}

.hero-v5 .hero-greeting {
  font:400 clamp(20px,1.9vw,30px)/1.4 var(--serif);
  color:#fff;
  margin:0 0 .5rem;
  max-width:none
}

.hero-v5 .hero-brand {
  font:400 clamp(34px,5.1vw,80px)/1.16 var(--serif);
  white-space:nowrap;
  letter-spacing:-.035em;
  margin:0 0 1.2rem;
  color:#fff
}

.hero-v5 .hero-service {
  font:500 clamp(20px,2.05vw,32px)/1.45 var(--sans);
  color:#fff;
  max-width:none;
  margin:0
}

.hero-rule {
  display:block;
  width:66px;
  height:4px;
  background:#58a99a;
  border-radius:2px;
  margin:1.7rem 0
}

.hero-v5 .hero-who .hero-name {
  font:600 clamp(27px,2.9vw,45px)/1.25 var(--sans)!important;
  margin:0!important;
  letter-spacing:-.025em
}

.hero-v5 .hero-sub {
  font-size:clamp(16px,1.4vw,22px)!important;
  margin:.75rem 0 1rem!important
}

.hero-v5 .hero-text {
  font-size:clamp(15px,1.35vw,21px)!important;
  line-height:1.55!important;
  margin:1rem 0 1.6rem!important
}

.hero-v5 .hero-cta .btn {
  padding:1.05rem 2.5rem!important;
  font-size:clamp(15px,1.25vw,20px)!important;
  font-weight:700;
  min-height:60px
}

.hero-v5 .hero-cta .btn:after {
  content:' →';
  margin-left:1rem;
  color:#398f7a
}

@media(min-width:701px) and (max-width:1100px) {
.home-page .hero-v5 {
  margin-left:20%!important;
  padding-left:22vw!important
}

.hero-v5 .hero-brand {
  font-size:4.5vw!important
}
}

@media(max-width:700px) {
.home-page .hero-v5 {
  margin:210px 0 0!important;
  padding:165px 1.5rem 2rem!important;
  border-radius:24px
}

.hero-v5 .hero-portrait {
  left:50%!important;
  top:-155px!important;
  bottom:auto!important;
  width:300px!important;
  height:300px!important;
  transform:translateX(-50%);
  mask-image:linear-gradient(#000 83%,transparent);
  -webkit-mask-image:linear-gradient(#000 83%,transparent)
}

.hero-v5 .hero-portrait>img:first-child {
  object-position:50% 28%!important;
  border-radius:0!important
}

.hero-v5 .hero-greeting {
  font-size:19px
}

.hero-v5 .hero-brand {
  font-size:clamp(26px,7.5vw,43px)!important;
  white-space:normal;
  line-height:1.2;
  margin-bottom:1rem
}

.hero-v5 .hero-service {
  font-size:20px
}

.hero-rule {
  margin:1.2rem 0;
  width:46px;
  height:3px
}

.hero-v5 .hero-who .hero-name {
  font-size:26px!important
}

.hero-v5 .hero-sub {
  font-size:15px!important
}

.hero-v5 .hero-text {
  font-size:15px!important;
  line-height:1.75!important
}

.hero-v5 .hero-cta .btn {
  font-size:15px!important;
  min-height:50px;
  padding:.9rem 1.5rem!important
}
}

:root[data-theme="dark"] .home-page .hero-v5 {
  background:linear-gradient(112deg,#284f85,#052763)
}

@media(min-width:701px) {
.hero-v5 .hero-portrait {
  width:64%!important;
  top:-14px!important
}

.hero-v5 .hero-portrait>img:first-child {
  object-position:50% 20%!important
}

.hero-v5 .hero-brand {
  line-height:1!important;
  margin-bottom:.7rem
}

.hero-v5 .hero-service {
  line-height:1.3
}

.hero-rule {
  margin:1.4rem 0
}

.hero-v5 .hero-sub {
  margin:.5rem 0!important
}

.hero-v5 .hero-text {
  margin:.5rem 0 1.2rem!important
}
}

@media(min-width:701px) {
.hero-v5 .hero-portrait {
  top:-36px!important
}

.hero-v5 .hero-brand {
  font-size:clamp(34px,5.3vw,82px)
}
}

.home-page .hero-v5,
:root[data-theme="dark"] .home-page .hero-v5 {
  background:transparent!important;
  border:0!important;
  box-shadow:none!important
}

.home-page .hero-v5::before {
  content:"";
  position:absolute;
  inset:0;
  z-index:-1;
  border-radius:inherit;
  background:linear-gradient(112deg,#396dad 0%,#174b94 44%,#012265 100%);
  -webkit-mask-image:linear-gradient(90deg,transparent 0%,#000 34%);
  mask-image:linear-gradient(90deg,transparent 0%,#000 34%);
  pointer-events:none
}

:root[data-theme="dark"] .home-page .hero-v5::before {
  background:linear-gradient(112deg,#284f85,#052763)
}

.home-page .hero-v5.glow::after {
  -webkit-mask-image:linear-gradient(90deg,transparent,#000 34%);
  mask-image:linear-gradient(90deg,transparent,#000 34%)
}

@media(max-width:700px) {
.home-page .hero-v5::before,
.home-page .hero-v5.glow::after {
  -webkit-mask-image:linear-gradient(90deg,transparent,#000 25%);
  mask-image:linear-gradient(90deg,transparent,#000 25%)
}
}

@media(max-width:700px) {
.home-page .hero-v5::before,
.home-page .hero-v5.glow::after {
  -webkit-mask-image:linear-gradient(90deg,transparent,#000 8%);
  mask-image:linear-gradient(90deg,transparent,#000 8%)
}
}
```
