<?php
require_once __DIR__ . '/../includes/functions.php';
if (!isLoggedIn()) jsonResponse(['error'=>'Unauthorized'],401);
$action = $_POST['action'] ?? '';
$userId = (int)$_SESSION['user_id'];
$db = getDB();
if ($action === 'add') {
  $bookId = (int)($_POST['book_id'] ?? 0);
  $qty = max(1, (int)($_POST['quantity'] ?? 1));
  $stmt = $db->prepare('INSERT INTO cart(user_id,book_id,quantity) VALUES (?,?,?) ON DUPLICATE KEY UPDATE quantity=quantity+VALUES(quantity)');
  $stmt->execute([$userId,$bookId,$qty]);
  jsonResponse(['ok'=>true]);
}
if ($action === 'remove') {
  $stmt = $db->prepare('DELETE FROM cart WHERE id=? AND user_id=?');
  $stmt->execute([(int)($_POST['cart_id'] ?? 0),$userId]);
  jsonResponse(['ok'=>true]);
}
if ($action === 'update') {
  $stmt = $db->prepare('UPDATE cart SET quantity=? WHERE id=? AND user_id=?');
  $stmt->execute([max(1,(int)$_POST['quantity']),(int)$_POST['cart_id'],$userId]);
  jsonResponse(['ok'=>true]);
}
if ($action === 'get') jsonResponse(['items'=>cartItems($userId),'total'=>cartTotal($userId)]);
jsonResponse(['error'=>'Unknown action'],400);
