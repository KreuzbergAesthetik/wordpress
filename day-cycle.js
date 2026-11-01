/* Scroll-controlled daylight and night palette. No timer, tracking or external assets. */
(function(){
  'use strict';
  var root=document.documentElement;
  var media=window.matchMedia('(prefers-color-scheme:dark)');
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)');
  var select=document.getElementById('ka-appearance');
  var choice=root.getAttribute('data-appearance')||'auto';
  var frame=0,last='';
  var day=[
    [0,   '#a5b7d9','#ead7d9','#f3ebe6'],
    [.22, '#9dbde0','#d9e7f5','#f4f7fc'],
    [.45, '#b0cce6','#e0edf6','#f5f8fb'],
    [.65, '#a5b8d4','#f0d9c2','#f8ead8'],
    [.83, '#b0a8ca','#e8c4c7','#efe2ea'],
    [1,   '#8d9bbf','#c0bed9','#e3e4ef']
  ];
  var night=[
    [0,   '#273959','#3c4166','#252c4b'],
    [.25, '#172943','#263754','#121d35'],
    [.5,  '#080f23','#17233a','#0b1427'],
    [.75, '#11172d','#232b4b','#141b35'],
    [1,   '#263452','#4b4968','#27344e']
  ];
  function rgb(hex){return [parseInt(hex.slice(1,3),16),parseInt(hex.slice(3,5),16),parseInt(hex.slice(5,7),16)];}
  function blend(a,b,t){a=rgb(a);b=rgb(b);return 'rgb('+a.map(function(v,i){return Math.round(v+(b[i]-v)*t);}).join(',')+')';}
  function render(){
    frame=0;
    var dark=choice==='dark'||(choice==='auto'&&media.matches);
    var theme=dark?'dark':'light';
    root.setAttribute('data-theme',theme);
    var h=document.documentElement;
    var max=Math.max(0,h.scrollHeight-h.clientHeight);
    var p=max?Math.min(1,Math.max(0,(window.scrollY||h.scrollTop)/max)):0;
    // A stable gradient respects reduced-motion preferences.
    if(reduce.matches)p=.45;
    var key=theme+':'+p.toFixed(4);
    if(key===last)return;
    last=key;
    var stops=dark?night:day;
    var a=stops[0],b=stops[1];
    for(var i=1;i<stops.length;i++){a=stops[i-1];b=stops[i];if(p<=b[0])break;}
    var t=Math.min(1,Math.max(0,(p-a[0])/(b[0]-a[0])));
    // Smooth joins keep the palette changes calm even at the phase boundaries.
    t=t*t*(3-2*t);
    root.style.setProperty('--cycle-top',blend(a[1],b[1],t));
    root.style.setProperty('--cycle-horizon',blend(a[2],b[2],t));
    root.style.setProperty('--cycle-bottom',blend(a[3],b[3],t));
    root.style.setProperty('--cycle-progress',p.toFixed(4));
  }
  function queue(){if(!frame)frame=requestAnimationFrame(render);}
  function setChoice(value){
    choice=value==='dark'||value==='light'?value:'auto';
    root.setAttribute('data-appearance',choice);
    if(select)select.value=choice;
    last='';render();
  }
  if(select){select.value=choice;select.addEventListener('change',function(){setChoice(select.value);try{localStorage.setItem('ka-appearance',choice);}catch(e){}});}
  window.addEventListener('scroll',queue,{passive:true});
  window.addEventListener('resize',queue,{passive:true});
  window.addEventListener('pageshow',queue);
  window.addEventListener('storage',function(event){if(event.key==='ka-appearance')setChoice(event.newValue);});
  [media,reduce].forEach(function(query){if(query.addEventListener)query.addEventListener('change',queue);else if(query.addListener)query.addListener(queue);});
  if(window.ResizeObserver)new ResizeObserver(queue).observe(document.body);
  if(document.fonts&&document.fonts.ready)document.fonts.ready.then(queue);
  render();
})();
