<!doctype html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<script>try{if(sessionStorage.getItem('ka_seen'))document.documentElement.classList.add('seen');if(localStorage.getItem('ka_calm')==='1')document.documentElement.classList.add('calm')}catch(e){}</script>
<script>
(function(){var p='auto';try{p=localStorage.getItem('ka-appearance')||'auto'}catch(e){}
if(p!=='light'&&p!=='dark')p='auto';
var dark=p==='dark'||(p==='auto'&&window.matchMedia&&window.matchMedia('(prefers-color-scheme:dark)').matches);
document.documentElement.setAttribute('data-theme',dark?'dark':'light');
document.documentElement.setAttribute('data-appearance',p);
})();
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
