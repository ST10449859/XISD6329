<?php $pageTitle = 'Settings'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">PREFERENCES</p><h1>Settings</h1><p class="muted">Customise your FightClubSA experience.</p></section>
<div class="panel form-panel"><div id="message" class="notice" hidden></div><form id="settings-form"><label>Appearance<select name="theme"><option value="light">Light</option><option value="dark">Dark</option></select></label><label>Language<select name="language"><option value="en">English</option><option value="af">Afrikaans</option><option value="zu">isiZulu</option></select></label><label class="check-label"><input type="checkbox" name="notifications_enabled"> Enable notifications</label><button class="btn" type="submit">Save settings</button></form></div>


<script>
requireLogin();(async()=>{try{const r=await api('settings.php');const s=r.settings;const f=document.getElementById('settings-form');f.theme.value=s.theme;f.language.value=s.language;f.notifications_enabled.checked=!!Number(s.notifications_enabled);applyTheme(s.theme);}catch(e){showMessage(e.message,'error');}})();
document.getElementById('settings-form').addEventListener('submit',async e=>{e.preventDefault();const f=e.currentTarget;try{const r=await api('settings.php',{method:'PUT',body:JSON.stringify({theme:f.theme.value,language:f.language.value,notifications_enabled:f.notifications_enabled.checked?1:0})});applyTheme(r.settings.theme);showMessage(r.message,'success');}catch(err){showMessage(err.message,'error');}});
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
