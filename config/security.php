<?php
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function clean($str) {
    return trim(strip_tags($str));
}

function csrf_token() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function verify_csrf($token) {
    return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}
