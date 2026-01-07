<?php
require '../includes/protect.php';
require '../config/database.php';
require '../config/security.php';
require '../includes/header.php';

$products = $pdo->query("
SELECT p.*, c.name AS category
FROM products p
JOIN categories c ON p.category_id=c.id
")->fetchAll();
?>

<h3 class="mb-3">Products</h3>

<a href="create.php" class="btn btn-primary mb-3">+ Add Product</a>

<?php if (empty($products)): ?>

    <div class="alert alert-secondary text-center">
        No products available
    </div>

<?php else: ?>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Status</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= e($p['name']) ?></td>
            <td><?= e($p['description']) ?></td>
            <td><?= e($p['category']) ?></td>
            <td>₹<?= number_format($p['price'], 2) ?></td>
            <td>
                <span class="badge <?= $p['status'] ? 'bg-success' : 'bg-danger' ?>">
                    <?= $p['status'] ? 'Active' : 'Inactive' ?>
                </span>
            </td>
            <td>
                <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>

                <form method="post" action="delete.php" class="d-inline">
                    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete product?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
<?php require '../includes/footer.php'; ?>
