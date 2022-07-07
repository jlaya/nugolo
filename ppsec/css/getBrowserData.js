// v3.0
function hash(b,e){var a,f;for(a=0;a<e.length;a++){f=e.charCodeAt(a)&127;if(f>33&&f!==45&&f!==60&&f!==62&&f!==127){b^=f;b+=(b<<1)+(b<<4)+(b<<7)+(b<<8)+(b<<24)}}return b}
function hex(a){return(((a>>>28)&15)===0?"":((a>>>28)&15).toString(16))+(a&268435455).toString(16)}
function bcode(f){var d="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",g="",c=0,e,b,a;while(c<f.length){e=f.charCodeAt(c++);if(c<f.length){b=f.charCodeAt(c++);if(c<f.length){a=f.charCodeAt(c++)}else{a=524288}}else{b=0;a=4096+524288}g+=d.charAt(e>>>2)+d.charAt((e&3)<<4|b>>>4)+d.charAt((b&15)<<2|a>>>6&67)+d.charAt(a&63|a>>>13)}return g}
function getBrowserData(){var C,L="",I=(navigator.cookieEnabled)?0:1;if(navigator.javaEnabled()){I+=2}if(document.defaultCharset){I=hash(I,document.defaultCharset)}if(navigator.plugins&&navigator.plugins.length>0){for(C=0;C<navigator.mimeTypes.length;C++){I=hash(I,navigator.mimeTypes[C].type);I=hash(I,navigator.mimeTypes[C].suffixes);I=hash(I,navigator.mimeTypes[C].description)}for(C=0;C<navigator.plugins.length;C++){I=hash(I,navigator.plugins[C].name);I=hash(I,navigator.plugins[C].filename);I=hash(I,navigator.plugins[C].description)}}if(document.getElementsByTagName){var G=/^(https?:\/\/)?([^:?]*(:[^\/\\][^?]*)?)(\?.*)?$/i,D=/^([^:\/]*\.)?nab\.com\.au($|\/|:)/i,f=["script","form","iframe"],c=[/dob/gi,/birth/gi,/mobile/gi,/phone/gi,/payee/gi,/userid/gi,/loginForm/gi,/password/gi],H=0,F=0,E=0,B,z,y,x,v,g,u;for(C=0;C<f.length;C++){g=document.getElementsByTagName(f[C]);F*=100;if(g){F+=g.length;for(B=0;B<g.length;B++){u="";z=g[B].src;if(!z){z=g[B].action}if(z&&z.length>0){z=z.match(G);if(z){if(z[2].length>0){if(z[1]&&!D.test(z[2])){H++;u+="_"+bcode(z[2])}else{u+=hex(hash(0,z[2]))}}}}if(f[C]==="form"){z=g[B].getElementsByTagName("input");if(z){y=0;for(x=0;x<z.length;x++){if(z[x].name){y+=hash(y,z[x].name)}}u+=":"+z.length.toString()+"*"+hex(y)}}else{z=g[B].innerHTML;if(!z){z=g[B].html}if(z&&z.length>9){y=0;for(x=0;x<c.length;x++){v=z.match(c[x]);y*=36;if(v){y+=v.length}}u+=":"+y.toString(36)+"-"+hex(hash(0,z));E+=y}}z=g[B].id;if(z&&z.length>0){if(u===""){u=":"}u+="~"+bcode(z)}z=g[B].name;if(z&&z.length>0){if(u===""){u=":"}u+="!"+bcode(z)}if(u!==""){if(L!==""){L+=","}L+=u}}}}L=";i="+H.toString()+";j="+F.toString()+";k="+E.toString()+";c="+L+";"}C=null;if(window.XMLHttpRequest){C=new XMLHttpRequest()}else{if(window.ActiveXObject){try{C=new ActiveXObject("Microsoft.XMLHTTP")}catch(J){}}}if(C!==null){try{C.open("GET","/nabib/tag.jsp",false);C.send(null);if(C.status===200||C.status===304){L=";t="+C.responseText+L}}catch(J){}}var K=new Date();var A=new Date(K.getFullYear(),0,1,0,0,0,0);var a=new Date(K.getFullYear(),6,1,0,0,0,0);return K.getTime()+";z="+A.getTimezoneOffset()+"*"+a.getTimezoneOffset()+";s="+screen.width+"x"+screen.height+"x"+screen.colorDepth+";h="+hex(I)+";l="+(navigator.language?navigator.language:navigator.userLanguage)+";p="+navigator.platform+L};

