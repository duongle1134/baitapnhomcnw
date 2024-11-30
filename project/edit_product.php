<?php
include 'products.php';

// Lấy sản phẩm cần sửa
$id = $_GET['id'] ?? null;
$product = null;

foreach ($products as $p) {
    if ($p['id'] == $id) {
        $product = $p;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Cập nhật thông tin sản phẩm
    foreach ($products as &$p) {
        if ($p['id'] == $id) {
            $p['name'] = $name;
            $p['price'] = $price;
            break;
        }
    }

    // Lưu lại sản phẩm
    saveProducts($products);

    // Quay về trang chính
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Sửa sản phẩm</h1>
    <?php if ($product): ?>
        <form method="POST" action="edit_product.php?id=<?= $id ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    <?php else: ?>
        <p class="text-danger">Không tìm thấy sản phẩm.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
