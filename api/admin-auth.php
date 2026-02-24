<?php
require_once __DIR__ . '/../includes/functions.php';
$action = $_POST['action'] ?? 'login';
if ($action === 'logout') { unset($_SESSION['admin_id']); header('Location:/admin-login.php'); exit; }
$stmt = getDB()->prepare('SELECT id,password_hash FROM admin_users WHERE username=?');
$stmt->execute([sanitize($_POST['username'] ?? '')]);
$admin = $stmt->fetch();
if ($admin && password_verify($_POST['password'] ?? '', $admin['password_hash'])) {
    $_SESSION['admin_id'] = (int)$admin['id'];
    header('Location: /admin/index.php'); exit;
}
header('Location: /admin-login.php?error=1');
