<?php
session_start();
require_once __DIR__ . '/../config/database.php';

function jsonResponse(array $data, int $status = 200): void {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function sanitize(string $value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function isLoggedIn(): bool { return isset($_SESSION['user_id']); }
function isAdmin(): bool { return isset($_SESSION['admin_id']); }

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: /login.php');
        exit;
    }
}

function requireAdmin(): void {
    if (!isAdmin()) {
        header('Location: /admin-login.php');
        exit;
    }
}

function currentUser(): ?array {
    if (!isLoggedIn()) return null;
    $stmt = getDB()->prepare('SELECT id, name, email, created_at FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}

function books(int $limit = 12): array {
    $stmt = getDB()->prepare('SELECT * FROM books ORDER BY created_at DESC LIMIT ?');
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function bookById(int $id): ?array {
    $stmt = getDB()->prepare('SELECT * FROM books WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function cartItems(int $userId): array {
    $sql = 'SELECT c.id, c.quantity, b.id AS book_id, b.title, b.price, b.image_url
            FROM cart c JOIN books b ON c.book_id = b.id WHERE c.user_id = ?';
    $stmt = getDB()->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

function cartTotal(int $userId): float {
    $stmt = getDB()->prepare('SELECT COALESCE(SUM(c.quantity * b.price),0) t FROM cart c JOIN books b ON c.book_id=b.id WHERE c.user_id=?');
    $stmt->execute([$userId]);
    return (float)($stmt->fetch()['t'] ?? 0);
}

function formatCurrency(float $amount): string {
    return '$' . number_format($amount, 2);
}
