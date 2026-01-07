<?php
require '../includes/protect.php';
require '../config/database.php';
require '../config/security.php';
require '../includes/header.php';

if ($_POST) {
    if (!verify_csrf($_POST['csrf'])) die("CSRF");

    $name = clean($_POST['name']);
    $status = $_POST['status'];

    if ($name && in_array($status, ['0','1'])) {
        $pdo->prepare("INSERT INTO categories (name,status) VALUES (?,?)")
            ->execute([$name,$status]);
        header("Location: list.php");
        exit;
    }
}
?>

<div class="card">
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control" name="name">
                </div>    
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            <button class="btn btn-success">Create</button>
            <a href="list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>
