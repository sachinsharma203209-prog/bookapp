<?php include __DIR__ . '/includes/header.php'; ?>
<h1>Register</h1>
<form method="post" action="/api/auth.php">
<input type="hidden" name="action" value="register">
<input name="name" placeholder="Full name" required>
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button>Create account</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
