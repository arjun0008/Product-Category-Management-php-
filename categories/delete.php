<?php
require '../includes/protect.php';
require '../config/database.php';
require '../config/security.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

if (!verify_csrf($_POST['csrf'])) {
    die("CSRF blocked");
}

$id = $_POST['id'] ?? null;
if (!$id) die("Invalid ID");

// Optional safety: block delete if products exist
$stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id=?");
$stmt->execute([$id]);

if ($stmt->fetchColumn() > 0) {
    die("Cannot delete category with products");
}

$pdo->prepare("DELETE FROM categories WHERE id=?")->execute([$id]);

header("Location: list.php");
