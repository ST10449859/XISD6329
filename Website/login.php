<?php $pageTitle = 'Member login'; require __DIR__.'/includes/header.php'; ?>

<section class="auth-layout"><div class="auth-aside"><p class="eyebrow">WELCOME BACK</p><h1>Ready for<br><span class="accent">round two?</span></h1><p>Sign in to manage your training, bookings and membership.</p></div>
<div class="panel auth-panel"><h2>Member login</h2><p class="muted">Enter your account details below.</p><div id="message" class="notice" hidden></div>
<form id="login-form"><label>Email address<input type="email" name="email" autocomplete="email" required></label><label>Password<input type="password" name="password" autocomplete="current-password" required></label><button class="btn full" type="submit">Sign in</button></form><p class="form-foot">New to FightClubSA? <a href="register.php">Create an account</a></p></div></section>


<script>
document.getElementById('login-form').addEventListener('submit', async e => {
 e.preventDefault(); const f=e.currentTarget; const b=f.querySelector('button'); b.disabled=true;
 try { const d=Object.fromEntries(new FormData(f)); const r=await api('auth.php',{method:'POST',body:JSON.stringify({...d,action:'login'})}); setSession(r); location.href='dashboard.php'; }
 catch(err){showMessage(err.message,'error');} finally{b.disabled=false;}
});
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
