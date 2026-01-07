<?php
session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/index.php");
    exit;
}
