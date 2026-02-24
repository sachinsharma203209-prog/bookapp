<?php
require_once __DIR__ . '/../includes/functions.php';
if (($_POST['action'] ?? '') !== 'submit') jsonResponse(['error'=>'Unknown action'],400);
$stmt = getDB()->prepare('INSERT INTO contact_messages(name,email,message) VALUES (?,?,?)');
$stmt->execute([sanitize($_POST['name']),sanitize($_POST['email']),sanitize($_POST['message'])]);
header('Location: /contact.php?sent=1');
