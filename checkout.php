<?php include __DIR__ . '/includes/header.php'; requireLogin(); $total = cartTotal($_SESSION['user_id']); ?>
<h1>Checkout</h1><p>Order total: <strong><?= formatCurrency($total) ?></strong></p>
<form method="post" action="/api/order.php">
<input type="hidden" name="action" value="place">
<input name="shipping_address" placeholder="Shipping address" required>
<select name="payment_method"><option>card</option><option>cod</option></select>
<button>Place Order</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
