<?php include __DIR__ . '/includes/header.php'; ?>
<h1>Admin Login</h1>
<form method="post" action="/api/admin-auth.php">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button>Login</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
