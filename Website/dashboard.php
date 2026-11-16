<?php $pageTitle = 'Member dashboard'; require __DIR__.'/includes/header.php'; ?>

<section class="page-heading"><p class="eyebrow">MEMBER AREA</p><h1 id="welcome">Your dashboard</h1><p class="muted">Your FightClubSA activity at a glance.</p></section>
<div class="stat-grid"><article class="stat-card"><span>Upcoming bookings</span><strong id="booking-count">—</strong></article><article class="stat-card"><span>Unread notifications</span><strong id="notification-count">—</strong></article><article class="stat-card"><span>Membership</span><strong id="membership-status">—</strong></article></div>
<div class="card-grid dashboard-links">
<a class="feature-card" href="classes.php"><div class="feature-icon">🥊</div><h3>Find a class</h3><p>Browse training sessions and reserve your place.</p></a>
<a class="feature-card" href="bookings.php"><div class="feature-icon">📅</div><h3>My bookings</h3><p>Review or cancel your booked sessions.</p></a>
<a class="feature-card" href="membership.php"><div class="feature-icon">🎟</div><h3>Membership</h3><p>Check your current membership information.</p></a>
<a class="feature-card" href="profile.php"><div class="feature-icon">👤</div><h3>My profile</h3><p>Keep your contact details up to date.</p></a>
<a class="feature-card" href="payments.php"><div class="feature-icon">💳</div><h3>Payments</h3><p>Review your payment history.</p></a>
<a class="feature-card" href="notifications.php"><div class="feature-icon">🔔</div><h3>Notifications</h3><p>See updates about your account.</p></a>
</div><div id="message" class="notice" hidden></div>


<script>
requireLogin(); document.getElementById('welcome').textContent='Welcome, '+(getUser()?.full_name||'member');
(async()=>{try{const [b,n,m]=await Promise.all([api('bookings.php'),api('notifications.php'),api('membership.php')]);document.getElementById('booking-count').textContent=b.bookings.filter(x=>x.status==='booked'&&x.class_date>=new Date().toISOString().slice(0,10)).length;document.getElementById('notification-count').textContent=n.notifications.filter(x=>!Number(x.is_read)).length;document.getElementById('membership-status').textContent=m.membership?.status||'Not active';}catch(e){showMessage(e.message,'error');}})();
</script>

<?php require __DIR__.'/includes/footer.php'; ?>
