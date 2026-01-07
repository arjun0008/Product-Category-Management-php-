<?php
require '../includes/protect.php';
require '../config/database.php';
require '../includes/header.php';

$cat = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$prod = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$active = $pdo->query("SELECT COUNT(*) FROM products WHERE status=1")->fetchColumn();
$inactive = $pdo->query("SELECT COUNT(*) FROM products WHERE status=0")->fetchColumn();
?>

<h3 class="mb-4">Dashboard</h3>

<div class="row">
    <div class="col-md-3">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h6>Categories</h6>
                <h3><?= $cat ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-secondary mb-3">
            <div class="card-body">
                <h6>Products</h6>
                <h3><?= $prod ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h6>Active Products</h6>
                <h3><?= $active ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-danger mb-3">
            <div class="card-body">
                <h6>Inactive Products</h6>
                <h3><?= $inactive ?></h3>
            </div>
        </div>
    </div>
</div>


<?php require '../includes/footer.php'; ?>
