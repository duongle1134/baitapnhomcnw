<?php include 'header.php'; ?>
<?php include 'products.php'; ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-75">
        <!-- Tiêu đề và nút thêm mới -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Danh Sách Sản Phẩm</h1>
            <a href="add_product.php" class="btn btn-lg btn-success">+ Thêm mới</a>
        </div>

        <!-- Bảng danh sách sản phẩm -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" style="width: 40%;">Sản phẩm</th>
                        <th class="text-center" style="width: 20%;">Giá thành</th>
                        <th class="text-center" style="width: 10%;">Sửa</th>
                        <th class="text-center" style="width: 10%;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($product['price']) ?> VND</td>
                        <td class="text-center">
                            <a href="edit_product.php?id=<?= $product['id'] ?>" class="text-primary fs-4">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="delete_product.php?id=<?= $product['id'] ?>" class="text-danger fs-4">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>