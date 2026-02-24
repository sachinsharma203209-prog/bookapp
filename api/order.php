<?php
require_once __DIR__ . '/../includes/functions.php';
if (!isLoggedIn()) jsonResponse(['error'=>'Unauthorized'],401);
$action = $_POST['action'] ?? '';
$db = getDB();
$userId = (int)$_SESSION['user_id'];
if ($action === 'place') {
  $items = cartItems($userId); if (!$items) { header('Location:/cart.php'); exit; }
  $total = cartTotal($userId);
  $db->beginTransaction();
  $stmt = $db->prepare('INSERT INTO orders(user_id,total_amount,shipping_address,payment_method,status) VALUES (?,?,?,?,?)');
  $stmt->execute([$userId,$total,sanitize($_POST['shipping_address'] ?? ''),sanitize($_POST['payment_method'] ?? 'card'),'placed']);
  $orderId = (int)$db->lastInsertId();
  $itemStmt = $db->prepare('INSERT INTO order_items(order_id,book_id,quantity,price) VALUES (?,?,?,?)');
  foreach ($items as $i) $itemStmt->execute([$orderId,$i['book_id'],$i['quantity'],$i['price']]);
  $db->prepare('DELETE FROM cart WHERE user_id=?')->execute([$userId]);
  $db->commit();
  header('Location: /orders.php'); exit;
}
if ($action === 'get_user_orders') { $s=$db->prepare('SELECT * FROM orders WHERE user_id=?'); $s->execute([$userId]); jsonResponse(['orders'=>$s->fetchAll()]); }
jsonResponse(['error'=>'Unknown action'],400);
