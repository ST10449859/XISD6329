<?php $pageTitle = 'Our trainers'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">MEET THE TEAM</p><h1>Our trainers</h1><p class="muted">Learn more about the coaches who support your training.</p></section><div id="trainers-list" class="card-grid"></div><div id="message" class="notice" hidden></div>


<script>
(async()=>{try{const r=await api('trainers.php');document.getElementById('trainers-list').innerHTML=r.trainers.length?r.trainers.map(t=>`<article class="feature-card"><div class="feature-icon">🥊</div><h3>${escapeHtml(t.full_name)}</h3><span class="pill">${escapeHtml(t.specialty)}</span><p>${escapeHtml(t.bio||'FightClubSA training coach.')}</p></article>`).join(''):'<div class="panel">Trainer profiles will be available soon.</div>';}catch(e){showMessage(e.message,'error');}})();
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
