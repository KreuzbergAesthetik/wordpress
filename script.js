
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
  var DOCK_AT=90,UNDOCK_AT=24,COLLAPSE_AT=420,PIN=0,M={on:false,w0:1,h0:1,k1:1,top:12,W:0,vh:0};
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
    var headDone=false;try{headDone=sessionStorage.getItem('ka_head_done')==='1'}catch(e){}
    M.on=!!pin&&!document.body.classList.contains('sub')&&vh>=480&&!reduce&&PH<=vh*2.2&&!headDone&&!M.done;
    document.body.classList.toggle('head-done',headDone&&!M.done);
    M.off=0;
    document.documentElement.style.setProperty('--pintop',(-M.off)+'px');
    document.body.classList.toggle('nowm',!M.on);
    PIN=M.on?Math.round(Math.max(260,Math.min(420,vh*.5))):0;
    COLLAPSE_AT=PIN+140+(M.off||0);
    document.documentElement.style.setProperty('--pinlen',PIN+'px');
    mast.classList.toggle('pc',M.on);
    M.top=parseFloat(getComputedStyle(nav).top)||12;
    M.w0=wm.offsetWidth||1;M.h0=wm.offsetHeight||1;
    M.k1=((W<=370?1:(W<=700?1.2:1.5))*rem)/(parseFloat(getComputedStyle(wm).fontSize)||48);
    M.k0=1;M.c0=null;M.c1=null;
    if(M.on&&slot&&slot.classList.contains('hero-brand')){
      var r0=document.createRange();r0.selectNodeContents(slot);M.k0=(r0.getBoundingClientRect().width||M.w0)/M.w0;
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
    var t=M.done?1:M.on?Math.max(0,Math.min(1,(y-M.off)/PIN)):(FADE?Math.max(0,Math.min(1,y/200)):1),e=t<.5?2*t*t:1-Math.pow(-2*t+2,2)/2;
    docked=t>=1;
    if(M.on&&docked&&!M.done){M.done=true;try{sessionStorage.setItem('ka_head_done','1')}catch(e){}document.body.classList.remove('wmfly');var lg=slot&&slot.previousElementSibling;if(lg)lg.style.opacity=''}
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
    var topC=M.top+29,startC=M.vh-16-29;
    var slotC=M.on?slot.getBoundingClientRect().top+slot.offsetHeight/2:topC;
    var pcn=topC,wc=slotC+(topC-slotC)*e,k=M.on?M.k0+(M.k1-M.k0)*e:M.k1;
    var cx0=M.W/2;
    if(M.on&&M.c0){var rg=document.createRange();rg.selectNodeContents(slot);var rb=rg.getBoundingClientRect();cx0=rb.left+rb.width/2;wc=(rb.top+rb.height/2)+(topC-(rb.top+rb.height/2))*e;
      wm.style.color=e>=1?'':'rgb('+[0,1,2].map(function(j){return Math.round(M.c0[j]+(M.c1[j]-M.c0[j])*e)}).join(',')+')'}
    nav.style.setProperty('--ty',(pcn-topC).toFixed(1)+'px');tyApplied=(pcn-topC).toFixed(1)+'px';
    var pc=pcn;
    var sc=1+.45*(1-e);nav.style.setProperty('--sc',sc.toFixed(4));nav.style.opacity='';nav.style.setProperty('--na',e.toFixed(3));nav.style.pointerEvents=e<.6?'none':'';
    var hbb=document.getElementById('hbbtn');if(hbb){var dd=hbb.offsetLeft+hbb.offsetWidth/2-nav.clientWidth/2;hbb.style.transform=sc>1?'translateX('+(dd*(1/sc-1)).toFixed(1)+'px) scale('+(1/sc).toFixed(4)+')':'';hbb.style.pointerEvents='auto'}
    var hs=document.getElementById('hgslot'),hsOn=M.on&&hs&&hs.offsetParent!==null;hg.style.opacity=hsOn?'1':e.toFixed(3);wm.style.opacity=M.on?'':e.toFixed(3);wm.style.pointerEvents=e<.6?'none':'';
    place(cx0+(M.W/2-cx0)*e,wc,k);
    var cx,cy,kk;
    if(col){cx=M.W-12-28;cy=M.top+28;kk=38/M.hh}
    else{cx=(M.W-M.pw)/2+M.padL+22;cy=pc;kk=44/M.hh}
    if(M.on&&typeof sc!=='undefined'&&sc>1){cx=M.W/2+(cx-M.W/2)*sc;cy=topC+(cy-topC)*sc;kk*=sc}
    if(hsOn&&e<1){var hr=hs.getBoundingClientRect(),hx=hr.left+hr.width/2,hy=hr.top+hr.height/2,hk=hr.height/M.hh;cx=hx+(cx-hx)*e;cy=hy+(cy-hy)*e;kk=hk+(kk-hk)*e}
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
      var sub=null,subHit=false,subs=[];
      [].forEach.call(g.querySelectorAll('tr'),function(tr){
        if(tr.classList.contains('sub')){sub=tr;subs.push(tr);tr._m=all||tr.textContent.toLowerCase().indexOf(t)>-1;tr._any=false;return}
        var m=all||tr.textContent.toLowerCase().indexOf(t)>-1||(sub&&sub._m);
        tr.hidden=!m;if(m){shown++;if(sub)sub._any=true}
      });
      subs.forEach(function(s){s.hidden=!s._any});
      g.hidden=shown===0;if(shown)any=true;
    });
    none.hidden=any;
  });
})();

(function(){
  var D=window.KA_DATA||{},WA=(D.phone||'').replace(/^\+/,''),MAIL=D.mail||'',chat=document.getElementById('chat');
  if(!chat)return;
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)').matches;
  var T={},order=[];(D.topics||[]).forEach(function(t,i){var k='t'+i;T[k]=t;order.push(k)});
  var asked={},topics=[],busy=false;
  function dec(x){var d=document.createElement('textarea');d.innerHTML=x;return d.value}
  function el(tag,cls,html){var e=document.createElement(tag);if(cls)e.className=cls;if(html!=null)e.innerHTML=html;return e}
  var ready=false;
  function show(){if(!ready)return;var l=chat.lastElementChild;if(l)l.scrollIntoView({behavior:reduce?'auto':'smooth',block:'nearest'})}
  function manuel(html){var r=el('div','crow');r.appendChild(el('span','cav'));r.appendChild(el('div','cbub',html));chat.appendChild(r)}
  function me(t){var r=el('div','crow me');r.appendChild(el('div','cbub',t));chat.appendChild(r)}
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
  function book(){say(['<p>Sehr gern. Termine vergebe ich aktuell persönlich. Schreibe mir einfach'+(topics.length?'. Ich habe Deine Themen schon in die Nachricht geschrieben: '+topics.join(', ')+'.':'.')+'</p><p class="cbtn-wrap"><a class="cbtn" href="https://wa.me/'+WA+'?text='+encodeURIComponent(text())+'" target="_blank" rel="noopener">'+(D.btn||'Nachricht schreiben')+'</a></p><p>Oder per E-Mail: <a class="cmail" href="mailto:'+MAIL+'?subject='+encodeURIComponent('Terminanfrage')+'&body='+encodeURIComponent(text())+'">'+MAIL+'</a></p><p class="cfine">Bitte schicke in der ersten Nachricht keine Fotos oder Gesundheitsdaten.</p>'],function(){chips([{label:'Noch eine Frage',fn:function(){say(['Gern. Was möchtest Du noch wissen?'],menu)}}])})}
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
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)').matches;
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
