<?php
require '../includes/protect.php';
require '../config/database.php';
require '../config/security.php';
require '../includes/header.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid request");

$stmt = $pdo->prepare("SELECT * FROM categories WHERE id=?");
$stmt->execute([$id]);
$cat = $stmt->fetch();
if (!$cat) die("Category not found");

if ($_POST) {
    if (!verify_csrf($_POST['csrf'])) die("CSRF blocked");

    $name = clean($_POST['name']);
    $status = $_POST['status'];

    if ($name === '' || !in_array($status, ['0','1'])) {
        die("Invalid input");
    }

    // Update category
    $pdo->prepare(
        "UPDATE categories SET name=?, status=? WHERE id=?"
    )->execute([$name, $status, $id]);

    // CASCADE RULE:
    // If category becomes inactive → deactivate products
    if ($status == '0') {
        $pdo->prepare(
            "UPDATE products SET status=0 WHERE category_id=?"
        )->execute([$id]);
    }

    header("Location: list.php");
    exit;
}
?>

<div class="card">
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" name="name" value="<?= e($cat['name']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                <option value="1" <?= $cat['status']?'selected':'' ?>>Active</option>
                <option value="0" <?= !$cat['status']?'selected':'' ?>>Inactive</option>
                </select>
            </div>
            <button class="btn btn-success">Update</button>
            <a href="list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>
