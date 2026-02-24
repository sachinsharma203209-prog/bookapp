<?php include __DIR__ . '/includes/header.php'; ?>
<h1>Login</h1>
<form method="post" action="/api/auth.php">
<input type="hidden" name="action" value="login">
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button>Login</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
