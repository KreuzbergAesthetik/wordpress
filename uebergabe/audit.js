// Prüfskript: alle Seiten × Geräte × hell/dunkel. Aufruf im Ordner mit der gebauten Vorschau (kt3d_neu.html, Unterordner audit/): node audit.js [seiten] [light,dark]
const {chromium}=require('playwright');const fs=require('fs');
const views=(process.argv[2]||'home,leistungen,ablauf,ueber-mich,kontakt').split(',');
const themes=(process.argv[3]||'light,dark').split(',');
const VP=[['handy',390,844],['tabhoch',768,1024],['tabquer',1024,768],['desktop',1440,900]];
(async()=>{const b=await chromium.launch();const report={};
for(const th of themes)for(const [vn,W,H] of VP){
 const ctx=await b.newContext({viewport:{width:W,height:H},colorScheme:th});
 await ctx.addInitScript(([s])=>{try{localStorage.setItem('ka-appearance',s);sessionStorage.setItem('ka_head_done_109','1')}catch(e){}},[th]);
 for(const v of views){const p=await ctx.newPage();
  await p.goto('file://'+process.cwd()+'/kt3d_neu.html'+(v==='home'?'':'#'+v));await p.waitForTimeout(1200);
  const hh=await p.evaluate(()=>document.documentElement.scrollHeight);
  for(let y=0;y<hh;y+=250){await p.evaluate(y=>scrollTo(0,y),y);await p.waitForTimeout(25)}
  await p.waitForTimeout(500);await p.evaluate(()=>scrollTo(0,0));await p.waitForTimeout(400);
  const m=await p.evaluate((dark)=>{
   const vw=innerWidth,out={};
   const root=document.querySelector('.kview:not([hidden])')||document.body;
   const vis=e=>{if(!e.offsetParent&&getComputedStyle(e).position!=='fixed')return false;const r=e.getBoundingClientRect();return r.width>1&&r.height>1};
   out.scrollW=document.documentElement.scrollWidth;out.vw=vw;out.h=document.documentElement.scrollHeight;
   // Überstand
   const of=[];document.querySelectorAll('body *').forEach(e=>{if(!vis(e))return;if(e.closest('[hidden]'))return;const r=e.getBoundingClientRect();if(r.right>vw+2||r.left<-2){const cs=getComputedStyle(e);if(cs.position==='fixed'&&e.id!=='wa-float')return;let c=e,clip=false;while(c=c.parentElement){const o=getComputedStyle(c);if(o.overflowX==='hidden'||o.overflowX==='clip'||o.overflow==='hidden'||o.overflowX==='auto'){clip=true;break}}if(!clip)of.push((e.tagName.toLowerCase()+'.'+(typeof e.className==='string'?e.className.trim().split(/\s+/).slice(0,2).join('.'):''))+' '+Math.round(r.left)+'…'+Math.round(r.right))}});
   out.overflow=[...new Set(of)].slice(0,12);
   // Kontrast
   function parse(c){const m=c.match(/rgba?\(([^)]+)\)/);if(!m)return null;const a=m[1].split(/[ ,\/]+/).filter(Boolean).map(Number);return [a[0],a[1],a[2],a.length>3?a[3]:1]}
   function lum(c){const f=x=>{x/=255;return x<=.03928?x/12.92:Math.pow((x+.055)/1.055,2.4)};return .2126*f(c[0])+.7152*f(c[1])+.0722*f(c[2])}
   function mix(t,b){const a=t[3];return [t[0]*a+b[0]*(1-a),t[1]*a+b[1]*(1-a),t[2]*a+b[2]*(1-a),1]}
   function bgOf(el){const ls=[];let n=el,grad=null;while(n&&n.nodeType===1){const s=getComputedStyle(n);const c=parse(s.backgroundColor);if(!grad&&s.backgroundImage&&/gradient/.test(s.backgroundImage)){const cols=[...s.backgroundImage.matchAll(/rgba?\([^)]+\)/g)].map(x=>parse(x[0])).filter(x=>x&&x[3]>.5);if(cols.length){grad=cols[Math.floor(cols.length/2)];ls.push(grad);break}}if(c&&c[3]>0){ls.push(c);if(c[3]>=.98)break}n=n.parentElement}let base=dark?[1,34,101,1]:[240,244,252,1];for(let i=ls.length-1;i>=0;i--)base=mix(ls[i],base);return base}
   const cf=[];const seen=new Set();const w=document.createTreeWalker(document.body,NodeFilter.SHOW_TEXT);let t;
   while(t=w.nextNode()){const tx=t.textContent.trim();if(tx.length<2)continue;const el=t.parentElement;if(!el||seen.has(el)||!vis(el)||el.closest('[hidden]'))continue;seen.add(el);let hid=false,n=el;while(n&&n.nodeType===1){const ss=getComputedStyle(n);if(+ss.opacity<.05||ss.visibility==='hidden'){hid=true;break}n=n.parentElement}if(hid)continue;if(el.closest('[aria-hidden="true"]')&&!el.closest('.mast'))continue;
    const s=getComputedStyle(el),fg=parse(s.color);if(!fg)continue;const bg=bgOf(el),f=mix(fg,bg),L1=lum(f),L2=lum(bg),cr=(Math.max(L1,L2)+.05)/(Math.min(L1,L2)+.05),fs=parseFloat(s.fontSize),large=fs>=24||(fs>=18.6&&+s.fontWeight>=600);
    if(cr<(large?3:4.5))cf.push(cr.toFixed(1)+' '+Math.round(fs)+'px "'+tx.slice(0,28)+'" '+el.tagName.toLowerCase()+'.'+(typeof el.className==='string'?el.className.trim().split(/\s+/)[0]:''));
    if(fs<12&&tx.length>3)(out.small=out.small||[]).push(Math.round(fs*10)/10+'px "'+tx.slice(0,24)+'"')}
   out.contrast=[...new Set(cf)].slice(0,14);if(out.small)out.small=[...new Set(out.small)].slice(0,8);
   // Tippflächen
   const tp=[];document.querySelectorAll('a,button,summary,select,input').forEach(e=>{if(!vis(e)||e.closest('[hidden]'))return;const r=e.getBoundingClientRect();const inl=getComputedStyle(e).display==='inline';if(inl)return;if(r.height<40||r.width<40)tp.push(Math.round(r.width)+'×'+Math.round(r.height)+' '+e.tagName.toLowerCase()+'.'+(typeof e.className==='string'?e.className.trim().split(/\s+/).slice(0,2).join('.'):'')+' "'+(e.textContent||e.getAttribute('aria-label')||'').trim().slice(0,16)+'"')});
   out.tap=[...new Set(tp)].slice(0,14);
   // Gestaltungswerte
   const tok=(sel)=>[...root.querySelectorAll(sel)].filter(vis).slice(0,1).map(e=>{const s=getComputedStyle(e),r=e.getBoundingClientRect();return Math.round(r.width)+'×'+Math.round(r.height)+' fs'+parseFloat(s.fontSize).toFixed(1)+' fw'+s.fontWeight+' r'+s.borderTopLeftRadius+' ff:'+s.fontFamily.split(',')[0].replace(/"/g,'')})[0];
   out.tok={};for(const s of ['h2','.eyebrow','.intro p','.hero-act-main','.hero-act-line','.lei-btn-main','.sum-contact .btn','.kon-page-btns .btn','#contact-form button[type=submit]','.grp','.lei-sum','.steps li','.check','.faq details','.phil-box','.lon-box','.chat-window','.next-link a','.wrap'])if(tok(s))out.tok[s]=tok(s);
   const wr=root.querySelector('.wrap');if(wr){const r=wr.getBoundingClientRect();out.gutter=Math.round(r.left)+'|'+Math.round(vw-r.right)}
   return out},th==='dark');
  report[`${v}|${vn}|${th}`]=m;
  await p.screenshot({path:`audit/${v}_${vn}_${th}.png`,fullPage:true});
  await p.close()}
 await ctx.close()}
fs.writeFileSync('audit/report.json',JSON.stringify(report,null,1));await b.close();console.log('fertig',Object.keys(report).length)})();
