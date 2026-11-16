<?php $pageTitle = 'Training classes'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">FIND YOUR SESSION</p><h1>Training classes</h1><p class="muted">Choose a session and reserve your place.</p></section>
<div id="message" class="notice" hidden></div><div id="classes-list" class="card-grid"><div class="panel">Loading classes…</div></div>


<script>
(async()=>{const root=document.getElementById('classes-list');try{const r=await api('classes.php');if(!r.classes.length){root.innerHTML='<div class="panel">No upcoming classes are available yet.</div>';return;}root.innerHTML=r.classes.map(c=>`<article class="feature-card"><span class="pill">${escapeHtml(c.spaces_available)} spaces left</span><h3>${escapeHtml(c.class_name)}</h3><p>${escapeHtml(c.description||'Training session')}</p><p class="muted">${escapeHtml(c.class_date)} · ${escapeHtml(c.start_time)}–${escapeHtml(c.end_time)}</p><p>Trainer: ${escapeHtml(c.trainer_name||'To be confirmed')}</p><button class="btn" data-book="${c.id}" ${Number(c.spaces_available)<1?'disabled':''}>Book class</button></article>`).join('');root.querySelectorAll('[data-book]').forEach(btn=>btn.addEventListener('click',async()=>{if(!getToken()){location.href='login.php';return;}btn.disabled=true;try{const r=await api('bookings.php',{method:'POST',body:JSON.stringify({action:'book',class_id:Number(btn.dataset.book)})});showMessage(r.message,'success');setTimeout(()=>location.reload(),700);}catch(e){showMessage(e.message,'error');btn.disabled=false;}}));}catch(e){root.innerHTML='';showMessage(e.message,'error');}})();
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
