<?php include __DIR__ . '/includes/header.php';
$list = [];
try { $list = books(4); } catch (Throwable $e) {}
?>
<section class="hero"><h1>Discover Your Next Favorite Book</h1><p>Premium collection curated by Nexus Publishing.</p><a class="btn" href="/shop.php">Shop Now</a></section>
<section><h2>New Arrivals</h2><div class="grid cards">
<?php foreach ($list as $book): ?>
<article class="card"><img src="<?= sanitize($book['image_url']) ?>" alt=""><h3><?= sanitize($book['title']) ?></h3><p><?= formatCurrency((float)$book['price']) ?></p><a href="/product.php?id=<?= (int)$book['id'] ?>">View</a></article>
<?php endforeach; if (!$list): ?><p>Set up database to load products.</p><?php endif; ?>
</div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
