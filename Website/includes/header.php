<?php
$pageTitle = $pageTitle ?? 'FightClubSA';
$activePage = basename($_SERVER['PHP_SELF'] ?? '');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#151515">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | FightClubSA</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/app.js" defer></script>
</head>
<body>
<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="index.php"><span class="brand-mark">FC</span><span>FIGHTCLUB<span class="accent">SA</span></span></a>
    <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false">☰</button>
    <nav class="main-nav">
      <a href="index.php">Home</a>
      <a href="classes.php">Classes</a>
      <a href="timetable.php">Timetable</a>
      <a href="membership.php">Membership</a>
      <a href="dashboard.php" data-member-link>Dashboard</a>
      <a href="login.php" data-guest-link>Login</a>
      <a href="register.php" class="nav-cta" data-guest-link>Join Now</a>
      <button type="button" class="nav-link-button" data-logout hidden>Logout</button>
    </nav>
  </div>
</header>
<main class="container">
