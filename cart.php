<?php include __DIR__ . '/includes/header.php'; requireLogin(); $items = cartItems($_SESSION['user_id']); $total = cartTotal($_SESSION['user_id']); ?>
<h1>Your Cart</h1>
<div id="cart-list"><?php foreach($items as $item): ?><div class="cart-item"><span><?= sanitize($item['title']) ?> x <?= (int)$item['quantity'] ?></span><strong><?= formatCurrency($item['price']*$item['quantity']) ?></strong><button class="remove-item" data-cart-id="<?= (int)$item['id'] ?>">Remove</button></div><?php endforeach; ?></div>
<h3>Total: <span id="cart-total"><?= formatCurrency($total) ?></span></h3>
<a class="btn" href="/checkout.php">Proceed to Checkout</a>
<?php include __DIR__ . '/includes/footer.php'; ?>
