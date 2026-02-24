<?php
require_once __DIR__ . '/../includes/functions.php';
if (!isAdmin()) jsonResponse(['error'=>'Unauthorized'],401);
$action = $_POST['action'] ?? '';
$db = getDB();
if ($action === 'add_book') {
  $stmt = $db->prepare('INSERT INTO books(title,author,description,price,image_url) VALUES (?,?,?,?,?)');
  $stmt->execute([sanitize($_POST['title']),sanitize($_POST['author']),sanitize($_POST['description'] ?? ''),(float)$_POST['price'],sanitize($_POST['image_url'] ?? '')]);
  header('Location: /admin/books.php'); exit;
}
if ($action === 'update_book') {
  $stmt = $db->prepare('UPDATE books SET title=?,author=?,description=?,price=?,image_url=? WHERE id=?');
  $stmt->execute([sanitize($_POST['title']),sanitize($_POST['author']),sanitize($_POST['description'] ?? ''),(float)$_POST['price'],sanitize($_POST['image_url'] ?? ''),(int)$_POST['id']]);
  jsonResponse(['ok'=>true]);
}
if ($action === 'delete_book') {
  $db->prepare('DELETE FROM books WHERE id=?')->execute([(int)$_POST['id']]);
  header('Location: /admin/books.php'); exit;
}
if ($action === 'get_books') jsonResponse(['books'=>books(500)]);
jsonResponse(['error'=>'Unknown action'],400);
