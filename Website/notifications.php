<?php $pageTitle = 'Notifications'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">STAY INFORMED</p><h1>Notifications</h1><p class="muted">Booking and account updates.</p></section>
<div id="message" class="notice" hidden></div><div id="notifications-list" class="stack"><div class="panel">Loading notifications…</div></div>


<script>
requireLogin();(async()=>{try{const r=await api('notifications.php');const root=document.getElementById('notifications-list');root.innerHTML=r.notifications.length?r.notifications.map(n=>`<article class="panel notification ${Number(n.is_read)?'read':''}"><div><h3>${escapeHtml(n.title)}</h3><p>${escapeHtml(n.message)}</p><small>${escapeHtml(n.created_at)}</small></div>${Number(n.is_read)?'<span class="pill">Read</span>':`<button class="btn btn-small" data-read="${n.id}">Mark read</button>`}</article>`).join(''):'<div class="panel">You have no notifications.</div>';root.querySelectorAll('[data-read]').forEach(btn=>btn.addEventListener('click',async()=>{try{await api('notifications.php',{method:'POST',body:JSON.stringify({notification_id:Number(btn.dataset.read)})});location.reload();}catch(e){showMessage(e.message,'error');}}));}catch(e){showMessage(e.message,'error');}})();
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
