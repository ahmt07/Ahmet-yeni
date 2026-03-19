<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ahmet Tekeli • Online Randevu Sistemi</title>
  <style>
    :root{
      --bg:#0b0f17;
      --panel:#121826;
      --panel-2:#161f31;
      --line:#283247;
      --text:#f3f4f6;
      --muted:#a9b2c7;
      --gold:#d4af37;
      --gold-2:#f2d77a;
      --green:#10b981;
      --blue:#3b82f6;
      --red:#ef4444;
      --red-dark:#7f1d1d;
      --yellow:#f59e0b;
      --gray:#6b7280;
      --shadow:0 10px 30px rgba(0,0,0,.35);
      --radius:18px;
    }

    *{box-sizing:border-box}
    html,body{margin:0;padding:0;background:radial-gradient(circle at top,#192238 0%,#0b0f17 45%,#070b12 100%);color:var(--text);font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}
    a{text-decoration:none;color:inherit}
    button,input,select,textarea{font:inherit}
    .hidden{display:none !important}

    .app{
      min-height:100vh;
      display:flex;
      flex-direction:column;
    }

    .topbar{
      position:sticky; top:0; z-index:50;
      display:flex; align-items:center; justify-content:space-between;
      gap:12px; padding:14px 18px;
      backdrop-filter: blur(12px);
      background:rgba(10,15,24,.82);
      border-bottom:1px solid rgba(255,255,255,.06);
    }
    .brand{display:flex;align-items:center;gap:12px}
    .brand-logo{
      width:42px;height:42px;border-radius:14px;
      display:grid;place-items:center;font-size:20px;font-weight:900;
      background:linear-gradient(135deg,#1f2a44,#0d1320);
      border:1px solid rgba(212,175,55,.35);
      box-shadow:0 0 0 1px rgba(212,175,55,.12),0 8px 20px rgba(0,0,0,.35);
      color:var(--gold-2);
    }
    .brand-text h1{margin:0;font-size:18px;line-height:1.1}
    .brand-text p{margin:4px 0 0;color:var(--muted);font-size:12px}
    .top-actions{display:flex;gap:8px;align-items:center;flex-wrap:wrap}
    .clock-chip,.chip{
      border:1px solid rgba(255,255,255,.08);
      background:rgba(255,255,255,.04);
      color:var(--text);
      padding:10px 12px;border-radius:999px;font-size:12px;font-weight:700;
    }

    .btn{
      border:none;cursor:pointer;border-radius:14px;padding:11px 14px;font-weight:800;
      transition:.2s transform,.2s opacity,.2s box-shadow;
      color:#fff;
      box-shadow:var(--shadow);
    }
    .btn:hover{transform:translateY(-1px)}
    .btn:active{transform:translateY(0)}
    .btn-primary{background:linear-gradient(135deg,var(--gold),#a17f1a);color:#111}
    .btn-dark{background:linear-gradient(135deg,#1d2740,#0f1626)}
    .btn-blue{background:linear-gradient(135deg,#2563eb,#1d4ed8)}
    .btn-green{background:linear-gradient(135deg,#10b981,#059669)}
    .btn-red{background:linear-gradient(135deg,#ef4444,#b91c1c)}
    .btn-gray{background:linear-gradient(135deg,#6b7280,#4b5563)}
    .btn-small{padding:8px 10px;font-size:12px;border-radius:12px}

    .shell{
      width:min(1400px,100% - 24px);
      margin:20px auto 30px;
      display:grid;
      grid-template-columns:280px 1fr;
      gap:18px;
    }

    .sidebar,.panel,.card,.modal-box{
      background:linear-gradient(180deg,rgba(22,31,49,.95),rgba(16,22,34,.95));
      border:1px solid rgba(255,255,255,.06);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
    }

    .sidebar{padding:14px; align-self:start; position:sticky; top:78px}
    .menu-title{font-size:12px;color:var(--muted);font-weight:800;text-transform:uppercase;letter-spacing:.08em;margin:6px 8px 10px}
    .menu{display:flex;flex-direction:column;gap:8px}
    .menu button{
      width:100%; text-align:left; border:none; cursor:pointer;
      background:transparent;color:var(--text);padding:13px 14px;border-radius:14px;font-weight:700;
      border:1px solid transparent;
    }
    .menu button.active,.menu button:hover{background:rgba(255,255,255,.05);border-color:rgba(212,175,55,.18)}

    .content{display:grid;gap:18px}
    .hero{
      padding:22px;
      display:grid;grid-template-columns:1.35fr .9fr;gap:18px;
    }
    .hero h2{margin:0;font-size:28px;line-height:1.05}
    .hero p{color:var(--muted);line-height:1.6}
    .hero-card{
      padding:18px;border-radius:16px;
      background:linear-gradient(135deg,rgba(212,175,55,.16),rgba(255,255,255,.03));
      border:1px solid rgba(212,175,55,.2);
    }
    .hero-stat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
    .mini-stat{padding:16px;border-radius:16px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06)}
    .mini-stat .v{font-size:28px;font-weight:900;color:var(--gold-2)}
    .mini-stat .l{font-size:12px;color:var(--muted);font-weight:700}

    .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px}
    .grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
    .panel{padding:18px}
    .panel-head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:16px;flex-wrap:wrap}
    .panel-head h3{margin:0;font-size:20px}
    .muted{color:var(--muted)}

    .form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
    .form-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
    .field{display:flex;flex-direction:column;gap:8px}
    .field label{font-size:13px;color:#d8dee9;font-weight:700}
    .field input,.field select,.field textarea{
      width:100%;
      background:#0e1523;color:#fff;border:1px solid var(--line);outline:none;
      border-radius:14px;padding:13px 14px;
    }
    .field textarea{min-height:96px;resize:vertical}
    .field input:focus,.field select:focus,.field textarea:focus{border-color:rgba(212,175,55,.5);box-shadow:0 0 0 3px rgba(212,175,55,.08)}

    .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
    .stat{padding:16px;border-radius:16px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06)}
    .stat .value{font-size:30px;font-weight:900}
    .stat .label{font-size:12px;color:var(--muted);font-weight:700;margin-top:6px}

    .table-wrap{overflow:auto;border-radius:16px;border:1px solid rgba(255,255,255,.06)}
    table{width:100%;border-collapse:collapse;min-width:900px;background:rgba(255,255,255,.02)}
    th,td{padding:14px 12px;border-bottom:1px solid rgba(255,255,255,.06);text-align:left;font-size:14px}
    th{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;background:rgba(255,255,255,.03)}

    .badge{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:999px;font-weight:800;font-size:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.06)}
    .badge.gold{color:#111;background:linear-gradient(135deg,var(--gold-2),var(--gold))}
    .badge.green{background:rgba(16,185,129,.16);color:#86efac;border-color:rgba(16,185,129,.24)}
    .badge.red{background:rgba(239,68,68,.16);color:#fca5a5;border-color:rgba(239,68,68,.24)}
    .badge.yellow{background:rgba(245,158,11,.16);color:#fcd34d;border-color:rgba(245,158,11,.24)}
    .badge.gray{background:rgba(107,114,128,.16);color:#d1d5db;border-color:rgba(107,114,128,.24)}
    .badge.blue{background:rgba(59,130,246,.16);color:#93c5fd;border-color:rgba(59,130,246,.24)}

    .cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:16px}
    .appointment-card{
      position:relative;
      padding:18px;
      border-radius:18px;
      background:linear-gradient(180deg,#141c2c 0%,#0f1523 100%);
      border:2px solid #2b3548;
      overflow:hidden;
    }
    .appointment-top{display:flex;justify-content:space-between;gap:10px;align-items:flex-start;margin-bottom:12px}
    .appointment-name{font-size:20px;font-weight:900}
    .appointment-info{display:grid;gap:8px;font-size:14px;color:#d1d5db;margin-bottom:12px}
    .appointment-info strong{color:#fff}
    .appointment-timeleft{margin-top:8px;padding:10px 12px;background:rgba(255,255,255,.04);border-radius:12px;font-weight:800;color:#93c5fd;font-size:13px}
    .appointment-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}

    .uyari-yaklasti{border-color:var(--yellow)!important;background:linear-gradient(180deg,#2d240f 0%,#0f1523 100%);box-shadow:0 0 0 1px rgba(245,158,11,.15),0 0 18px rgba(245,158,11,.08)}
    .randevu-zamani-geldi{border-color:var(--red)!important;background:linear-gradient(180deg,#330f12 0%,#0f1523 100%);animation:randevuBlink 1s infinite}
    .randevu-zamani-geldi::before{content:"RANDEVU SAATİ GELDİ";position:absolute;top:12px;right:12px;padding:5px 8px;border-radius:999px;background:#ff0000;color:#fff;font-size:10px;font-weight:900;letter-spacing:.05em}
    .randevu-gecikti{border-color:var(--red-dark)!important;background:linear-gradient(180deg,#25090a 0%,#0f1523 100%);box-shadow:0 0 18px rgba(127,29,29,.35)}
    .tamamlandi{border-color:var(--green)!important;background:linear-gradient(180deg,#0d2d1f 0%,#0f1523 100%)}
    .iptal{border-color:var(--gray)!important;background:linear-gradient(180deg,#2d2d34 0%,#0f1523 100%);opacity:.92}
    @keyframes randevuBlink{0%{box-shadow:0 0 0 rgba(255,0,0,0)}50%{box-shadow:0 0 24px rgba(239,68,68,.9)}100%{box-shadow:0 0 0 rgba(255,0,0,0)}}

    .legend{display:flex;flex-wrap:wrap;gap:10px}

    .auth-wrap{min-height:100vh;display:grid;place-items:center;padding:20px}
    .auth-card{width:min(1100px,100%);display:grid;grid-template-columns:1.1fr .9fr;gap:18px}
    .auth-left,.auth-right{padding:24px}
    .auth-left h2{font-size:34px;margin:0 0 12px}
    .auth-right .tabs{display:flex;gap:8px;margin-bottom:16px}
    .tabs button{flex:1;padding:12px;border-radius:14px;border:none;cursor:pointer;background:#0e1523;color:#fff;font-weight:800;border:1px solid var(--line)}
    .tabs button.active{background:linear-gradient(135deg,var(--gold),#a17f1a);color:#111}

    .auth-benefits{display:grid;gap:10px;margin-top:18px}
    .auth-benefits div{padding:14px;border-radius:14px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06)}

    .toolbar{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
    .toolbar .field{min-width:180px;flex:1}

    .empty{padding:30px;text-align:center;color:var(--muted);border:1px dashed rgba(255,255,255,.12);border-radius:16px;background:rgba(255,255,255,.02)}

    .toast-wrap{position:fixed;right:18px;bottom:18px;display:grid;gap:10px;z-index:1000}
    .toast{min-width:260px;max-width:360px;padding:14px 16px;border-radius:16px;border:1px solid rgba(255,255,255,.08);background:#111827;box-shadow:var(--shadow);font-weight:700}
    .toast.success{border-color:rgba(16,185,129,.3)}
    .toast.error{border-color:rgba(239,68,68,.3)}
    .toast.info{border-color:rgba(59,130,246,.3)}

    .modal{position:fixed;inset:0;background:rgba(0,0,0,.6);display:none;place-items:center;padding:18px;z-index:999}
    .modal.show{display:grid}
    .modal-box{width:min(760px,100%);padding:20px}

    .kpi-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}
    .kpi{padding:14px;border-radius:16px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06)}
    .kpi .n{font-size:24px;font-weight:900}
    .kpi .t{font-size:12px;color:var(--muted);font-weight:700}

    .footer-note{padding:20px;text-align:center;color:var(--muted);font-size:12px}

    @media (max-width:1100px){
      .shell{grid-template-columns:1fr}
      .sidebar{position:static}
      .hero{grid-template-columns:1fr}
      .stats,.grid-3,.kpi-grid{grid-template-columns:repeat(2,1fr)}
      .auth-card{grid-template-columns:1fr}
    }
    @media (max-width:700px){
      .form-grid,.form-grid-3,.grid-2,.stats,.kpi-grid{grid-template-columns:1fr}
      .topbar{padding:12px}
      .brand-text h1{font-size:16px}
      .hero h2{font-size:24px}
      .appointment-actions .btn{width:100%}
    }
  </style>
</head>
<body>
<div class="app" id="app"></div>
<div class="toast-wrap" id="toastWrap"></div>
<div class="modal" id="modal"></div>
<script>
(() => {
  const STORAGE_KEY = 'ahmet_tekeli_randevu_v1';
  const app = document.getElementById('app');
  const toastWrap = document.getElementById('toastWrap');
  const modal = document.getElementById('modal');
  const alertPlayed = new Set();

  const todayStr = () => new Date().toISOString().slice(0,10);
  const nowTimeStr = () => {
    const d = new Date();
    return String(d.getHours()).padStart(2,'0') + ':' + String(d.getMinutes()).padStart(2,'0');
  };
  const tlCurrency = n => new Intl.NumberFormat('tr-TR',{style:'currency',currency:'TRY',maximumFractionDigits:0}).format(Number(n||0));
  const fmtDate = d => new Date(d+'T00:00:00').toLocaleDateString('tr-TR',{day:'2-digit',month:'2-digit',year:'numeric'});
  const fmtDateTime = (date,time) => new Date(date+'T'+time+':00').toLocaleString('tr-TR',{day:'2-digit',month:'2-digit',year:'numeric',hour:'2-digit',minute:'2-digit'});
  const uid = p => p + '_' + Math.random().toString(36).slice(2,10);
  const hash = s => btoa(unescape(encodeURIComponent(s))).split('').reverse().join('');

  const seed = {
    settings: {
      shopName:'Ahmet Tekeli Erkek Kuaförü',
      phone:'0555 111 22 33',
      address:'Antalya / Muratpaşa',
      whatsapp:'905551112233',
      welcomeText:'Premium online randevu, personel takibi, müşteri yönetimi ve canlı uyarı sistemi.'
    },
    services:[
      {id:'srv1',name:'Saç Kesimi',duration:30,price:400,active:true},
      {id:'srv2',name:'Sakal Tıraşı',duration:20,price:250,active:true},
      {id:'srv3',name:'Saç + Sakal',duration:50,price:650,active:true},
      {id:'srv4',name:'Keratin Bakım',duration:60,price:900,active:true},
    ],
    staff:[
      {id:'st1',name:'Ahmet Usta',username:'ahmet',password:hash('123456'),role:'barber',phone:'05551112233',workingDays:[1,2,3,4,5,6],start:'09:00',end:'22:00',breakStart:'13:00',breakEnd:'13:30',offDates:[],serviceIds:['srv1','srv2','srv3','srv4'],commission:60,active:true},
      {id:'st2',name:'Efe Usta',username:'efe',password:hash('123456'),role:'barber',phone:'05554443322',workingDays:[1,2,3,4,5,6],start:'10:00',end:'21:00',breakStart:'15:00',breakEnd:'15:30',offDates:[],serviceIds:['srv1','srv2','srv3'],commission:55,active:true},
      {id:'st3',name:'Ercan Usta',username:'ercan',password:hash('123456'),role:'barber',phone:'05557776655',workingDays:[1,2,3,4,5,6],start:'11:00',end:'22:00',breakStart:'16:00',breakEnd:'16:30',offDates:[],serviceIds:['srv1','srv2'],commission:50,active:true},
    ],
    users:[
      {id:'u_admin',name:'Admin',username:'admin',password:hash('123456'),role:'admin',phone:'',createdAt:Date.now()},
      {id:'u_cust_demo',name:'Demo Müşteri',username:'5551112233',password:hash('123456'),role:'customer',phone:'5551112233',createdAt:Date.now()},
    ],
    appointments:[
      {id:'ap1',customerId:'u_cust_demo',customerName:'Demo Müşteri',customerPhone:'5551112233',staffId:'st1',serviceId:'srv3',date:todayStr(),time:'09:30',duration:50,price:650,status:'bekliyor',notes:'',createdAt:Date.now()-600000,source:'online'},
      {id:'ap2',customerId:'u_cust_demo',customerName:'Demo Müşteri',customerPhone:'5551112233',staffId:'st2',serviceId:'srv1',date:todayStr(),time:'10:00',duration:30,price:400,status:'bekliyor',notes:'',createdAt:Date.now()-500000,source:'online'},
      {id:'ap3',customerId:'u_cust_demo',customerName:'Demo Müşteri',customerPhone:'5551112233',staffId:'st3',serviceId:'srv2',date:todayStr(),time:'11:00',duration:20,price:250,status:'tamamlandi',notes:'',createdAt:Date.now()-400000,source:'walkin'}
    ],
    notifications:[],
    logs:[]
  };

  const state = {
    db: loadDB(),
    currentUser: null,
    currentView: 'dashboard',
    authTab: 'login',
    filters: {date: todayStr(), staffId:'', status:'all', search:''}
  };

  function loadDB(){
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return structuredClone(seed);
    try {
      const data = JSON.parse(raw);
      return {...structuredClone(seed), ...data};
    } catch {
      return structuredClone(seed);
    }
  }
  function saveDB(){ localStorage.setItem(STORAGE_KEY, JSON.stringify(state.db)); }
  function resetDB(){ state.db = structuredClone(seed); saveDB(); state.currentUser = null; state.currentView='dashboard'; render(); toast('Sistem sıfırlandı.', 'info'); }

  function toast(message, type='success'){
    const div = document.createElement('div');
    div.className = 'toast ' + type;
    div.textContent = message;
    toastWrap.appendChild(div);
    setTimeout(()=>{div.style.opacity='0';div.style.transform='translateY(10px)'},2400);
    setTimeout(()=>div.remove(),3000);
  }

  function log(action, extra={}){
    state.db.logs.unshift({id:uid('log'), action, extra, user: state.currentUser?.name || 'Sistem', at: Date.now()});
    state.db.logs = state.db.logs.slice(0,120);
    saveDB();
  }

  function openModal(html){
    modal.innerHTML = `<div class="modal-box">${html}</div>`;
    modal.classList.add('show');
    modal.onclick = e => { if (e.target === modal) closeModal(); };
  }
  function closeModal(){ modal.classList.remove('show'); modal.innerHTML=''; }
  window.closeModal = closeModal;

  function playAlertSound(){
    try {
      const ctx = new (window.AudioContext || window.webkitAudioContext)();
      const osc = ctx.createOscillator();
      const gain = ctx.createGain();
      osc.type='sine';
      osc.frequency.setValueAtTime(880, ctx.currentTime);
      gain.gain.setValueAtTime(0.001, ctx.currentTime);
      gain.gain.exponentialRampToValueAtTime(.18, ctx.currentTime+.03);
      gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime+.33);
      osc.connect(gain); gain.connect(ctx.destination);
      osc.start(); osc.stop(ctx.currentTime+.35);
    } catch {}
  }

  function currentStats(){
    const today = todayStr();
    const todays = state.db.appointments.filter(a => a.date === today);
    const waiting = todays.filter(a => a.status==='bekliyor').length;
    const done = todays.filter(a => a.status==='tamamlandi').length;
    const canceled = todays.filter(a => a.status==='iptal').length;
    const revenue = todays.filter(a => a.status==='tamamlandi').reduce((t,a)=>t+Number(a.price||0),0);
    return {todays, waiting, done, canceled, revenue};
  }

  function appointmentPhase(ap){
    if (ap.status === 'tamamlandi') return 'tamamlandi';
    if (ap.status === 'iptal') return 'iptal';
    const now = new Date();
    const dt = new Date(ap.date + 'T' + ap.time + ':00');
    const diffMin = Math.floor((dt - now)/60000);
    const sameDay = ap.date === todayStr();
    if (sameDay && diffMin <= 10 && diffMin > 0) return 'uyari-yaklasti';
    if (sameDay && diffMin <= 0 && diffMin > -15) return 'randevu-zamani-geldi';
    if (sameDay && diffMin <= -15) return 'randevu-gecikti';
    return 'normal';
  }

  function appointmentBadge(ap){
    const phase = appointmentPhase(ap);
    if (ap.status==='tamamlandi') return '<span class="badge green">Tamamlandı</span>';
    if (ap.status==='iptal') return '<span class="badge gray">İptal</span>';
    if (phase==='uyari-yaklasti') return '<span class="badge yellow">10 dk kala</span>';
    if (phase==='randevu-zamani-geldi') return '<span class="badge red">Saati geldi</span>';
    if (phase==='randevu-gecikti') return '<span class="badge red">Gecikti</span>';
    return '<span class="badge blue">Bekliyor</span>';
  }

  function appointmentMessage(ap){
    if (ap.status==='tamamlandi') return 'İşlem tamamlandı.';
    if (ap.status==='iptal') return 'Randevu iptal edildi.';
    const dt = new Date(ap.date + 'T' + ap.time + ':00');
    const diffMin = Math.floor((dt - new Date())/60000);
    if (diffMin > 10) return 'Randevuya ' + diffMin + ' dakika var.';
    if (diffMin <= 10 && diffMin > 0) return 'Dikkat: randevuya ' + diffMin + ' dakika kaldı.';
    if (diffMin <= 0 && diffMin > -15) return 'Müşterinin randevu saati geldi.';
    return 'Randevu saati ' + Math.abs(diffMin) + ' dakika geçti.';
  }

  function getUserById(id){ return state.db.users.find(x=>x.id===id); }
  function getStaff(id){ return state.db.staff.find(x=>x.id===id); }
  function getService(id){ return state.db.services.find(x=>x.id===id); }

  function availableSlots(staffId, date, serviceId, editingId=null){
    const staff = getStaff(staffId);
    const service = getService(serviceId);
    if (!staff || !service) return [];
    const slots = [];
    const dow = new Date(date + 'T00:00:00').getDay();
    if (!staff.workingDays.includes(dow)) return slots;
    if ((staff.offDates||[]).includes(date)) return slots;

    const serviceMinutes = Number(service.duration || 30);
    const [sh,sm] = staff.start.split(':').map(Number);
    const [eh,em] = staff.end.split(':').map(Number);
    const [bh,bm] = staff.breakStart.split(':').map(Number);
    const [b2h,b2m] = staff.breakEnd.split(':').map(Number);

    const startMin = sh*60+sm;
    const endMin = eh*60+em;
    const breakStart = bh*60+bm;
    const breakEnd = b2h*60+b2m;

    const dayApps = state.db.appointments.filter(a => a.staffId===staffId && a.date===date && a.id!==editingId && a.status!=='iptal');

    for(let t=startMin; t+serviceMinutes<=endMin; t+=10){
      const slotStart = t;
      const slotEnd = t + serviceMinutes;
      const inBreak = !(slotEnd <= breakStart || slotStart >= breakEnd);
      if (inBreak) continue;
      const clash = dayApps.some(a => {
        const dur = Number(a.duration || getService(a.serviceId)?.duration || 30);
        const [ah,am] = a.time.split(':').map(Number);
        const apStart = ah*60+am;
        const apEnd = apStart + dur;
        return !(slotEnd <= apStart || slotStart >= apEnd);
      });
      if (clash) continue;
      slots.push(String(Math.floor(t/60)).padStart(2,'0') + ':' + String(t%60).padStart(2,'0'));
    }
    return slots;
  }

  function addNotification(text){
    state.db.notifications.unshift({id:uid('not'), text, seen:false, at:Date.now()});
    state.db.notifications = state.db.notifications.slice(0,50);
    saveDB();
  }

  function markNotificationsSeen(){
    state.db.notifications.forEach(n=>n.seen=true); saveDB(); renderTopbar();
  }

  function createAppointment(payload){
    const ap = {
      id: uid('ap'),
      customerId: payload.customerId,
      customerName: payload.customerName,
      customerPhone: payload.customerPhone,
      staffId: payload.staffId,
      serviceId: payload.serviceId,
      date: payload.date,
      time: payload.time,
      duration: Number(payload.duration),
      price: Number(payload.price),
      status:'bekliyor',
      notes: payload.notes || '',
      createdAt: Date.now(),
      source: payload.source || 'online'
    };
    state.db.appointments.unshift(ap);
    saveDB();
    const staff = getStaff(ap.staffId);
    const service = getService(ap.serviceId);
    addNotification(`${ap.customerName} için ${staff?.name || ''} - ${service?.name || ''} randevusu oluşturuldu (${fmtDateTime(ap.date, ap.time)}).`);
    log('Randevu oluşturuldu', ap);
    return ap;
  }

  function updateAppointmentStatus(id,status){
    const ap = state.db.appointments.find(x=>x.id===id); if (!ap) return;
    ap.status=status; saveDB();
    log('Randevu durumu değişti',{id,status});
    toast('Randevu durumu güncellendi.');
    render();
  }

  function deleteAppointment(id){
    state.db.appointments = state.db.appointments.filter(a=>a.id!==id); saveDB(); log('Randevu silindi',{id}); toast('Randevu silindi.','info'); render();
  }

  function upsertService(service){
    const ex = state.db.services.find(x=>x.id===service.id);
    if (ex) Object.assign(ex, service); else state.db.services.unshift({...service,id:uid('srv')});
    saveDB(); render();
  }
  function upsertStaff(staff){
    const ex = state.db.staff.find(x=>x.id===staff.id);
    if (ex) Object.assign(ex, staff); else state.db.staff.unshift({...staff,id:uid('st'),password:hash(staff.rawPassword || '123456')});
    saveDB(); render();
  }

  function createCustomer(name, phone, password){
    if (state.db.users.some(u => u.username === phone)) throw new Error('Bu telefonla kayıtlı kullanıcı var.');
    const user = {id:uid('u'), name, username:phone, password:hash(password), role:'customer', phone, createdAt:Date.now()};
    state.db.users.push(user); saveDB(); log('Müşteri kaydı',{name,phone}); return user;
  }

  function login(username,password,role){
    const pass = hash(password);
    let user = null;
    if (role === 'customer') user = state.db.users.find(u => u.role==='customer' && u.username===username && u.password===pass);
    if (role === 'admin') user = state.db.users.find(u => u.role==='admin' && u.username===username && u.password===pass);
    if (role === 'barber') user = state.db.staff.find(u => u.role==='barber' && u.username===username && u.password===pass);
    if (!user) throw new Error('Giriş bilgileri hatalı.');
    state.currentUser = user;
    state.currentView = role === 'customer' ? 'customer-booking' : 'dashboard';
    render();
    toast('Giriş başarılı.');
  }

  function logout(){ state.currentUser = null; render(); toast('Çıkış yapıldı.','info'); }

  function authScreen(){
    app.innerHTML = `
      <div class="auth-wrap">
        <div class="auth-card">
          <div class="panel auth-left">
            <div class="badge gold">Premium Tek Parça HTML Sistem</div>
            <h2>${state.db.settings.shopName}</h2>
            <p class="muted">${state.db.settings.welcomeText}</p>
            <div class="auth-benefits">
              <div>📅 Online müşteri randevusu</div>
              <div>🔔 Zamanı gelen randevuda yanıp sönme ve sesli uyarı</div>
              <div>👨‍💼 Admin paneli, berber paneli, müşteri paneli</div>
              <div>💾 Tüm veriler tarayıcı içinde localStorage ile saklanır</div>
              <div>📱 Mobil uyumlu premium görünüm</div>
            </div>
            <div style="margin-top:18px" class="muted">
              Demo hesaplar:<br>
              <strong>Admin:</strong> admin / 123456<br>
              <strong>Berber:</strong> ahmet / 123456<br>
              <strong>Müşteri:</strong> 5551112233 / 123456
            </div>
          </div>

          <div class="panel auth-right">
            <div class="tabs">
              <button class="${state.authTab==='login'?'active':''}" onclick="appActions.switchAuthTab('login')">Giriş</button>
              <button class="${state.authTab==='register'?'active':''}" onclick="appActions.switchAuthTab('register')">Müşteri Kayıt</button>
            </div>

            ${state.authTab==='login' ? `
              <form id="loginForm">
                <div class="field">
                  <label>Giriş tipi</label>
                  <select name="role">
                    <option value="customer">Müşteri</option>
                    <option value="barber">Berber</option>
                    <option value="admin">Admin</option>
                  </select>
                </div>
                <div class="form-grid" style="margin-top:14px">
                  <div class="field">
                    <label>Kullanıcı adı / Telefon</label>
                    <input name="username" required placeholder="admin veya 5551112233">
                  </div>
                  <div class="field">
                    <label>Şifre</label>
                    <input type="password" name="password" required placeholder="******">
                  </div>
                </div>
                <div style="margin-top:16px;display:flex;gap:10px;flex-wrap:wrap">
                  <button class="btn btn-primary" type="submit">Giriş Yap</button>
                  <button class="btn btn-dark" type="button" onclick="appActions.loadDemo()">Demo Verileri Yenile</button>
                </div>
              </form>
            ` : `
              <form id="registerForm">
                <div class="field">
                  <label>Ad Soyad</label>
                  <input name="name" required placeholder="Müşteri adı">
                </div>
                <div class="form-grid" style="margin-top:14px">
                  <div class="field">
                    <label>Telefon</label>
                    <input name="phone" required placeholder="05xx xxx xx xx">
                  </div>
                  <div class="field">
                    <label>Şifre</label>
                    <input type="password" name="password" required placeholder="En az 6 karakter">
                  </div>
                </div>
                <div style="margin-top:16px;display:flex;gap:10px;flex-wrap:wrap">
                  <button class="btn btn-primary" type="submit">Kayıt Ol</button>
                </div>
              </form>
            `}
          </div>
        </div>
      </div>
    `;

    document.getElementById('loginForm')?.addEventListener('submit', e => {
      e.preventDefault();
      const fd = new FormData(e.target);
      try{ login((fd.get('username')||'').toString().trim(), (fd.get('password')||'').toString(), fd.get('role')); }
      catch(err){ toast(err.message,'error'); }
    });

    document.getElementById('registerForm')?.addEventListener('submit', e => {
      e.preventDefault();
      const fd = new FormData(e.target);
      try{
        const name = (fd.get('name')||'').toString().trim();
        const phone = (fd.get('phone')||'').toString().replace(/\D/g,'');
        const password = (fd.get('password')||'').toString();
        if (password.length < 6) throw new Error('Şifre en az 6 karakter olmalı.');
        createCustomer(name,phone,password);
        toast('Kayıt başarılı. Giriş yapabilirsiniz.');
        state.authTab = 'login'; render();
      }catch(err){ toast(err.message,'error'); }
    });
  }

  function layout(inner){
    app.innerHTML = `
      <div class="topbar" id="topbar"></div>
      <div class="shell">
        <aside class="sidebar">
          <div class="menu-title">Menü</div>
          <div class="menu" id="menu"></div>
        </aside>
        <main class="content">${inner}</main>
      </div>
      <div class="footer-note">Tek parça HTML sistem • Veriler bu tarayıcıda saklanır • İstersen sonra PHP/MySQL sürüme çevrilir.</div>
    `;
    renderTopbar();
    renderMenu();
  }

  function renderTopbar(){
    const topbar = document.getElementById('topbar');
    if (!topbar) return;
    const unread = state.db.notifications.filter(n=>!n.seen).length;
    topbar.innerHTML = `
      <div class="brand">
        <div class="brand-logo">✂</div>
        <div class="brand-text">
          <h1>${state.db.settings.shopName}</h1>
          <p>${state.currentUser?.name || ''} • ${roleLabel(state.currentUser?.role)}</p>
        </div>
      </div>
      <div class="top-actions">
        <div class="clock-chip" id="liveClock"></div>
        <button class="btn btn-dark btn-small" onclick="appActions.showNotifications()">Bildirim${unread ? ' ('+unread+')' : ''}</button>
        ${state.currentUser?.role==='customer' ? `<a class="btn btn-primary btn-small" target="_blank" href="https://wa.me/${state.db.settings.whatsapp}?text=${encodeURIComponent('Merhaba, randevu hakkında bilgi almak istiyorum.')}">WhatsApp</a>` : ''}
        <button class="btn btn-gray btn-small" onclick="appActions.changePassword()">Şifre Değiştir</button>
        <button class="btn btn-red btn-small" onclick="appActions.logout()">Çıkış</button>
      </div>
    `;
    tickClock();
  }

  function tickClock(){
    const el = document.getElementById('liveClock');
    if (!el) return;
    el.textContent = 'Bugün: ' + new Date().toLocaleString('tr-TR');
  }

  function roleLabel(role){
    return role === 'admin' ? 'Admin' : role === 'barber' ? 'Berber' : role === 'customer' ? 'Müşteri' : '';
  }

  function renderMenu(){
    const menu = document.getElementById('menu'); if (!menu) return;
    const role = state.currentUser?.role;
    const items = role === 'admin'
      ? [
        ['dashboard','Gösterge Paneli'],['appointments','Randevular'],['calendar','Takvim'],['customers','Müşteriler'],['staff','Berberler'],['services','Hizmetler'],['reports','Raporlar'],['settings','Ayarlar']
      ]
      : role === 'barber'
      ? [['dashboard','Gösterge Paneli'],['appointments','Randevularım'],['calendar','Takvimim'],['reports','Kazançlarım']]
      : [['customer-booking','Randevu Al'],['my-appointments','Randevularım'],['profile','Profilim']];
    menu.innerHTML = items.map(([key,label]) => `<button class="${state.currentView===key?'active':''}" onclick="appActions.go('${key}')">${label}</button>`).join('');
  }

  function dashboardView(){
    const stats = currentStats();
    const nextApps = filteredAppointments().slice(0,6);
    return `
      <section class="hero panel">
        <div>
          <div class="badge gold">Canlı Yönetim Paneli</div>
          <h2>${roleLabel(state.currentUser.role)} paneline hoş geldin</h2>
          <p>${state.db.settings.welcomeText}</p>
          <div class="legend">
            <span class="badge blue">Bekliyor</span>
            <span class="badge yellow">10 dk kala</span>
            <span class="badge red">Zamanı geldi</span>
            <span class="badge red">15 dk geçti</span>
            <span class="badge green">Tamamlandı</span>
            <span class="badge gray">İptal</span>
          </div>
        </div>
        <div class="hero-card">
          <div class="hero-stat-grid">
            <div class="mini-stat"><div class="v">${stats.todays.length}</div><div class="l">Bugünkü Randevu</div></div>
            <div class="mini-stat"><div class="v">${stats.waiting}</div><div class="l">Bekleyen</div></div>
            <div class="mini-stat"><div class="v">${stats.done}</div><div class="l">Tamamlanan</div></div>
            <div class="mini-stat"><div class="v">${tlCurrency(stats.revenue)}</div><div class="l">Bugünkü Ciro</div></div>
          </div>
        </div>
      </section>

      <section class="stats">
        <div class="stat"><div class="value">${state.db.staff.filter(x=>x.active).length}</div><div class="label">Aktif Berber</div></div>
        <div class="stat"><div class="value">${state.db.services.filter(x=>x.active).length}</div><div class="label">Aktif Hizmet</div></div>
        <div class="stat"><div class="value">${state.db.users.filter(x=>x.role==='customer').length}</div><div class="label">Toplam Müşteri</div></div>
        <div class="stat"><div class="value">${state.db.notifications.filter(x=>!x.seen).length}</div><div class="label">Yeni Bildirim</div></div>
      </section>

      <section class="grid-2">
        <div class="panel">
          <div class="panel-head"><h3>Sıradaki Randevular</h3></div>
          <div class="cards">
            ${nextApps.length ? nextApps.map(cardAppointment).join('') : `<div class="empty">Randevu bulunamadı.</div>`}
          </div>
        </div>
        <div class="panel">
          <div class="panel-head"><h3>Son İşlem Kayıtları</h3></div>
          <div style="display:grid;gap:10px">
            ${state.db.logs.slice(0,10).map(l => `<div class="card" style="padding:14px"><strong>${l.action}</strong><div class="muted" style="margin-top:6px">${new Date(l.at).toLocaleString('tr-TR')} • ${l.user}</div></div>`).join('') || `<div class="empty">Kayıt yok.</div>`}
          </div>
        </div>
      </section>
    `;
  }

  function filteredAppointments(){
    let arr = [...state.db.appointments];
    if (state.currentUser.role === 'customer') arr = arr.filter(a => a.customerId === state.currentUser.id);
    if (state.currentUser.role === 'barber') arr = arr.filter(a => a.staffId === state.currentUser.id);
    const f = state.filters;
    if (f.date) arr = arr.filter(a => a.date === f.date);
    if (f.staffId) arr = arr.filter(a => a.staffId === f.staffId);
    if (f.status !== 'all') arr = arr.filter(a => a.status === f.status);
    if (f.search) {
      const q = f.search.toLowerCase();
      arr = arr.filter(a => [a.customerName,a.customerPhone,getStaff(a.staffId)?.name,getService(a.serviceId)?.name].filter(Boolean).join(' ').toLowerCase().includes(q));
    }
    arr.sort((a,b) => new Date(a.date+'T'+a.time) - new Date(b.date+'T'+b.time));
    return arr;
  }

  function appointmentsView(){
    const apps = filteredAppointments();
    return `
      <section class="panel">
        <div class="panel-head">
          <h3>${state.currentUser.role==='barber' ? 'Randevularım' : 'Randevular'}</h3>
          <div class="toolbar">
            <div class="field"><label>Tarih</label><input type="date" id="fltDate" value="${state.filters.date}"></div>
            <div class="field"><label>Berber</label><select id="fltStaff"><option value="">Tümü</option>${state.db.staff.filter(s=>s.active).map(s=>`<option ${state.filters.staffId===s.id?'selected':''} value="${s.id}">${s.name}</option>`).join('')}</select></div>
            <div class="field"><label>Durum</label><select id="fltStatus"><option value="all">Tümü</option><option ${state.filters.status==='bekliyor'?'selected':''} value="bekliyor">Bekliyor</option><option ${state.filters.status==='tamamlandi'?'selected':''} value="tamamlandi">Tamamlandı</option><option ${state.filters.status==='iptal'?'selected':''} value="iptal">İptal</option></select></div>
            <div class="field"><label>Ara</label><input id="fltSearch" value="${state.filters.search}" placeholder="Müşteri, telefon, hizmet"></div>
          </div>
        </div>
        <div class="cards">
          ${apps.length ? apps.map(cardAppointment).join('') : `<div class="empty">Filtreye uygun randevu yok.</div>`}
        </div>
      </section>
    `;
  }

  function cardAppointment(ap){
    const staff = getStaff(ap.staffId);
    const service = getService(ap.serviceId);
    const phase = appointmentPhase(ap);
    return `
      <div class="appointment-card ${phase}">
        <div class="appointment-top">
          <div>
            <div class="appointment-name">${ap.customerName}</div>
            <div class="muted" style="margin-top:4px">${fmtDateTime(ap.date, ap.time)}</div>
          </div>
          ${appointmentBadge(ap)}
        </div>
        <div class="appointment-info">
          <div><strong>Telefon:</strong> ${ap.customerPhone}</div>
          <div><strong>Berber:</strong> ${staff?.name || '-'}</div>
          <div><strong>Hizmet:</strong> ${service?.name || '-'}</div>
          <div><strong>Süre / Fiyat:</strong> ${ap.duration} dk • ${tlCurrency(ap.price)}</div>
          ${ap.notes ? `<div><strong>Not:</strong> ${ap.notes}</div>` : ''}
        </div>
        <div class="appointment-timeleft">${appointmentMessage(ap)}</div>
        ${(state.currentUser.role==='admin' || state.currentUser.role==='barber') ? `
          <div class="appointment-actions">
            <button class="btn btn-green btn-small" onclick="appActions.apStatus('${ap.id}','tamamlandi')">Tamamlandı</button>
            <button class="btn btn-gray btn-small" onclick="appActions.apStatus('${ap.id}','bekliyor')">Bekliyor</button>
            <button class="btn btn-red btn-small" onclick="appActions.apStatus('${ap.id}','iptal')">İptal</button>
            ${state.currentUser.role==='admin' ? `<button class="btn btn-dark btn-small" onclick="appActions.deleteAppointment('${ap.id}')">Sil</button>` : ''}
          </div>
        ` : ''}
      </div>
    `;
  }

  function customersView(){
    const customers = state.db.users.filter(u=>u.role==='customer').sort((a,b)=>b.createdAt-a.createdAt);
    return `
      <section class="panel">
        <div class="panel-head"><h3>Müşteriler</h3></div>
        <div class="table-wrap">
          <table>
            <thead><tr><th>Ad Soyad</th><th>Telefon</th><th>Kayıt</th><th>Toplam Randevu</th></tr></thead>
            <tbody>
              ${customers.map(c => `<tr><td>${c.name}</td><td>${c.phone}</td><td>${new Date(c.createdAt).toLocaleDateString('tr-TR')}</td><td>${state.db.appointments.filter(a=>a.customerId===c.id).length}</td></tr>`).join('')}
            </tbody>
          </table>
        </div>
      </section>
    `;
  }

  function staffView(){
    return `
      <section class="panel">
        <div class="panel-head">
          <h3>Berberler</h3>
          <button class="btn btn-primary btn-small" onclick="appActions.addStaff()">Yeni Berber</button>
        </div>
        <div class="cards">
          ${state.db.staff.map(s => `
            <div class="card" style="padding:18px">
              <div class="panel-head" style="margin-bottom:10px"><strong>${s.name}</strong>${s.active?'<span class="badge green">Aktif</span>':'<span class="badge gray">Pasif</span>'}</div>
              <div class="muted">Kullanıcı: ${s.username}</div>
              <div class="muted">Saat: ${s.start} - ${s.end}</div>
              <div class="muted">Mola: ${s.breakStart} - ${s.breakEnd}</div>
              <div class="muted">Komisyon: %${s.commission}</div>
              <div class="muted">Hizmet: ${s.serviceIds.map(id=>getService(id)?.name).filter(Boolean).join(', ')}</div>
              <div class="appointment-actions"><button class="btn btn-dark btn-small" onclick="appActions.editStaff('${s.id}')">Düzenle</button></div>
            </div>
          `).join('')}
        </div>
      </section>
    `;
  }

  function servicesView(){
    return `
      <section class="panel">
        <div class="panel-head">
          <h3>Hizmetler</h3>
          <button class="btn btn-primary btn-small" onclick="appActions.addService()">Yeni Hizmet</button>
        </div>
        <div class="table-wrap">
          <table>
            <thead><tr><th>Hizmet</th><th>Süre</th><th>Fiyat</th><th>Durum</th><th>İşlem</th></tr></thead>
            <tbody>
              ${state.db.services.map(s=>`<tr><td>${s.name}</td><td>${s.duration} dk</td><td>${tlCurrency(s.price)}</td><td>${s.active?'<span class="badge green">Aktif</span>':'<span class="badge gray">Pasif</span>'}</td><td><button class="btn btn-dark btn-small" onclick="appActions.editService('${s.id}')">Düzenle</button></td></tr>`).join('')}
            </tbody>
          </table>
        </div>
      </section>
    `;
  }

  function reportsView(){
    const apps = state.currentUser.role==='barber' ? state.db.appointments.filter(a=>a.staffId===state.currentUser.id) : state.db.appointments;
    const month = new Date().toISOString().slice(0,7);
    const monthApps = apps.filter(a=>a.date.startsWith(month));
    const done = monthApps.filter(a=>a.status==='tamamlandi');
    const revenue = done.reduce((t,a)=>t+Number(a.price||0),0);
    const role = state.currentUser.role;
    const myCommission = role==='barber' ? revenue * ((state.currentUser.commission||0)/100) : 0;
    return `
      <section class="panel">
        <div class="panel-head"><h3>Raporlar</h3></div>
        <div class="kpi-grid">
          <div class="kpi"><div class="n">${monthApps.length}</div><div class="t">Bu Ay Randevu</div></div>
          <div class="kpi"><div class="n">${done.length}</div><div class="t">Tamamlanan</div></div>
          <div class="kpi"><div class="n">${tlCurrency(revenue)}</div><div class="t">Toplam Ciro</div></div>
          <div class="kpi"><div class="n">${monthApps.filter(a=>a.status==='iptal').length}</div><div class="t">İptal</div></div>
          <div class="kpi"><div class="n">${role==='barber' ? tlCurrency(myCommission) : tlCurrency(revenue / Math.max(1,state.db.staff.length))}</div><div class="t">${role==='barber'?'Tahmini Hakediş':'Ortalama Kişi Başı'}</div></div>
        </div>
        <div class="table-wrap" style="margin-top:18px">
          <table>
            <thead><tr><th>Tarih</th><th>Müşteri</th><th>Berber</th><th>Hizmet</th><th>Durum</th><th>Tutar</th></tr></thead>
            <tbody>
              ${monthApps.map(a=>`<tr><td>${fmtDate(a.date)} ${a.time}</td><td>${a.customerName}</td><td>${getStaff(a.staffId)?.name||'-'}</td><td>${getService(a.serviceId)?.name||'-'}</td><td>${a.status}</td><td>${tlCurrency(a.price)}</td></tr>`).join('') || `<tr><td colspan="6">Kayıt yok</td></tr>`}
            </tbody>
          </table>
        </div>
      </section>
    `;
  }

  function settingsView(){
    const s = state.db.settings;
    return `
      <section class="panel">
        <div class="panel-head"><h3>Ayarlar</h3></div>
        <form id="settingsForm">
          <div class="form-grid">
            <div class="field"><label>İşletme Adı</label><input name="shopName" value="${s.shopName}"></div>
            <div class="field"><label>Telefon</label><input name="phone" value="${s.phone}"></div>
          </div>
          <div class="form-grid" style="margin-top:14px">
            <div class="field"><label>Adres</label><input name="address" value="${s.address}"></div>
            <div class="field"><label>WhatsApp</label><input name="whatsapp" value="${s.whatsapp}"></div>
          </div>
          <div class="field" style="margin-top:14px"><label>Karşılama Metni</label><textarea name="welcomeText">${s.welcomeText}</textarea></div>
          <div style="margin-top:16px;display:flex;gap:10px;flex-wrap:wrap">
            <button class="btn btn-primary" type="submit">Kaydet</button>
            <button class="btn btn-red" type="button" onclick="appActions.resetAll()">Sistemi Sıfırla</button>
          </div>
        </form>
      </section>
    `;
  }

  function calendarView(){
    const date = state.filters.date || todayStr();
    const apps = filteredAppointments().sort((a,b)=>a.time.localeCompare(b.time));
    return `
      <section class="panel">
        <div class="panel-head">
          <h3>Takvim Görünümü</h3>
          <div class="field" style="min-width:220px"><label>Tarih</label><input type="date" id="calDate" value="${date}"></div>
        </div>
        <div style="display:grid;gap:12px">
          ${apps.length ? apps.map(a=>`<div class="card" style="padding:14px;display:flex;justify-content:space-between;gap:10px;align-items:center;flex-wrap:wrap"><div><strong>${a.time}</strong> • ${a.customerName} • ${getService(a.serviceId)?.name || ''} • ${getStaff(a.staffId)?.name || ''}</div><div>${appointmentBadge(a)}</div></div>`).join('') : `<div class="empty">Bu tarihte randevu yok.</div>`}
        </div>
      </section>
    `;
  }

  function customerBookingView(){
    const activeStaff = state.db.staff.filter(s=>s.active);
    const serviceOptions = state.db.services.filter(s=>s.active);
    return `
      <section class="hero panel">
        <div>
          <div class="badge gold">Online Randevu</div>
          <h2>${state.db.settings.shopName}</h2>
          <p>${state.db.settings.address} • ${state.db.settings.phone}</p>
          <p class="muted">Berberini seç, hizmetini belirle, uygun saati kap.</p>
        </div>
        <div class="hero-card">
          <div class="mini-stat"><div class="v">${activeStaff.length}</div><div class="l">Aktif Berber</div></div>
          <div style="margin-top:10px" class="mini-stat"><div class="v">${serviceOptions.length}</div><div class="l">Aktif Hizmet</div></div>
        </div>
      </section>

      <section class="grid-2">
        <div class="panel">
          <div class="panel-head"><h3>Yeni Randevu Oluştur</h3></div>
          <form id="bookingForm">
            <div class="form-grid">
              <div class="field"><label>Berber</label><select name="staffId" id="bookingStaff">${activeStaff.map(s=>`<option value="${s.id}">${s.name}</option>`).join('')}</select></div>
              <div class="field"><label>Hizmet</label><select name="serviceId" id="bookingService">${serviceOptions.map(s=>`<option value="${s.id}">${s.name} • ${s.duration} dk • ${tlCurrency(s.price)}</option>`).join('')}</select></div>
            </div>
            <div class="form-grid" style="margin-top:14px">
              <div class="field"><label>Tarih</label><input type="date" id="bookingDate" name="date" min="${todayStr()}" value="${todayStr()}"></div>
              <div class="field"><label>Uygun Saat</label><select name="time" id="bookingTime"></select></div>
            </div>
            <div class="field" style="margin-top:14px"><label>Not</label><textarea name="notes" placeholder="İsteğe bağlı not"></textarea></div>
            <div style="margin-top:16px"><button class="btn btn-primary" type="submit">Randevu Oluştur</button></div>
          </form>
        </div>
        <div class="panel">
          <div class="panel-head"><h3>Randevu Bilgisi</h3></div>
          <div id="bookingInfo" class="empty">Berber, hizmet ve tarih seçtiğinde uygun saatler burada oluşur.</div>
        </div>
      </section>
    `;
  }

  function myAppointmentsView(){
    const my = state.db.appointments.filter(a=>a.customerId===state.currentUser.id).sort((a,b)=>new Date(b.date+'T'+b.time)-new Date(a.date+'T'+a.time));
    return `
      <section class="panel">
        <div class="panel-head"><h3>Randevularım</h3></div>
        <div class="cards">
          ${my.length ? my.map(cardAppointment).join('') : `<div class="empty">Henüz randevun yok.</div>`}
        </div>
      </section>
    `;
  }

  function profileView(){
    return `
      <section class="panel">
        <div class="panel-head"><h3>Profilim</h3></div>
        <div class="grid-2">
          <div class="card" style="padding:18px">
            <div><strong>Ad Soyad:</strong> ${state.currentUser.name}</div>
            <div style="margin-top:8px"><strong>Telefon:</strong> ${state.currentUser.phone}</div>
            <div style="margin-top:8px"><strong>Toplam Randevu:</strong> ${state.db.appointments.filter(a=>a.customerId===state.currentUser.id).length}</div>
          </div>
          <div class="card" style="padding:18px">
            <div><strong>İşletme:</strong> ${state.db.settings.shopName}</div>
            <div style="margin-top:8px"><strong>Telefon:</strong> ${state.db.settings.phone}</div>
            <div style="margin-top:8px"><strong>Adres:</strong> ${state.db.settings.address}</div>
          </div>
        </div>
      </section>
    `;
  }

  function bindFilters(){
    const ids = [['fltDate','date'],['fltStaff','staffId'],['fltStatus','status'],['fltSearch','search'],['calDate','date']];
    ids.forEach(([id,key]) => {
      document.getElementById(id)?.addEventListener('input', e => { state.filters[key]=e.target.value; render(); });
      document.getElementById(id)?.addEventListener('change', e => { state.filters[key]=e.target.value; render(); });
    });
  }

  function bindSettings(){
    document.getElementById('settingsForm')?.addEventListener('submit', e => {
      e.preventDefault();
      const fd = new FormData(e.target);
      Object.keys(state.db.settings).forEach(k => state.db.settings[k] = (fd.get(k) || '').toString());
      saveDB(); toast('Ayarlar kaydedildi.'); render();
    });
  }

  function bindBookingForm(){
    const staffSel = document.getElementById('bookingStaff');
    const serviceSel = document.getElementById('bookingService');
    const dateInput = document.getElementById('bookingDate');
    const timeSel = document.getElementById('bookingTime');
    const info = document.getElementById('bookingInfo');

    function syncServices(){
      const staffId = staffSel.value;
      const staff = getStaff(staffId);
      const services = state.db.services.filter(s=>s.active && staff.serviceIds.includes(s.id));
      serviceSel.innerHTML = services.map(s=>`<option value="${s.id}">${s.name} • ${s.duration} dk • ${tlCurrency(s.price)}</option>`).join('');
      syncSlots();
    }
    function syncSlots(){
      const staffId = staffSel.value;
      const serviceId = serviceSel.value;
      const date = dateInput.value;
      const slots = availableSlots(staffId,date,serviceId);
      timeSel.innerHTML = slots.length ? slots.map(t=>`<option value="${t}">${t}</option>`).join('') : `<option value="">Uygun saat yok</option>`;
      const staff = getStaff(staffId);
      const service = getService(serviceId);
      info.className = slots.length ? 'card' : 'empty';
      info.style.padding = slots.length ? '18px' : '';
      info.innerHTML = slots.length
        ? `<div><strong>Berber:</strong> ${staff.name}</div><div style="margin-top:8px"><strong>Hizmet:</strong> ${service.name}</div><div style="margin-top:8px"><strong>Süre:</strong> ${service.duration} dk</div><div style="margin-top:8px"><strong>Ücret:</strong> ${tlCurrency(service.price)}</div><div style="margin-top:8px"><strong>Uygun saat sayısı:</strong> ${slots.length}</div>`
        : 'Seçilen gün için uygun saat yok.';
    }

    staffSel?.addEventListener('change', syncServices);
    serviceSel?.addEventListener('change', syncSlots);
    dateInput?.addEventListener('change', syncSlots);
    syncServices();

    document.getElementById('bookingForm')?.addEventListener('submit', e => {
      e.preventDefault();
      const fd = new FormData(e.target);
      const service = getService(fd.get('serviceId'));
      if (!fd.get('time')) return toast('Uygun saat seç.', 'error');
      createAppointment({
        customerId: state.currentUser.id,
        customerName: state.currentUser.name,
        customerPhone: state.currentUser.phone,
        staffId: fd.get('staffId'),
        serviceId: fd.get('serviceId'),
        date: fd.get('date'),
        time: fd.get('time'),
        duration: service.duration,
        price: service.price,
        notes: fd.get('notes'),
        source:'online'
      });
      toast('Randevu oluşturuldu.');
      state.currentView='my-appointments';
      render();
    });
  }

  function renderMain(){
    let inner='';
    switch(state.currentView){
      case 'dashboard': inner = dashboardView(); break;
      case 'appointments': inner = appointmentsView(); break;
      case 'calendar': inner = calendarView(); break;
      case 'customers': inner = customersView(); break;
      case 'staff': inner = staffView(); break;
      case 'services': inner = servicesView(); break;
      case 'reports': inner = reportsView(); break;
      case 'settings': inner = settingsView(); break;
      case 'customer-booking': inner = customerBookingView(); break;
      case 'my-appointments': inner = myAppointmentsView(); break;
      case 'profile': inner = profileView(); break;
      default: inner = dashboardView();
    }
    layout(inner);
    bindFilters();
    bindSettings();
    bindBookingForm();
    pulseAppointments();
  }

  function pulseAppointments(){
    state.db.appointments.forEach(ap => {
      const phase = appointmentPhase(ap);
      if (phase === 'randevu-zamani-geldi') {
        const key = ap.id + '_' + ap.date + '_' + ap.time;
        if (!alertPlayed.has(key)) {
          playAlertSound();
          alertPlayed.add(key);
          addNotification(`Randevu saati geldi: ${ap.customerName} • ${getStaff(ap.staffId)?.name || ''} • ${ap.time}`);
        }
      }
    });
  }

  function changePasswordModal(){
    openModal(`
      <div class="panel-head"><h3>Şifre Değiştir</h3><button class="btn btn-gray btn-small" onclick="closeModal()">Kapat</button></div>
      <form id="pwdForm">
        <div class="field"><label>Yeni Şifre</label><input type="password" name="password" required minlength="6"></div>
        <div style="margin-top:16px"><button class="btn btn-primary" type="submit">Kaydet</button></div>
      </form>
    `);
    document.getElementById('pwdForm').addEventListener('submit', e => {
      e.preventDefault();
      const pwd = new FormData(e.target).get('password').toString();
      if (state.currentUser.role === 'barber') {
        const st = state.db.staff.find(s=>s.id===state.currentUser.id); st.password = hash(pwd);
      } else {
        const us = state.db.users.find(u=>u.id===state.currentUser.id); us.password = hash(pwd);
      }
      saveDB(); closeModal(); toast('Şifre güncellendi.');
    });
  }

  function notificationModal(){
    openModal(`
      <div class="panel-head"><h3>Bildirimler</h3><button class="btn btn-gray btn-small" onclick="closeModal()">Kapat</button></div>
      <div style="display:grid;gap:10px">${state.db.notifications.length ? state.db.notifications.map(n => `<div class="card" style="padding:14px"><strong>${n.text}</strong><div class="muted" style="margin-top:6px">${new Date(n.at).toLocaleString('tr-TR')}</div></div>`).join('') : '<div class="empty">Bildirim yok.</div>'}</div>
    `);
    markNotificationsSeen();
  }

  function serviceModal(serviceId=null){
    const s = serviceId ? state.db.services.find(x=>x.id===serviceId) : {id:'',name:'',duration:30,price:0,active:true};
    openModal(`
      <div class="panel-head"><h3>${serviceId?'Hizmeti Düzenle':'Yeni Hizmet'}</h3><button class="btn btn-gray btn-small" onclick="closeModal()">Kapat</button></div>
      <form id="serviceForm">
        <div class="form-grid">
          <div class="field"><label>Hizmet Adı</label><input name="name" value="${s.name}" required></div>
          <div class="field"><label>Süre (dk)</label><input type="number" name="duration" value="${s.duration}" required></div>
        </div>
        <div class="form-grid" style="margin-top:14px">
          <div class="field"><label>Fiyat</label><input type="number" name="price" value="${s.price}" required></div>
          <div class="field"><label>Durum</label><select name="active"><option value="true" ${s.active?'selected':''}>Aktif</option><option value="false" ${!s.active?'selected':''}>Pasif</option></select></div>
        </div>
        <div style="margin-top:16px"><button class="btn btn-primary" type="submit">Kaydet</button></div>
      </form>
    `);
    document.getElementById('serviceForm').addEventListener('submit', e => {
      e.preventDefault();
      const fd = new FormData(e.target);
      upsertService({id:s.id,name:fd.get('name').toString(),duration:Number(fd.get('duration')),price:Number(fd.get('price')),active:fd.get('active')==='true'});
      closeModal(); toast('Hizmet kaydedildi.');
    });
  }

  function staffModal(staffId=null){
    const s = staffId ? state.db.staff.find(x=>x.id===staffId) : {id:'',name:'',username:'',phone:'',start:'09:00',end:'22:00',breakStart:'13:00',breakEnd:'13:30',commission:50,workingDays:[1,2,3,4,5,6],offDates:[],serviceIds:[],active:true};
    openModal(`
      <div class="panel-head"><h3>${staffId?'Berberi Düzenle':'Yeni Berber'}</h3><button class="btn btn-gray btn-small" onclick="closeModal()">Kapat</button></div>
      <form id="staffForm">
        <div class="form-grid">
          <div class="field"><label>Ad Soyad</label><input name="name" value="${s.name}" required></div>
          <div class="field"><label>Kullanıcı Adı</label><input name="username" value="${s.username}" required></div>
        </div>
        <div class="form-grid" style="margin-top:14px">
          <div class="field"><label>Telefon</label><input name="phone" value="${s.phone}" required></div>
          <div class="field"><label>Komisyon %</label><input type="number" name="commission" value="${s.commission}" required></div>
        </div>
        ${!staffId ? `<div class="field" style="margin-top:14px"><label>Şifre</label><input name="rawPassword" value="123456" required></div>`:''}
        <div class="form-grid-3" style="margin-top:14px">
          <div class="field"><label>Başlangıç</label><input type="time" name="start" value="${s.start}"></div>
          <div class="field"><label>Bitiş</label><input type="time" name="end" value="${s.end}"></div>
          <div class="field"><label>Durum</label><select name="active"><option value="true" ${s.active?'selected':''}>Aktif</option><option value="false" ${!s.active?'selected':''}>Pasif</option></select></div>
        </div>
        <div class="form-grid" style="margin-top:14px">
          <div class="field"><label>Mola Başlangıç</label><input type="time" name="breakStart" value="${s.breakStart}"></div>
          <div class="field"><label>Mola Bitiş</label><input type="time" name="breakEnd" value="${s.breakEnd}"></div>
        </div>
        <div class="field" style="margin-top:14px"><label>İzin Günleri (virgülle tarih: 2026-03-20,2026-03-24)</label><input name="offDates" value="${(s.offDates||[]).join(',')}"></div>
        <div class="field" style="margin-top:14px"><label>Hizmetler</label><div class="grid-2">${state.db.services.map(sr=>`<label class="card" style="padding:12px;display:flex;gap:10px;align-items:center"><input type="checkbox" name="serviceIds" value="${sr.id}" ${(s.serviceIds||[]).includes(sr.id)?'checked':''}> ${sr.name}</label>`).join('')}</div></div>
        <div style="margin-top:16px"><button class="btn btn-primary" type="submit">Kaydet</button></div>
      </form>
    `);
    document.getElementById('staffForm').addEventListener('submit', e => {
      e.preventDefault();
      const fd = new FormData(e.target);
      upsertStaff({
        id:s.id,
        name:fd.get('name').toString(), username:fd.get('username').toString(), phone:fd.get('phone').toString(),
        start:fd.get('start').toString(), end:fd.get('end').toString(), breakStart:fd.get('breakStart').toString(), breakEnd:fd.get('breakEnd').toString(),
        commission:Number(fd.get('commission')), active:fd.get('active')==='true', serviceIds:fd.getAll('serviceIds'),
        offDates:fd.get('offDates').toString().split(',').map(x=>x.trim()).filter(Boolean), role:'barber', workingDays:[1,2,3,4,5,6], rawPassword:fd.get('rawPassword')?.toString() || undefined
      });
      closeModal(); toast('Berber kaydedildi.');
    });
  }

  window.appActions = {
    switchAuthTab(tab){ state.authTab = tab; authScreen(); },
    loadDemo(){ state.db = structuredClone(seed); saveDB(); toast('Demo verileri yüklendi.'); authScreen(); },
    go(view){ state.currentView = view; render(); },
    logout,
    resetAll(){ if(confirm('Tüm veriler sıfırlansın mı?')) resetDB(); },
    apStatus(id,status){ updateAppointmentStatus(id,status); },
    deleteAppointment(id){ if(confirm('Randevu silinsin mi?')) deleteAppointment(id); },
    addService(){ serviceModal(); },
    editService(id){ serviceModal(id); },
    addStaff(){ staffModal(); },
    editStaff(id){ staffModal(id); },
    changePassword(){ changePasswordModal(); },
    showNotifications(){ notificationModal(); }
  };

  function render(){
    if (!state.currentUser) { authScreen(); return; }
    renderMain();
  }

  setInterval(() => {
    tickClock();
    if (state.currentUser) {
      pulseAppointments();
      const needsRefresh = ['dashboard','appointments','calendar','my-appointments'].includes(state.currentView);
      if (needsRefresh) renderMain();
    }
  }, 15000);

  render();
})();
</script>
</body>
</html>
