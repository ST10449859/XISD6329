const API_BASE = new URL('api/', document.baseURI).toString();
const TOKEN_KEY = 'fightclubsa_token';
const USER_KEY = 'fightclubsa_user';
function getToken(){return localStorage.getItem(TOKEN_KEY);}
function getUser(){try{return JSON.parse(localStorage.getItem(USER_KEY)||'null');}catch{return null;}}
function setSession(data){localStorage.setItem(TOKEN_KEY,data.token);localStorage.setItem(USER_KEY,JSON.stringify(data.user));}
function clearSession(){localStorage.removeItem(TOKEN_KEY);localStorage.removeItem(USER_KEY);}
function escapeHtml(v){return String(v??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[c]));}
function money(v){return new Intl.NumberFormat('en-ZA',{style:'currency',currency:'ZAR'}).format(Number(v||0));}
function showMessage(message,type=''){const box=document.getElementById('message');if(!box){alert(message);return;}box.textContent=message;box.className='notice'+(type?' '+type:'');box.hidden=false;}
async function api(path,options={}){const headers={...(options.headers||{})};if(options.body&&!headers['Content-Type'])headers['Content-Type']='application/json';if(getToken())headers.Authorization='Bearer '+getToken();let response;try{response=await fetch(API_BASE+path,{...options,headers});}catch{throw new Error('Cannot reach the server. Check your internet connection.');}let data;try{data=await response.json();}catch{throw new Error('The server did not return JSON. Check the PHP configuration and error log.');}if(response.status===401){clearSession();}if(!response.ok||data.success===false)throw new Error(data.message||'The request failed.');return data;}
function requireLogin(){if(!getToken())location.href='login.php';}
async function logout(){try{if(getToken())await api('logout.php',{method:'POST',body:'{}'});}catch(e){console.warn(e.message);}clearSession();location.href='index.php';}
function applyTheme(theme){document.body.classList.toggle('dark',theme==='dark');}
async function loadSavedTheme(){if(!getToken())return;try{const r=await api('settings.php');applyTheme(r.settings?.theme||'light');}catch{}}
document.addEventListener('DOMContentLoaded',()=>{loadSavedTheme();document.querySelectorAll('[data-logout]').forEach(b=>b.addEventListener('click',logout));document.querySelectorAll('[data-member-link]').forEach(a=>a.hidden=!getToken());document.querySelectorAll('[data-guest-link]').forEach(a=>a.hidden=!!getToken());const toggle=document.querySelector('.menu-toggle');if(toggle)toggle.addEventListener('click',()=>{const nav=document.querySelector('.main-nav');nav.classList.toggle('open');toggle.setAttribute('aria-expanded',nav.classList.contains('open')?'true':'false');});});
