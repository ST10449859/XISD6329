<?php $pageTitle = 'My profile'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">ACCOUNT DETAILS</p><h1>My profile</h1><p class="muted">Update your contact information.</p></section>
<div class="panel form-panel"><div id="message" class="notice" hidden></div><form id="profile-form"><label>Full name<input name="full_name" required maxlength="100"></label><label>Email address<input name="email" type="email" disabled></label><label>Phone number<input name="phone" maxlength="30"></label><button class="btn" type="submit">Save profile</button></form></div>


<script>
requireLogin();(async()=>{try{const r=await api('profile.php');for(const k of ['full_name','email','phone'])document.querySelector(`[name="${k}"]`).value=r.user[k]||'';}catch(e){showMessage(e.message,'error');}})();
document.getElementById('profile-form').addEventListener('submit',async e=>{e.preventDefault();try{const f=e.currentTarget;const r=await api('profile.php',{method:'PUT',body:JSON.stringify({full_name:f.full_name.value,phone:f.phone.value})});const u=getUser();u.full_name=r.user.full_name;localStorage.setItem('fightclubsa_user',JSON.stringify(u));showMessage(r.message,'success');}catch(err){showMessage(err.message,'error');}});
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
