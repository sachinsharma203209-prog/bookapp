<?php include __DIR__ . '/includes/header.php';
$id = (int)($_GET['id'] ?? 0); $book = null; try {$book = bookById($id);} catch (Throwable $e) {}
if (!$book) { echo '<p>Book not found.</p>'; include __DIR__ . '/includes/footer.php'; exit; }
?>
<section class="product"><img src="<?= sanitize($book['image_url']) ?>" alt=""><div><h1><?= sanitize($book['title']) ?></h1><p>By <?= sanitize($book['author']) ?></p><p><?= sanitize($book['description']) ?></p><h3><?= formatCurrency((float)$book['price']) ?></h3><?php if(isLoggedIn()): ?><button class="btn add-to-cart" data-book-id="<?= (int)$book['id'] ?>">Add to Cart</button><?php else: ?><a class="btn" href="/login.php">Login to buy</a><?php endif; ?></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
