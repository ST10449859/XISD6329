<?php $pageTitle = 'Payment history'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">ACCOUNT HISTORY</p><h1>Payments</h1><p class="muted">Review payments recorded against your membership.</p></section>
<div id="message" class="notice" hidden></div><div class="panel table-wrap"><table><thead><tr><th>Date</th><th>Reference</th><th>Plan</th><th>Method</th><th>Amount</th><th>Status</th></tr></thead><tbody id="payments-body"><tr><td colspan="6">Loading…</td></tr></tbody></table></div>


<script>
requireLogin();(async()=>{try{const r=await api('payments.php');const b=document.getElementById('payments-body');b.innerHTML=r.payments.length?r.payments.map(p=>`<tr><td>${escapeHtml(p.created_at)}</td><td>${escapeHtml(p.reference_code)}</td><td>${escapeHtml(p.plan_name)}</td><td>${escapeHtml(p.payment_method)}</td><td>${money(p.amount)}</td><td>${escapeHtml(p.status)}</td></tr>`).join(''):'<tr><td colspan="6">No payment records found.</td></tr>';}catch(e){showMessage(e.message,'error');}})();
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
