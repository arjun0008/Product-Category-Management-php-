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

$pdo->prepare("DELETE FROM products WHERE id=?")->execute([$id]);

header("Location: list.php");
