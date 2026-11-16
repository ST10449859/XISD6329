<?php $pageTitle = 'Membership'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">YOUR MEMBERSHIP</p><h1>Membership details</h1><p class="muted">See your current plan and membership period.</p></section>
<div id="message" class="notice" hidden></div><div id="membership-card" class="panel">Sign in to view your membership.</div>


<script>
if(getToken())(async()=>{try{const r=await api('membership.php');const m=r.membership;document.getElementById('membership-card').innerHTML=m?`<span class="pill">${escapeHtml(m.status)}</span><h2>${escapeHtml(m.plan_name)}</h2><p>${escapeHtml(m.plan_description||'')}</p><p class="price">${money(m.monthly_price)} <small>/ ${escapeHtml(m.duration_days||30)} days</small></p><div class="detail-grid"><div><small>Start date</small><strong>${escapeHtml(m.start_date)}</strong></div><div><small>End date</small><strong>${escapeHtml(m.end_date)}</strong></div></div>`:'<h2>No membership found</h2><p>Please contact the gym to activate a membership plan.</p>';}catch(e){showMessage(e.message,'error');}})();else document.getElementById('membership-card').innerHTML='<h2>Sign in required</h2><a class="btn" href="login.php">Sign in</a>';
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
