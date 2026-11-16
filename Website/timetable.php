<?php $pageTitle = 'Class timetable'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">PLAN YOUR TRAINING</p><h1>Class timetable</h1><p class="muted">Upcoming sessions scheduled at FightClubSA.</p></section>
<div id="message" class="notice" hidden></div><div class="panel table-wrap"><table><thead><tr><th>Date</th><th>Time</th><th>Class</th><th>Trainer</th><th>Spaces</th></tr></thead><tbody id="timetable-body"><tr><td colspan="5">Loading timetable…</td></tr></tbody></table></div>


<script>
(async()=>{try{const r=await api('classes.php');const b=document.getElementById('timetable-body');b.innerHTML=r.classes.length?r.classes.map(c=>`<tr><td>${escapeHtml(c.class_date)}</td><td>${escapeHtml(c.start_time)}–${escapeHtml(c.end_time)}</td><td>${escapeHtml(c.class_name)}</td><td>${escapeHtml(c.trainer_name||'TBC')}</td><td>${escapeHtml(c.spaces_available)}</td></tr>`).join(''):'<tr><td colspan="5">No upcoming sessions.</td></tr>';}catch(e){showMessage(e.message,'error');}})();
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
