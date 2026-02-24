<?php include __DIR__ . '/includes/header.php'; ?>
<h1>Contact Us</h1>
<form method="post" action="/api/contact.php">
<input type="hidden" name="action" value="submit">
<input name="name" placeholder="Name" required><input type="email" name="email" placeholder="Email" required>
<textarea name="message" placeholder="Message" required></textarea><button>Send</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
