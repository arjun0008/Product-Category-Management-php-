<?php
require '../includes/protect.php';
require '../config/database.php';
require '../config/security.php';
require '../includes/header.php';

$cats = $pdo->query("SELECT * FROM categories WHERE status=1")->fetchAll();

if ($_POST) {
    if (!verify_csrf($_POST['csrf'])) die("CSRF");

    $pdo->prepare("
    INSERT INTO products (name,description,price,category_id,status)
    VALUES (?,?,?,?,?)
    ")->execute([
        clean($_POST['name']),
        clean($_POST['description']),
        $_POST['price'],
        $_POST['category_id'],
        $_POST['status']
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
                <input name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input class="form-control" type="number" step="0.01" name="price">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                <?php foreach ($cats as $c): ?>
                <option value="<?= $c['id'] ?>"><?= e($c['name']) ?></option>
                <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
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
