<?php $pageTitle = 'My bookings'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">YOUR TRAINING PLAN</p><h1>My bookings</h1><p class="muted">View and manage your class reservations.</p></section>
<div id="message" class="notice" hidden></div><div class="panel table-wrap"><table><thead><tr><th>Class</th><th>Date</th><th>Time</th><th>Trainer</th><th>Status</th><th></th></tr></thead><tbody id="bookings-body"><tr><td colspan="6">Loading bookings…</td></tr></tbody></table></div>


<script>
requireLogin();(async()=>{try{const r=await api('bookings.php');const b=document.getElementById('bookings-body');b.innerHTML=r.bookings.length?r.bookings.map(x=>`<tr><td>${escapeHtml(x.class_name)}</td><td>${escapeHtml(x.class_date)}</td><td>${escapeHtml(x.start_time)}–${escapeHtml(x.end_time)}</td><td>${escapeHtml(x.trainer_name||'TBC')}</td><td><span class="pill">${escapeHtml(x.status)}</span></td><td>${x.status==='booked'?`<button class="btn btn-small btn-danger" data-cancel="${x.booking_id}">Cancel</button>`:''}</td></tr>`).join(''):'<tr><td colspan="6">You have no bookings yet. <a href="classes.php">Browse classes</a>.</td></tr>';b.querySelectorAll('[data-cancel]').forEach(btn=>btn.addEventListener('click',async()=>{if(!confirm('Cancel this booking?'))return;btn.disabled=true;try{const d=await api('bookings.php',{method:'POST',body:JSON.stringify({action:'cancel',booking_id:Number(btn.dataset.cancel)})});showMessage(d.message,'success');location.reload();}catch(e){showMessage(e.message,'error');btn.disabled=false;}}));}catch(e){showMessage(e.message,'error');}})();
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
