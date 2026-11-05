/* Bewegung reduzieren (System) gilt wie der Schalter "Animationen reduzieren" */
try{if(window.matchMedia&&window.matchMedia('(prefers-reduced-motion:reduce)').matches)document.documentElement.classList.add('calm')}catch(e){}

(function(){
  
  var btn=document.getElementById('logobtn'),menu=document.getElementById('navmenu');
  var mast=document.getElementById('mast'),nav=document.getElementById('mastnav'),wm=document.getElementById('wm'),slot=document.getElementById('wmslot'),pin=document.getElementById('pin'),pinned=pin&&pin.firstElementChild,hg=document.getElementById('wmk');
  var scrim=document.getElementById('scrim'),sclose=document.getElementById('sideclose');
  function isOpen(){return menu.classList.contains('open')}
  function openMenu(){menu.classList.add('open');scrim.classList.add('open');menu.setAttribute('aria-hidden','false');btn.setAttribute('aria-expanded','true');document.getElementById('hbbtn').setAttribute('aria-expanded','true');sclose.focus()}
  function closeMenu(back){if(!isOpen())return;menu.classList.remove('open');scrim.classList.remove('open');menu.setAttribute('aria-hidden','true');btn.setAttribute('aria-expanded','false');document.getElementById('hbbtn').setAttribute('aria-expanded','false');if(back)(mast.classList.contains('collapsed')?btn:document.getElementById('hbbtn')).focus()}
  [btn,document.getElementById('hbbtn')].forEach(function(b){b.addEventListener('click',function(){isOpen()?closeMenu(true):openMenu()})});
  sclose.addEventListener('click',function(){closeMenu(true)});
  scrim.addEventListener('click',function(){closeMenu(true)});
  menu.addEventListener('click',function(e){if(e.target.closest('a'))closeMenu(false)});
  document.addEventListener('keydown',function(e){
    if(!isOpen())return;
    if(e.key==='Escape'){closeMenu(true);return}
    if(e.key==='Tab'){var f=[].slice.call(menu.querySelectorAll('a[href],button,select')),i=f.indexOf(document.activeElement);
      if(e.shiftKey&&i<=0){e.preventDefault();f[f.length-1].focus()}else if(!e.shiftKey&&i===f.length-1){e.preventDefault();f[0].focus()}}
  });
  document.addEventListener('pointermove',function(e){var t=e.target.closest&&e.target.closest('.glow');if(!t)return;var b=t.getBoundingClientRect();t.style.setProperty('--mx',(e.clientX-b.left)+'px');t.style.setProperty('--my',(e.clientY-b.top)+'px')});

  /* Schalter "Animationen reduzieren" */
  var calmBox=document.getElementById('ka-calm');
  if(calmBox){calmBox.checked=document.documentElement.classList.contains('calm');
    calmBox.addEventListener('change',function(){try{localStorage.setItem('ka_calm',calmBox.checked?'1':'0')}catch(e){}location.reload()})}

  /* Kopfleiste: feste Dauer statt Scroll-Kopplung. Drei Zustände: Start (Leiste unten), angedockt (oben), eingeklappt (runder Knopf). */
  var HKEY='ka_head_done_109',DOCK_AT=90,UNDOCK_AT=24,COLLAPSE_AT=420,PIN=0,M={on:false,w0:1,h0:1,k1:1,top:12,W:0,vh:0};
  var lastY=null,upTravel=0,downTravel=0,docked=true,col=false,mvTimer=0,ready=false,tyApplied=null,measured=false;
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)').matches||document.documentElement.classList.contains('calm');
  function measure(){
    var vh=window.innerHeight,W=mast.clientWidth,rem=parseFloat(getComputedStyle(document.documentElement).fontSize)||16;
    document.body.classList.remove('nowm');
    /* Startpunkt des Schriftzugs: der sichtbare Praxisname (Handy über dem Porträt, sonst in der Karte) */
    [document.getElementById('wmslot'),document.getElementById('wmslot2')].forEach(function(el){if(!el)return;el.classList.remove('is-slot');if(el.offsetParent!==null)slot=el});
    if(slot)slot.classList.add('is-slot');
    var PH=pin?pinned.offsetHeight:0;
    /* Die Startkarte bleibt vom ersten Pixel an stehen, auch wenn sie höher als der Bildschirm ist: erst setzt sich die Leiste zusammen, dann scrollt die Seite. */
    /* Die Einflug-Animation läuft nur einmal pro Sitzung; danach steht die Leiste sofort oben. */
    var headDone=false;try{headDone=sessionStorage.getItem(HKEY)==='1'}catch(e){}if(String(window.name).indexOf(HKEY)>=0)headDone=true;
    M.on=!!pin&&!document.body.classList.contains('sub')&&vh>=300&&!reduce&&PH<=vh*3&&!headDone&&!M.done;
    document.body.classList.toggle('head-done',headDone&&!M.done);
    M.off=0;
    document.documentElement.style.setProperty('--pintop',(-M.off)+'px');
    document.body.classList.toggle('nowm',!M.on);
    PIN=M.on?Math.round(Math.max(440,Math.min(760,vh*.9))):0;
    COLLAPSE_AT=PIN+140+(M.off||0);
    document.documentElement.style.setProperty('--pinlen',PIN+'px');
    mast.classList.toggle('pc',M.on);
    M.top=parseFloat(getComputedStyle(nav).top)||12;
    M.w0=wm.offsetWidth||1;M.h0=wm.offsetHeight||1;
    M.k1=((W<=370?1:(W<=700?1.2:1.5))*rem)/(parseFloat(getComputedStyle(wm).fontSize)||48);
    M.k0=1;M.c0=null;M.c1=null;
    if(M.on&&slot&&slot.classList.contains('hero-brand')){
      var r0=document.createRange();r0.selectNodeContents(slot);var rr0=r0.getBoundingClientRect();M.k0=(rr0.width||M.w0)/M.w0;M.S0=rr0.top+rr0.height/2+(window.scrollY||0);
      wm.style.color='';M.c1=(getComputedStyle(wm).color.match(/\d+(\.\d+)?/g)||[1,34,101]).map(Number);M.c0=(getComputedStyle(slot).color.match(/\d+(\.\d+)?/g)||[255,255,255]).map(Number);
    }
    document.body.classList.toggle('wmfly',M.on&&!!M.c0);
    M.W=W;M.vh=vh;M.hw=hg.offsetWidth||1;M.hh=hg.offsetHeight||1;M.pw=Math.min(1048,W-20);M.padL=(W<=700?1.3:1.8)*rem;
    if(!M.on)docked=true;
    else if(!measured){docked=(window.scrollY||document.documentElement.scrollTop)>DOCK_AT}
    measured=true;
  }
  var rest=[];(function(){if(!pin)return;var n=pin;while(n&&n!==document.body){var x=n.nextElementSibling;while(x){if(x.tagName!=='SCRIPT'&&x.tagName!=='FOOTER'&&x.id!=='navmenu'&&!x.classList.contains('wa')&&x.tagName!=='ASIDE')rest.push(x);x=x.nextElementSibling}n=n.parentElement;if(n&&n.tagName==='MAIN')break}})();
  function place(cx,cy,k){wm.style.transform='translate('+(cx-M.w0/2).toFixed(1)+'px,'+(cy-M.h0/2).toFixed(1)+'px) scale('+k.toFixed(4)+')'}
  function moved(){
    if(!ready)return;
    mast.classList.add('mv');clearTimeout(mvTimer);mvTimer=setTimeout(function(){mast.classList.remove('mv')},1600);
  }
  function anim(y){
    var wasDocked=docked,wasCol=col;
    var FADE=false;
    var P=null;var t=M.done?1:M.on?Math.max(0,Math.min(1,(y-M.off)/PIN)):(FADE?Math.max(0,Math.min(1,y/200)):1),e=t<.5?2*t*t:1-Math.pow(-2*t+2,2)/2;
    docked=t>=1;
    if(M.on&&docked&&!M.done){M.done=true;(function(){var it=document.querySelector('.hero-intro');if(!it)return;var h0=it.offsetHeight;document.body.classList.add('intro-collapsed');var d=h0-it.offsetHeight;if(d>0)window.scrollBy(0,-d);})();try{sessionStorage.setItem(HKEY,'1')}catch(e){}try{if(String(window.name).indexOf(HKEY)<0)window.name=String(window.name||'')+' '+HKEY}catch(e){}document.body.classList.remove('wmfly');var lg=slot&&slot.previousElementSibling;if(lg)lg.style.opacity=''}
    var dy=lastY===null?0:y-lastY;lastY=y;
    if(y<=2||!docked){col=false;upTravel=0;downTravel=0}
    else if(dy<0){upTravel-=dy;downTravel=0;if(upTravel>=12)col=false}
    else if(dy>0){downTravel+=dy;upTravel=0;if(y>COLLAPSE_AT&&downTravel>=56&&!isOpen())col=true}
    col=false;
    if(wasDocked!==docked||wasCol!==col){
      moved();
      mast.classList.toggle('collapsed',col);
      var active=document.activeElement;
      if(!col&&active===btn)document.getElementById('hbbtn').focus({preventScroll:true});
    }
    var ro=1;for(var i=0;i<rest.length;i++){rest[i].style.opacity=ro<1?ro.toFixed(2):'';rest[i].style.pointerEvents=ro<1?'none':''}
    var li=slot&&slot.previousElementSibling&&slot.previousElementSibling.classList.contains('hero-greeting')?slot.previousElementSibling:document.querySelector('.lead-in');if(li&&M.on&&!M.done)li.style.opacity=Math.max(0,1-t*2.4).toFixed(2);
    /* Der Text unter dem Schriftzug blendet kurz aus, solange der Schriftzug darüber hinweg in die Leiste fliegt, und kommt danach wieder */
    var sv=document.querySelector('.hero-service');
    if(sv){if(M.on&&!M.done){var so=t<.18?1-t/.18:(t>.9?(t-.9)/.1:0);sv.style.opacity=so.toFixed(2)}else if(sv.style.opacity!==''){sv.style.opacity=''}}
    var topC=M.top+29,startC=M.vh-16-29;
    var slotC=M.on?slot.getBoundingClientRect().top+slot.offsetHeight/2:topC;
    var pcn=topC,wc=slotC+(topC-slotC)*e,k=M.on?M.k0+(M.k1-M.k0)*e:M.k1;
    var cx0=M.W/2;
    if(M.on&&M.c0){var rg=document.createRange();rg.selectNodeContents(slot);var rb=rg.getBoundingClientRect();cx0=rb.left+rb.width/2;if(M.S0>topC+1){var L=Math.min(PIN||9999,(M.S0-topC)*2.4),q=M.done?1:Math.max(0,Math.min(1,y/L));q=q<.5?2*q*q:1-Math.pow(-2*q+2,2)/2;wc=M.S0+(topC-M.S0)*q;k=M.k0+(M.k1-M.k0)*q;P=q;}else{var sy0=Math.max(topC,rb.top+rb.height/2);wc=sy0+(topC-sy0)*e;}
      wm.style.color=e>=1?'':'rgb('+[0,1,2].map(function(j){return Math.round(M.c0[j]+(M.c1[j]-M.c0[j])*e)}).join(',')+')'}
    nav.style.setProperty('--ty',(pcn-topC).toFixed(1)+'px');tyApplied=(pcn-topC).toFixed(1)+'px';
    var pc=pcn;
    var eh=(P===null)?e:P;var sc=1+.45*(1-eh);nav.style.setProperty('--sc',sc.toFixed(4));nav.style.opacity='';nav.style.setProperty('--na',eh.toFixed(3));nav.style.pointerEvents=eh<.6?'none':'';
    var hbb=document.getElementById('hbbtn');if(hbb){var dd=hbb.offsetLeft+hbb.offsetWidth/2-nav.clientWidth/2;hbb.style.transform=sc>1?'translateX('+(dd*(1/sc-1)).toFixed(1)+'px) scale('+(1/sc).toFixed(4)+')':'';hbb.style.pointerEvents='auto'}
    var hs=document.getElementById('hgslot'),hsOn=M.on&&hs&&hs.offsetParent!==null;hg.style.opacity=hsOn?'1':e.toFixed(3);wm.style.opacity=M.on?'':e.toFixed(3);wm.style.pointerEvents=e<.6?'none':'';
    place(cx0+(M.W/2-cx0)*e,wc,k);
    var cx,cy,kk;
    if(col){cx=M.W-12-28;cy=M.top+28;kk=38/M.hh}
    else{cx=(M.W-M.pw)/2+M.padL+22;cy=pc;kk=44/M.hh}
    if(M.on&&typeof sc!=='undefined'&&sc>1){cx=M.W/2+(cx-M.W/2)*sc;cy=topC+(cy-topC)*sc;kk*=sc}
    if(hsOn&&eh<1){var hr=hs.getBoundingClientRect();if(!M.H0){M.H0={x:hr.left+hr.width/2,y:hr.top+hr.height/2+(window.scrollY||0),k:hr.height/M.hh}}var hx=M.H0.x,hy=M.H0.y,hk=M.H0.k;cx=hx+(cx-hx)*eh;cy=hy+(cy-hy)*eh;kk=hk+(kk-hk)*eh}
    hg.style.transform='translate('+(cx-M.hw/2).toFixed(1)+'px,'+(cy-M.hh/2).toFixed(1)+'px) scale('+kk.toFixed(4)+')';
    window.KA_COLLAPSED=docked;
    mast.classList.toggle('live',docked);
    document.body.classList.toggle('notlive',!docked);
  }
  function upd(){
    var h=document.scrollingElement||document.documentElement,max=Math.max(0,h.scrollHeight-h.clientHeight),y=Math.max(0,window.scrollY||h.scrollTop||0),p=max>0?Math.min(1,y/max):0;
    document.documentElement.style.setProperty('--p',p.toFixed(3));
    anim(y);
  }
  measure();
  window.addEventListener('scroll',upd,{passive:true});window.addEventListener('resize',function(){measure();upd()});if(document.fonts&&document.fonts.ready)document.fonts.ready.then(function(){measure();upd()});
  upd();
  requestAnimationFrame(function(){requestAnimationFrame(function(){ready=true;mast.classList.add('anim')})});
})();
(function(){
  var q=document.getElementById('preissuche'),none=document.getElementById('nohit');
  if(!q)return;
  /* Suche hinter der Lupe: Klick öffnet das Feld, Escape oder leeres Feld beim Verlassen schließt es */
  var box=document.getElementById('suche'),tg=box&&box.querySelector('.search-toggle');
  if(tg){
    function openS(o){box.classList.toggle('open',o);tg.setAttribute('aria-expanded',o?'true':'false');if(o)q.focus()}
    tg.addEventListener('click',function(){openS(!box.classList.contains('open'))});
    q.addEventListener('keydown',function(e){if(e.key==='Escape'){q.value='';q.dispatchEvent(new Event('input'));openS(false);tg.focus()}});
    q.addEventListener('blur',function(){if(!q.value.trim())setTimeout(function(){if(document.activeElement!==tg)openS(false)},150)});
  }
  var groups=[].slice.call(document.querySelectorAll('.grp'));
  q.addEventListener('input',function(){
    var t=q.value.trim().toLowerCase(),any=false;
    groups.forEach(function(g){
      var head=(g.querySelector('h3').textContent).toLowerCase();
      var all=!t||head.indexOf(t)>-1,shown=0;
      [].forEach.call(g.querySelectorAll('.subgrp'),function(sg){
        var h=sg.querySelector('.subgrp-h'),hm=all||(h&&h.textContent.toLowerCase().indexOf(t)>-1),cnt=0;
        [].forEach.call(sg.querySelectorAll('tr:not(.tinfo-row)'),function(tr){var m=hm||tr.textContent.toLowerCase().indexOf(t)>-1;tr.hidden=!m;if(m)cnt++;var n=tr.nextElementSibling;if(n&&n.classList.contains('tinfo-row')&&!m){n.hidden=true;var bt=tr.querySelector('.tinfo-btn');if(bt)bt.setAttribute('aria-expanded','false')}});
        sg.hidden=cnt===0;shown+=cnt;
      });
      g.hidden=shown===0;if(shown)any=true;
    });
    none.hidden=any;
  });
})();

(function(){
  var D=window.KA_DATA||{},WA=(D.phone||'').replace(/^\+/,''),MAIL=D.mail||'',IC=D.icons||{},chat=document.getElementById('chat');
  if(!chat)return;
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)').matches||document.documentElement.classList.contains('calm');
  var T={},order=[];(D.topics||[]).forEach(function(t,i){var k='t'+i;T[k]=t;order.push(k)});
  var asked={},topics=[],busy=false;
  function dec(x){var d=document.createElement('textarea');d.innerHTML=x;return d.value}
  function el(tag,cls,html){var e=document.createElement(tag);if(cls)e.className=cls;if(html!=null)e.innerHTML=html;return e}
  var ready=false;
  function show(){if(!ready)return;var l=chat.lastElementChild;if(l)l.scrollIntoView({behavior:reduce?'auto':'smooth',block:'nearest'})}
  function manuel(html){var r=el('div','crow');r.appendChild(el('span','cav'));r.appendChild(el('div','cbub',html));chat.appendChild(r)}
  function me(t){var r=el('div','crow me');r.appendChild(el('div','cbub',t));r.appendChild(el('span','cav-you',IC.person||''));chat.appendChild(r)}
  function chips(list){var c=el('div','cchips');list.forEach(function(it){var b=el('button','cchip'+(it.go?' go':''),(it.icon||'')+'<span>'+it.label+'</span>');b.type='button';b.addEventListener('click',function(){if(busy)return;ready=true;c.remove();me(it.label);show();it.fn()});c.appendChild(b)});chat.appendChild(c);show()}
  function say(parts,done){busy=true;var i=0;(function next(){
    if(i>=parts.length){busy=false;done&&done();return}
    var t=el('div','crow');t.appendChild(el('span','cav ghost'));t.appendChild(el('div','cbub ctyping','<i></i><i></i><i></i>'));chat.appendChild(t);show();
    setTimeout(function(){t.remove();manuel(parts[i++]);show();next()},reduce?0:1000)})()}
  function pr(rows){return '<table class="cprices"><tbody>'+rows.map(function(r){return '<tr><td>'+r[0]+'</td><td>'+r[1]+'</td></tr>'}).join('')+'</tbody></table><p class="cfine">'+(D.chatFine||'')+'</p>'}
  function menu(){chips(order.filter(function(k){return !asked[k]}).map(function(k){return{label:T[k].label,icon:T[k].icon,fn:function(){topic(k)}}}))}
  function after(){
    var l=[{label:'Wie läuft ein Termin ab?',fn:flow},{label:'Was soll ich mitbringen?',fn:bring}];
    if(order.some(function(k){return !asked[k]}))l.push({label:'Noch ein anderes Thema',fn:function(){say(['Gern. Was noch?'],menu)}});
    l.push({label:'Ich möchte einen Termin anfragen',go:true,fn:book});chips(l)}
  function topic(k){asked[k]=1;topics.push(dec(T[k].label));var t=T[k],parts=t.text.map(function(x){return '<p>'+x+'</p>'});if(t.prices)parts[parts.length-1]+=pr(t.prices);say(parts,after)}
  function flow(){say([(D.steps||[]).map(function(st,i){return '<p><b>'+(i+1)+'. '+st[0]+':</b> '+st[1]+'</p>'}).join('')],after)}
  function bring(){say(['<p>'+(D.checkIntro||'')+'</p><ul class="clist">'+(D.checks||[]).map(function(c){return '<li>'+c+'</li>'}).join('')+'</ul>'],after)}
  function text(){var base=(D.smsText||'').replace(/\s+$/,'');var hasTail=/[:]$/.test(base);return topics.length?base.replace(/Mein Anliegen:?$/,'').trim()+' Mein Thema: '+topics.join(', ')+'.':(D.smsText||'')}
  function book(){say(['<p>Sehr gern. Termine vergebe ich aktuell persönlich. Schreibe mir einfach'+(topics.length?'. Ich habe Deine Themen schon in die Nachricht geschrieben: '+topics.join(', ')+'.':'.')+'</p><p class="cbtn-wrap cbtn-two"><a class="cbtn cbtn-mail" href="mailto:'+MAIL+'?subject='+encodeURIComponent('Terminanfrage')+'&body='+encodeURIComponent(text())+'">'+(IC.mail||'')+'E-Mail</a><a class="cbtn cbtn-wa" href="https://wa.me/'+WA+'?text='+encodeURIComponent(text())+'" target="_blank" rel="noopener">'+(IC.whatsapp||'')+'WhatsApp</a></p><p class="cfine">Bitte schicke in der Nachricht keine Fotos oder Gesundheitsdaten.</p>'],function(){chips([{label:'Noch eine Frage',fn:function(){say(['Gern. Was möchtest Du noch wissen?'],menu)}}])})}
  manuel('<p>'+(D.chatIntro||'')+'</p>');
  menu();
  chat.firstElementChild&&0;
})();


(function(){
  var tl=document.getElementById('tl');if(!tl)return;
  function fill(){var r=tl.getBoundingClientRect(),vh=window.innerHeight,p=window.innerWidth>700?(vh*.92-r.top)/(vh*.28):(vh*.75-r.top)/(r.height||1);var q=Math.min(1,Math.max(0,p));tl.style.setProperty('--tlp',Math.round(q*100)+'%');var li=tl.children,n=li.length;for(var i=0;i<n;i++){li[i].classList.toggle('hit',q>=(n>1?i/(n-1):0)-.001&&q>0)}}
  window.addEventListener('scroll',fill,{passive:true});window.addEventListener('resize',fill);fill();
})();


/* Logo in der Leiste: Sanduhr dreht sich und läuft erst, wenn das Logo als Knopf rechts sitzt */
(function(){
  var w=document.getElementById('wmk'),f=document.getElementById('lgf'),s=document.getElementById('lgs'),t=document.getElementById('lgt');
  if(!w||!f)return;
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)').matches||document.documentElement.classList.contains('calm');
  function lerp(a,b,x){return a+(b-a)*x}
  function set(p){w.style.setProperty('--a',lerp(12.6,32.9,p).toFixed(2)+'%');w.style.setProperty('--b',lerp(87.5,62.5,p).toFixed(2)+'%')}
  set(0);
  if(reduce)return;
  var phase='idle',start=0,angle=0,D=16000,since=0;
  function sand(on){s.classList.toggle('on',on);t.classList.toggle('on',on)}
  /* Jedes Mal, wenn die Leiste oben andockt: Sanduhr dreht sich einmal, der Sand läuft durch und blendet danach aus. */
  function frame(now){
    var col=!!window.KA_COLLAPSED;
    if(!col){if(phase!=='idle'){phase='idle';sand(false);set(0)}since=0}
    else if(phase==='idle'){
      if(!since)since=now;
      if(now-since>700){phase='flip';start=now;angle+=180;f.style.transform='rotate('+angle+'deg)'}
    }else if(phase==='flip'&&now-start>1900){phase='run';start=now;set(0);sand(true)}
    else if(phase==='run'){
      var p=Math.min(1,(now-start)/D);set(p);
      if(p>=1){phase='done';sand(false)}
    }
    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();

/* Sanduhr im Seitenmenü: bei jedem Öffnen drehen und laufen lassen */
(function(){
  var menu=document.getElementById('navmenu'),w=document.getElementById('sidehg');
  if(!menu||!w||window.matchMedia('(prefers-reduced-motion:reduce)').matches||document.documentElement.classList.contains('calm'))return;
  var f=w.querySelector('.lg-f'),s=w.querySelector('.ls'),t=w.querySelector('.wst');
  function lerp(a,b,x){return a+(b-a)*x}
  function set(p){w.style.setProperty('--a',lerp(12.6,32.9,p).toFixed(2)+'%');w.style.setProperty('--b',lerp(87.5,62.5,p).toFixed(2)+'%')}
  set(0);
  /* Läuft bei jedem Öffnen des Menüs: drehen, Sand rieselt, danach steht das Logo ohne Sand */
  var started=false,angle=0,timers=[],raf=0;
  function stop(){timers.forEach(clearTimeout);timers=[];cancelAnimationFrame(raf);s.classList.remove('on');t.classList.remove('on');set(0);started=false}
  function run(){
    started=true;
    timers.push(setTimeout(function(){angle+=180;f.style.transform='rotate('+angle+'deg)';
      timers.push(setTimeout(function(){s.classList.add('on');t.classList.add('on');var t0=performance.now(),D=5500;
        (function step(now){var p=Math.min(1,(now-t0)/D);set(p);if(p<1){raf=requestAnimationFrame(step)}else{s.classList.remove('on');t.classList.remove('on')}})(t0);
      },1900));
    },450));
  }
  new MutationObserver(function(){var o=menu.classList.contains('open');if(o&&!started)run();else if(!o&&started)stop()}).observe(menu,{attributes:true,attributeFilter:['class']});
})();

/* Ladeanimation nur beim ersten Besuch pro Sitzung */
try{sessionStorage.setItem('ka_seen','1')}catch(e){}

/* Schwebender Nachrichtenknopf: ausblenden, wenn Kontaktkarten oder Fußzeile sichtbar sind */
(function(){
  var wa=document.getElementById('wa-float');if(!wa||!('IntersectionObserver' in window))return;
  var seen=new Set();
  var io=new IntersectionObserver(function(es){es.forEach(function(e){e.isIntersecting?seen.add(e.target):seen.delete(e.target)});wa.classList.toggle('wa-hide',seen.size>0)},{rootMargin:'0px 0px -12% 0px'});
  [].forEach.call(document.querySelectorAll('.pills,#contact-form,.contact .txt,footer'),function(el){io.observe(el)});
})();

/* Schwebenden Kontakt-Knopf ausblenden, sobald das Kontakt-Band oder die Fußzeile im Bild ist */
(function(){
  if(!('IntersectionObserver' in window))return;
  var vis=new Set();
  var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting)vis.add(e.target);else vis.delete(e.target)});document.body.classList.toggle('kon-in',vis.size>0)},{threshold:0});
  document.querySelectorAll('.sum-kon, footer').forEach(function(el){io.observe(el)});
})();

/* Über mich: Unterzeile genau so breit wie die Überschrift */
(function(){
  function fit(){document.querySelectorAll('.about-head').forEach(function(h){var t=h.querySelector('.about-h2 span'),s=h.querySelector('.about-sub'),ss=s&&s.querySelector('span');if(!t||!ss||!t.offsetWidth)return;s.style.fontSize='20px';var w=ss.getBoundingClientRect().width;if(w)s.style.fontSize=(20*t.getBoundingClientRect().width/w).toFixed(2)+'px'})}
  window.addEventListener('resize',fit);window.addEventListener('hashchange',function(){setTimeout(fit,60)});
  if(document.fonts&&document.fonts.ready)document.fonts.ready.then(fit);fit();setTimeout(fit,400);
})();

/* Über mich: Werte als Kacheln, Text klappt darunter über die volle Breite auf */
(function(){
  var tabs=[].slice.call(document.querySelectorAll('.vtab'));if(!tabs.length)return;
  tabs.forEach(function(t){t.addEventListener('click',function(){
    var open=t.getAttribute('aria-selected')==='true';
    tabs.forEach(function(o){o.setAttribute('aria-selected','false');var pn=document.getElementById(o.getAttribute('aria-controls'));if(pn){pn.hidden=true;pn.classList.remove('in')}});
    if(!open){t.setAttribute('aria-selected','true');var p=document.getElementById(t.getAttribute('aria-controls'));if(p){p.hidden=false;requestAnimationFrame(function(){p.classList.add('in')})}}
  })});
})();

/* Über mich: ersten Wert beim Laden aufgeklappt zeigen */
(function(){var t=document.getElementById('vtab-0');if(t&&t.getAttribute('aria-selected')!=='true')t.click();})();

/* Über mich: immer nur ein Wert offen – Öffnen eines Werts schließt die anderen */
(function(){
  var rows=[].slice.call(document.querySelectorAll('.vlist .vrow'));
  function fillIcon(r){var ic=r.querySelector('.vrow-ico svg.fillable');if(ic)ic.classList.add('fill-on')}
  rows.forEach(function(r){if(r.open)fillIcon(r);r.addEventListener('toggle',function(){if(r.open){fillIcon(r);rows.forEach(function(o){if(o!==r&&o.open)o.open=false})}})});
})();

/* Knöpfe: gesamten Inhalt (Symbol + Text) in einen Rahmen packen, damit er beim Überfahren als Ganzes wächst */
(function(){
  function wrap(root){[].forEach.call((root||document).querySelectorAll('.btn,.cbtn'),function(b){if(b.querySelector(':scope>.bt-in'))return;var s=document.createElement('span');s.className='bt-in';while(b.firstChild)s.appendChild(b.firstChild);b.appendChild(s)})}
  wrap();
  var chat=document.getElementById('chat');if(chat&&'MutationObserver' in window)new MutationObserver(function(){wrap(chat)}).observe(chat,{childList:true,subtree:true});
})();

/* Behandlungen am Handy: Kategorien als Aufklapp-Karten, immer nur eine offen */
(function(){
  var wrap=document.querySelector('#leistungen .groups');if(!wrap)return;
  var grps=[].slice.call(wrap.querySelectorAll('.grp'));
  function desk(){return window.innerWidth>700}
  function setOpen(g,o){g.classList.toggle('open',o);var hh=g.querySelector('h3');if(hh)hh.setAttribute('aria-expanded',o?'true':'false')}
  /* Desktop: alle Karten offen und einzeln zuklappbar. Handy: immer nur eine offen, die erste vorgeöffnet. */
  function initState(){grps.forEach(function(g,i){setOpen(g,desk()||i===0)})}
  grps.forEach(function(g){
    var h=g.querySelector('h3');if(!h)return;
    h.setAttribute('role','button');h.setAttribute('tabindex','0');
    function tog(){
      var o=!g.classList.contains('open');
      if(desk()){setOpen(g,o);return}
      grps.forEach(function(x){setOpen(x,false)});
      if(o){setOpen(g,true);var t=g.getBoundingClientRect().top;if(t<80)window.scrollBy({top:t-90,behavior:'smooth'})}
    }
    h.addEventListener('click',function(){tog()});
    h.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();tog()}});
  });
  initState();
  var lastDesk=desk();
  window.addEventListener('resize',function(){if(desk()!==lastDesk){lastDesk=desk();initState()}});
  var q=document.getElementById('preissuche');
  if(q)q.addEventListener('input',function(){wrap.classList.toggle('searching',!!q.value.trim())});
})();


/* Infoboxen zu den Behandlungen: "i" öffnet ein kleines Overlay neben dem Knopf */
(function(){
  var btns=[].slice.call(document.querySelectorAll('.tinfo-btn'));if(!btns.length)return;
  var pop=document.createElement('div');pop.className='tinfo-pop';pop.setAttribute('role','dialog');pop.hidden=true;document.body.appendChild(pop);
  var cur=null;
  function close(){pop.hidden=true;if(cur)cur.setAttribute('aria-expanded','false');cur=null}
  function place(b){var r=b.getBoundingClientRect(),vw=document.documentElement.clientWidth,w=Math.min(360,vw-24);pop.style.width=w+'px';
    var left=r.left+r.width/2-w/2;left=Math.max(12,Math.min(vw-w-12,left));pop.style.left=(left+window.scrollX)+'px';
    var top=r.bottom+10+window.scrollY;pop.style.top=top+'px';pop.style.setProperty('--ax',(r.left+r.width/2-left)+'px');
    var ph=pop.offsetHeight,vh=window.innerHeight;if(r.bottom+10+ph>vh-10&&r.top-10-ph>70){pop.style.top=(r.top-10-ph+window.scrollY)+'px';pop.classList.add('up')}else pop.classList.remove('up')}
  btns.forEach(function(b){b.addEventListener('click',function(e){e.stopPropagation();e.preventDefault();
    if(cur===b){close();return}close();var t=b.parentNode.querySelector('.tinfo-tpl');if(!t)return;
    pop.innerHTML='<button type="button" class="tinfo-x" aria-label="Schließen">&times;</button>'+t.innerHTML;pop.hidden=false;cur=b;b.setAttribute('aria-expanded','true');place(b);
    pop.querySelector('.tinfo-x').addEventListener('click',close)})});
  document.addEventListener('click',function(e){if(cur&&!pop.contains(e.target))close()});
  document.addEventListener('keydown',function(e){if(e.key==='Escape')close()});
  window.addEventListener('resize',function(){if(cur)place(cur)});
})();

/* Füllen der Linien-Icons und Sanduhr-Trenner: die Füllung steht an der Bildschirmmitte. Beim Hochscrollen schiebt sie sich über einen längeren Scrollweg (dist) von oben nach unten ins Symbol, beim Zurückscrollen leert es sich wieder */
(function(){
  var items=[].slice.call(document.querySelectorAll('svg.fillable,.div .hgi')).filter(function(el){return !el.closest('.hero-vals,.quals,.vlist')}).map(function(el){
    return{el:el,ref:el.matches('svg')?el.querySelector('path.fl'):el,p:-1};
  }),tick=false;
  function check(){
    tick=false;
    var line=window.innerHeight*0.5,dist=Math.max(180,Math.min(340,window.innerHeight*0.38));
    items.forEach(function(it){
      var r=it.ref.getBoundingClientRect();
      if(!r.height)return;
      var p=Math.round(Math.max(0,Math.min(1,(line-r.top)/dist))*1000)/10;
      if(p!==it.p){it.p=p;it.el.style.setProperty('--p',p)}
    });
  }
  function req(){if(!tick){tick=true;requestAnimationFrame(check)}}
  window.addEventListener('scroll',req,{passive:true});
  window.addEventListener('resize',req);check();
})();

/* Seitenwechsel: kurze Sanduhr, die sich einmal schnell dreht */
(function(){
  var root=document.documentElement,busy=false,rm=(window.matchMedia&&window.matchMedia('(prefers-reduced-motion:reduce)').matches)||root.classList.contains('calm');
  if(root.classList.contains('pgt-on')){
    try{sessionStorage.removeItem('ka_pgt')}catch(e){}
    var off=function(){setTimeout(function(){root.classList.remove('pgt-on')},180)};
    if(document.readyState==='complete')off();else window.addEventListener('load',off);
  }
  window.addEventListener('pageshow',function(e){if(e.persisted){root.classList.remove('pgt-on','pgt-spin');busy=false}});
  function play(done){
    if(rm){done();return}
    root.classList.add('pgt-on','pgt-spin');
    setTimeout(done,400);
  }
  document.addEventListener('click',function(e){
    if(e.defaultPrevented||e.button||e.metaKey||e.ctrlKey||e.shiftKey||e.altKey||busy)return;
    var a=e.target.closest&&e.target.closest('a[href]');
    if(!a||(a.target&&a.target!=='_self')||a.hasAttribute('download'))return;
    var h=a.getAttribute('href');
    if(h.charAt(0)==='#'){
      /* Vorschau: Ansichten per Adresszusatz */
      var v=h.slice(1)||'home',cur=(location.hash||'#').slice(1)||'home';
      if(v===cur||!document.querySelector('.kview[data-view="'+v+'"]'))return;
      e.preventDefault();busy=true;
      play(function(){location.hash=h==='#'?'':h;root.classList.remove('pgt-spin');setTimeout(function(){root.classList.remove('pgt-on');busy=false},60)});
      return;
    }
    var u;try{u=new URL(a.href,location.href)}catch(x){return}
    if(u.origin!==location.origin||!/^https?:$/.test(u.protocol))return;
    if(u.pathname===location.pathname&&u.search===location.search)return;
    if(/\/wp-(admin|login)|\.(pdf|zip)$/i.test(u.pathname))return;
    e.preventDefault();busy=true;
    try{sessionStorage.setItem('ka_pgt','1')}catch(x){}
    play(function(){location.href=a.href});
  });
})();

/* Ablauf-Stationen: Punkt füllt sich, sobald man an der Karte vorbeigescrollt ist */
(function(){
  var steps=[].slice.call(document.querySelectorAll('#ablauf .steps li,.sum-abl .steps li')),tick=false;
  function check(){
    tick=false;
    var vh=window.innerHeight,de=document.documentElement,maxS=Math.max(0,de.scrollHeight-vh),sy=window.pageYOffset||0;
    steps.forEach(function(li){
      var r=li.getBoundingClientRect();if(!r.width)return;
      var idx=[].indexOf.call(li.parentNode.children,li),home=!!li.closest('.sum-abl');
      /* jeder weitere Punkt braucht mehr Scrollweg; nie weiter, als das Seitenende erlaubt */
      var mob,off,cy=r.top+Math.min(40,r.height/2),lim=cy-(maxS-sy)+30,mob=window.innerWidth<=700,off=mob?(home?-idx*24:idx*50):-idx*(home?60:95),line=Math.max(vh*(home?0.85:0.32)+off,lim);
      li.classList.toggle('st-hit',cy<line);
    });
  }
  function req(){if(!tick){tick=true;requestAnimationFrame(check)}}
  window.addEventListener('scroll',req,{passive:true});window.addEventListener('resize',req);check();
})();

/* Ablaufseite: gemeinsamer gestrichelter Kasten um Erstgespräch und Aufklärung & Behandlung */
(function(){
  var st=document.querySelector('#ablauf .steps');if(!st)return;
  var lis=[].slice.call(st.querySelectorAll('li.same-day-step'));if(lis.length<2)return;
  var fr=document.createElement('div');fr.className='sd-frame';fr.setAttribute('aria-hidden','true');st.appendChild(fr);
  function place(){
    var s=st.getBoundingClientRect();if(!s.width)return;
    var a=lis[0].getBoundingClientRect(),b=lis[lis.length-1].getBoundingClientRect();
    var l=Math.min(a.left,b.left)-s.left-10,r=Math.max(a.right,b.right)-s.left+10;
    fr.style.left=Math.max(l,-12)+'px';fr.style.width=(Math.min(r,s.width+12)-Math.max(l,-12))+'px';
    fr.style.top=(Math.min(a.top,b.top)-s.top-10)+'px';fr.style.height=(Math.max(a.bottom,b.bottom)-Math.min(a.top,b.top)+20)+'px';
  }
  window.addEventListener('resize',place);window.addEventListener('load',place);
  if(document.fonts&&document.fonts.ready)document.fonts.ready.then(place);
  window.addEventListener('hashchange',function(){setTimeout(place,50)});
  place();setTimeout(place,300);
})();

/* Grüne Icons (Startbereich, Qualifikationen, Werte): jedes füllt sich ganz auf einmal, mit Scroll-Abstand nacheinander, und bleibt gefüllt */
(function(){
  var ic=[].slice.call(document.querySelectorAll('.hero-vals svg.fillable,.quals svg.fillable')),tick=false;
  if(!ic.length)return;
  [].slice.call(document.querySelectorAll('.hero-vals,.quals')).forEach(function(box){
    var k=0,hero=box.classList.contains('hero-vals');ic.forEach(function(el){if(box.contains(el)){if(hero)el._hi=k;else el._off=k*110;k++}});
  });
  function check(){
    tick=false;
    var line=window.innerHeight*0.65;
    var vh=window.innerHeight;
    ic=ic.filter(function(el){
      var r=el.getBoundingClientRect(),cy=r.top+r.height/2,ok;
      if(!r.width)return true;
      /* Startbereich: ab 1/4 des Weges, den die Reihe ab ihrem Sichtbarwerden bis zum oberen Bildrand zurücklegt, füllen sich Stern, Herz und Personen von links nach rechts, jedes durch weiteres Scrollen ausgelöst, mit kurzem Scrollabstand */
      if(el._hi!==undefined){var docY=cy+(window.pageYOffset||0),st=Math.max(1,Math.min(vh,docY));ok=(st-cy)/st>=0.25+el._hi*0.12}
      else ok=cy<line-(el._off||0);
      if(ok){el.classList.add('fill-on');return false}
      return true;
    });
    if(!ic.length){window.removeEventListener('scroll',req);window.removeEventListener('resize',req)}
  }
  function req(){if(!tick){tick=true;requestAnimationFrame(check)}}
  window.addEventListener('scroll',req,{passive:true});window.addEventListener('resize',req);check();
})();

/* Zeitstrahl Startseite: nur die Sanduhr im letzten Schild dreht sich einmalig, sobald das Schild blau wird */
(function(){
  var tl=document.getElementById('tl');if(!tl)return;
  var last=tl.lastElementChild,done=false,tick=false;
  if(!last)return;
  function check(){
    tick=false;
    if(done)return;
    if(last.classList.contains('hit')){done=true;window.removeEventListener('scroll',req);var f=last.querySelector('.wmk-node .lg-f');if(f)setTimeout(function(){f.style.transform='rotate(180deg)'},500)}
  }
  function req(){if(!tick){tick=true;requestAnimationFrame(check)}}
  window.addEventListener('scroll',req,{passive:true});check();
})();
