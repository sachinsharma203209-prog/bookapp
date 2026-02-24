<?php
require_once __DIR__ . '/../includes/functions.php';
$action = $_POST['action'] ?? '';
try {
    if ($action === 'register') {
        $name = sanitize($_POST['name'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $stmt = getDB()->prepare('INSERT INTO users(name,email,password_hash) VALUES (?,?,?)');
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT)]);
        $_SESSION['user_id'] = (int)getDB()->lastInsertId();
        header('Location: /index.php'); exit;
    }
    if ($action === 'login') {
        $stmt = getDB()->prepare('SELECT id,password_hash FROM users WHERE email=?');
        $stmt->execute([sanitize($_POST['email'] ?? '')]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($_POST['password'] ?? '', $user['password_hash'])) {
            throw new Exception('Invalid credentials');
        }
        $_SESSION['user_id'] = (int)$user['id'];
        header('Location: /index.php'); exit;
    }
    if ($action === 'logout') {
        unset($_SESSION['user_id']);
        header('Location: /index.php'); exit;
    }
    jsonResponse(['error' => 'Unknown action'], 400);
} catch (Throwable $e) {
    if (str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')) jsonResponse(['error' => $e->getMessage()], 400);
    header('Location: /login.php?error=1');
}
