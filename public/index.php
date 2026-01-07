<?php
session_start();
require '../config/database.php';
require '../config/security.php';
require '../includes/header.php';

$error = '';

if ($_POST) {
    if (!verify_csrf($_POST['csrf'])) die("CSRF blocked");

    $u = clean($_POST['username']);
    $p = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$u]);
    $user = $stmt->fetch();

    if ($user && password_verify($p, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    }
    $error = "Invalid login";
}
?>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm mt-5">
            <div class="card-body">
                <h4 class="text-center mb-3">Login</h4>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="post">
                    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

                    <div class="mb-3">
                        <input class="form-control" name="username" placeholder="Username">
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>

                    <button class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require '../includes/footer.php'; ?>
