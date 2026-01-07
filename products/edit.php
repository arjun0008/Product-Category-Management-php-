<?php
require '../includes/protect.php';
require '../config/database.php';
require '../config/security.php';
require '../includes/header.php';

$id = $_GET['id'];
$p = $pdo->prepare("SELECT * FROM products WHERE id=?");
$p->execute([$id]);
$prod = $p->fetch();

$cats = $pdo->query("SELECT * FROM categories WHERE status=1")->fetchAll();

if ($_POST) {
    if (!verify_csrf($_POST['csrf'])) die("CSRF");

    $pdo->prepare("
    UPDATE products SET name=?,description=?,price=?,category_id=?,status=?
    WHERE id=?
    ")->execute([
        clean($_POST['name']),
        clean($_POST['description']),
        $_POST['price'],
        $_POST['category_id'],
        $_POST['status'],
        $id
    ]);
    header("Location: list.php");
}
?>

<div class="card">
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" name="name" value="<?= e($prod['name']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description"><?= e($prod['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input class="form-control" type="number" step="0.01" name="price" value="<?= $prod['price'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-select" name="category_id">
                <?php foreach ($cats as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $c['id']==$prod['category_id']?'selected':'' ?>>
                <?= e($c['name']) ?>
                </option>
                <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                <option value="1" <?= $prod['status']?'selected':'' ?>>Active</option>
                <option value="0" <?= !$prod['status']?'selected':'' ?>>Inactive</option>
                </select>
            </div>
            <button class="btn btn-success">Update</button>
            <a href="list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php require '../includes/footer.php'; ?>
