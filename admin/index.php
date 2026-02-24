<?php require_once __DIR__ . '/../includes/functions.php'; requireAdmin();
$stats = ['books'=>0,'users'=>0,'orders'=>0,'sales'=>0];
$stats['books'] = (int)getDB()->query('SELECT COUNT(*) c FROM books')->fetch()['c'];
$stats['users'] = (int)getDB()->query('SELECT COUNT(*) c FROM users')->fetch()['c'];
$stats['orders'] = (int)getDB()->query('SELECT COUNT(*) c FROM orders')->fetch()['c'];
$stats['sales'] = (float)getDB()->query('SELECT COALESCE(SUM(total_amount),0) s FROM orders')->fetch()['s'];
?>
<!doctype html><html><head><link rel="stylesheet" href="/css/style.css"></head><body><main class="container"><h1>Admin Dashboard</h1><div class="grid cards"><div class="card">Books: <?= $stats['books'] ?></div><div class="card">Users: <?= $stats['users'] ?></div><div class="card">Orders: <?= $stats['orders'] ?></div><div class="card">Sales: <?= formatCurrency($stats['sales']) ?></div></div><p><a href="/admin/books.php">Manage Books</a></p><form method="post" action="/api/admin-auth.php"><input type="hidden" name="action" value="logout"><button>Logout</button></form></main></body></html>
