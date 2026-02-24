<?php include __DIR__ . '/includes/header.php'; requireLogin(); $user = currentUser(); ?>
<h1>My Account</h1>
<p>Name: <?= sanitize($user['name'] ?? '') ?></p>
<p>Email: <?= sanitize($user['email'] ?? '') ?></p>
<form method="post" action="/api/auth.php"><input type="hidden" name="action" value="logout"><button>Logout</button></form>
<?php include __DIR__ . '/includes/footer.php'; ?>
