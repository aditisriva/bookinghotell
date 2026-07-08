'use strict';
const sb=document.getElementById('dsSb'),ov=document.getElementById('dsOv'),tog=document.getElementById('dsTog');
tog?.addEventListener('click',()=>{sb.classList.toggle('open');ov.classList.toggle('show')});
ov?.addEventListener('click',()=>{sb.classList.remove('open');ov.classList.remove('show')});

const pg=location.pathname.split('/').pop()||'admin-dashboard.php';
document.querySelectorAll('.ds-link').forEach(a=>{if(a.getAttribute('href')===pg)a.classList.add('active')});

const avb=document.getElementById('dsAvBtn'),avm=document.getElementById('dsAvMenu');
avb?.addEventListener('click',e=>{e.stopPropagation();avm?.classList.toggle('show')});
document.addEventListener('click',()=>avm?.classList.remove('show'));

function dsToast(msg,type='success'){
  let w=document.getElementById('dsToastWrap');
  if(!w){w=document.createElement('div');w.id='dsToastWrap';w.style.cssText='position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;display:flex;flex-direction:column;gap:.5rem;max-width:320px';document.body.appendChild(w)}
  const c={success:'#064e3b',error:'#7f1d1d',info:'#1e3a8a',warn:'#78350f'};
  const tc={success:'#a7f3d0',error:'#fecaca',info:'#bfdbfe',warn:'#fde68a'};
  const ic={success:'bi-check-circle-fill',error:'bi-x-circle-fill',info:'bi-info-circle-fill',warn:'bi-exclamation-triangle-fill'};
  const t=document.createElement('div');
  t.style.cssText=`background:${c[type]};color:${tc[type]};padding:.75rem 1rem;border-radius:10px;font-size:.84rem;font-weight:500;font-family:'Inter',sans-serif;display:flex;align-items:center;gap:.55rem;box-shadow:0 4px 20px rgba(0,0,0,.2)`;
  t.innerHTML=`<i class="bi ${ic[type]}"></i><span>${msg}</span>`;
  w.appendChild(t);
  setTimeout(()=>{t.style.opacity='0';t.style.transition='opacity .3s';setTimeout(()=>t.remove(),320)},3000);
}

function dsConfirm(msg,fn){if(confirm(msg||'Delete?'))fn()}

if(window.Chart){Chart.defaults.font.family="'Inter',system-ui,sans-serif";Chart.defaults.color='#64748b'}
function renderRevenue(id){const c=document.getElementById(id);if(!c||!window.Chart)return;new Chart(c,{type:'line',data:{labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],datasets:[{label:'Revenue (₹)',data:[185000,210000,195000,248000,312000,285000,340000,368000,298000,315000,385000,420000],borderColor:'#1a56db',backgroundColor:'rgba(26,86,219,.08)',borderWidth:2.5,fill:true,tension:.4,pointBackgroundColor:'#1a56db',pointRadius:4,pointHoverRadius:6}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{grid:{color:'#f1f5f9'},ticks:{callback:v=>'₹'+(v/1000).toFixed(0)+'K'}},x:{grid:{display:false}}}}})}
function renderTrend(id){const c=document.getElementById(id);if(!c||!window.Chart)return;new Chart(c,{type:'bar',data:{labels:['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],datasets:[{label:'New',data:[12,19,8,15,22,28,18],backgroundColor:'rgba(26,86,219,.8)',borderRadius:6},{label:'Cancelled',data:[2,3,1,4,3,2,1],backgroundColor:'rgba(220,38,38,.7)',borderRadius:6}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'top'}},scales:{y:{grid:{color:'#f1f5f9'},beginAtZero:true},x:{grid:{display:false}}}}})}
function renderOcc(id){const c=document.getElementById(id);if(!c||!window.Chart)return;new Chart(c,{type:'doughnut',data:{labels:['Occupied','Available','Maintenance'],datasets:[{data:[18,9,3],backgroundColor:['#1a56db','#059669','#f59e0b'],borderWidth:0,hoverOffset:6}]},options:{responsive:true,maintainAspectRatio:false,cutout:'70%',plugins:{legend:{position:'bottom'}}}})}
function renderMonthly(id){const c=document.getElementById(id);if(!c||!window.Chart)return;new Chart(c,{type:'bar',data:{labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],datasets:[{label:'Earnings',data:[185000,210000,195000,248000,312000,285000,340000,368000,298000,315000,385000,420000],backgroundColor:'rgba(26,86,219,.75)',borderRadius:6}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{grid:{color:'#f1f5f9'},ticks:{callback:v=>'₹'+(v/1000).toFixed(0)+'K'}},x:{grid:{display:false}}}}})}
