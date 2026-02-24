<?php require_once __DIR__ . '/../includes/functions.php'; requireAdmin(); $items = books(200); ?>
<!doctype html><html><head><link rel="stylesheet" href="/css/style.css"></head><body><main class="container"><h1>Manage Books</h1>
<form method="post" action="/api/admin.php">
<input type="hidden" name="action" value="add_book">
<input name="title" placeholder="Title" required><input name="author" placeholder="Author" required><input name="price" step="0.01" type="number" placeholder="Price" required><input name="image_url" placeholder="Image URL"><textarea name="description" placeholder="Description"></textarea><button>Add Book</button>
</form>
<?php foreach($items as $book): ?><div class="card"><strong><?= sanitize($book['title']) ?></strong> - <?= formatCurrency((float)$book['price']) ?>
<form method="post" action="/api/admin.php" style="display:inline"><input type="hidden" name="action" value="delete_book"><input type="hidden" name="id" value="<?= (int)$book['id'] ?>"><button>Delete</button></form></div><?php endforeach; ?>
</main></body></html>
