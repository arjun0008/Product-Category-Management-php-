<?php
require '../includes/protect.php';
require '../config/database.php';
require '../config/security.php';
require '../includes/header.php';

$cats = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<h3 class="mb-3">Categories</h3>

<a href="create.php" class="btn btn-primary mb-3">+ Add Category</a>

<?php if (empty($cats)): ?>

    <div class="alert alert-secondary text-center">
        No products available
    </div>

<?php else: ?>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cats as $c): ?>
        <tr>
            <td><?= e($c['name']) ?></td>
            <td>
                <span class="badge <?= $c['status'] ? 'bg-success' : 'bg-danger' ?>">
                    <?= $c['status'] ? 'Active' : 'Inactive' ?>
                </span>
            </td>
            <td>
                <a href="edit.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">Edit</a>

                <form method="post" action="delete.php" class="d-inline">
                    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete category?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
<?php require '../includes/footer.php'; ?>
