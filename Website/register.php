<?php $pageTitle = 'Join FightClubSA'; require __DIR__.'/includes/header.php'; ?>

<section class="auth-layout"><div class="auth-aside"><p class="eyebrow">START YOUR JOURNEY</p><h1>Stronger starts<br><span class="accent">with you.</span></h1><p>Create your member account to explore classes and manage your training.</p></div>
<div class="panel auth-panel"><h2>Create account</h2><p class="muted">All fields are required.</p><div id="message" class="notice" hidden></div>
<form id="register-form"><label>Full name<input name="full_name" maxlength="100" autocomplete="name" required></label><label>Email address<input type="email" name="email" maxlength="150" autocomplete="email" required></label><label>Password<input type="password" name="password" minlength="8" autocomplete="new-password" required><small>At least 8 characters.</small></label><button class="btn full" type="submit">Create account</button></form><p class="form-foot">Already registered? <a href="login.php">Sign in</a></p></div></section>


<script>
document.getElementById('register-form').addEventListener('submit',async e=>{e.preventDefault();const f=e.currentTarget,b=f.querySelector('button');b.disabled=true;try{const d=Object.fromEntries(new FormData(f));const r=await api('auth.php',{method:'POST',body:JSON.stringify({...d,action:'register'})});showMessage(r.message,'success');f.reset();setTimeout(()=>location.href='login.php',1200);}catch(err){showMessage(err.message,'error');}finally{b.disabled=false;}});
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
