<?php include __DIR__ . '/includes/header.php';
$q = trim($_GET['q'] ?? '');
$items = [];
try {
  if ($q !== '') {
    $stmt = getDB()->prepare('SELECT * FROM books WHERE title LIKE ? OR author LIKE ? ORDER BY created_at DESC');
    $like = "%$q%"; $stmt->execute([$like,$like]); $items = $stmt->fetchAll();
  } else { $items = books(100); }
} catch (Throwable $e) {}
?>
<h1>Book Store</h1>
<form><input name="q" placeholder="Search books" value="<?= sanitize($q) ?>"><button>Search</button></form>
<div class="grid cards"><?php foreach($items as $book): ?><article class="card"><img src="<?= sanitize($book['image_url']) ?>" alt=""><h3><?= sanitize($book['title']) ?></h3><p><?= sanitize($book['author']) ?></p><p><?= formatCurrency((float)$book['price']) ?></p><a href="/product.php?id=<?= (int)$book['id'] ?>">Details</a></article><?php endforeach; ?></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
