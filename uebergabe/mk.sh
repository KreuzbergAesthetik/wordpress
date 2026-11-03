python3 build3.py >/dev/null && python3 - <<'P'
import base64
h=open('kt3.html',encoding='utf8').read().replace('assets/logo-dark.png','logo-dark.png').replace('assets/portrait-cutout.webp','portrait-cutout.webp')
pj='data:image/jpeg;base64,'+base64.b64encode(open('portrait.jpg','rb').read()).decode()
h=h.replace('url(portrait.webp)','url('+pj+')')
for n,m in [('logo-light.png','image/png'),('logo-dark.png','image/png'),('portrait.jpg','image/jpeg'),('hg-line.png','image/png'),('hg-fill.png','image/png'),('portrait-cutout.webp','image/webp'),('avatar.webp','image/webp')]:
    d='data:%s;base64,%s'%(m,base64.b64encode(open(n,'rb').read()).decode())
    h=h.replace('"'+n+'"','"'+d+'"').replace('url('+n+')','url('+d+')')
open('kt3d.html','w',encoding='utf8').write('<!doctype html>\n'+h)
P
