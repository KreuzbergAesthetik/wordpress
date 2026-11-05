import re,subprocess,shutil,os
T='theme3/kreuzberg-aesthetik/'
shutil.rmtree('wptest',ignore_errors=True);os.makedirs('wptest')
shutil.copytree(T,'wptest',dirs_exist_ok=True)
stub=open('stub_tpl.php',encoding='utf8').read()
open('wptest/stub.php','w',encoding='utf8').write(stub)
out=subprocess.run(['php','stub.php'],cwd='wptest',capture_output=True,text=True)
if out.stderr.strip(): print(out.stderr[:800])
html=out.stdout
open('wptest/raw.html','w',encoding='utf8').write(html)
open('wptest/index.html','w',encoding='utf8').write(html)
body=html[:html.index('<script>window.KA_DATA')]
body=re.sub(r'href="/(ueber-mich|leistungen|ablauf|kontakt|impressum|datenschutz)/"',r'href="#\1"',body)
body=body.replace('href="/leistungen/#chat-hilfe"','href="#leistungen" data-kachat="1"')
body=body.replace('href="/"','href="#"')
data=re.search(r'<script>(window\.KA_DATA=.*?;)</script>',html,flags=re.S).group(1)
css=open(T+'style.css',encoding='utf8').read()
css=re.sub(r'/\*\nTheme Name.*?\*/\n','',css,flags=re.S)
css=re.sub(r'/\* [\w-]+ \*/\n@font-face\s*\{.*?\}\n','',css,flags=re.S)
css=css.replace('url(assets/','url(')
body=body.replace('assets/logo-light.png','logo-light.png').replace('assets/portrait.webp','portrait.jpg')
js=open(T+'script.js',encoding='utf8').read()
demo="""document.getElementById('contact-form').addEventListener('submit',function(e){e.preventDefault();var n=document.getElementById('note');n.hidden=false;n.textContent=this.checkValidity()?'Dies ist ein Entwurf. Das Formular sendet noch nichts ab.':'Bitte fülle alle Felder aus und stimme der Datenverarbeitung zu.'});\n"""
router='''
(function(){
  var views=[].slice.call(document.querySelectorAll('.kview'));
  function route(){
    var h=(location.hash||'#').slice(1)||'home';
    var found=views.some(function(v){return v.dataset.view===h});
    if(!found)h='home';
    views.forEach(function(v){v.hidden=v.dataset.view!==h});
    document.body.classList.toggle('sub',h!=='home');document.body.classList.toggle('home-page',h==='home');
    window.scrollTo(0,0);
    window.dispatchEvent(new Event('resize'));
    if(window.__kaChat){window.__kaChat=0;setTimeout(function(){var c=document.getElementById('chat-hilfe');if(c)window.scrollTo(0,c.getBoundingClientRect().top+(window.pageYOffset||0)-90)},500)}
  }
  document.addEventListener('click',function(e){var a=e.target.closest&&e.target.closest('a[data-kachat]');if(a)window.__kaChat=1},true);
  window.addEventListener('hashchange',route);
  route();
})();
'''
page='<title>Kreuzberg Ästhetik</title>\n<meta name="claude:viewport-fit-sides" content="cover">\n<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Literata:ital,wght@0,400;0,500;1,400&family=Lora:ital,wght@0,400;1,400&family=Quicksand:wght@400;500;600;700&display=swap">\n<style>\n'+css+'</style>\n'+body+'\n<script>\n'+demo+data+'\n'+js+'\n'+router+'\n</script>\n'
open('kt3.html','w',encoding='utf8').write(page)
print(len(page))
