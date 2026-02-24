<?php include __DIR__ . '/includes/header.php'; requireLogin(); $stmt = getDB()->prepare('SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC'); $stmt->execute([$_SESSION['user_id']]); $orders = $stmt->fetchAll(); ?>
<h1>Order History</h1>
<?php foreach($orders as $o): ?><div class="card"><p>Order #<?= (int)$o['id'] ?> - <?= sanitize($o['status']) ?> - <?= formatCurrency((float)$o['total_amount']) ?></p></div><?php endforeach; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>
