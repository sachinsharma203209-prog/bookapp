<?php require_once __DIR__ . '/functions.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Nexus Publishing</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
  <div class="topbar">📚 Free shipping for orders over $50</div>
  <nav class="nav container">
    <a class="logo" href="/index.php">NEXUS</a>
    <div class="links">
      <a href="/shop.php">Shop</a><a href="/about.php">About</a><a href="/contact.php">Contact</a>
      <?php if (isLoggedIn()): ?>
        <a href="/orders.php">Orders</a><a href="/account.php">Account</a><a href="/cart.php">Cart</a>
      <?php else: ?>
        <a href="/login.php">Login</a><a href="/register.php">Register</a>
      <?php endif; ?>
      <a href="/admin-login.php">Admin</a>
    </div>
  </nav>
</header>
<main class="container">
